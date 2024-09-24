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

require( _LANG_FILE_( "cls_fl_cell.res.##LANG_CODE##.inc.php" ) );

//----------------------------------------------------------------
// cls_fl_cell
//----------------------------------------------------------------
class cls_fl_cell extends cls_fl_aso
{
}

//----------------------------------------------------------------
// cls_pic_up
//----------------------------------------------------------------
class cls_pic_up extends CVImageUpload
{
	function Setup()
	{
		$this->file_key = 'rs:def:' . $this->GetName() . "_inp";
		$this->ext_list = explode( ",", ALLOWED_PIC_EXT );
		$this->fn_prefix = 'f_';

		$this->path_tmp_storage = PATH_PIC_TMP;
		$this->path_sys_storage = PATH_PIC_SYS;
		$this->path_empty_storage = PATH_PIC_EMPTY;
		$this->empty_filename =  'no_pic.png';

		$this->url_tmp_storage = URL_PIC_TMP;
		$this->url_sys_storage = URL_PIC_SYS;
		$this->url_empty_storage = URL_PIC_EMPTY;

		$this->max_pic_width = 180;
		$this->max_pic_height = 180;

		$this->fileup_max_filesize = FILEUP_MAX_FILESIZE;

		return nothing;
	}

	function ValidateUpload( $path, &$errmsg )
	{
		//-- [BEGIN] Get Image Dimention
		list($width, $height) = @getimagesize( $path );
		//-- [END] Get Image Dimention

		//-- [BEGIN] Check if file is image format
		if ( !isset( $width ) )
		{
			$errmsg = RSTR_CVFILEUPLOAD_ERR_INVALID_FILE_FORMAT;
			return false;
		}
		//-- [END] Check if file is image format

		if ( VALIDATE_IMAGE_SIZE )
		{
			//-- [BEGIN] Width Check
			$obj =& $this->prt->GetChild( "image_w" );
			$this->width = $obj->GetVal();

			if ( $width != $this->width )
			{
				$errmsg = RSTR_CLS_FL_CELL_ERR_WRONG_IMAGE_WIDTH;
				$errmsg = str_replace( "##width_u##", sprintf( "%d", $width ), $errmsg );
				$errmsg = str_replace( "##width_t##", sprintf( "%d", $this->width ), $errmsg );
				return false;
			}
			//-- [END] Width Check

			//-- [BEGIN] Height Check
			$obj =& $this->prt->GetChild( "image_h" );
			$this->height = $obj->GetVal();

			if ( $height != $this->height )
			{
				$errmsg = RSTR_CLS_FL_CELL_ERR_WRONG_IMAGE_HEIGHT;
				$errmsg = str_replace( "##height_u##", sprintf( "%d", $height ), $errmsg );
				$errmsg = str_replace( "##height_t##", sprintf( "%d", $this->height ), $errmsg );
				return false;
			}
			//-- [END] Height Check
		}

		return true;
	}

	function Validate_Value( &$msg )
	{
		return true;
	}

	function &GetFileDisplay( &$msg )
	{
		$state = $this->GetState();

		switch ( $state )
		{
		case FILEUP_EMPTY_FILE:
			$obj = new COutHtml();
			$obj->SetTagName( 'div' );
			$obj->SetInside( "&nbsp;" );
			break;

		case FILEUP_TEMP_FILE:
		case FILEUP_STORED_FILE:
			if ( isset( $this->width ) )
				$w = $this->width;
			else
			{
				$obj_w =& $this->prt->GetChild( "image_w" );
				$w = $obj_w->GetVal();
			}

			if ( isset( $this->height ) )
				$h = $this->height;
			else
			{
				$obj_h =& $this->prt->GetChild( "image_h" );
				$h = $obj_h->GetVal();
			}

			$obj = new COutHtml();
			$obj->SetTagName( 'img' );
			$obj->SetKV( 'src',
				$this->GetFileUrl( $state == FILEUP_STORED_FILE ) );
			$obj->SetKV( 'border', '0' );
			//$w = ( isset( $this->width ) ? $this->width : "30" );
			//$h = ( isset( $this->height ) ? $this->height : "30" );
			$obj->SetKV( 'width', $w );
			$obj->SetKV( 'height', $h );
			break;
		}

		return $obj;
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>
