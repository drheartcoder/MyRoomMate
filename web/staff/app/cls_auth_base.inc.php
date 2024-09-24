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
// AUTHSESSION_KEY
//----------------------------------------------------------------

define( 'AUTHSESSION_KEY', "AuthSessionKey:(" . __FILE__ . ")" );

//----------------------------------------------------------------
// cls_auth_base
//----------------------------------------------------------------
class cls_auth_base extends cls_auth_aso
{
	function IsAuthorized( $ps, $cmd )
	{
		if ( $this->sys->IsAdmin() )
		{
			return true;
		}
		else
		{
			return ( $ps != "staff" );
		}
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>