<?php

// use XoopsModules\kw_device\kw_device;
use XoopsModules\Tadtools\Utility;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\CkEditor;
use XoopsModules\Tadtools\My97DatePicker;


require_once __DIR__ . '/header.php';
$xoopsOption['template_main'] = 'kw_device_admin.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

// if (empty($kw_device_uid)) {
//     redirect_header('index.php', 3, _MD_KWDEVICE_FORBBIDEN); //沒有存取權限
// }

/*-----------執行動作判斷區----------*/
require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op             = system_CleanVars($_REQUEST, 'op', '', 'string');
$book_year      = system_CleanVars($_REQUEST, 'book_year', '', 'int');
$book_id        = system_CleanVars($_REQUEST, 'book_id', '', 'int');
$book_uid       = system_CleanVars($_REQUEST, 'book_uid', '', 'int');
$equ_id         = system_CleanVars($_REQUEST, 'equ_id', '', 'int');
$review         = system_CleanVars($_REQUEST, 'review', 'book_id', 'string');
$show_PageBar   = system_CleanVars($_REQUEST, 'show_PageBar', 'true', 'bool');
$type           = system_CleanVars($_REQUEST, 'type', '', 'string');
$isvalue        = system_CleanVars($_REQUEST, 'isvalue', '', 'int');
$note           = system_CleanVars($_REQUEST, 'note', '', 'string');

$today = date('Y-m-d');


