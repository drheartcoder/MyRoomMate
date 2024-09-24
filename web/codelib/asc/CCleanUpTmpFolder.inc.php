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

class CCleanUpTmpFolder
{
	function Setup( $dir_path, $cut_off_time )
	{
		$this->dir_path = $dir_path;
		$this->cut_off_time = $cut_off_time;
	}

	function GetAllFileNameInTmp()
	{
		$ls = array();
		$path = $this->dir_path;
	    if ( $dh = opendir( $path ) )
		{
			while ( ( $f = readdir( $dh ) ) !== false )
			{
				if (!(( $f == '.' ) ||  ( $f == '..' )))
	 			{
					$ls[] = $f;
				}
			}
			closedir( $dh );
		}
	    return $ls;
	}

	function TmpFn2TimeStr( $tmp_fn )
	{
		$fx = explode( "_", $tmp_fn );
		if ( count( $fx ) == 3 )
		{
			$d = $fx[1];
			if ( strlen( $d ) == 14 )
			{
				$year = substr( $d, 0, 4 );
				$month = substr( $d, 4, 2 );
				$day = substr( $d, 6, 2 );
				$hour = substr( $d, 8, 2 );
				$min = substr( $d, 10, 2 );
				$sec = substr( $d, 12, 2 );
				$t = $year . '-' . $month . '-' . $day . ' ' .
					$hour . ':' . $min . ':' . $sec;
					return $t;
			}
		}
		return null;
	}

	function Run()
	{
		$del_count = 0;

		$ls = $this->GetAllFileNameInTmp();
		foreach( $ls as $fn )
		{
			$t = $this->TmpFn2TimeStr( $fn );
			if ( $t == null )
				$b_del = false;
			else
				$b_del = ( $t < $this->cut_off_time );

			if ( $b_del )
			{
				@unlink( $this->dir_path . $fn );
				$del_count++;
			}
		}

		return $del_count;
	}
}
?>