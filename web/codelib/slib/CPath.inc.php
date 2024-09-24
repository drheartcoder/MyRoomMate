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
// CPath
//----------------------------------------------------------------
class CPath
{
	public static function ThisFileUrl()
	{
		return $_SERVER['PHP_SELF'];
	}

	public static function ThisFileName()
	{
		$path = CPath::ThisFileUrl();
		$pos = strrpos( $path, '/' );
		return substr( $path, $pos+1 );
	}

	public static function ThisFolderUrl()
	{
		$path = CPath::ThisFileUrl();
		$pos = strrpos( $path, '/' );
		return substr( $path, 0, $pos+1 );
	}

	public static function ThisFilePath()
	{
		if ( isset( $_SERVER['SCRIPT_FILENAME'] ) )
			$path = $_SERVER['SCRIPT_FILENAME'];
		else
			$path = $_SERVER["PATH_TRANSLATED"];

		return str_replace( "\\", '/', $path );
	}

	public static function ThisFolderPath()
	{
		$path = CPath::ThisFilePath();
		if (( $pos = strrpos( $path, '/' ) ) !== false )
			return substr( $path, 0, $pos+1 );
		else if (( $pos = strrpos( $path, "\\" ) ) !== false )
			return substr( $path, 0, $pos+1 );
		else
			return $path;
	}
}

?>