switch ($op) {
        //審核者

    case 'kw_device_book_form':
        kw_device_book_form($equ_id, $book_id);
        break;

    case 'kw_device_book_insert':
        $book_id = kw_device_book_insert($equ_id);
        header("location: {$_SERVER['PHP_SELF']}");
        break;

    case 'kw_device_book_update':
        kw_device_book_update($book_id);
        header("location: {$_SERVER['PHP_SELF']}?book_id={$book_id}");
        break;

    case 'kw_device_book_delete':
        kw_device_book_delete($book_id);
        header("location: {$_SERVER['PHP_SELF']}");
        break;

    case 'kw_device_update_book_enable':
        $book_isenable     = system_CleanVars($_REQUEST, 'book_isenable', '', 'int');
        kw_device_update_isenable('book', $book_id, $book_isenable);
        header("location: {$_SERVER['PHP_SELF']}");
        break;

    case 'kw_device_check_list':
        if ($book_id && $type) {
            kw_device_check_update($book_id, $type, $isvalue, $note);
            header("location: {$_SERVER['PHP_SELF']}?op=kw_device_check_list");
        }
        kw_device_book_list($book_year, $review, true);
        $op = 'kw_device_check_list';
        break;

    default:

        kw_device_book_list($book_year, $review, true);
        $op = 'kw_device_book_list';
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('op', $op);
// $xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu));
$xoopsTpl->assign("toolbar", Utility::toolbar_bootstrap($interface_menu));
$xoopsTpl->assign('today', $today);
$xoopsTpl->assign('uid', $kw_device_uid);
$xoopsTpl->assign('iskwDeviceAdmin', $iskwDeviceAdmin);
$xoopsTpl->assign('iskwDeviceCheck', $iskwDeviceCheck);
$xoTheme->addStylesheet(XOOPS_URL . '/modules/kw_device/assets/css/module.css');
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tadtools/css/vtable.css');
require_once XOOPS_ROOT_PATH . '/footer.php';



/*-----------function區--------------*/


function kw_device_book_list($book_year = '', $review = '',  $show_PageBar = false)
{
    global $kw_device_uid, $iskwDeviceCheck, $iskwDeviceAdmin;
    global $xoopsDB, $xoopsTpl, $xoopsModuleConfig, $op, $today;

    //檢查權限
    if (!$kw_device_uid) {
        redirect_header('index.php', 3, _MD_KWDEVICE_FORBBIDEN);
        exit;
    }

    $myts = \MyTextSanitizer::getInstance();

    //取得排序語法
    if ('book_islate' === $review) { //預期未還
        $order = 'ORDER BY a.`book_islate`, b.`equ_id` desc';
    } else if ('book_ischecked' === $review) { //審核狀況
        $order = 'ORDER BY a.`book_ischecked`, b.`equ_id` desc';
    } else if ('book_isdeny' === $review) { //審核狀況
        $order = 'ORDER BY a.`book_isdeny`, b.`equ_id` desc';
    } else if ('book_isreturn' === $review) {  //是否歸還
        $order = 'ORDER BY a.`book_isreturn`, b.`equ_id` desc';
    } else if ('book_isfinish' === $review) {  //是否完成
        $order = 'ORDER BY a.`book_isfinish`, b.`equ_id` desc';
    } else if ('book_isenable' === $review) { //是否申請
        $order = 'ORDER BY a.`book_isenable`, b.`equ_id` desc';
    } else {  //時間排序
        $order = 'ORDER BY a.`book_time` desc, b.`equ_id` desc';
    }


    $semester = kw_device_get_semester();
    if (empty($book_year))
        $book_year = $semester['year'];
    else
        $book_year = $myts->htmlSpecialChars($book_year);


    if ($iskwDeviceAdmin)
        $and_book_id = "a.`book_year`='{$book_year}'";
    elseif ($op == "kw_device_check_list" && $iskwDeviceCheck) //審核介面
        $and_book_id = "a.`book_year`='{$book_year}' and a.`config_uid`='{$kw_device_uid}' and a.`book_isenable` = '1' ";
    else //個人借用清單
        $and_book_id = "a.`book_year`='{$book_year}' and a.`book_uid`='{$kw_device_uid}'";



    $sql = 'select a.*,b.* from `' . $xoopsDB->prefix('kw_device_book') . '` as a
    join `' . $xoopsDB->prefix('kw_device_equ') . "` as b on a.`equ_id` = b.`equ_id`
    where {$and_book_id} {$order}";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql);

    //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    if ($show_PageBar) {
        $PageBar = Utility::getPageBar($sql, 10, 20);
        $bar     = $PageBar['bar'];
        $sql     = $PageBar['sql'];
        $total   = $PageBar['total'];
        if ($xoopsTpl) {
            $xoopsTpl->assign('bar', $bar);
            $xoopsTpl->assign('total', $total);
        }
    }

    //取得分類所有資料陣列
    $all_config_arr     = kw_device_get_allTitle('config');
    $all_cate_arr       = kw_device_get_allTitle('cate');
    $all_place_arr      = kw_device_get_allTitle('place');


    $all_book = [];
    $i                  = 0;
    while (false !== ($all = $xoopsDB->fetchArray($result))) {

        foreach ($all as $k => $v) {
            $$k = $v;
        }
        $uid_name = XoopsUser::getUnameFromId($book_uid, 1);
        if (empty($uid_name)) $uid_name = XoopsUser::getUnameFromId($book_uid, 0);

        //check isuntaken
        if ($today > $book_time_end && $book_ischecked == 1 &&  $book_istaken == 0) {
            $isuntaken = 1;
            $update_sql = "UPDATE  `" . $xoopsDB->prefix('kw_device_book') . "` SET 
            `book_ischecked` = '0', `book_isdeny` = '1' , `book_checknote` ='領取逾期取消借用'   
             WHERE `book_id` = '{$book_id}'";
            $xoopsDB->queryF($update_sql);
        } else {
            $isuntaken = 0;
        }


        //check islate
        if ($today > $book_time_end && $book_istaken == 1 && $book_isreturn == 0 && $book_islate == 0) {
            $islate = 1;
            $update_sql = "UPDATE  `" . $xoopsDB->prefix('kw_device_book') . "` SET 
            `book_islate` = '1'  WHERE `book_id` = '{$book_id}'";
            $xoopsDB->queryF($update_sql);
        } else {
            $islate = $book_islate;
        }


        $all_book[$i]['book_id']        = (int) $book_id;
        $all_book[$i]['book_uid']       = (int) $book_uid;
        $all_book[$i]['book_uidname']    = $myts->htmlSpecialChars($uid_name);
        $all_book[$i]['book_number']     = (int) $book_number;
        $all_book[$i]['book_desc']       =  $myts->displayTarea($book_desc, 1, 1, 0, 1, 0);
        $all_book[$i]['book_mode']       = $myts->htmlSpecialChars($book_mode);
        $all_book[$i]['book_time_start'] = $myts->htmlSpecialChars($book_time_start);
        $all_book[$i]['book_time_end']   = $myts->htmlSpecialChars($book_time_end);
        $all_book[$i]['book_ischecked']  = (int) $book_ischecked;
        $all_book[$i]['book_isdeny']     = (int) $book_isdeny;
        $all_book[$i]['book_istaken']    = (int) $book_istaken;
        $all_book[$i]['book_isreturn']   = (int) $book_isreturn;
        $all_book[$i]['book_islate']     = (int) $islate;
        $all_book[$i]['book_isuntaken']  = (int) $isuntaken;
        $all_book[$i]['book_isfinish']   = (int) $book_isfinish;
        $all_book[$i]['book_isenable']   = (int) $book_isenable;
        $all_book[$i]['book_year']       = (int) $book_year;
        $all_book[$i]['book_time']       = $myts->htmlSpecialChars($book_time);
        $all_book[$i]['book_checknote']  = $myts->htmlSpecialChars($book_checknote);
        $all_book[$i]['config_uid']       = (int) $config_uid;

        $all_book[$i]['equ_id']         = (int) $equ_id;
        $all_book[$i]['equ_year']        = $myts->htmlSpecialChars($equ_year);
        $all_book[$i]['equ_code']        = $myts->htmlSpecialChars($equ_code);
        $all_book[$i]['equ_title']      = $myts->htmlSpecialChars($equ_title);
        $all_book[$i]['equ_note']       = $myts->displayTarea($equ_note, 1, 1, 0, 1, 0);
        $all_book[$i]['cate_id']          = $myts->htmlSpecialChars($all_cate_arr[$cate_id]);
        $all_book[$i]['config_id']       = $myts->htmlSpecialChars($all_config_arr[$config_uid]);
        $all_book[$i]['place_id']         = $myts->htmlSpecialChars($all_place_arr[$place_id]);
        $all_book[$i]['equ_number']       = (int) $equ_number;
        $all_book[$i]['equ_available']     = (int) $equ_available;
        $all_book[$i]['equ_sort']       = (int) $equ_sort;
        $all_book[$i]['equ_count']       = (int) $equ_count;
        // $all_book[$i]['equ_date']   = isset($equ_date) ? $myts->htmlSpecialChars($equ_date) : '';
        $all_book[$i]['equ_isenable']     = (int) $equ_isenable;
        $all_book[$i]['equ_isenable_pic'] = $equ_isenable ? '<img src="' . XOOPS_URL . '/modules/kw_device/assets/images/yes.gif" alt="' . _YES . '" title="' . _YES . '">' : '<img src="' . XOOPS_URL . '/modules/kw_device/assets/images/no.gif" alt="' . _NO . '" title="' . _NO . '">';

        //是否可借
        $all_book[$i]['is_full'] = ($equ_available == '0') ? true : false;

        $i++;
    }

    //刪除確認的JS

    $sweet_alert_obj = new SweetAlert();
    $sweet_alert_obj->render('delete_book_func', "{$_SERVER['PHP_SELF']}?op=kw_device_book_delete&book_id=", 'book_id');



    $xoopsTpl->assign('all_book', $all_book);
    $xoopsTpl->assign('semester', $semester);
    $xoopsTpl->assign('book_year', $book_year);
    $xoopsTpl->assign('review', $review);
    $xoopsTpl->assign('uid', $kw_device_uid);
    $xoopsTpl->assign('iskwDeviceAdmin', $iskwDeviceAdmin);
    $xoopsTpl->assign('iskwDeviceCheck', $iskwDeviceCheck);
}




