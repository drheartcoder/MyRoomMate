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

require( _LANG_FILE_( "CVFileUpload.res.##LANG_CODE##.inc.php" ) );

define( 'FILEUP_SEPA', '/' );

define( 'FILEUP_EMPTY_FILE', 'E' );
define( 'FILEUP_TEMP_FILE', 'T' );
define( 'FILEUP_STORED_FILE', 'S' );

//----------------------------------------------------------------
// CVFileUpload
//----------------------------------------------------------------
class CVFileUpload extends CVText
{
	function Setup()
	{
		$this->file_key = 'rs:def:' . $this->GetName() . '_inp';
		$this->ext_list = array( 'txt', 'doc', 'xls', 'jpg', 'jpeg', 'gif', 'png' );
		$this->fn_prefix = 'f_';
		$this->path_tmp_storage = "/.../tmp/";
		$this->path_sys_storage = "/.../sys/";
		$this->path_empty_storage = "/.../empty/";
		$this->empty_filename =  "no_pic.png";
		$this->url_tmp_storage = "http://.../tmp/";
		$this->url_sys_storage = "http://.../sys/";
		$this->fileup_max_filesize = 6 * 1000 * 1000;
		return nothing;
	}

	function SetEmpty()
	{
		$ax = array(
			'state'=>FILEUP_EMPTY_FILE,
			'new_int_filename'=>'',
			'new_org_filename'=>'',
			'old_int_filename'=>'',
			'old_org_filename'=>''
		);
		$this->SetVal( $ax );
	}

	function IsEmpty( &$msg )
	{
		$ax = $this->GetVal();
		return ( $ax['state'] == FILEUP_EMPTY_FILE );
	}

	function Str2Arr( $s )
	{
		$sx = explode( FILEUP_SEPA, $s );
		$ax = array(
			'state'=>$sx[0],
			'new_int_filename'=>$sx[1],
			'new_org_filename'=>$sx[2],
			'old_int_filename'=>$sx[3],
			'old_org_filename'=>$sx[4]
		);
		return $ax;
	}

	function Arr2Str( $ax )
	{
		$s =
			$ax['state'] . FILEUP_SEPA .
			$ax['new_int_filename'] . FILEUP_SEPA .
			$ax['new_org_filename'] . FILEUP_SEPA .
			$ax['old_int_filename'] . FILEUP_SEPA .
			$ax['old_org_filename'];
		return $s;
	}

	function GetState()
	{
		$ax = $this->GetVal();
if ( is_string($ax) ) {
	return substr($ax,0,1);
} else {
	return $ax['state'];
}
	}

	function GetNewIntFilename()
	{
		$ax = $this->GetVal();
		return $ax['new_int_filename'];
	}

	function GetNewOrgFilename()
	{
		$ax = $this->GetVal();
		return $ax['new_org_filename'];
	}

	function GetOldIntFilename()
	{
		$ax = $this->GetVal();
		return $ax['old_int_filename'];
	}

	function GetOldOrgFilename()
	{
		$ax = $this->GetVal();
		return $ax['old_org_filename'];
	}

	function GetFileUrl( $b_direct_url = false )
	{
		$state = $this->GetState();

		if ( $b_direct_url )
		{
			switch ( $state )
			{
			case FILEUP_TEMP_FILE:
				$url = $this->url_tmp_storage . $this->GetNewIntFilename();
				break;
			case FILEUP_STORED_FILE:
				$url = $this->url_sys_storage . $this->GetNewIntFilename();
				break;
			case FILEUP_EMPTY_FILE:
				$url = $this->path_empty_storage . $this->GetNewIntFilename();
				break;
			}
		}
		else
		{
			$url = "file.php?cn=" . get_class($this) . "&ptype=" . $state . "&fn=";
			switch ( $state )
			{
			case FILEUP_TEMP_FILE:
			case FILEUP_STORED_FILE:
				$url .= $this->GetNewIntFilename();
				break;
			case FILEUP_EMPTY_FILE:
				$url .= $this->empty_filename;
				break;
			}
		}

		return $url;
	}

	function RemoveOldFile()
	{
		$path_sys = $this->path_sys_storage . $this->GetOldIntFilename();
		if ( file_exists( $path_sys ) ) @unlink( $path_sys );
	}

	function RemoveFile()
	{
		if ( $this->GetState() == FILEUP_TEMP_FILE )
		{
			$path = $this->path_tmp_storage . $this->GetNewIntFilename();
			if ( file_exists( $path ) ) @unlink( $path );
		}

		$ax = $this->GetVal();
		$ax['state'] = FILEUP_EMPTY_FILE;
		$ax['new_int_filename'] = '';
		$ax['new_org_filename'] = '';
		$this->SetVal( $ax );
	}

