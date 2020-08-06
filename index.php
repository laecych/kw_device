<?php
/*-----------引入檔案區--------------*/

use Xmf\Request;
use XoopsModules\Tadtools\Utility;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\CkEditor;
use XoopsModules\Tadtools\My97DatePicker;

require_once __DIR__ . '/header.php';
$xoopsOption['template_main'] = "kw_device_index.tpl";
include_once XOOPS_ROOT_PATH . "/header.php";


/*-----------執行動作判斷區----------*/
// require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = Request::getString('op');
$equ_id = Request::getInt('equ_id');
$review = Request::getString('$review', 'equ_sort');
$value = Request::getInt('value', 0);
$show_PageBar = Request::getBool('show_PageBar', 'true');
$today = date('Y-m-d');
// $op             = system_CleanVars($_REQUEST, 'op', '', 'string');
// $equ_id         = system_CleanVars($_REQUEST, 'equ_id', '0', 'int');
// $review         = system_CleanVars($_REQUEST, 'review', 'equ_sort', 'string');
// $value          = system_CleanVars($_REQUEST, 'value', '0', 'int');
// $show_PageBar   = system_CleanVars($_REQUEST, 'show_PageBar', 'true', 'bool');


switch ($op) {

    case 'kw_device_equ_form':
        kw_device_equ_form($equ_id);
        break;
    case 'kw_device_equ_insert':
        $equ_id = kw_device_equ_insert();
        header("location: {$_SERVER['PHP_SELF']}?equ_id={$equ_id}");
        break;
    case 'kw_device_equ_update':
        kw_device_equ_update($equ_id);
        header("location: {$_SERVER['PHP_SELF']}?equ_id={$equ_id}");
        break;
    case 'kw_device_equ_delete':
        kw_device_equ_delete($equ_id);
        header("location: {$_SERVER['PHP_SELF']}");
        break;
    case 'kw_device_update_equ_enable':
        $equ_isenable = system_CleanVars($_REQUEST, 'equ_isenable', '', 'int');
        kw_device_update_isenable('equ', $equ_id, $equ_isenable);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    default:

        kw_device_equ_list($review, $value, true);
        $op = 'kw_device_equ_list';
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('op', $op);
// $xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu));
$xoopsTpl->assign("toolbar", Utility::toolbar_bootstrap($interface_menu));;
$xoopsTpl->assign('today', $today);
$xoopsTpl->assign('uid', $kw_device_uid);
$xoopsTpl->assign('iskwDeviceAdmin', $iskwDeviceAdmin);
$xoopsTpl->assign('iskwDeviceCheck', $iskwDeviceCheck);
$xoTheme->addStylesheet(XOOPS_URL . '/modules/kw_device/assets/css/module.css');
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tadtools/css/vtable.css');
require_once XOOPS_ROOT_PATH . '/footer.php';



/*-----------function區--------------*/


// function kw_device_equ_show($equ_id)
// {
// }

function kw_device_equ_list($review = '', $value = '', $show_PageBar = false)
{
    // global $iskwDeviceAdmin, $iskwDeviceCheck, $kw_device_uid;
    global $xoopsDB, $xoopsTpl, $xoopsModuleConfig;


    //取得搜尋語法
    if ('cate' === $review && !empty($value)) { //審核狀況
        $search = " WHERE `cate_id`={$value} and `equ_isenable`=1 ORDER BY `equ_id` desc";
    } else if ('place' === $review &&  !empty($value)) {  //是否歸還
        $search = " WHERE `place_id`={$value} and `equ_isenable`=1 ORDER BY `equ_id` desc";
    } else if ('config' === $review &&  !empty($value)) {  //是否還成
        $search = " WHERE `config_uid`={$value} and `equ_isenable`=1 ORDER BY `equ_id` desc ";
    } else {  //時間排序
        $search = " WHERE `equ_isenable`=1 ORDER BY `equ_id` desc";
    }
    $xoopsTpl->assign('$review', $review);
    $xoopsTpl->assign('$value', $value);

    //社團列表
    $myts       = \MyTextSanitizer::getInstance();
    $sql        = 'select * from `' . $xoopsDB->prefix('kw_device_equ') . "` " . $search;

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

    $result = $xoopsDB->query($sql) or Utility::web_error($sql);
    $total_num = $xoopsDB->getRowsNum($result);
    $xoopsTpl->assign('total_num', $total_num);
    //取得分類所有資料陣列
    $all_config_arr     = kw_device_get_allTitle('config');
    $all_cate_arr       = kw_device_get_allTitle('cate');
    $all_place_arr      = kw_device_get_allTitle('place');
    $xoopsTpl->assign('all_config_arr',  $all_config_arr);
    $xoopsTpl->assign('all_cate_arr',   $all_cate_arr);
    $xoopsTpl->assign('all_place_arr',  $all_place_arr);

    // $all_config_uid     = kw_device_get_config_uid();

    $all_equ_content    = [];
    $i                  = 0;
    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        //以下會產生這些變數： $equ_id, $club_year, $equ_num, $cate_id, $equ_title, $teacher_id, $equ_week, $equ_date_open, $equ_date_close, $equ_time_start, $equ_time_end, $place_id, $equ_member, $equ_money, $equ_fee, $equ_regnum, $equ_note, $equ_date_start, $equ_date_end, $equ_ischecked, $equ_isopen, $equ_desc
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        $all_equ_content[$i]['equ_id']         = (int) $equ_id;
        $all_equ_content[$i]['equ_year']        = $myts->htmlSpecialChars($equ_year);
        $all_equ_content[$i]['equ_code']        = $myts->htmlSpecialChars($equ_code);
        $all_equ_content[$i]['equ_title']      = $myts->htmlSpecialChars($equ_title);
        $all_equ_content[$i]['equ_note']       = $myts->displayTarea($equ_note, 1, 1, 0, 1, 0);
        $all_equ_content[$i]['cate_id']          = $myts->htmlSpecialChars($all_cate_arr[$cate_id]);
        $all_equ_content[$i]['config_id']       = $myts->htmlSpecialChars($all_config_arr[$config_uid]);
        $all_equ_content[$i]['config_uid']        = $myts->htmlSpecialChars($config_uid);
        $all_equ_content[$i]['place_id']         = $myts->htmlSpecialChars($all_place_arr[$place_id]);
        $all_equ_content[$i]['equ_number']       = (int) $equ_number;
        $all_equ_content[$i]['equ_available']     = (int) $equ_available;
        $all_equ_content[$i]['equ_sort']       = (int) $equ_sort;
        $all_equ_content[$i]['equ_count']       = (int) $equ_count;
        $all_equ_content[$i]['equ_date']       = isset($equ_date) ? $myts->htmlSpecialChars($equ_date) : '';
        $all_equ_content[$i]['equ_isenable']     = (int) $equ_isenable;
        $all_equ_content[$i]['equ_isenable_pic'] = $equ_isenable ? '<img src="' . XOOPS_URL . '/modules/kw_device/assets/images/yes.gif" alt="' . _YES . '" title="' . _YES . '">' : '<img src="' . XOOPS_URL . '/modules/kw_device/assets/images/no.gif" alt="' . _NO . '" title="' . _NO . '">';

        //是否可借
        $all_equ_content[$i]['is_full'] = ($equ_available == '0') ? true : false;

        $i++;
    }

    //刪除確認的JS
    $sweet_alert_obj = new SweetAlert();
    $sweet_alert_obj->render('delete_equ_func', "{$_SERVER['PHP_SELF']}?op=kw_device_equ_delete&equ_id=", "equ_id");

    $xoopsTpl->assign('can_operate', true);




    // $uid = $xoopsUser ? $xoopsUser->uid() : '';
    $xoopsTpl->assign('arr_semester', kw_device_get_semester());
    $xoopsTpl->assign('all_equ_content', $all_equ_content);
}

