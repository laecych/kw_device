<?php

use XoopsModules\Tadtools\Utility;

if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}

function xoops_module_install_kw_device(&$module)
{

    Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/kw_device");

    return true;
}
