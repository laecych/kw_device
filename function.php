<?php

use XoopsModules\Tadtools\Utility;


//其他自訂的共同的函數



//檢查user是否具有審核權限
function kw_device_isCheck($uid)
{
    global $xoopsUser, $xoopsDB, $iskwDeviceAdmin;

    if ($xoopsUser) {
        if ($iskwDeviceAdmin) {
            return true;
            exit;
        }
        $sql = "select `config_uid` from `" . $xoopsDB->prefix("kw_device_config") . "` where `config_uid`='" . $uid . "' and `config_isenable` ='1' ";

        $result = $xoopsDB->query($sql) or Utility::web_error($sql);
        list($uid) = $xoopsDB->fetchRow($result);
        if ($uid) {
            return true;
            exit;
        }
    }
    return false;
}

//檢查user是否具有借用權限
// function kw_device_isBook($mode = "kw_device_book_group")
// {
//     global $xoopsUser, $xoopsModuleConfig, $iskwDeviceAdmin;

//     if ($xoopsUser) {
//         if ($iskwDeviceAdmin) {
//             return true;
//             exit;
//         }
//         $my_groups = $xoopsUser->groups();
//         $book_groups = $xoopsModuleConfig[$mode];
//         //die(var_export($mygroups)."==".var_export($book_groups));
//         foreach ($my_groups as $key => $group) {
//             if (in_array($group, $book_groups)) {
//                 return true;
//             }
//         }
//     }
//     return false;
// }

//以ID取得單筆資料
/**
 * @param $dbName
 * @param $ID
 * @return $data
 */
function kw_device_get_data($dbName, $dbName_ID = '', $name = '', $value = '')
{
    global $xoopsDB;

    if (empty($dbName)) {
        redirect_header("{$_SERVER['PHP_SELF']}", 3, _MD_KWDEVICE_ERROR);
        return;
    }

    if (!empty($dbName_ID)) //用id取得資料
    {
        $sql = 'select * from `' .  $xoopsDB->prefix('kw_device_' . $dbName) . "`  where `{$dbName}_id` = '{$dbName_ID}'";
        $result = $xoopsDB->query($sql) or Utility::web_error($sql);
        $data = $xoopsDB->fetchArray($result);
    } else if (!empty($name) && !empty($value)) {
        $sql = 'select * from `' .  $xoopsDB->prefix('kw_device_' . $dbName) . "`  where `{$name}` = '{$value}'";
        $data = [];
        $i = 1;
        while (false !== ($all = $xoopsDB->fetchArray($result))) {
            $data[$i] = $all;
            $i++;
        }
    } else                               //取得多筆資料
    {
        $sql = 'select * from `' .  $xoopsDB->prefix('kw_device_' . $dbName) . "` ";
        $data = [];
        $i = 1;
        while (false !== ($all = $xoopsDB->fetchArray($result))) {
            $data[$all[$dbName . '_id']] = $all;
            $i++;
        }
    }
    return $data;
}



function uid_check($uid)
{
    global $xoopsDB;
    $sql = 'select `config_uid` from `' . $xoopsDB->prefix('kw_device_config') . "` where config_uid=`{$uid}`";
    $result = $xoopsDB->query($sql);
    list($Uid) = $xoopsDB->fetchRow($result);
    if ($Uid)
        return true;
    else
        return false;
}


function kw_device_get_allTitle($dbName)
{
    global $xoopsDB;

    if (empty($dbName)) {
        redirect_header("{$_SERVER['PHP_SELF']}", 3, _MD_KWDEVICE_ERROR);
        return;
    }
    if ($dbName == 'config') {
        $sql = "select `{$dbName}_uid`, `{$dbName}_title` from `" . $xoopsDB->prefix('kw_device_' . $dbName) . "` where  `{$dbName}_isenable`='1' order by `{$dbName}_sort`";
        $result = $xoopsDB->query($sql) or Utility::web_error($sql);
        $data = [];
        while (list($Uid, $Title) = $xoopsDB->fetchRow($result)) {
            $data[$Uid] = $Title;
        }
    } else {
        $sql = "select `{$dbName}_id`, `{$dbName}_title` from `" . $xoopsDB->prefix('kw_device_' . $dbName) . "` where  `{$dbName}_isenable`='1' order by `{$dbName}_sort`";
        $result = $xoopsDB->query($sql) or Utility::web_error($sql);
        $data = [];
        while (list($Id, $Title) = $xoopsDB->fetchRow($result)) {
            $data[$Id] = $Title;
        }
    }
    return $data;
}