function kw_device_book_form($equ_id = '', $book_id = '')
{
    global $kw_device_uid;
    global $xoopsDB, $xoopsTpl, $xoopsModuleConfig;

    //檢查權限
    if (!$kw_device_uid) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_FORBBIDEN);
        exit;
    }

    //檢查預約設備 equ_id or book_id
    if (empty($equ_id) && empty($book_id)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_NEED_EQU_ID);
        exit;
    } else {

        //判斷修改or新增(取預設值)
        if (!empty($book_id)) {
            $DBV        = kw_device_get_data('book', $book_id);
            $xoopsTpl->assign('book_id', $book_id);
            //取得設備
            $equ_id     = $DBV['equ_id'];
            $equ_arr    = kw_device_get_data("equ", $equ_id);
            $xoopsTpl->assign('equ', $equ_arr);
            $xoopsTpl->assign('equ_id', $equ_id);
            $xoopsTpl->assign('equ_available', $equ_arr['equ_available']);
        } else {
            $DBV      = [];
            $book_id = '';

            $equ_arr = kw_device_get_data("equ", $equ_id);
            $xoopsTpl->assign('equ', $equ_arr);
            $xoopsTpl->assign('equ_id', $equ_id);
            $xoopsTpl->assign('equ_available', $equ_arr['equ_available']);
        }


        $config     = kw_device_get_config_title('config', $equ_arr['config_uid']);
        $cate       = kw_device_get_config_title('cate', $equ_arr['cate_id']);
        $place      = kw_device_get_config_title('place', $equ_arr['place_id']);
        $xoopsTpl->assign('config', $config);
        $xoopsTpl->assign('cate', $cate);
        $xoopsTpl->assign('place', $place);


        $kw_device_semester = kw_device_get_semester();
        $xoopsTpl->assign('semester', $kw_device_semester);



        // $book_arr = explode(';', $xoopsModuleConfig['school_class']);
        // foreach ($book_arr as $book_name) {
        //     $school_class[] = trim($book_name);
        // }
        // $xoopsTpl->assign('school_class', $school_class);

        //安全性表單
        require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        $token = new \XoopsFormHiddenToken('XOOPS_TOKEN', 360);
        $xoopsTpl->assign('book_token', $token->render());

        //引入日期
        $cal = new My97DatePicker();
        $cal::render();

        //設定 book_time_start 欄位的預設值
        $book_time_start = !isset($DBV['book_time_start']) ? '' : $DBV['book_time_start'];
        $xoopsTpl->assign('book_time_start', $book_time_start);
        //設定 book_time_end 欄位的預設值
        $book_time_end = !isset($DBV['book_time_end']) ? '' : $DBV['book_time_end'];
        $xoopsTpl->assign('book_time_end', $book_time_end);

        //設定 book_mode 欄位的預設值
        $book_mode = !isset($DBV['book_mode']) ? '1' : $DBV['book_mode'];
        $xoopsTpl->assign('book_mode', $book_mode);


        //設定 book_isenable 欄位的預設值
        $book_isenable = !isset($DBV['book_isenable']) ? '1' : $DBV['book_isenable'];
        $xoopsTpl->assign('book_isenable', $book_isenable);


        //設定 book_desc 欄位的預設值
        $book_desc = !isset($DBV['book_desc']) ? '' : $DBV['book_desc'];
        $xoopsTpl->assign('book_desc', $book_desc);

        //設定 book_available 欄位的預設值
        $book_available = [];
        $book_available = range(1, $equ_arr['equ_available']);
        $xoopsTpl->assign('book_available',  $book_available);

        //所見即所得編輯器
        $ck = new CkEditor('kw_device', 'book_desc', $book_desc);
        $ck->setHeight(250);
        $ck->setToolbarSet('tadSimple');
        $editor = $ck->render();
        $xoopsTpl->assign('book_desc_editor', $editor);

        //套用formValidator驗證機制

        $formValidator = new FormValidator('#bookForm', true);
        $formValidator->render();
    }
}