	function UploadFile( &$errmsg )
	{
		if ( $this->UploadFile2( $errmsg, $new_filename, $org_filename ) )
		{
			$ax = array(
				'state' => FILEUP_TEMP_FILE,
				'new_int_filename' => $new_filename,
				'new_org_filename' => $org_filename,
				'old_int_filename' => $this->GetOldIntFilename(),
				'old_org_filename' => $this->GetOldOrgFilename()
			);
			$this->SetVal( $ax );
			return true;
		}
		else
		{
			$errmsg = '[' . $this->GetCaption() . '] ' . $errmsg;
			return false;
		}
	}

	function UploadFile2( &$errmsg, &$new_filename, &$org_filename )
	{
		$files = $_FILES[ $this->file_key ];

		//-- [BEGIN] PHP file upload error
		if ( $files['name'] == '' )
		{
			//-- The filename was not selected."
			$errmsg = RSTR_CVFILEUPLOAD_ERR_FILENAME_NOT_SELECTED;
			return false;
		}

		$file_uploaded_size = $files['size'];
		if ( $file_uploaded_size > $this->fileup_max_filesize ) 
		{
			if ( $this->fileup_max_filesize < 1000 )
			{
				$bsize = sprintf( "%d",
					$this->fileup_max_filesize ) . " bytes";
			}
			else if ( $this->fileup_max_filesize < 1000 * 1000 )
			{
				$bsize = sprintf( "%01.2f",
					$this->fileup_max_filesize / ( 1000 ) ) . " KB";
			}
			else
			{
				$bsize = sprintf( "%01.2f",
					$this->fileup_max_filesize / ( 1000 * 1000 ) ) . " MB";
			}

			$errmsg = str_replace( "##bsize##", $bsize,
				RSTR_CVFILEUPLOAD_ERR_FILESIZE );
			return false;
		}

		$err_code = $files['error'];
		switch ( $err_code )
		{
		case UPLOAD_ERR_OK:
			break;

		case UPLOAD_ERR_INI_SIZE:
			//-- The uploaded file exceeds the upload_max_filesize directive in php.ini.
			$errmsg = RSTR_CVFILEUPLOAD_ERR_INI_SIZE;
			return false;

		case UPLOAD_ERR_FORM_SIZE:
			//-- The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.
			$errmsg = RSTR_CVFILEUPLOAD_ERR_FORM_SIZE;
			return false;

		case UPLOAD_ERR_PARTIAL:
			//-- The uploaded file was only partially uploaded.
			$errmsg = RSTR_CVFILEUPLOAD_ERR_PARTIAL;
			return false;

		case UPLOAD_ERR_NO_FILE:
			//-- No file was uploaded.
			$errmsg = RSTR_CVFILEUPLOAD_ERR_NO_FILE;
			return false;

		case UPLOAD_ERR_NO_TMP_DIR:
			//-- Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.
			$errmsg = RSTR_CVFILEUPLOAD_ERR_NO_TMP_DIR;
			return false;

		case UPLOAD_ERR_CANT_WRITE:
			//-- Failed to write file to disk. Introduced in PHP 5.1.0.
			$errmsg = RSTR_CVFILEUPLOAD_ERR_CANT_WRITE;
			return false;

		case UPLOAD_ERR_EXTENSION:
			//-- File upload stopped by extension.
			$errmsg = RSTR_CVFILEUPLOAD_ERR_EXTENSION;
			return false;

		default:
			//-- General Failure
			$errmsg = RSTR_CVFILEUPLOAD_ERR_GENERAL_FAILURE;
			return false;
		}
		//-- [END] PHP file upload error

		$sys_tmp_path = $files['tmp_name'];
		if ( !$this->ValidateUpload( $sys_tmp_path, $errmsg ) )
		{
			return false;
		}

		$org_filename = basename( $files['name'] );
		$path_parts = pathinfo( $org_filename );
		$ext = strtolower( $path_parts['extension'] );

		if ( !in_array( $ext, $this->ext_list ) )
		{
			$errmsg = str_replace( "##ext##", $ext,
				RSTR_CVFILEUPLOAD_ERR_INVALID_FILE_TYPE );
			return false;
		}

		$new_filename =
			$this->fn_prefix . date( 'YmdHis' ) . '_' . 
			CUtil::CreateRandomString( 20 ) . "." . $ext;
		$path_tmp = $this->path_tmp_storage . $new_filename;

		if ( !( move_uploaded_file( $files['tmp_name'], $path_tmp ) ) )
		{
			$errmsg = RSTR_CVFILEUPLOAD_ERR_MOVE_UPLOADED_FILE;
			return false;
		}

		@chmod( $path_tmp, 0755 );

		return true;
	}

