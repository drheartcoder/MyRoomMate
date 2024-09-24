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
// cls_hm_base
//----------------------------------------------------------------
class cls_hm_base extends cls_hm_aso
{
	//----------------------------------------------------------------
	// GetImagePath
	//----------------------------------------------------------------
	function GetImagePath()
	{
		return _LANG_FILE_( "images/buttons/##LANG_CODE##/" );
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>