function kw_device_book_insert($equ_id)
{
    global $kw_device_uid, $iskwDeviceCheck, $iskaDeviceAdmin, $today;
    global $xoopsDB;

    //檢查權限
    if (!$iskaDeviceAdmin && !$kw_device_uid && !$iskwDeviceCheck) {
        redirect_header('index.php', 3, _MD_KWDEVICE_FORBBIDEN);
        exit;
    }

    if (empty($equ_id)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_NEED_EQU_ID);
        exit;
    }

    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode('<br>', $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $myts = \MyTextSanitizer::getInstance();


    $equ_arr =  kw_device_get_data("equ", $equ_id); //取得設備資料和審核者
    $config_uid = $equ_arr['config_uid'];
    $book_uid = $kw_device_uid;
    $book_number = (int) $myts->addSlashes($_REQUEST['book_number']);
    $book_isenable = (int) $myts->addSlashes($_REQUEST['book_isenable']);
    $book_desc = $myts->addSlashes($_REQUEST['book_desc']);
    $book_mode = $myts->addSlashes($_REQUEST['book_mode']);
    $book_time_start = $myts->addSlashes($_REQUEST['book_time_start']);
    $book_time_end = $myts->addSlashes($_REQUEST['book_time_end']);
    $semester = kw_device_get_semester();
    $book_year = $semester['year'];
    // $book_ip = kw_device_get_ip();

    $update_available = $equ_arr['equ_available'] - $book_number;
    $update_count = $equ_arr['equ_count'] + 1;

    //檢查借用是否可行（但管理員不在此限）
    //檢查設備是否可借
    if ($equ_arr['equ_available'] == 0 or $equ_arr['equ_available'] < $book_number) { //沒有設備了 or 借的數量大於可借
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_EQU_BOOK_FULL);
        return;
    }

    //檢查借用日期是否正確
    if (!kw_device_chk_time($book_time_start, $book_time_end, $book_mode)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_BOOK_DATE_ERROR);
        return;
    }


    $sql = " INSERT INTO `" . $xoopsDB->prefix('kw_device_book') . "` (
        `book_uid`,`equ_id`, `config_uid`,`book_number`,`book_isenable`, `book_desc`, `book_mode`,`book_time_start`, `book_time_end`,  `book_year`, `book_time`) 
        VALUES
        (
            '{$book_uid}',
            '{$equ_id}',
            '{$config_uid}',
            '{$book_number}',
            '{$book_isenable}',
            '{$book_desc}',
            '{$book_mode}',
            '{$book_time_start}',
            '{$book_time_end}',
            '{$book_year}',
            NOW()
        )";


    if ($xoopsDB->query($sql)) {
        // $book_id = $xoopsDB->getInsertId();
        //update 可借用設備數量
        $update_sql = "UPDATE `" . $xoopsDB->prefix('kw_device_equ') . "` SET `equ_available` ='{$update_available}', `equ_count`='{$update_count}'  where `equ_id`='{$equ_id}'";
        $xoopsDB->queryF($update_sql) or Utility::web_error($sql);
    } else {
        Utility::web_error($sql);
    }

    //email通知審核者
    $title = sprintf(_MD_KWDEVICE_BOOKMAIL_TITLE, $today,  $equ_arr['equ_title']);
    $content = sprintf(_MD_KWDEVICE_BOOKMAIL_CONTENT, $today, $equ_arr['equ_title'], "<a href='" . XOOPS_URL . "/modules/kw_device/admin.php?op=kw_device_check_list'>" . XOOPS_URL . "/modules/kw_device/admin.php?op=kw_device_check_list</a>");

    $msg = SendEmail($config_uid, $title, $content);
    redirect_header("admin.php", 3, $msg);
}

