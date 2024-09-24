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

//-- Maximum upload file size ( in byte )
define( 'FILEUP_MAX_FILESIZE', 5 * 1000 * 1000 );

//-- Allowed image file extensions
define( 'ALLOWED_PIC_EXT', 'jpg,jpeg,gif,png' );

//-- Must be true if you want the script to reject
//-- any size the does not fit the cell size.
//define( 'VALIDATE_IMAGE_SIZE', true );
define( 'VALIDATE_IMAGE_SIZE', false );

//-- The minimum time period to keep temp files in the temporary file folder ( in hours )
define( 'TMP_FILE_MAX_HOUR', (24 * 1) );

?>