function kw_device_get_config_uid($config_id = '')
{
    global $xoopsDB;

    if (!empty($config_id)) {
        $sql = "select  `config_uid` from `" . $xoopsDB->prefix('kw_device_config') . "` where  `config_id` = '" . $config_id . "'  and  `config_isenable`='1' ";
        $result = $xoopsDB->query($sql) or Utility::web_error($sql);
        list($uid) = $xoopsDB->fetchRow($result);
        $data = $uid;
    } else {
        $sql = "select `config_id`, `config_uid` from `" . $xoopsDB->prefix('kw_device_config') . "` where  `config_isenable`='1' ";
        $result = $xoopsDB->query($sql) or Utility::web_error($sql);
        $data = [];
        while (list($Id, $uid) = $xoopsDB->fetchRow($result)) {
            $data[$Id] = $uid;
        }
    }

    return $data;
}


//取得審核者姓名
// function kw_device_get_check($book_id)
// {
//     global $xoopsDB, $xoopsUser;
//     if (empty($book_id)) {
//         redirect_header("{$_SERVER['PHP_SELF']}", 3, _MD_KWDEVICE_ERROR);
//         return;
//     }
//     $sql = 'select `check_id`, `check_uid` from `' . $xoopsDB->prefix('kw_device_check') . "` where `book_id`='{$book_id}' and `check_isenable`='1' order by `check_sort`";
//     $result = $xoopsDB->query($sql) or Utility::web_error($sql);
//     $check = [];
//     while (list($check_id, $check_uid) = $xoopsDB->fetchRow($result)) {
//         $check_name = $xoopsUser->name($check_uid);
//         $check[$check_id] = $check_name;
//     }
//     return $check;
// }
//get client ip
/**
 * @return mixed
 */
function kw_device_get_ip()
{
    $ip = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(', ', $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) {
            array_unshift($ips, $ip);
            $ip = false;
        }
        foreach ($ips as $i => $iValue) {
            if (!preg_match("#^(10|172\.16|192\.168)\.#i", $ips[$i])) {
                $ip = $iValue;
                break;
            }
        }
    }
    return ($ip ?: $_SERVER['REMOTE_ADDR']);
}


//get client ip
/**
 * @param $qtd
 * @return mixed
 */
function kw_device_get_key($length = 5)
{
    $Characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $QuantidadeCharacters = strlen($Characters);
    $QuantidadeCharacters--;
    $Hash = NULL;
    for ($x = 1; $x <= $length; $x++) {
        $Posicao = rand(0, $QuantidadeCharacters);
        $Hash .= substr($Characters, $Posicao, 1);
    }
    return $Hash;
}



