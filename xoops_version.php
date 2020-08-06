<?php
$modversion = array();

//---模組基本資訊---//
$modversion['name']        = '設備借用管理';
$modversion['version']     = 1.00;
$modversion['description'] = '模組說明';
$modversion['author']      = 'kawaki';
$modversion['credits']     = 'tad';
$modversion['help']        = 'page=help';
$modversion['license']     = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['image']       = 'images/logo.png';
$modversion['dirname']     = basename(dirname(__FILE__));

//---模組狀態資訊---//
$modversion['release_date']        = '2020/07/10';
$modversion['module_website_url']  = 'https://github.com/laecych/kw_divice';
$modversion['module_website_name'] = '模組官網名稱';
$modversion['module_status']       = 'release';
$modversion['author_website_url']  = 'https://github.com/laecych/kw_divice';
$modversion['author_website_name'] = '作者網站名稱';
$modversion['min_php']             = 5.4;
$modversion['min_xoops']           = '2.5.9';

//---paypal資訊---//
$modversion['paypal']                  = array();
$modversion['paypal']['business']      = 'kawaki@gmail.com';
$modversion['paypal']['item_name']     = 'Donation : ' . '贊助對象名稱';
$modversion['paypal']['amount']        = 0;
$modversion['paypal']['currency_code'] = 'USD';

//---安裝設定---//
$modversion['onInstall']   = "include/onInstall.php";
$modversion['onUpdate'] = "include/onUpdate.php";
// $modversion['onUninstall'] = "include/onUninstall.php";

//---後台使用系統選單---//
$modversion['system_menu'] = 1;

//---模組資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][0] = 'kw_device_config';
$modversion['tables'][1] = "kw_device_cate";
$modversion['tables'][2] = "kw_device_place";
$modversion['tables'][3] = "kw_device_equ";
$modversion['tables'][4] = "kw_device_book";
// $modversion['tables'][5] = "kw_device_check";

//---後台管理介面設定---//
$modversion['hasAdmin']   = 0;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu']  = 'admin/menu.php';

//---前台主選單設定---//
$modversion['hasMain'] = 1;
$i = 1;
$modversion['sub'][$i]['name'] = _MI_KWDEVICE_SMNAME1; //設備列表
$modversion['sub'][$i]['url'] = 'index.php';
$i++;

$modversion['sub'][$i]['name'] = _MI_KWDEVICE_SMNAME2; //管理介面
$modversion['sub'][$i]['url'] = 'admin.php';
$i++;

$modversion['sub'][$i]['name'] = _MI_KWDEVICE_SMNAME3; //管理介面
$modversion['sub'][$i]['url'] = 'admin.php?op=kw_device_check_list';
$i++;

$modversion['sub'][$i]['name'] = _MI_KWDEVICE_SMNAME4; //管理介面
$modversion['sub'][$i]['url'] = 'config.php';
$i++;


//---模組自動功能---//
//$modversion['onInstall'] = "include/install.php";
//$modversion['onUpdate'] = "include/update.php";
//$modversion['onUninstall'] = "include/onUninstall.php";

//---樣板設定---//
$modversion['templates']                    = array();
$i                                          = 1;
$modversion['templates'][$i]['file']        = 'kw_device_index.tpl';
$modversion['templates'][$i]['description'] = 'kw_device_index.tpl';


$i++;
$modversion['templates'][$i]['file']        = 'kw_device_admin.tpl';
$modversion['templates'][$i]['description'] = 'kw_device_admin.tpl';

$i++;
$modversion['templates'][$i]['file']        = 'kw_device_config.tpl';
$modversion['templates'][$i]['description'] = 'kw_device_config.tpl';

//---偏好設定---//
// $modversion['config'] = array();

// $i = 0;
// $modversion['config'][$i]['name'] = 'kw_device_book_group';
// $modversion['config'][$i]['title'] = '_MI_KWDEVICE_BOOKING_GROUP';
// $modversion['config'][$i]['description'] = '_MI_KWDEVICE_BOOKING_GROUP_DESC';
// $modversion['config'][$i]['formtype'] = 'group_multi';
// $modversion['config'][$i]['valuetype'] = 'array';
// $modversion['config'][$i]['default'] = '1';
// ++$i;
// $modversion['config'][$i]['name'] = 'kw_device_max_book_period';
// $modversion['config'][$i]['title'] = '_MI_KWDEVICE_MAX_BOOKINGWEEK';
// $modversion['config'][$i]['description'] = '_MI_KWDEVICE_MAX_BOOKINGWEEK_DESC';
// $modversion['config'][$i]['formtype'] = 'textbox';
// $modversion['config'][$i]['valuetype'] = 'int';
// $modversion['config'][$i]['default'] = '4';



//$i=0;
//$modversion['config'][$i]['name']    = '偏好設定名稱（英文）';
//$modversion['config'][$i]['title']    = '偏好設定標題（常數）';
//$modversion['config'][$i]['description']    = '偏好設定說明（常數）';
//$modversion['config'][$i]['formtype']    = '輸入表單類型';
//$modversion['config'][$i]['valuetype']    = '輸入值類型';
//$modversion['config'][$i]['default']    = 預設值;
//
//$i++;

//---搜尋---//
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = "include/search.php";
$modversion['search']['func'] = "搜尋函數名稱";

//---區塊設定---//
//$modversion['blocks'] = array();
//$i=1;
//$modversion['blocks'][$i]['file'] = "區塊檔.php";
//$modversion['blocks'][$i]['name'] = 區塊名稱（常數）;
//$modversion['blocks'][$i]['description'] = 區塊說明（常數）;
//$modversion['blocks'][$i]['show_func'] = "執行區塊函數名稱";
//$modversion['blocks'][$i]['template'] = "區塊樣板.tpl";
//$modversion['blocks'][$i]['edit_func'] = "編輯區塊函數名稱";
//$modversion['blocks'][$i]['options'] = "設定值1|設定值2";
//
//$i++;

//---評論---//
//$modversion['hasComments'] = 1;
//$modversion['comments']['pageName'] = '單一頁面.php';
//$modversion['comments']['itemName'] = '主編號';

//---通知---//
$modversion['hasNotification'] = 1;