function kw_device_equ_form($equ_id = '')
{
    global $xoopsTpl;
    global $kw_device_uid, $iskwDeviceBook, $iskwDeviceAdmin, $iskwDeviceCheck;
    //安全性表單
    require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
    $token = new \XoopsFormHiddenToken('XOOPS_TOKEN', 360);
    $xoopsTpl->assign('token', $token->render());

    //引入日期
    $cal = new My97DatePicker();
    $cal::render();

    if (!$iskwDeviceAdmin && !$iskwDeviceCheck) {
        redirect_header('index.php', 3, _MD_KWDEVICE_FORBBIDEN);
    }


    //判斷修改or新增(取預設值)
    if (!empty($equ_id)) {
        $DBV       = kw_device_get_data('equ', $equ_id);
    } else {
        $DBV      = [];
        $equ_id = '';
    }


    $xoopsTpl->assign('equ_id', $equ_id);

    //設定 cate_id 欄位的預設值
    $cate_id = !isset($DBV['cate_id']) ? '' : $DBV['cate_id'];
    $xoopsTpl->assign('cate_id', $cate_id);
    //設定 place_id 欄位的預設值
    $place_id = !isset($DBV['place_id']) ? '' : $DBV['place_id'];
    $xoopsTpl->assign('place_id', $place_id);
    //設定 config_id 欄位的預設值
    // $config_id = !isset($DBV['config_id']) ? '' : $DBV['config_id'];
    // $xoopsTpl->assign('config_id', $config_id);

    //設定 config_uid 欄位的預設值
    $config_uid = !isset($DBV['config_uid']) ? '' : $DBV['config_uid'];
    $xoopsTpl->assign('config_uid', $config_uid);

    //設定 equ_year 欄位的預設值 semester
    $arr_year = kw_device_get_semester();
    $xoopsTpl->assign('arr_semester', $arr_year);
    $equ_year = !isset($DBV['equ_year']) ?  $arr_year['year'] : $DBV['equ_year'];
    $xoopsTpl->assign('equ_year', $equ_year);

    //設定 equ_code 欄位的預設值
    $equ_code = !isset($DBV['equ_code']) ? '' : $DBV['equ_code'];
    $xoopsTpl->assign('equ_code', $equ_code);

    //設定 equ_title 欄位的預設值
    $equ_title = !isset($DBV['equ_title']) ? '' : $DBV['equ_title'];
    $xoopsTpl->assign('equ_title', $equ_title);

    //設定 equ_available 欄位的預設值
    $equ_note = !isset($DBV['equ_note']) ? '' : $DBV['equ_note'];
    $xoopsTpl->assign('equ_note', $equ_note);
    //設定 sort 欄位的預設值
    $equ_sort = !isset($DBV['equ_sort']) ? kw_device_max_sort('equ') : $DBV['equ_sort'];
    $xoopsTpl->assign('equ_sort', $equ_sort);

    //設定 equ_number 欄位的預設值
    $equ_number = !isset($DBV['equ_number']) ? '' : $DBV['equ_number'];
    $xoopsTpl->assign('equ_number', $equ_number);
    //設定 equ_available 欄位的預設值
    $equ_available = !isset($DBV['equ_available']) ? '' : $DBV['equ_available'];
    $xoopsTpl->assign('equ_available', $equ_available);
    //設定 equ_count 欄位的預設值
    $equ_count = !isset($DBV['equ_count']) ? '' : $DBV['equ_count'];
    $xoopsTpl->assign('equ_count', $equ_count);

    //設定 equ_isopen 欄位的預設值
    $equ_isenable = !isset($DBV['equ_isenable']) ? '1' : $DBV['equ_isenable'];
    $xoopsTpl->assign('equ_isopen', $equ_isenable);


    //所見即所得編輯器

    $ck = new CkEditor('kw_device', 'equ_note', $equ_note);
    $ck->setHeight(250);
    $ck->setToolbarSet('tadSimple');
    $editor = $ck->render();
    $xoopsTpl->assign('equ_note_editor', $editor);


    //設備類型
    $xoopsTpl->assign('arr_cate', kw_device_get_allTitle('cate'));
    //設備地點
    $xoopsTpl->assign('arr_place', kw_device_get_allTitle('place'));
    //審核者
    $xoopsTpl->assign('arr_config', kw_device_get_allTitle('config'));


    //套用formValidator驗證機制
    $formValidator = new FormValidator('#equform', true);
    $formValidator->render();

    // $xoopsTpl->assign('uid', $xoopsUser->uid());
    $xoopsTpl->assign('kw_device_uid',   $kw_device_uid);
    $xoopsTpl->assign('iskwDeviceBook',  $iskwDeviceBook);
    $xoopsTpl->assign('iskwDeviceAdmin', $iskwDeviceAdmin);
    $xoopsTpl->assign('iskwDeviceCheck', $iskwDeviceCheck);
}