function  kw_device_get_semester()
{
    //semester and year
    $arr_time  = getdate();
    // $this_week = $arr_time['wday'];

    if ($arr_time['mon'] >= 2 && $arr_time['mon'] <= 7) { // 2-7 (第二學期)
        $this_semester = '02';
        $this_year     = $arr_time['year'] - 1912;
        $semester = [
            'year' => $this_year . $this_semester,
            'this_year' => $this_year,
            'this_dcyear' => $this_year + 1911,
            'this_semester' => $this_semester,
            'start_date' => $this_year + 1 . '-02-01',
            'end_date' => $this_year + 1 . '-07-31',
            'start_date_dc' => $this_year + 1912 . '-02-01',
            'end_date_dc' => $this_year + 1912 . '-07-31',
        ];
    } elseif ($arr_time['mon'] >= 8 && $arr_time['mon'] <= 12) { //8-12 (第一學期)
        $this_semester = '01';
        $this_year     = $arr_time['year'] - 1911;
        $semester = [
            'year' => $this_year . $this_semester,
            'this_year' => $this_year + 1911,
            'this_dcyear' => $this_year + 1911,
            'this_semester' => $this_semester,
            'start_date' => $this_year . '-08-01',
            'end_date' => $this_year + 1 . '-01-31',
            'start_date_dc' => $this_year + 1911 . '-08-01',
            'end_date_dc' => $this_year + 1912 . '-01-31',
        ];
    } elseif ($arr_time['mon'] == 1) { //01 (第一學期)
        $this_semester = '01';
        $this_year     = $arr_time['year'] - 1912;
        $semester = [
            'year' => $this_year . $this_semester,
            'this_year' => $this_year,
            'this_dcyear' => $this_year + 1911,
            'this_semester' => $this_semester,
            'start_date' => $this_year . '-08-01',
            'end_date' => $this_year + 1 . '-01-31',
            'start_date' => $this_year + 1911 . '-08-01',
            'end_date' => $this_year + 1912 . '-01-31'
        ];
    }

    return $semester;
}


function kw_device_chk_time($start_date, $end_date, $mode)
{
    $today          = Date('Y-m-d');
    $limit_day      = Date('Y-m-d', strtotime(' 7 day', strtotime($start_date)));
    $limit_week     = Date('Y-m-d', strtotime(' 31 day', strtotime($start_date)));
    $limit_semester = Date('Y-m-d', strtotime(' 2 year', strtotime($start_date)));

    $semester = kw_device_get_semester();

    if ($mode == 'day') { //短期借用 最長可借一星期 

        if ($start_date <  $semester['start_date_dc']  || $end_date >  $semester['end_date_dc'] || $start_date > $end_date || $end_date >  $limit_day || $start_date < $today)
            return false;
        else
            return true;
    } else if ($mode == 'week') { //中期借用 最長借1個月
        if ($start_date <  $semester['start_date_dc']  || $end_date >  $semester['end_date_dc'] || $start_date > $end_date || $end_date >  $limit_week  || $start_date < $today)
            return false;
        else
            return true;
    } else if ($mode == 'month') { //長期借用 最長借1學期
        if ($start_date < $semester['start_date_dc']  || $end_date >  $semester['end_date_dc'] || $start_date > $end_date)
            return false;
        else
            return true;
    } else { //長期借用 最長借1學期
        if ($start_date <  $semester['start_date_dc']  || $end_date >  $semester['end_date_dc'] || $start_date > $end_date || $end_date >    $limit_semester  || $start_date < $today)
            return false;
        else
            return true;
    }
}
//檢查刪除相依性資訊 1.刪除設備時需要檢查 2.刪除預約時需要檢查 3.刪除設備類型、地點、審核者時需要檢查
//刪除cate,config,place時 check equ table
//刪除equ時，check book table
//刪除book時，check check table
function kw_device_delete_check($type, $Id, $dbname)
{
    global $xoopsDB;

    if (empty($type) or !isset($Id)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWDEVICE_ERROR);
        return;
    } else {
        if ($type == 'config')
            $sql = 'select count(*) from `' . $xoopsDB->prefix('kw_device_' . $dbname) . "`  where `config_uid` = '{$Id}'";
        else
            $sql = 'select count(*) from `' . $xoopsDB->prefix('kw_device_' . $dbname) . "`  where `{$type}_id` = '{$Id}'";

        $result = $xoopsDB->query($sql) or Utility::web_error($sql);
        list($count) = $xoopsDB->fetchRow($result);
    }
    return $count;
}

