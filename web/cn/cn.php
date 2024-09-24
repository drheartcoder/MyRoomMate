<?php
//=================================================================
// AdFreely -Ad Board script-
// Copyright (c) phpkobo.com ( http://www.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : AF201_206
//
// This software is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; version 2 of the
// License.
//
// [Installation Guide]
// http://www.phpkobo.com/doc.php?d=install&p=AF201_206
//
//=================================================================

	error_reporting( 0 );
	require( 'common.inc.php' );
	$sys =& CVSystem::SetupSystem();
	$sys->SetUserType( UT_GUEST );

//---------------------------------------------------------------
// getCellTxt
//---------------------------------------------------------------
function getCellTxt( $ad_id )
{
	global $sys;

	$cell = array();

	$db =& $sys->DB;
	$table_name = TBL_CELL;
	$ls = array( "cell_id",
		"image_w",
		"image_h",
		"pic",
		"url_link",
	);
	$qc = array(
		"active= 'Y'",
		"ad_id='" . $db->Sanitize($ad_id) . "'"
	);
	$sql = $db->GetSQLSelect( $table_name, $ls, $qc ) . " LIMIT 1;" ;
	$result = $db->Query( $sql );
	if ( $rs = $db->GetRowA( $result ) )
	{
		$cell_id = sprintf( "%d", $rs['cell_id'] );
		$image_w = sprintf( "%d", $rs['image_w'] );
		$image_h = sprintf( "%d", $rs['image_h'] );
		$pic = $rs['pic'];
		$url_link = CStr::n2e( $rs['url_link'] );
	}
	$db->FreeResult( $result );

	if ( isset( $cell_id ) )
	{
		if ( !is_null( $pic ) )
		{
			$obj =& CUtil::CreateObject( "cls_pic_up" );
			$obj->Setup();
			$obj->SetVal( $pic );
			$obj->SetDBData();
			$url_image = $obj->GetFileUrl( true );

			ob_start();
			include( dirname(__FILE__) . "/include/tpl.image_cell.inc.php" );
			$txt = ob_get_contents();
			ob_end_clean();
		}
		else
		{
			ob_start();
			include( dirname(__FILE__) . "/include/tpl.empty_cell.inc.php" );
			$txt = ob_get_contents();
			ob_end_clean();
		}
	}
	else
	{
		ob_start();
		include( dirname(__FILE__) . "/include/tpl.wrong_cell.inc.php" );
		$txt = ob_get_contents();
		ob_end_clean();
	}

	//-- No CR,LF are allowed
	$txt = str_replace( "\r", " ", $txt );
	$txt = str_replace( "\n", " ", $txt );

	return $txt;
}

//---------------------------------------------------------------
// switch
//---------------------------------------------------------------
if ( !isset( $_GET['cid'] ) )
	$cid = '';
else
	$cid = $_GET['cid'];

