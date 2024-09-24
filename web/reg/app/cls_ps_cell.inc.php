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
define( 'MAX_HEIGHT', 200 );

//----------------------------------------------------------------
// cls_ps_cell
//----------------------------------------------------------------
class cls_ps_cell extends cls_ps_base
{
	var $fs_name = 'cell';
	var $fs_reg_init = "(g_reg_init)";
	var $fs_reg_page1 = "(g_reg_page1)";
	var $fs_reg_page2 = "(g_reg_page2)";
	var $fs_reg_page3R = "(g_reg_page3R)";
	var $fs_reg_page3U = "(g_reg_page3U)";
	var $fs_reg_page4R = "(g_reg_page4R)";
	var $fs_reg_page4U = "(g_reg_page4U)";
	var $fs_reg_page5 = "(g_reg_page5)";
	var $fs_reg_page6 = "(g_reg_page1),(g_reg_page2),(g_reg_page3U),(g_reg_page3R),
			(g_reg_page4R),(g_reg_page5),(g_reg_save),(edit_save)";
	var $config_email = "config.email.form.php";

	//------------------------------------------------------------
	// GetFilePrefix
	//------------------------------------------------------------
	function GetFilePrefix()
	{
		return "cell";
	}

	//------------------------------------------------------------
	// CommandProc
	//------------------------------------------------------------
	function CommandProc( &$sc )
	{
		$pagesig_key = 'pagesig:' . get_class( $this );

		$def =& $this->GetFieldList( $this->fs_name );

		//-- [BEGIN] Width, Height
		$def->SetNS( 'rs:def:' );
		$def->SetList( "+image_w,+image_h" );
		$def->FromState();
		$obj = $def->GetChild( "image_w" );
		$image_w = $obj->GetVal();
		$this->sys->image_w = $image_w;
		$obj = $def->GetChild( "image_h" );
		$image_h = $obj->GetVal();
		$this->sys->image_h = $image_h;
		//-- [END] Width, Height

		$cmd = $sc->Cmd();

		switch( $cmd )
		{

		//------------------------------------------------------
		// Reg Init
		//------------------------------------------------------
		case 'reg_init':

			//-- [BEGIN] Set PageID
			$sc->SetPageID( "reg_init" );
			//-- [END] Set PageID

			//-- [BEGIN] Mark PageSig
			$this->sys->PageSig->Mark( $pagesig_key );
			//-- [END] Mark PageSig

			//-- [BEGIN] Set init values
			$def->SetNS( "rs:def:" );
			$def->SetList( $this->fs_reg_init );
			$def->SetEmpty();
			$def->FromInitValue( 'reg' );

			$iv = $def->GetInitValues();
			if ( $iv != null )
			{
				foreach( $iv as $key=>$val )
				{
					$obj = $def->GetChild( $key );
					$obj->SetVal( $val );
				}
			}

			$ad_id = $this->sys->GetIV('ad_id');
			if ( $ad_id == '' )
			{
				echo "Invalid Ad ID [emp]";
				die;
			}

			$obj = $def->GetChild('ad_id');
			$obj->SetVal( $this->sys->GetIV('ad_id') );

			$def->ToState();
			//-- [END] Set init values

			//-- [BEGIN] Load data from database to state
			$def->SetNS( 'rs:def:' );
			$def->SetList( "+ad_id" );
			$qc = $def->GetQueryCond();

			//-- Read data from database
			$def->SetNS( "rs:def:" );
			$def->SetList( "(staff)" );
			if ( !$def->FromRecordSet( $qc, false ) )
			{
				$obj = $def->GetChild('ad_id');
				$ad_id = $obj->GetVal();

				echo "Invalid Ad ID {$ad_id}";
				die;
			}
			$def->ToState();
			//-- [END] Load data from database to state

			$this->CheckAdIDConflict( $def );

			//-- [BEGIN] Go
			$sc->SetNextSc( "reg_page3U" );
			//-- [END] Go

			break;

		//------------------------------------------------------
		// Page3U 
		//------------------------------------------------------
		case 'reg_page3U':

			//-- [BEGIN] Validate the previous PageID and set the current PageID
			if ( !$sc->CheckPrevPageID(
				array( "reg_init", "reg_page3U", "reg_page4U" )
			) ) break;
			$sc->SetPageID( "reg_page3U" );
			//-- [END] Validate the previous PageID and set the current PageID

			//-- [BEGIN] Load data from state
			$def->SetNS( "rs:def:" );
			$def->SetList( $this->fs_reg_page3U );
			$def->FromState();
			//-- [END] Load data from state

			$this->NormalizePicSize( $def );

			//-- [BEGIN] Output
			$def->ToZBuffer( XC_OF_INPUT );
			//-- [END] Output

			//-- [BEGIN] Set display on
			$this->SetDisplay( "def:", true );
			//-- [END] Set display on

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "reg_page3U" );
			//-- [END] Set template page

			break;

		case 'reg_page3U_prev':

			//-- [BEGIN] Load data from input to state and validate
			$def->SetNS( 'rs:def:' );
			$def->SetList( $this->fs_reg_page3U );
			$def->FromInput();
			$def->ToState();
			//-- [END] Load data from input to state and validate

			//-- [BEGIN] Go to page2 
			$sc->SetNextSc( "reg_page2" );
			//-- [END] Go to page2 

			break;

		case 'reg_page3U_next':

			//-- [BEGIN] Set return page
			$sc->SetNextSc( "reg_page3U" );
			//-- [END] Set return page

			//-- [BEGIN] Load data from input to state and validate
			$def->SetNS( 'rs:def:' );
			$def->SetList( $this->fs_reg_page3U );
			$def->FromInput();
			$def->ToState();
			if ( !$def->ValidateX( XPT_INPUT ) ) break;
			//-- [END] Load data from input to state and validate

			//-- [BEGIN] Upload File
			$fileup_key = "pic"; //$this->sys->GetIV( 'fileup_key' );
			$obj = $def->GetChild( $fileup_key );
			if ( $obj->GetState() == FILEUP_EMPTY_FILE )
			{
				if ( !$obj->UploadFile( $errmsg ) )
				{
					$obj->SetErrMsg( $errmsg );
					$this->ReportError( $errmsg );
					break;
				}
			}
			//-- [END] Upload File

			$def->ToState();

			//-- [BEGIN] Go
			$sc->SetNextSc( "reg_page4U" );
			//-- [END] Go 

			break;

		case 'reg_page3U_file_remove':

			//-- [BEGIN] Set return page
			$sc->SetNextSc( "reg_page3U" );
			//-- [END] Set return page

			//-- [BEGIN] Input
			$def->SetNS( 'rs:def:' );
			$def->SetList( $this->fs_reg_page3U );
			$def->FromInput();
			//-- [END] Input

			//-- [BEGIN] Remove File
			$fileup_key = $this->sys->GetIV( 'fileup_key' );
			$obj = $def->GetChild( $fileup_key );
			$obj->RemoveFile();
			//-- [END] Remove File

			$def->ToState();

			//-- [BEGIN] Go
			$sc->SetNextSc( "reg_page3U" );
			//-- [END] Go

			break;

		//------------------------------------------------------
		// Page4U 
		//------------------------------------------------------
		case 'reg_page4U':

			//-- [BEGIN] Validate the previous PageID and set the current PageID
			if ( !$sc->CheckPrevPageID(
				array( "reg_page3U", "reg_page4U", "reg_page5" )
			) ) break;
			$sc->SetPageID( "reg_page4U" );
			//-- [END] Validate the previous PageID and set the current PageID

			//-- [BEGIN] Load data from state
			$def->SetNS( "rs:def:" );
			$def->SetList( $this->fs_reg_page4U );
			$def->FromState();
			//-- [END] Load data from state

			$this->NormalizePicSize( $def );

			//-- [BEGIN] Output
			$def->ToZBuffer( XC_OF_INPUT );
			//-- [END] Output

			//-- [BEGIN] Set display on
			$this->SetDisplay( "def:", true );
			//-- [END] Set display on

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "reg_page4U" );
			//-- [END] Set template page

