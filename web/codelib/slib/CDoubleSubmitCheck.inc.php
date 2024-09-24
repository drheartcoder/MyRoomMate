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

class CDoubleSubmitCheck
{
	public static function Init()
	{
		$_SESSION[ 'double_submit' ] = '';
	}
	
	public static function Submitted()
	{
		$_SESSION[ 'double_submit' ] = 'Y';
	}
	
	public static function Check()
	{
		return ( $_SESSION[ 'double_submit' ] == 'Y' );
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>