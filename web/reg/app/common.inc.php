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

//----------------------------------------------------------------
// User Configuration Files
//----------------------------------------------------------------
require( dirname(__FILE__) . "/../../config/common.inc.php" );

//----------------------------------------------------------------
// System Platform
//----------------------------------------------------------------
require( dirname(__FILE__). "/../../codelib/sys/common.inc.php" );

//----------------------------------------------------------------
// Application Shared Code
//----------------------------------------------------------------
require( dirname(__FILE__). "/../../codelib/asc/common.inc.php" );

//----------------------------------------------------------------
// Resource
//----------------------------------------------------------------
require( _LANG_FILE_( "res.##LANG_CODE##.inc.php" ) );

//----------------------------------------------------------------
// PageSet
//----------------------------------------------------------------
require( 'cls_ps_base.inc.php' );
require( 'cls_ps_cell.inc.php' );

//----------------------------------------------------------------
// HtmlMacro
//----------------------------------------------------------------
require( 'cls_hm_base.inc.php' );

//----------------------------------------------------------------
// System
//----------------------------------------------------------------
require( 'cls_sys_base.inc.php' );

//-----------------------------------------------------------------------
// [END] StartUp Code
//-----------------------------------------------------------------------

?>