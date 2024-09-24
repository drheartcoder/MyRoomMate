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

$spec = array(

'frame' => array(
XA_CLASS=>'cls_ps_frame',
XA_AUTH=>false,
XA_DEFAULT_COMMAND=>'login'
),

'staff' => array(
XA_CLASS=>'cls_ps_staff',
XA_DEFAULT_COMMAND=>'search_init'
),

'about' => array(
XA_CLASS=>'cls_ps_about',
XA_DEFAULT_COMMAND=>'detail'
),

'cell' => array(
XA_CLASS=>'cls_ps_cell',
XA_DEFAULT_COMMAND=>'search_init'
),

);

?>
