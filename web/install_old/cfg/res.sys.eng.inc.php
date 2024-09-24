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

//-- Error Message
define( 'ERR_CANNOT_CONNECT_TO_DB', 
	"Can not connect to database server [##co## ##hostname## ##cc##]" );
define( 'ERR_CANNOT_FIND_DB',
	"Can not find database [##co## ##database## ##cc##]" );
define( 'ERR_TABLE_EXISTS',
	"Table [##table##] already exists in [##database##]" );

//-- Strings
define( 'RSTR_INSTALL_INSTALLATION', 'Installation' );

//-- Strings ( Home Page )
define( 'RSTR_INSTALL_START_INSTALL',
	"Click <b>Setup</b> to start " .
	RSTR_APP_TITLE . ' ' . RSTR_APP_VERSION . ' installation.' );
define( 'RSTR_INSTALL_CHECK_ERROR',
	'Sorry, you got an error. Please check your database settings and ' .
	'click <b>Setup</b> again.' );
define( 'RSTR_INSTALL_SETUP', 'Setup' );

//-- Strings ( Done Page )
define( 'RSTR_INSTALL_SUCCESS',
	'The installation has been done successfully!' );
define( 'RSTR_INSTALL_IMPORTANT', 'IMPORTANT!' );
define( 'RSTR_INSTALL_REMOVE_FOLDER',
	"Please remove the <font color='#000000'>install</font> " .
	"folder from your web site to avoid a security risk!" );
define( 'RSTR_INSTALL_LOG_IN',
	"After removing the install folder, " . 
	"log in to <a href='../staff/index.php' target='_blank'>" .
	RSTR_APP_TITLE . " Admin Panel</a> " .
	"using the username and password shown below." );
define( 'RSTR_INSTALL_USERNAME', 'Username' );
define( 'RSTR_INSTALL_PASSWORD', 'Password' );

?>