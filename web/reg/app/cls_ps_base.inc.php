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
	// SendRegEmail
	//------------------------------------------------------------
	function SendRegEmail( &$def, $fs_list, $config_file, $email_address_field = null )
	{
		$path = PATH_CONFIG . $config_file;

		$email = new CEmail();
		$email->OpenConfig( $path );

		if ( $email_address_field != null )
		{
			$obj = $def->GetChild( $email_address_field );
			$email_address = $obj->GetVal();
			$email->SetParam( "To", array( array( $email_address ) ) );
		}

		$def->SetNS( 'rs:def:' );
		$def->SetList( $fs_list );
		$def->ToZBuffer( XC_OF_DEFAULT );

		$Body = $email->GetParam( 'Body' );
		if ( !is_null( $Body ) )
		{
			foreach( $def->clist as $key => $val )
			{
				$v = $this->sys->ZBuffer->Get( "rs:def:" . $key . "=" );
				$Body = str_replace( "##" . $key . "##", $v, $Body );
			}
			$email->SetParam( 'Body', $Body );
		}

		$Html = $email->GetParam( 'Html' );
		if ( !is_null( $Html ) )
		{
			foreach( $def->clist as $key => $val )
			{
				$v = $this->sys->ZBuffer->Get( "rs:def:" . $key );
				$Html = str_replace( "##" . $key . "##", $v, $Html );
			}
			$email->SetParam( 'Html', $Html );
		}

		$b = $email->Send();

		$msg = "EMAIL ERROR : <br>";
		if ( $b )
			$msg .= "NONE";
		else
			$msg .= $email->GetErrMsg();

		if ( DEBUG_DISPLAY_SMTP_LOG )
		{
			echo $msg . '<br/>';
			$email->DisplaySmtpLog();
		}

		if ( !$b )
		{
			$this->ReportError( $msg );
			return false;
		}

		return true;
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>