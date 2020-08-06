<?php

use XoopsModules\Kw_device;
use XoopsModules\Kw_device\Helper;

require dirname(__DIR__) . '/preloads/autoloader.php';

$moduleDirName      = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

/** @var Kw_device\Helper $helper */
$helper = Kw_device\Helper::getInstance();
$helper->loadLanguage('common');

$pathIcon32 = \Xmf\Module\Admin::menuIconPath('');
if (is_object($helper->getModule())) {
    $pathModIcon32 = $helper->getModule()->getInfo('modicons32');
}

$adminmenu[] = [
    'title' => _MI_TAD_ADMIN_HOME,
    'desc'  => _MI_TAD_ADMIN_HOME_DESC,
    'link'  => 'admin/index.php',
    'icon'  => 'assets/images/admin/home.png',
];

// $adminmenu[] = [
//     'title' => _MI_KWDEVICE_SETUP_ADMIN,
//     'desc'  => _MI_KWDEVICE_SETUP_ADMIN,
//     'link'  => 'admin/main.php',
//     'icon'  => 'assets/images/admin/button.png',
// ];


$adminmenu[] = [
    'title' => _MI_TAD_ADMIN_ABOUT,
    'desc'  => _MI_TAD_ADMIN_ABOUT_DESC,
    'link'  => 'admin/about.php',
    'icon'  => "{$pathIcon32}/about.png",
];