	function ValidateUpload( $path, &$errmsg )
	{
		return true;

		//-- [BEGIN] Get Image Dimention
		list($width, $height) = getimagesize( $path );
		//-- [END] Get Image Dimention

		//-- [BEGIN] Check if file is image format
		if ( !isset( $width ) )
		{
			$errmsg = RSTR_CVFILEUPLOAD_ERR_INVALID_FILE_FORMAT;
			return false;
		}
		//-- [END] Check if file is image format

		//-- [BEGIN] Width Check
		if ( $width != $w )
		{
			$errmsg = str_replace( "##w##", $w,
				RSTR_CVFILEUPLOAD_ERR_INVALID_WIDTH );
			return false;
		}
		//-- [END] Width Check

		//-- [BEGIN] Height Check
		if ( $height != $h )
		{
			$errmsg = str_replace( "##h##", $h,
				RSTR_CVFILEUPLOAD_ERR_INVALID_HEIGHT );
			return false;
		}
		//-- [END] Height Check

		return true;
	}

	function &CreateFileUpInputBox( &$msg )
	{
		$ht = new COutHtml();
		$ht->SetTagName('input');
		$ht->SetKV('type','file');
		$ht->SetKV('name',$this->GetRpName( $msg ) . "_inp" );
		$ht->SetKV('value', '' );
		if ( $this->Get(XA_SIZE) != '' )
			$ht->SetKV('size', $this->Get(XA_SIZE));
		if ( $this->Get(XA_MAX_CHAR) != '' )
			$ht->SetKV('maxlength', $this->Get(XA_MAX_CHAR));
		if ( $this->IsError() )
			$this->sys->Error->UseErrStyle( $ht );
		return $ht;
	}

	function &GetFileDisplay( &$msg )
	{
		$obj = new COutString();
		$obj->AddItem( $this->GetNewOrgFilename() );
		return $obj;
	}

	function &BuildHtmlTag( &$msg )
	{
		$state = $this->GetState();

		switch ( $state )
		{
		case FILEUP_EMPTY_FILE:
			$obj =& $this->CreateFileUpInputBox( $msg );
			break;

		case FILEUP_STORED_FILE:
		case FILEUP_TEMP_FILE:
			$obj =& $this->GetFileDisplay( $msg );
			break;
		}

		$ht = new COutHtml();
		$ht->SetTagName('input');
		$ht->SetKV( 'type', 'hidden');
		$ht->SetKV( 'name', $this->GetRpName( $msg ) );
		$ht->SetKV( 'value', $this->Arr2Str( $this->GetVal() ) );

		$os = new COutString();
		$os->AddItem( $obj );
		$os->AddItem( $ht );

		return $os;
	}

	//------------------------------------------------------------
	// OutputDefault
	//------------------------------------------------------------
	function &OutputDefault( &$msg )
	{
		$obj =& $this->GetFileDisplay( $msg );
		return $obj;
	}

	//------------------------------------------------------------
	// SetDBData
	//------------------------------------------------------------
	function SetDBData()
	{
		if ( $this->GetVal() == '' )
		{
			$this->SetEmpty();
		}
		else
		{
			$sx = explode( FILEUP_SEPA, $this->GetVal() );
			$ax = array(
				'state'=>FILEUP_STORED_FILE,
				'new_int_filename'=>$sx[0],
				'new_org_filename'=>$sx[1],
				'old_int_filename'=>$sx[0],
				'old_org_filename'=>$sx[1]
			);
			$this->SetVal( $ax );
		}
	}

