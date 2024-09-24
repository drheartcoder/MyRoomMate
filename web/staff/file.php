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
	if ( isset( $_GET[ 'cn' ] ) )
	{
		$class_name = $_GET[ 'cn' ];
		if ( class_exists( $class_name ) )
		{
			$obj =& CUtil::CreateObject( $class_name );
			$obj->Download();
			return;
		}
	}

return "OBJECT ERROR";

?>