//更新啟用或停用
function kw_device_update_isenable($dbName, $Id, $isenable)
{
    global $xoopsDB, $kw_device_uid, $iskwDeviceAdmin, $iskwDeviceCheck;
    //檢查權限
    if (!$iskwDeviceAdmin && !$iskwDeviceCheck &&  !$kw_device_uid) {
        redirect_header("{$_SERVER['PHP_SELF']}", 3, _MD_KWDEVICE_FORBBIDEN);
        return;
    }
    // $myts = \MyTextSanitizer::getInstance();
    $arr = kw_device_get_data($dbName, $Id);
    if ($dbName == 'book') {
        $ischecked = $arr['book_ischecked'];
        $isdeny = $arr['book_isdeny'];
    }
    if ($ischecked != 0 ||  $isdeny != 0) //檢查狀態可行性
    {
        redirect_header("{$_SERVER['PHP_SELF']}", 3, _MD_KWDEVICE_FORBBIDEN);
        return;
    }

    $sql = 'update `' . $xoopsDB->prefix('kw_device_' . $dbName) . "` set
    `{$dbName}_isenable` = '{$isenable}' where `{$dbName}_id` = '$Id'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql);
    return $Id;
}

//取得排序最大值
function kw_device_max_sort($type)
{
    global $xoopsDB;
    $sql = "select max(`{$type}_sort`) from `" . $xoopsDB->prefix('kw_device_' . $type) . '`';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql);
    list($sort) = $xoopsDB->fetchRow($result);

    return ++$sort;
}

//取得排序值
function kw_device_get_sort($dbname, $id)
{
    global $xoopsDB, $xoopsUser;
    if (empty($dbname) || empty($id)) {
        redirect_header("{$_SERVER['PHP_SELF']}", 3, _MD_KWDEVICE_ERROR);
        return;
    }
    $sql = "select `" . $dbname . "_sort` from `" .  $xoopsDB->prefix('kw_device_' . $dbName) .  "` where  `" . $dbname . "_id`='{$id}' ";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql);
    list($sort) = $xoopsDB->fetchRow($result);

    return $sort;
}


//以id取得所有資料
function kw_device_get_config($type, $id)
{
    global $xoopsDB;

    if (empty($id) || empty($type)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_NEED_TADTOOLS);
        return;
    }

    // $type_id = $type . '_id';
    $sql     = 'select * from `' . $xoopsDB->prefix('kw_device_' . $type) . '`
    where `' . $type . "_id` = '{$id}'";

    $result = $xoopsDB->query($sql) or Utility::web_error($sql);
    $data = $xoopsDB->fetchArray($result);

    return $data;
}

//以id取得名稱
function kw_device_get_config_title($type, $id)
{
    global $xoopsDB;
    if (empty($id) || empty($type)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_NEED_TADTOOLS);
        return;
    }
    // $type_id = $type . '_id';
    if ($type == 'config')
        $sql     = "select `config_title` from `" . $xoopsDB->prefix('kw_device_' . $type) . '`
        where `' . $type . "_uid` = '{$id}'";
    else
        $sql     = "select `" . $type . "_title` from `" . $xoopsDB->prefix('kw_device_' . $type) . '`
        where `' . $type . "_id` = '{$id}'";

    $result = $xoopsDB->query($sql) or Utility::web_error($sql);
    list($data) = $xoopsDB->fetchRow($result);

    return $data;
}



function SendEmail($uid = '', $title = '', $content = '')
{
    global $xoopsMailer, $xoopsConfig, $xoopsDB, $xoopsModuleConfig, $xoopsModule;
    if (empty($uid)) {
        return;
    }

    // $memberHandler = xoops_getHandler('member');
    // $user           = $memberHandler->getUser($uid);
    // $email          = $user->email();
    $sql = 'select email from `' . $xoopsDB->prefix('users') . "` where uid='{$uid}'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    list($email) = $xoopsDB->fetchRow($result);

    $xoopsMailer = &getMailer();
    $xoopsMailer->multimailer->ContentType = 'text/html';
    $xoopsMailer->addHeaders('MIME-Version: 1.0');

    $msg .= ($xoopsMailer->sendMail($email, $title, $content, $headers)) ? sprintf(_MD_KWDEVICE_MAIL_OK, $title, $email) : sprintf(_MD_KWDEVICE_MAIL_FAIL, $title, $email);


    return $msg;
}
