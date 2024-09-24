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
// Spec
//----------------------------------------------------------------
$spec_sys_base = array(
	XA_CLASS=>'cls_sys_base',
	XA_AUTH=>true,
	XA_DEFAULT_PAGESET=>'frame',
	XA_FRAME_FIELDSET=>'staff',
	XA_FRAME_FIELDSET_ID=>'staff_id',
	XA_START_PAGE=>'cell/_def'
);

//----------------------------------------------------------------
// cls_sys_base
//----------------------------------------------------------------
class cls_sys_base extends cls_sys_aso
{
	function OnCompoSpec( &$compo )
	{
		parent::OnCompoSpec( $compo );
		$compo['Authorization'] = 'cls_auth_base';
		$compo['HtmlMacro'] = 'cls_hm_base';
	}

	function OnLoadPageListSpec()
	{
		include( 'df.pageset.inc.php' );
		$this->SetPageSetSpec( $spec );
	}

	function IsAdmin()
	{
		return ( $this->AuthSession->GetV('group_id') == GROUP_ADMIN );
	}

	function ShowRLog()
	{
		return true;
		//return false;
	}

	function EncryptPassword( $password )
	{
		//return CUtil::EncryptPassword( $password );
		return $password;
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>