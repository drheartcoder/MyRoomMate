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
// String Functions
//----------------------------------------------------------------
class CStr
{
	public static function e2n( $s )
	{
		return ( $s == '' ? null : $s );
	}

	public static function n2e( $s )
	{
		return ( is_null( $s ) ? '' : $s );
	}

	public static function html( $s )
	{
		if ( is_null( $s ) )
			return '';
		else
			return htmlspecialchars( $s );
	}

	public static function implode( $sepa, $ax, $idx )
	{
		$s = '';
		foreach( $ax as $v )
		{
			if ( $s != '' ) $s .= $sepa;
			$s .= $v[$idx];
		}
		return $s;
	}
}

?>