function kw_device_equ_insert()
{
    global $xoopsDB, $iskwDeviceAdmin, $iskwDeviceCheck;

    //檢查權限
    if (!$iskwDeviceAdmin && !$iskwDeviceCheck) {
        redirect_header('index.php', 3, _MD_KWDEVICE_FORBBIDEN);
    }

    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode('<br>', $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $myts = \MyTextSanitizer::getInstance();

    $equ_id         = (int) $_POST['equ_id'];
    $equ_year       = $myts->addSlashes($_POST['equ_year']);
    $equ_code       = $myts->addSlashes($_POST['equ_code']);
    $equ_title      = $myts->addSlashes($_POST['equ_title']);
    $equ_note       = $myts->addSlashes($_POST['equ_note']);
    $cate_id        = (int) $_POST['cate_id'];
    $place_id       = (int) $_POST['place_id'];
    $config_uid     = (int) $_POST['config_uid'];
    // $config_uid     = kw_device_get_config_uid($config_id);
    // $equ_config_arr   = $_POST['conf_uid_arr'];
    // $conf_id        = implode(',', $equ_conf_arr);
    $equ_number     = (int) $_POST['equ_number'];
    $equ_sort       = (int) $_POST['equ_sort'];
    $equ_isenable   = (int) $_POST['equ_isenable'];
    $today          = date('Y-m-d H:i:s');

    //檢查equ_code是否惟一
    if (!kw_device_equ_check($equ_code)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_EQU_CODE_ERROR);
        return;
    }


    $sql = 'insert into `' . $xoopsDB->prefix('kw_device_equ') . "` (
        `equ_year`,
        `equ_code`,
        `equ_title`,
        `equ_note`,
        `cate_id`,
        `place_id`,
        `config_uid`,
        `equ_number`,
        `equ_available`,
        `equ_date`,
        `equ_isenable`,
        `equ_sort`
    ) values(
        '{$equ_year}',
        '{$equ_code}',
        '{$equ_title}',
        '{$equ_note}',
        '{$cate_id}',
        '{$place_id}',
        '{$config_uid}',
        '{$equ_number}',
        '{$equ_number}',
        '{$today}',
        '{$equ_isenable}',
        '{$equ_sort}'
    )";
    $xoopsDB->query($sql) or Utility::web_error($sql);
    //取得最後新增資料的流水編號
    $equ_id = $xoopsDB->getInsertId();
    return $equ_id;
}

