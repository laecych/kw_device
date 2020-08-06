<?php

use XoopsModules\Tadtools\Utility;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\EasyResponsiveTabs;

require_once __DIR__ . '/header.php';
$xoopsOption['template_main'] = "kw_device_config.tpl";
include_once XOOPS_ROOT_PATH . "/header.php";

if (!$iskwDeviceAdmin) {
    redirect_header('index.php', 3, _MD_KWDEVICE_FORBBIDEN); //沒有存取權限
}


/*-----------執行動作判斷區----------*/
require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op          = system_CleanVars($_REQUEST, 'op', '', 'string');
$type        = system_CleanVars($_REQUEST, 'type', '', 'string');
$config_uid   = system_CleanVars($_REQUEST, 'config_uid', '', 'int');
$cate_id     = system_CleanVars($_REQUEST, 'cate_id', '', 'int');
$place_id    = system_CleanVars($_REQUEST, 'place_id', '', 'int');
// $users_uid   = system_CleanVars($_REQUEST, 'users_uid', '', 'string');
// $equ_enable   = system_CleanVars($_REQUEST, 'equ_enable', '', 'int');



switch ($op) {


        //審核者
    case 'kw_device_config_insert':
        $config_id = kw_device_config_insert($type);
        header("location: {$_SERVER['PHP_SELF']}?type=$type#setupTab1");
        exit;

    case 'kw_device_config_update':
        kw_device_config_update($type, $config_uid);
        header("location: {$_SERVER['PHP_SELF']}?type=$type#setupTab1");
        exit;

    case 'kw_device_config_delete':
        kw_device_config_delete($type, $config_uid);
        header("location: {$_SERVER['PHP_SELF']}?type=$type#setupTab1");
        break;


        //新增類別
    case 'kw_device_cate_insert':
        $cate_id = kw_device_config_insert($type);
        header("location: {$_SERVER['PHP_SELF']}?type=$type#setupTab2");
        exit;
    case 'kw_device_cate_update':
        kw_device_config_update($type, $cate_id);
        header("location: {$_SERVER['PHP_SELF']}?type=$type#setupTab2");
        exit;
    case 'kw_device_cate_delete':
        kw_device_config_delete($type, $cate_id);
        header("location: {$_SERVER['PHP_SELF']}?type=$type#setupTab2");
        exit;

        //地點
    case 'kw_device_place_insert':
        $place_id = kw_device_config_insert($type);
        header("location: {$_SERVER['PHP_SELF']}?type=$type#setupTab3");
        exit;

    case 'kw_device_place_update':
        kw_device_config_update($type, $place_id);
        header("location: {$_SERVER['PHP_SELF']}?type=$type#setupTab3");
        exit;

    case 'kw_device_place_delete':
        kw_device_config_delete($type, $place_id);
        header("location: {$_SERVER['PHP_SELF']}?type=$type#setupTab3");
        exit;

    default:
        kw_device_config_list('config');
        kw_device_config_form('config', $config_uid);
        kw_device_config_list('cate');
        kw_device_config_form('cate', $cate_id);
        kw_device_config_list('place');
        kw_device_config_form('place', $place_id);
        kw_device_config_list('equ');
        $op = 'kw_device_config';
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('op', $op);

// $xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu));
$xoopsTpl->assign("toolbar", Utility::toolbar_bootstrap($interface_menu));
$xoopsTpl->assign('uid', $kw_device_uid);
$xoopsTpl->assign('iskwDeviceAdmin', $iskwDeviceAdmin);
$xoopsTpl->assign('iskwDeviceCheck', $iskwDeviceCheck);
$xoTheme->addStylesheet(XOOPS_URL . '/modules/kw_device/assets/css/module.css');
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tadtools/css/vtable.css');
require_once XOOPS_ROOT_PATH . '/footer.php';



/*-----------function區--------------*/


function kw_device_config_list($type)
{
    global $xoopsDB, $xoopsTpl;

    //刪除確認的JS
    $sweet_alert_obj = new SweetAlert();
    $sweet_alert_obj->render("delete_{$type}_func", "{$_SERVER['PHP_SELF']}?type={$type}&op=kw_device_{$type}_delete&{$type}_id=", "{$type}_id");

    //頁簽的js    
    $responsive_tabs = new EasyResponsiveTabs('#setupTab');
    $responsive_tabs->rander();


    $myts = \MyTextSanitizer::getInstance();

    $sql = 'select * from `' . $xoopsDB->prefix('kw_device_' . $type) . '` order by ' . $type . '_sort';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql);

    $all_content = [];
    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        //過濾讀出的變數值
        $all["{$type}_title"] = $myts->htmlSpecialChars($all["{$type}_title"]);
        $all_content[]        = $all;
    }


    $xoopsTpl->assign('type', $type);
    $xoopsTpl->assign('action', "{$_SERVER['PHP_SELF']}?type={$type}");
    $xoopsTpl->assign("all_{$type}_content", $all_content);
}