switch( $cid )
{
//---------------------------------------------------------------
// default
//---------------------------------------------------------------
default:
	//-- [BEGIN] About
	echo "/*" . 
	RSTR_APP_HOMEPAGE_URL . " " . 
	RSTR_APP_TITLE . " " . 
	RSTR_APP_VERSION .
	" */";
	//-- [END] About

	$path = dirname( CUtil::GetCurrentPageURL() ) . '/';

	$cr = "\r\n";
	$s = '';
	$s .= "<link rel='stylesheet' type='text/css' href='{$path}css/cell.css' />{$cr}";
	$s .= "<link rel='stylesheet' type='text/css' href='{$path}css/custom-theme/jquery-ui-1.8.2.custom.css' />{$cr}";
	$s .= "<script type='text/javascript' src='{$path}js/jquery-1.4.2.min.js'></script>{$cr}";
	$s .= "<script type='text/javascript' src='{$path}js/jquery-ui-1.8.2.custom.min.js'></script>{$cr}";
	$s .= "<script type='text/javascript' src='{$path}cn.php?cid=js'></script>{$cr}";
	echo CUtil::JSDocumentWrite( $s );
	break;

//---------------------------------------------------------------
// get
//---------------------------------------------------------------
case 'get':
	if ( !isset( $_REQUEST['id_list'] ) )
		$id_list = '';
	else
		$id_list = $_REQUEST['id_list'];

	$ax = explode( "," , $id_list );
	$bx = array();
	foreach( $ax as $ad_id )
	{
		$ad_id = trim( $ad_id );
		if ( $ad_id != '' )
		{
			$bx[] = "\"" . $ad_id . "\":\"" . getCellTxt( $ad_id ) . "\"";
		}
	}
	$s = "{" . implode( ", ", $bx ) . "}";
	echo $s;
	break;

//---------------------------------------------------------------
// js
//---------------------------------------------------------------
case 'js':

	$path = dirname( CUtil::GetCurrentPageURL() ) . '/';
	$sig = CUtil::CreateRandomString( 20 );
?>

var sel_ad_id = undefined;
var newJQuery = jQuery.noConflict(), oldJQuery = jQuery;

//-- jQuery incorrectly tells chrome is safari
//-- So you need to exclude the chrome case
function isSafari()
{
	if ( newJQuery.browser.safari )
	{
		var is_chrome = /chrome/.test( navigator.userAgent.toLowerCase() );
		if ( !is_chrome )
		{
			return true;
		}
	}
	return false;
}

function randomString( string_length )
{
	var chars = "ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var randomstring = '';
	for (var i = 0; i < string_length; i++ )
	{
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	return randomstring;
}

function iframe_success()
{
	setupCells( sel_ad_id );
}

function iframe_close()
{
	(function ($) {
		$( "#adfreely_dlg" ).dialog( "close" );
	}(newJQuery));
}

function setupCells( idlist )
{
	(function ($) {
		$.ajax({
			type: "POST",
			url: '<?php echo $path; ?>cn.php?cid=get',
			data: "id_list=" + idlist,
			success: function( data ) {
				var d = eval( '(' + data + ')' );
				$( '.adfreely' ).each( function(index) {
					var ad_id = $(this).attr( 'rel' );
					$(this).html( d[ad_id] );
				});

				var w = 710;
				var h = 510;

				//$( "a.cell_link" ).unbind('click');
				$( "a.cell_link" ).click( function(event) {
					sel_ad_id = $(this).attr( 'rel' );

					var config = {
						modal: true,
						draggable: false,
						resizable: false,
						title: '<?php echo RSTR_REGDLG_TITLE; ?>&nbsp;&nbsp;&nbsp;[ ' + sel_ad_id + ' ]',
						width: w,
						height: h,
						close: function(event, ui) {
							$( "#adfreely_dlg" ).html( '' );
						}
					}

					//-- In case of Safari, specify the
					//-- initial position of dialog box
					if ( isSafari() )
					{
						config['position'] = [10,10];
					}

					$( "#adfreely_dlg" ).dialog(config);

					//-- random id for Safari
					var s =
						"<iframe id='" + randomString( 20 ) +
						"' src='<?php echo dirname( $path ) . '/'; ?>reg/index.php?ad_id=" + sel_ad_id +
						"' width='" + (w-40) + "' height='" + (h-65) + "' " +
						"frameborder='0' scrolling='no'></iframe>";

					$( "#adfreely_dlg" ).html( s );

					event.preventDefault();
				});
			}
		});
	}(newJQuery));
}

(function ($) {
	$(document).ready(function() {
		$('body').append( "<div id='adfreely_dlg' style='display:none;'></div>" );

		var s = '';
		$( '.adfreely' ).each( function(index) {
			if ( s != '' ) s += ',';
			s += $(this).attr( 'rel' );
		});
		setupCells( s );
	});
}(newJQuery));

<?php
	break;
}

?>
