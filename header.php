<?php

//載入XOOPS主設定檔（必要）
// include_once "../../mainfile.php";
require_once dirname(dirname(__DIR__)) . '/mainfile.php';

xoops_loadLanguage('main', basename(__DIR__));
//載入自訂的共同函數檔
// include_once "function.php";
require_once __DIR__ . '/function.php';
//載入工具選單設定檔（亦可將 interface_menu.php 的內容複製到此檔下方，並刪除 interface_menu.php）
// include_once "interface_menu.php";


if ($xoopsUser) {
    $kw_device_uid = $xoopsUser->uid();
    $iskwDeviceAdmin = $xoopsUser->isAdmin($xoopsModule->getVar('mid'));
    $iskwDeviceCheck = kw_device_isCheck($kw_device_uid);

    // $iskwDeviceBook  = kw_device_isBook("kw_device_book_group");
}



$interface_menu[_MI_KWDEVICE_SMNAME1] = "index.php";
$interface_icon[_TAD_TO_MOD] = "fa-chevron-right";

if ($kw_device_uid) {
    //個人借用清單
    $interface_menu[_MI_KWDEVICE_SMNAME2] = "admin.php";
    $interface_icon[_TAD_TO_MOD] = "fa-chevron-right";
}
if ($iskwDeviceCheck || $iskwDeviceAdmin) {
    //審核借用清單
    $interface_menu[_MI_KWDEVICE_SMNAME3] = "admin.php?op=kw_device_check_list";
    $interface_icon[_TAD_TO_MOD] = "fa-chevron-right";
}

if ($iskwDeviceAdmin) {
    $interface_menu[_MI_KWDEVICE_SMNAME4] = "config.php";
    $interface_icon[_TAD_TO_MOD] = "fa-chevron-right";
}