/**
 * @param        $type 
 * @param string $type_id
 */
function kw_device_config_form($type, $type_id = '')
{
    global $xoopsDB, $xoopsTpl, $xoopsUser;

    //抓取預設值
    $DBV = empty($type_id) ? [] : kw_device_get_config($type, $type_id);

    //預設值設定
    $xoopsTpl->assign('type', $type);

    //設定 config_id 欄位的預設值
    $id = !isset($DBV[$type . '_id']) ? '' : $DBV[$type . '_id'];
    $xoopsTpl->assign($type . '_id', $id);

    if ($type == 'config') {
        kw_device_get_user(); //取得所有uid送到前台

        $uid = !isset($DBV[$type . '_uid']) ? '' : $DBV[$type . '_uid'];
        $xoopsTpl->assign($type . '_uid', $uid);
    }
    //設定 title 欄位的預設值
    $title = !isset($DBV[$type . '_title']) ? '' : $DBV[$type . '_title'];
    $xoopsTpl->assign($type . '_title', $title);


    //設定 sort 欄位的預設值
    $sort = !isset($DBV[$type . '_sort']) ? kw_device_max_sort($type) : $DBV[$type . '_sort'];
    $xoopsTpl->assign($type . '_sort', $sort);

    //設定 enable 欄位的預設值
    $enable = !isset($DBV[$type . '_isenable']) ? '' : $DBV[$type . '_isenable'];
    $xoopsTpl->assign($type . '_enable', $enable);

    $op = empty($type_id) ? "kw_device_{$type}_insert" : "kw_device_{$type}_update";
    $xoopsTpl->assign($type . '_op', $op);

    //加入Token安全機制
    require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
    $token      = new \XoopsFormHiddenToken();
    $token_form = $token->render();
    $xoopsTpl->assign($type . '_token', $token_form);

    //套用formValidator驗證機制

    $formValidator = new FormValidator('.myForm', true);
    $formValidator->render();
}




function kw_device_config_insert($type)
{
    global $xoopsDB, $xoopsTpl;

    //XOOPS表單安全檢查

    if (!$GLOBALS['xoopsSecurity']->check() && $type != 'config') {
        $error = implode('<br>', $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $myts = \MyTextSanitizer::getInstance();

    $title  = $myts->addSlashes($_POST[$type . '_title']);
    $sort   = (int) $_POST[$type . '_sort'];
    $enable = (int) $_POST[$type . '_enable'];

    if ($type == 'config') {

        $uid   = (int) $_POST[$type . '_uid'];

        //檢查uid是否重複
        if (uid_check($uid) || empty($uid)) {
            redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_UID_WRONG);
        }

        $sql = 'insert into `' . $xoopsDB->prefix('kw_device_' . $type) . "` (
            `{$type}_uid`,
            `{$type}_title`,
            `{$type}_sort`,
            `{$type}_isenable`
            ) values(
            '{$uid}',
            '{$title}',
            '{$sort}',
            '{$enable}'
        )";

        $xoopsDB->query($sql) or Utility::web_error($sql);
    } else {
        $sql = 'insert into `' . $xoopsDB->prefix('kw_device_' . $type) . "` (
            `{$type}_title`,
            `{$type}_sort`,
            `{$type}_isenable`
            ) values(
            '{$title}',
            '{$sort}',
            '{$enable}'
        )";
        $xoopsDB->query($sql) or Utility::web_error($sql);
    }

    //取得最後新增資料的流水編號
    $id = $xoopsDB->getInsertId();

    return $id;
}


