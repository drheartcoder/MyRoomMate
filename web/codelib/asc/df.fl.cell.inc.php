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

'cell_id'=>array(
XA_CLASS=>'CVPrimaryKey',
XA_CAPTION=>'Cell ID',
XA_SIZE=>9,
XA_REQUIRED=>false,
XA_MAX_CHAR=>9,
XA_SB_SIZE=>9,
XA_LIST=>'(sp)(sr)(key)(staff)(g_reg_init)'
),

'active'=>array(
XA_CLASS=>'cls_active',
XA_CAPTION=>RSTR_ACTIVE,
XA_INIT_VALUE=>array( 'reg'=>'Y', 'search'=>'Y' ),
XA_REQUIRED=>true,
XA_SELECT_ON_TOP=>STR_SELECT_CAPTION,
XA_SEARCH_OP=>'s=',
XA_LIST=>'(sp)(sr)(fd)(staff)(g_reg_init)'
),

'active_Y' => array(
XA_CLASS=>'CVRadio',
XA_NAME_RS=>nothing,
XA_REQUIRED=>false,
XA_LINKED_TO=>'active',
XA_RADIO_VALUE=>'Y',
XA_LIST=>'(fd)'
),

'active_N' => array(
XA_CLASS=>'CVRadio',
XA_NAME_RS=>nothing,
XA_REQUIRED=>false,
XA_LINKED_TO=>'active',
XA_RADIO_VALUE=>'N',
XA_LIST=>'(fd)'
),

'rlog_create_date_time'=>array(
XA_CLASS=>'cls_rlog_date_time',
XA_CAPTION=>RSTR_CREATE_DATE_TIME,
XA_FORMAT=>'Y-m-d H:i:s',
XA_LIST=>'(rlog)(reg_save)(sr)'
),

'rlog_create_user_type'=>array(
XA_CLASS=>'cls_rlog_user_type',
XA_CAPTION=>RSTR_CREATE_USER_TYPE,
XA_LIST=>'(rlog)(reg_save)'
),

'rlog_create_user_id'=>array(
XA_CLASS=>'cls_rlog_user_id',
XA_CAPTION=>RSTR_CREATE_USER_NAME,
XA_LIST=>'(rlog)(reg_save)'
),

'rlog_create_user_name'=>array(
XA_CLASS=>'cls_rlog_user_name',
XA_CAPTION=>RSTR_CREATE_USER_NAME,
XA_LIST=>'(rlog)(reg_save)(sr)'
),

'rlog_edit_date_time'=>array(
XA_CLASS=>'cls_rlog_date_time',
XA_CAPTION=>RSTR_EDIT_DATE_TIME,
XA_FORMAT=>'Y-m-d H:i:s',
XA_LIST=>'(rlog)(edit_save)'
),

'rlog_edit_user_type'=>array(
XA_CLASS=>'cls_rlog_user_type',
XA_CAPTION=>RSTR_EDIT_USER_TYPE,
XA_LIST=>'(rlog)(edit_save)'
),

'rlog_edit_user_id'=>array(
XA_CLASS=>'cls_rlog_user_id',
XA_CAPTION=>RSTR_EDIT_USER_NAME,
XA_LIST=>'(rlog)(edit_save)'
),

'rlog_edit_user_name'=>array(
XA_CLASS=>'cls_rlog_user_name',
XA_CAPTION=>RSTR_EDIT_USER_NAME,
XA_LIST=>'(rlog)(edit_save)'
),

'ad_id'=>array(
XA_CLASS=>'CVAsciiText',
XA_CAPTION=>RSTR_AD_ID,
XA_SIZE=>24,
XA_SB_SIZE=>24,
XA_REQUIRED=>true,
XA_MIN_CHAR=>1,
XA_MAX_CHAR=>24,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(sp)(sr)(fd)(staff)(g_reg_init)'
),

'image_w'=>array(
XA_CLASS=>'CVInteger',
XA_CAPTION=>RSTR_IMAGE_W,
XA_SIZE=>6,
XA_REQUIRED=>true,
XA_MIN_CHAR=>1,
XA_MAX_CHAR=>5,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(sr)(fd)(staff)(g_reg_init)'
),

'image_h'=>array(
XA_CLASS=>'CVInteger',
XA_CAPTION=>RSTR_IMAGE_H,
XA_SIZE=>6,
XA_REQUIRED=>true,
XA_MIN_CHAR=>1,
XA_MAX_CHAR=>5,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(sr)(fd)(staff)(g_reg_init)'
),

'url_link'=>array(
XA_CLASS=>'CVText',
XA_CAPTION=>RSTR_LINK_URL,
XA_SIZE=>40,
XA_REQUIRED=>false,
XA_MIN_CHAR=>1,
XA_MAX_CHAR=>500,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(fd)(g_reg_init)(g_reg_page5)'
),

'pic'=>array(
XA_CLASS=>'cls_pic_up',
XA_CAPTION=>RSTR_PIC,
XA_SIZE=>40,
XA_REQUIRED=>false,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>255,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(sr)(fd)(g_reg_init)(g_reg_page3U)(g_reg_page4U)'
),

'pic_state'=>array(
XA_CLASS=>'CVFileUpload_State',
XA_NAME_RS=>nothing,
XA_CAPTION=>RSTR_PIC_STATE,
XA_LINKED_TO=>'pic',
XA_LIST=>'(fd)(g_reg_init)(g_reg_page3U)'
),

);

?>