	//------------------------------------------------------------
	// XProc
	//------------------------------------------------------------
	function XProc( &$msg )
	{
		switch ( $msg->Get(XM_CMD) )
		{
		case XC_BEFORE_TO_STATE:
			$this->SetVal( $this->Arr2Str( $this->GetVal() ) );
			break;

		case XC_AFTER_FROM_INPUT:
		case XC_AFTER_FROM_STATE:
		case XC_AFTER_TO_STATE:
			$this->SetVal( $this->Str2Arr( $this->GetVal() ) );
			break;

		case XC_AFTER_FROM_RECORDSET:
			$this->SetDBData();
			break;

		case XC_BEFORE_INSERT_RECORDSET:
		case XC_BEFORE_UPDATE_RECORDSET:
			$this->keep_val = $this->GetVal();

			$state = $this->GetState();
			switch ( $state )
			{
			case FILEUP_EMPTY_FILE:
				$this->RemoveOldFile();
				$this->SetVal( '' );
				break;

			case FILEUP_TEMP_FILE:
				$this->RemoveOldFile();
				$path_sys = $this->path_sys_storage . $this->GetNewIntFilename();
				$path_tmp = $this->path_tmp_storage . $this->GetNewIntFilename();
				@rename( $path_tmp, $path_sys );
				$s = $this->GetNewIntFilename() .
					FILEUP_SEPA .
					$this->GetNewOrgFilename();
				$this->SetVal( $s );
				break;

			case FILEUP_STORED_FILE:
				$s = $this->GetOldIntFilename() .
					FILEUP_SEPA .
					$this->GetOldOrgFilename();
				$this->SetVal( $s );
				break;
			}
			break;

		case XC_AFTER_INSERT_RECORDSET:
		case XC_AFTER_UPDATE_RECORDSET:
			$this->SetVal( $this->keep_val );
			$state = $this->GetState();
			switch ( $state )
			{
			case FILEUP_EMPTY_FILE:
				$this->SetEmpty();
				break;

			case FILEUP_TEMP_FILE:
				$ax = array(
					'state' => FILEUP_STORED_FILE,
					'new_int_filename' => $this->GetNewIntFilename(),
					'new_org_filename' => $this->GetNewOrgFilename(),
					'old_int_filename' => $this->GetNewIntFilename(),
					'old_org_filename' => $this->GetNewOrgFilename()
				);
				$this->SetVal( $ax );
				break;

			case FILEUP_STORED_FILE:
				$ax = array(
					'state' => FILEUP_STORED_FILE,
					'new_int_filename' => $this->GetOldIntFilename(),
					'new_org_filename' => $this->GetOldOrgFilename(),
					'old_int_filename' => $this->GetOldIntFilename(),
					'old_org_filename' => $this->GetOldOrgFilename()
				);
				$this->SetVal( $ax );
				break;
			}
			break;
		}

		return parent::XProc( $msg );
	}

	//----------------------------------------------------------------
	// Download
	//----------------------------------------------------------------
	function Download()
	{
		$this->Setup();

		//-- some basic checking
		if ( !isset( $_GET['fn'] ) ) return;
		if ( strpos( $_GET['fn'], '..' ) !== false ) return;

		if ( !isset( $_GET['ptype'] ) ) return;
		$ptype = $_GET['ptype'];

		if ( $ptype == FILEUP_STORED_FILE )
		{
			$path = $this->path_sys_storage;
		}
		else if ( $ptype == FILEUP_TEMP_FILE )
		{
			$path = $this->path_tmp_storage;
		}
		else if ( $ptype == FILEUP_EMPTY_FILE )
		{
			$path = $this->path_empty_storage;
		}
		else
			return;

		$path .= $_GET['fn'];

		if ( !file_exists( $path ) ) return;
		$Size = filesize( $path );

		//-- send out all headers
		header( "HTTP/1.1 200 OK" );
		header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
		header( "Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
		header( "cache-Control: no-store, no-cache, must-revalidate" );
		header( "cache-Control: post-check=0, pre-check=0", false );
		header( "Pragma: no-cache" );
		//header( "Content-Type: image/jpg" );
		header( "Content-Length: $Size" );

		//-- and finally the image itself
		readfile( $path );
	}
}

//----------------------------------------------------------------
// CVFileUpload_State
//----------------------------------------------------------------
class CVFileUpload_State extends CVText
{
	function GetVal()
	{
		if ( $link = $this->Get(XA_LINKED_TO) )
		{
			$p =& $this->prt->GetChild($link);
			return $p->GetState();
		}
		else
		{
			echo "Missing XA_LINKED_TO (CVFileUpload_State)";
			die;
		}
	}

	function &BuildHtmlTag( &$msg )
	{
		return $this->OutputDefault( $msg );
	}
}

//----------------------------------------------------------------
// CVImageUpload
//----------------------------------------------------------------
class CVImageUpload extends CVFileUpload
{
	function &GetFileDisplay( &$msg )
	{
		$state = $this->GetState();

		switch ( $state )
		{
		case FILEUP_EMPTY_FILE:
		case FILEUP_STORED_FILE:
		case FILEUP_TEMP_FILE:
			$obj = new COutHtml();
			$obj->SetTagName( 'img' );
			$obj->SetKV( 'src', $this->GetFileUrl() );
			$obj->SetKV( 'border', '0' );
			break;
		}

		return $obj;
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>
