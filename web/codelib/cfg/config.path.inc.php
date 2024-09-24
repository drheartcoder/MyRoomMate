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

//--[BEGIN] Setup Path
define( 'PATH_SCRIPT_ROOT', dirname( dirname( dirname( __FILE__ ) ) ) . '/' );
define( 'PATH_PIC_ROOT', PATH_SCRIPT_ROOT . 'pic/' );
define( 'PATH_PIC_SYS', PATH_PIC_ROOT . 'sys/' );
define( 'PATH_PIC_TMP', PATH_PIC_ROOT . 'tmp/' );
define( 'PATH_PIC_EMPTY', PATH_PIC_ROOT . 'empty/' );
//--[END] Setup Path

//--[BEGIN] Setup URL
function __PAGE_URL__()
{
	$pageURL = 'http';

	if (( isset($_SERVER["HTTPS"]) ) && ( $_SERVER["HTTPS"] == "on" ))
	{
		$pageURL .= "s";
	}
	$pageURL .= "://" . $_SERVER["SERVER_NAME"];

	if ($_SERVER["SERVER_PORT"] != "80")
	{
		$pageURL .= $_SERVER["SERVER_PORT"];
	}

	$pageURL .= $_SERVER['PHP_SELF'];

	return $pageURL;
}

//-----------------------------------------------------------
// To resolve URL_SCRIPT_ROOT, assume that the calling script
// is located at :
// (script_root_folder)/(sub_folder)/(calling_script.php)
//
// e.g. web/staff/index.php
// e.g. web/guest/index.php
// e.g. web/cn/cn.php
//
define( 'URL_SCRIPT_ROOT', dirname( dirname( __PAGE_URL__() ) ) . '/' );
define( 'URL_PIC_ROOT', URL_SCRIPT_ROOT . 'pic/' );
define( 'URL_PIC_SYS', URL_PIC_ROOT . 'sys/' );
define( 'URL_PIC_TMP', URL_PIC_ROOT . 'tmp/' );
define( 'URL_PIC_EMPTY', URL_PIC_ROOT . 'empty/' );
//--[END] Setup URL

//-- The URL of the cell folder
define( 'URL_CELL_FOLDER', URL_SCRIPT_ROOT . 'cell/' );

?>