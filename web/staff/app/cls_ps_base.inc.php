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
// cls_ps_base
//----------------------------------------------------------------
class cls_ps_base extends cls_ps_aso
{
	//------------------------------------------------------------
	// OnLoadFieldListSpec
	//------------------------------------------------------------
	function OnLoadFieldListSpec()
	{
		include( 'df.fieldlist.inc.php' );
		$this->SetFieldListSpec( $spec );
	}

	//------------------------------------------------------------
	// GetSelRecArray
	//------------------------------------------------------------
	function GetSelRecArray()
	{
		$ax = $this->sys->GetIV( '_selrec_' );
		$selrec = array();
		if ( is_array( $ax ) )
		{
			foreach( $ax as $v )
			{
				$v = trim( $v );
				if ( CValidator::IsInteger( $v ) )
				{
					$selrec[] = intval( $v );
				}
			}
		}
		return $selrec;
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>