function kw_device_book_update($book_id)
{
    global $kw_device_uid, $iskwDeviceCheck, $iskaDeviceAdmin;
    global $xoopsDB;

    //檢查權限
    if (!$iskaDeviceAdmin && !$kw_device_uid && !$iskwDeviceCheck) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_FORBBIDEN);
        exit;
    }
    if (empty($book_id)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_NEED_BOOK_ID);
        exit;
    } else {
        $book_arr = kw_device_get_data('book', $book_id);
        $book_number_old = $book_arr['book_number'];
        $equ_id = $book_arr['equ_id'];
        $equ_arr = kw_device_get_data('equ', $equ_id);
        $equ_available = $equ_arr['equ_available'];
    }


    //檢查是否審核完畢
    if ($book_arr['book_ischecked'] == 1) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_BOOK_ISCHECK);
        exit;
    }

    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode('<br>', $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $myts = \MyTextSanitizer::getInstance();

    $book_number        = (int) $_POST['book_number'];
    $book_isenable      = (int) $_POST['book_isenable'];
    $book_mode          = $myts->addSlashes($_POST['book_mode']);
    $book_time_start    = $myts->addSlashes($_POST['book_time_start']);
    $book_time_end      = $myts->addSlashes($_POST['book_time_end']);
    $book_desc          = $myts->addSlashes($_POST['book_desc']);
    $book_time          = date('Y-m-d H:i:s');

    //檢查借用日期是否正確
    if (!kw_device_chk_time($book_time_start, $book_time_end, $book_mode)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_BOOK_DATE_ERROR);
        return;
    }


    $sql = 'update `' . $xoopsDB->prefix('kw_device_book') . "` set 
    `book_number` = '{$book_number}',
    `book_desc` = '{$book_desc}',
    `book_mode` = '{$book_mode}',
    `book_time_start` = '{$book_time_start}',
    `book_time_end` = '{$book_time_end}',
    `book_isenable` = '{$book_isenable}',
    `book_time` = '{$book_time}' 
    where `book_id` = '$book_id'";

    //update可借用設備數量
    if ($xoopsDB->query($sql)) {
        if ($book_number_old != $book_number) {
            $diff = $book_number_old - $book_number;
            $equ_available =   $equ_available + $diff;
            $update_sql = "UPDATE `" . $xoopsDB->prefix('kw_device_equ') . "` SET `equ_available` ='{$equ_available}'  where `equ_id`='{$equ_id}'";
            $xoopsDB->queryF($update_sql) or Utility::web_error($sql);
        }
    } else
        Utility::web_error($sql);

    return $book_id;
}



