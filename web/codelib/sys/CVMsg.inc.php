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
// CVMsg
//----------------------------------------------------------------
class CVMsg
{
	var $sender;
	var $ls;
	var $msg_arr;

  /**
   * Initialize Object
   *
   * @param object $prt
   * @param array $ls
   * @param array $msg_arr
   */
	function Init( $sender, &$ls, &$msg_arr )
	{
		$this->sender = $sender;
		$this->ls =& $ls;
		$this->msg_arr =& $msg_arr;
	}

  /**
   * Get
   *
   * @param string $key
   * @return string
   */
	function Get( $key )
	{
		if ( isset( $this->msg_arr[$key] ) )
			return $this->msg_arr[$key];
		else
			return '';
	}

  /**
   * Set
   *
   * @param string $key
   * @param string $val
   */
	function Set( $key, $val )
	{
		$this->msg_arr[$key] = $val;
		return $val;
	}
}

//-----------------------------------------------------------------------
// END OF FILE
//-----------------------------------------------------------------------
?>