function kw_device_equ_update($equ_id)
{
    global $xoopsDB, $iskwDeviceAdmin, $iskwDeviceCheck;

    //檢查權限
    if (!$iskwDeviceAdmin && !$iskwDeviceCheck) {
        redirect_header('index.php', 3, _MD_KWDEVICE_FORBBIDEN);
    }

    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode('<br>', $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $myts = \MyTextSanitizer::getInstance();

    $equ_id         = (int) $_POST['equ_id'];
    $equ_year       = $myts->addSlashes($_POST['equ_year']);
    $equ_code       = $myts->addSlashes($_POST['equ_code']);
    $equ_title      = $myts->addSlashes($_POST['equ_title']);
    $equ_note       = $myts->addSlashes($_POST['equ_note']);
    $cate_id        = (int) $_POST['cate_id'];
    $place_id       = (int) $_POST['place_id'];
    // $equ_conf_arr   = $_POST['conf_uid_arr'];
    $config_uid      = (int) $_POST['config_uid'];
    $equ_number     = (int) $_POST['equ_number'];
    $equ_isenable   = (int) $_POST['equ_isenable'];
    $today          = date('Y-m-d H:i:s');
    $equ_sort       = (int) $_POST['equ_sort'];


    $sql = 'update `' . $xoopsDB->prefix('kw_device_equ') . "` SET 
    `equ_code`      = '{$equ_code}',
    `equ_year`      = '{$equ_year}',
    `cate_id`       = '{$cate_id}',
    `place_id`      = '{$place_id}',
    `config_uid`    = '{$config_uid}',
    `equ_title`     = '{$equ_title}',
    `equ_note`      = '{$equ_note}', 
    `equ_number`    = '{$equ_number}',
    `equ_isenable`  = '{$equ_isenable}',
    `equ_date`      = '{$today}',
    `equ_sort`      = '{$equ_sort}' 
        WHERE `equ_id` = '$equ_id' ";
    $xoopsDB->queryF($sql) or Utility::web_error($sql);

    return $equ_id;
}
function kw_device_equ_delete($equ_id)
{
    global $xoopsDB, $iskwDeviceAdmin, $iskwDeviceCheck;

    //檢查權限
    if (!$iskwDeviceAdmin && !$iskwDeviceCheck) {
        redirect_header('index.php', 3, _MD_KWDEVICE_FORBBIDEN);
        return;
    }

    //檢查參數
    if (empty($equ_id)) {
        redirect_header('index.php', 3, _MD_KWDEVICE_NEED_EQU_ID);
        return;
    } else if (kw_device_delete_check('equ', $equ_id, 'book')) { //檢查是否有借用
        redirect_header('index.php', 3, _MD_KWDEVICE_NOT_EMPTY_BOOK);
        return;
    } else {
        $sql = 'delete from `' . $xoopsDB->prefix('kw_device_equ') . "` where `equ_id`='{$equ_id}'; ";
        $xoopsDB->queryF($sql) or Utility::web_error($sql);
    }
}


function kw_device_equ_check($equ_code)
{
    global $xoopsDB;
    if (empty($equ_code)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_ERROR);
        return false;
    } else {
        $sql = 'select count(*) from `' . $xoopsDB->prefix('kw_device_equ') . "`  where `equ_code` = '{$equ_code}'";
        // die($sql);
        $result = $xoopsDB->query($sql);
        list($data) = $xoopsDB->fetchRow($result);

        if (empty($data))
            return true;
        else
            return false;
    }
}