function  kw_device_book_delete($book_id)
{
    global $xoopsDB;
    global $kw_device_uid, $iskwDeviceCheck, $iskaDeviceAdmin;

    //檢查權限
    if (!$kw_device_uid) {
        redirect_header('index.php', 3, _MD_KWDEVICE_FORBBIDEN);
        exit;
    }

    if (empty($book_id)) {
        redirect_header("{$_SERVER['PHP_SELF']}", 3, _MD_KWDEVICE_NEED_BOOKID);
        return;
    } else {
        //取得預約借用數量和設備id
        $book_arr       = kw_device_get_data('book', $book_id);
        $equ_id         = $book_arr['equ_id'];
        $book_ischecked = $book_arr['book_ischecked'];
        $book_number    = $book_arr['book_number'];

        //檢查是否已審核
        if ($book_ischecked == 1) {
            redirect_header("{$_SERVER['PHP_SELF']}", 3, _MD_KWDEVICE_FORBBIDEN);
            return;
        }

        //刪除
        $sql = 'delete from `' . $xoopsDB->prefix('kw_device_book') . "`  where `book_id` = '{$book_id}'";
        if ($xoopsDB->queryF($sql)) {

            //修改可借用數量
            $sql = 'update `' . $xoopsDB->prefix('kw_device_equ') . "`
                set `equ_available` =`equ_available`+{$book_number}   where `equ_id` = '{$equ_id}'";
            $xoopsDB->queryF($sql);
        } else
            Utility::web_error($sql);

        return $book_id;
    }
}

