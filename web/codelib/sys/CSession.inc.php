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
// CSession
//----------------------------------------------------------------
class CSession extends CObject
{
	function Setup()
	{
		//-------------------------------------
		//-- session_cache_limiter('none') 
		//-- prevents "page expired" error from
		//-- IE when pressing back-button
		//-------------------------------------
		@session_cache_limiter('none');
		//-----------------------------------

		@session_start();
		//header('Cache-control: private'); 
		//header('Cache-Control: max-age=3600, must-revalidate'); 
		//header('Cache-Control: max-age=1, must-revalidate'); 
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>