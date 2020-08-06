<?php

use XoopsModules\Tadtools\Utility;
use XoopsModules\Kw_device\Utility as Kw_device_Utility;

if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}

function xoops_module_update_kw_device(&$module, $old_version)
{
    global $xoopsDB;
    Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/kw_device");
    //if(!Kw_device_Utility::chk_chk1()) Kw_device_Utility::go_update1();

    return true;
}