function kw_device_check_update($book_id, $type, $isvalue, $note = '')
{
    global $xoopsDB, $kw_device_uid, $iskwDeviceAdmin, $iskwDeviceCheck, $today;

    if (empty($book_id)) {
        redirect_header("{$_SERVER['PHP_SELF']}?op=kw_device_check_list", 3, _MD_KWDEVICE_NEED_BOOKID);
        return false;
    } else {

        $book_arr = kw_device_get_data('book', $book_id);
        $book_number = $book_arr['book_number'];
        $equ_id = $book_arr['equ_id'];

        //檢查權限
        if (!$iskwDeviceAdmin && !$iskwDeviceCheck) {
            redirect_header("{$_SERVER['PHP_SELF']}?op=kw_device_check_list", 3, _MD_KWDEVICE_FORBBIDEN);
            return false;
        } else if ($kw_device_uid != $book_arr['config_uid'] && !$iskwDeviceAdmin) { //檢查是否是審核者本人
            redirect_header("{$_SERVER['PHP_SELF']}?op=kw_device_check_list", 3, _MD_KWDEVICE_NEED_BOOKID);
            return false;
        } else {

            if ($type == 'isreturn') {
                $sql = "UPDATE  `" . $xoopsDB->prefix('kw_device_book') . "` SET 
                    `book_{$type}`  = '{$isvalue}',
                    `book_islate`   =   '0',
                    `book_checknote`= '{$note}' 
                    WHERE `book_id` = '{$book_id}'";
                if ($xoopsDB->queryF($sql)) {
                    $update_sql = "UPDATE `" . $xoopsDB->prefix('kw_device_equ') . "` SET 
                        `equ_available` =`equ_available` + {$book_number} 
                        WHERE `equ_id`='{$equ_id}'";
                    $xoopsDB->queryF($update_sql) or Utility::web_error($update_sql);
                }
            } else if ($type == 'isdeny') {
                $sql = "UPDATE  `" . $xoopsDB->prefix('kw_device_book') . "` SET 
                    `book_{$type}`  = '{$isvalue}',
                    `book_checknote`= '{$note}' 
                    WHERE `book_id` = '{$book_id}'";
                if ($xoopsDB->queryF($sql)) {
                    $update_sql = "UPDATE `" . $xoopsDB->prefix('kw_device_equ') . "` SET 
                        `equ_available` =`equ_available` + {$book_number} 
                        WHERE `equ_id`='{$equ_id}'";
                    $xoopsDB->queryF($update_sql) or Utility::web_error($update_sql);
                }
            } else {

                $sql = "UPDATE  `" . $xoopsDB->prefix('kw_device_book') . "` SET 
                `book_{$type}`  = '{$isvalue}',
                `book_checknote`= '{$note}' 
                WHERE `book_id` = '{$book_id}'";

                $xoopsDB->queryF($sql) or Utility::web_error($sql);
            }

            //email to user
            if ($type == 'ischecked') { //同意
                $title = sprintf(_MD_KWDEVICE_MAIL_TITLE, $today);
                $content = sprintf(_MD_KWDEVICE_MAIL_CONTENT, $book_arr['book_year'] . $book_id, $note);

                $msg = SendEmail($book_arr['book_uid'], $title, $content);
                redirect_header("admin.php", 3, $msg);
            } else if ($type == 'isdeny') { //拒絕
                $title = sprintf(_MD_KWDEVICE_MAIL_TITLE, $today);
                $content = sprintf(_MD_KWDEVICE_MAIL_CONTENT_DENY, $book_arr['book_year'] . $book_id, $note);

                $msg = SendEmail($book_arr['book_uid'], $title, $content);
                redirect_header("admin.php", 3, $msg);
            }

            return true;
        }
    }
}