			break;

		case 'reg_page4U_prev':

			//-- [BEGIN] Go
			$sc->SetNextSc( "reg_page3U" );
			//-- [END] Go

			break;

		case 'reg_page4U_next':

			//-- [BEGIN] Go
			$sc->SetNextSc( "reg_page5" );
			//-- [END] Go 

			break;

		//------------------------------------------------------
		// Page5 
		//------------------------------------------------------
		case 'reg_page5':

			//-- [BEGIN] Validate the previous PageID and set the current PageID
			if ( !$sc->CheckPrevPageID(
				array( "reg_page4R", "reg_page4U",
					"reg_page5", "reg_page6" )
			) ) break;
			$sc->SetPageID( "reg_page5" );
			//-- [END] Validate the previous PageID and set the current PageID

			//-- [BEGIN] Load data from state
			$def->SetNS( "rs:def:" );
			$def->SetList( $this->fs_reg_page5 );
			$def->FromState();
			//-- [END] Load data from state

			//-- [BEGIN] Output
			$def->ToZBuffer( XC_OF_INPUT );
			//-- [END] Output

			//-- [BEGIN] Set display on
			$this->SetDisplay( "def:", true );
			//-- [END] Set display on

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "reg_page5" );
			//-- [END] Set template page

			break;

		case 'reg_page5_prev':

			//-- [BEGIN] Load data from input to state and validate
			$def->SetNS( 'rs:def:' );
			$def->SetList( $this->fs_reg_page5 );
			$def->FromInput();
			$def->ToState();
			//-- [END] Load data from input to state and validate

			//-- [BEGIN] Go to page 
			$sc->SetNextSc( "reg_page4U" );
			//-- [END] Go to page 

			break;

		case 'reg_page5_next':

			//-- [BEGIN] Set return page
			$sc->SetNextSc( "reg_page5" );
			//-- [END] Set return page

			//-- [BEGIN] Load data from input to state and validate
			$def->SetNS( 'rs:def:' );
			$def->SetList( $this->fs_reg_page5 );
			$def->FromInput();
			$def->ToState();
			if ( !$def->ValidateX( XPT_INPUT ) ) break;
			//-- [END] Load data from input to state and validate

			//-- [BEGIN] Go to page6 
			$sc->SetNextSc( "reg_page6" );
			//-- [END] Go to page6 

			break;

		//------------------------------------------------------
		// Reg Page6 
		//------------------------------------------------------
		case "reg_page6":

			//-- [BEGIN] Validate the previous PageID and set the current PageID
			if ( !$sc->CheckPrevPageID(
				array( "reg_page5" )
			) ) break;
			$sc->SetPageID( "reg_page6" );
			//-- [END] Validate the previous PageID and set the current PageID

			//-- [BEGIN] Set return page
			$sc->SetNextSc( "reg_page1" );
			//-- [END] Set return page

			//-- [BEGIN] Check PageSig
			if ( !DEBUG_SKIP_DOUBLE_SUBMIT_CHECK )
			{
				if ( !$this->sys->PageSig->Check( $pagesig_key ) )
				{
					$sc->DoubleSubmitError();
					break;
				}
			}
			//-- [END] Check PageSig

			//-- [BEGIN] Load data from state
			$def->SetNS( "rs:def:" );
			$def->SetList( $this->fs_reg_page6 );
			$def->FromState();
			//-- [END] Load data from state

			$this->CheckAdIDConflict( $def );

			//-- [BEGIN] Set additional init values
			$def->SetNS( "rs:def:" );
			$def->SetList( "+cell_id" );
			$def->FromState();
			$qc = $def->GetQueryCond();
			//-- [END] Set additional init values

			//-- [BEGIN] Output
			$def->SetNS( 'rs:def:' );
			$def->SetList( $this->fs_reg_page6 );
			$def->ToZBuffer( XC_OF_DEFAULT );
			//-- [END] Output

			//-- [BEGIN] Save data into database
			$def->SetList( $this->fs_reg_page6 );
			$def->UpdateRecordSet( $qc );
			//-- [END] Save data into database

			//-- [BEGIN] Send email
			//if ( !$this->SendRegEmail( $def,
			//	$this->fs_reg_page6,
			//	$this->config_email
			//) ) break;
			//-- [END] Send email

			//-- [BEGIN] Clear PageSig
			$this->sys->PageSig->Clear( $pagesig_key );
			//-- [END] Clear PageSig

			//-- [BEGIN] Set display on
			$this->SetDisplay( "def:", true );
			//-- [END] Set display on

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "reg_page6" );
			//-- [END] Set template page

			break;

		//------------------------------------------------------
		// Page Not Found
		//------------------------------------------------------
		default:
			$sc->RaiseError( SC_ERR_PAGE_NOT_FOUND );
			break;
		}
	}

	//------------------------------------------------------------
	// NormalizePicSize
	//------------------------------------------------------------
	function NormalizePicSize( &$def )
	{
		$obj = $def->GetChild( 'pic' );
		if ( $this->sys->image_h > MAX_HEIGHT )
		{
			$obj->width = round( $this->sys->image_w *
				( MAX_HEIGHT / ( $this->sys->image_h * 1.0 ) ) );
			$obj->height = MAX_HEIGHT;
		}
		else
		{
			$obj->width = $this->sys->image_w;
			$obj->height = $this->sys->image_h;
		}
	}

	//------------------------------------------------------------
	// CheckAdIDConflict
	//------------------------------------------------------------
	function CheckAdIDConflict( &$def )
	{
		$def->SetList( "+ad_id" );
		$def->FromState();

		$p = $def->GetChild( 'ad_id' );
		$ad_id = $p->GetVal();

		$db =& $this->sys->DB;
		$table_name = $def->Get(XA_TABLE_NAME);
		$flist = array( "ad_id", "active", "pic" );
		$qc = array(
			"ad_id = '". $db->Sanitize($ad_id) . "'",
			"active = 'Y'"
		);
		$sql = $db->GetSQLSelect( $table_name, $flist, $qc );
		$result = $db->Query( $sql );
		$b = false;
		if ( $rs = $db->GetRowA( $result ) )
		{
			$b = true;
			$pic = $rs['pic'];
		}
		$db->FreeResult( $result );

		if ( $b )
		{
			if ( !is_null( $pic ) )
			{
				$errmsg = str_replace( "##ad_id##", $ad_id,
					RSTR_CELL_NOT_ABAILABLE );
				echo $errmsg;
				die;
			}
		}
		else
		{
			echo "Invalid Ad ID {$ad_id}";
			die;
		}

		return $b;
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>