function kw_device_config_update($type, $type_id)
{
    global $xoopsDB, $xoopsTpl;

    if (!isset($type_id) or empty($type)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_NEED_CATE_ID); //沒有指定編號
    }

    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check() && $type != 'config') {
        $error = implode('<br>', $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $myts = \MyTextSanitizer::getInstance();

    $title  = $myts->addSlashes($_POST[$type . '_title']);
    $sort   = (int) $_POST[$type . '_sort'];
    $enable = (int) $_POST[$type . '_enable'];


    if ($type == 'config') {
        $uid = (int) $_POST['config_uid'];
        $sql = 'update `' . $xoopsDB->prefix('kw_device_' . $type) . "` set
        `{$type}_uid` = '{$uid}',
        `{$type}_title` = '{$title}',
        `{$type}_sort` = '{$sort}',
        `{$type}_isenable` = '{$enable}'
        where `{$type}_id` = '{$type_id}'";
        $xoopsDB->queryF($sql) or Utility::web_error($sql);
    } else {

        $sql = 'update `' . $xoopsDB->prefix('kw_device_' . $type) . "` set
        `{$type}_title` = '{$title}',
        `{$type}_sort` = '{$sort}',
        `{$type}_isenable` = '{$enable}'
        where `{$type}_id` = '{$type_id}'";
        $xoopsDB->queryF($sql) or Utility::web_error($sql);
    }

    return $type_id;
}

function kw_device_config_delete($type, $type_id)
{
    global $xoopsDB;

    if (!isset($type_id) or empty($type)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_NEED_CATE_ID); //沒有指定編號
        return;
    } else if (kw_device_delete_check($type, $type_id, 'equ')) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_NOT_EMPTY_BOOK); //有相依性問題
        return;
    } else {
        if ($type == 'config')
            $sql = 'delete from `' . $xoopsDB->prefix('kw_device_' . $type) . '`
        where `' . $type . "_uid` = '{$type_id}'";
        else
            $sql = 'delete from `' . $xoopsDB->prefix('kw_device_' . $type) . '`
        where `' . $type . "_id` = '{$type_id}'";

        $xoopsDB->queryF($sql) or Utility::web_error($sql);
    }
}


//取得所有使用者
function kw_device_get_user()
{
    global $xoopsTpl, $xoopsDB;
    // $groupid  = group_id_from_name(_MD_KWDEVICE_TEACHER_GROUP);
    // $user_arr = [];
    // //列出群組中有哪些人
    // if ($groupid) {
    //     /* @var \XoopsMemberHandler $memberHandler */
    //     $memberHandler = xoops_getHandler('member');
    //     $user_arr      = $memberHandler->getUsersByGroup($groupid);
    // }

    $sql = 'select uid, uname, name from ' . $xoopsDB->prefix('users') . ' order by uname';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql);



    $i = 0;
    while (list($uid, $name, $uname) = $xoopsDB->fetchRow($result)) {
        $user_arr[$i]['uid'] = $uid;
        $user_arr[$i]['name'] = $name;
        $user_arr[$i]['uname'] = $uname;
        $i++;
    }
    $xoopsTpl->assign('user_arr', $user_arr);



    // $myts    = \MyTextSanitizer::getInstance();
    // $user_ok = $user_yet = '';
    // while (false !== ($all = $xoopsDB->fetchArray($result))) {
    //     foreach ($all as $k => $v) {
    //         $$k = $v;
    //     }
    //     $name  = $myts->htmlSpecialChars($name);
    //     $uname = $myts->htmlSpecialChars($uname);
    //     $name  = empty($name) ? '' : " ({$name})";
    //     if (!empty($user_arr) and in_array($uid, $user_arr)) {
    //         $user_ok .= "<option value=\"$uid\">{$uid} {$name} {$uname} </option>";
    //     } else {
    //         $user_yet .= "<option value=\"$uid\">{$uid} {$name} {$uname} </option>";
    //     }
    // }
    //加入Token安全機制
    //  require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
    //  $token = new \XoopsFormHiddenToken();
    //  $xoopsTpl->assign('config_token', $token->render());

    // $xoopsTpl->assign('user_arr', implode(',', $user_arr));
    // $xoopsTpl->assign('user_ok', $user_ok);
    // $xoopsTpl->assign('user_yet', $user_yet);
}
