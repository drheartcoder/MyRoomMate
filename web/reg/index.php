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
	$LANG_CODE = "eng";
	require( 'common.inc.php' );
	$sys =& CVSystem::SetupSystem( $spec_sys_base );
	$sys->SetUserType( UT_GUEST );
	$sys->Run();
?>
