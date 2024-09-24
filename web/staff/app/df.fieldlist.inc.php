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

'staff' => array(
XA_CLASS=>'cls_fl_staff',
XA_SPEC_FILE=>'df.fl.staff.inc.php',
XA_TABLE_NAME=>TBL_STAFF,
XA_ID_NAME=>'staff_id',
XA_INIT_ORDER_BY=>'staff_id ASC',
XA_INIT_PAGE_SIZE=>20
),

'cell' => array(
XA_CLASS=>'cls_fl_cell',
XA_SPEC_FILE=>'df.fl.cell.inc.php',
XA_TABLE_NAME=>TBL_CELL,
XA_ID_NAME=>'cell_id',
XA_INIT_ORDER_BY=>'ad_id ASC',
XA_INIT_PAGE_SIZE=>20
),

);

?>
