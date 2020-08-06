<?php

// if (!isset($_SESSION['language']) && empty($_REQUEST['language'])) {
//     $_SESSION['language'] = 'tchinese_utf8';
// } elseif (isset($_SESSION['language']) && !empty($_REQUEST['language'])) {
//     $_SESSION['language'] = $_REQUEST['language'];
// }

// if ('english' === $_SESSION['language']) {
//     require_once dirname(__DIR__) . '/english/main.php';
// }
// require_once XOOPS_ROOT_PATH . "/modules/tadtools/language/tchinese_utf8/main.php";

xoops_loadLanguage('main', 'tadtools');
//前台選單
define("_MI_KWDEVICE_SMNAME1", "設備列表");
define("_MI_KWDEVICE_SMNAME2", "借用清單");
define("_MI_KWDEVICE_SMNAME3", "借用審核");
define("_MI_KWDEVICE_SMNAME4", "管理設定");

//config 設定
define('_MD_KWDEVICE_CONFIG_SETUP', '審核設定');
define('_MD_KWDEVICE_CATE_SETUP', '類別設定');
define('_MD_KWDEVICE_PLACE_SETUP', '地點設定');
define('_MD_KWDEVICE_EQU_SETUP', '設備設定');

define('_MD_KWDEVICE_CONFIG_LIST', '審核列表');
define('_MD_KWDEVICE_PLACE_LIST', '地點列表');
define('_MD_KWDEVICE_CATE_LIST', '類型列表');
define('_MD_KWDEVICE_EQU_LIST', '設備排序');

define('_MD_KWDEVICE_CONFIG_SORT', '審核排序');
define('_MD_KWDEVICE_CATE_SORT', '類別排序');
define('_MD_KWDEVICE_PLACE_SORT', '地點排序');

define('_MD_KWDEVICE_ISENABLE', '是否啟用');
define('_MD_KKWDEVICE_ENABLE_1', '啟用');
define('_MD_KKWDEVICE_ENABLE_0', '關閉');

define('_MD_KWDEVICE_CONFIG_PICKER', '挑選審核者');
define('_MD_KWDEVICE_CONFIG_TITLE', '審核者職稱');
define('_MD_KWDEVICE_CATE_TITLE', '設備類型');
define('_MD_KWDEVICE_PLACE_TITLE', '借用地點');
define('_MD_KWDEVICE_UID_WRONG', '審核者uid重複');


//templet
define('_MD_KWDEVICE_BOOK_NAME', '借用者');
define('_MD_KWDEVICE_APPLY_NOTE', '借用申請注意事項');
define('_MD_KWDEVICE_CHECK_OK', '確定送出');


//index 前台
define('_MD_KWDEVICE_NEED_CONFIG', '請先到設定頁面');
define('_MD_KWDEVICE', '設備借用管理系統');
define('_MD_KWDEVICE_LANGUAGE', '英語');
define('_MD_KWDEVICE_EMPTY_EQU', '目前沒有任何設備可借用!');
define('_MD_KWDEVICE_ADD_EQU', '新增設備');
define('_MD_KWDEVICE_EDIT_EQU', '編輯設備');
define('_MD_KWDEVICE_NO_CHECK', '目前沒有任何審核');
define('_MD_KWDEVICE_NO_BOOK', '目前沒有任何借用申請');

define('_MD_KWDEVICE_APPLY_FROM_FROM', '設備借用起始日');
define('_MD_KWDEVICE_APPLY_FROM_TO', '到終止日');
define('_MD_KWDEVICE_PICK_EQU', '設備');
define('_MD_KWDEVICE_AFTER_REGISTRATION', '候補');
define('_MD_KWDEVICE_EQU_ENABLE_DESC', '點選啟用');
define('_MD_KWDEVICE_EQU_UNABLE_DESC', '點選關閉');
define('_MD_KWDEVICE_EQU_BLANK_DESC', '無法借用');
define('_MD_KWDEVICE_CLICK_TO', '點此改為：');
define('_MD_KWDEVICE_EQU_ENABLE', '設備開放');
define('_MD_KWDEVICE_EQU_UNABLE', '設備維修');
define('_MD_KWDEVICE_UNABLE', '關閉啟用');
define('_MD_KWDEVICE_ENABLE', '啟用');
define('_MD_KWDEVICE_EQU_BLANK', '借光');
define('_MD_KWDEVICE_EQU_UNBLANK', '可借');
define('_MD_KWDEVICE_EQU_FULL', '光');
define('_MD_KWDEVICE_EQU_CODE_ERROR', '設備編碼重複');


define('_MD_KWDEVICE_EQU_YEAR', '採購年度');
define('_MD_KWDEVICE_EQU_CODE', '設備編號');
define('_MD_KWDEVICE_EQU_CODENOT', '編號不可重複');
define('_MD_KWDEVICE_EQU_CATE', '設備類型');
define('_MD_KWDEVICE_EQU_TITLE', '設備名稱');
define('_MD_KWDEVICE_EQU_NUMBER', '設備數量');
define('_MD_KWDEVICE_EQU_AVALIABLE', '可借數量');
define('_MD_KWDEVICE_EQU_ISENABLE', '是否開放借用');
define('_MD_KWDEVICE_EQU_PLACE', '保管地點');
define('_MD_KWDEVICE_EQU_CONFIG', '保管者');
define('_MD_KWDEVICE_EQU_DATE', '新增日期');
define('_MD_KWDEVICE_EQU_SORT', '排序');
define('_MD_KWDEVICE_EQU_COUNT', '借用次數');
define('_MD_KWDEVICE_EQU_NOTE', '設備注意事項');
define('_MD_KWDEVICE_EQU_BOOK', '申請借用');
define('_MD_KWDEVICE_EQU_ADMID', '設備管理');
define('_MD_KWDEVICE_EQU_SEARCH', '設備搜尋依：');
define('_MD_KWDEVICE_EQU_SELECT', '請選擇');

//flow messages
define('_MD_KWDEVICE_NEED_CATE_ID', '沒有指定類別編號');
define('_MD_KWDEVICE_NEED_BOOK_ID', '沒有指定借用編號');
define('_MD_KWDEVICE_NEED_PLACE_ID', '沒有指定地點編號');
define('_MD_KWDEVICE_NEED_CONFIG_ID', '沒有指定審核者編號');
define('_MD_KWDEVICE_NEED_EQU_ID', '沒有指定設備編號');
define('_MD_KWDEVICE_ERROR', '函式參數錯誤');
define('_MD_KWDEVICE_NEED_BOOKID', '沒有指定借用編號');
define('_MD_KWDEVICE_FORBBIDEN', '沒有權限');


//book error message
define('_MD_KWDEVICE_EQU_BOOK_FULL', '此設備已經借光無法借用');
define('_MD_KWDEVICE_BOOK_ISCHECK', '此設備已經審核完成無法借用');
define('_MD_KWDEVICE_BOOK_SUCCESS', '此動作執行成功');
define('_MD_KWDEVICE_BOOK_FAILUE', '此動作執行失敗');
define('_MD_KWDEVICE_OVER_END_TIME', '此動作執行失敗');
define('_MD_KWDEVICE_NOT_REG_TIME', '此動作執行失敗');
define('_MD_KWDEVICE_NOT_EMPTY_BOOK', '目前此設備有借用紀錄無法刪除');
define('_MD_KWDEVICE_BOOK_DATE_ERROR', '預約時間設定錯誤!!');
define('_MD_KWDEVICE_TODAY', '今天日期');
define('_MD_KWDEVICE_BOOK', '借用清單');
define('_MD_KWDEVICE_CHECK', '借用審核');

define('_MD_KWDEVICE_BOOK_ID', '借用編號');
define('_MD_KWDEVICE_BOOK_TITLE', '設備名稱');
define('_MD_KWDEVICE_BOOK_NUMBER', '借用數量');
define('_MD_KWDEVICE_BOOK_DATE', '借用日期');
define('_MD_KWDEVICE_BOOK_MODE', '借用模式');
define('_MD_KWDEVICE_BOOK_OPEN', '借用起始日');
define('_MD_KWDEVICE_BOOK_CLOSE', '借用終止日');
define('_MD_KWDEVICE_BOOK_ISENABLE', '立即申請');
define('_MD_KWDEVICE_BOOK_DESC', '用途說明');
define('_MD_KWDEVICE_BOOK_APPLY', '設備借用申請');
define('_MD_KWDEVICE_BOOK_SHORT', '短期借用(一星期內)');
define('_MD_KWDEVICE_BOOK_MIDDLE', '中期借用(一個月內)');
define('_MD_KWDEVICE_BOOK_MONTH', '長期借用(一學期內)');
define('_MD_KWDEVICE_BOOK_LONG', '學期借用(學期單位)');
define('_MD_KWDEVICE_BOOK_NOTE', '設備申請注意事項');
define('_MD_KWDEVICE_BOOK_DATE_LIMIT', '借用日期範圍');
define('_MD_KWDEVICE_BOOK_NOTE_YES', '我以閱讀完畢設備借用注意事項並願意遵守');
define('_MD_KWDEVICE_BOOK_STATU', '狀態');
define('_MD_KWDEVICE_BOOK_UID', '借用者');
define('_MD_KWDEVICE_BOOK_CHECK', '審核管理');
define('_MD_KWDEVICE_BOOK_ADMID', '借用管理');
define('_MD_KWDEVICE_BOOK_YEAR', '借用年度');
define('_MD_KWDEVICE_BOOK_SORT', '排序');
define('_MD_KWDEVICE_BOOK_INCHECK', '審核中請等待');
define('_MD_KWDEVICE_BOOK_CHECKED', '審核完畢領取設備');
define('_MD_KWDEVICE_BOOK_INUSE', '設備借用中');
define('_MD_KWDEVICE_BOOK_RETRUN', '設備已歸還');
define('_MD_KWDEVICE_BOOK_LATE', '借用逾期');
define('_MD_KWDEVICE_BOOK_FINISH', '借用手續已完成');
define('_MD_KWDEVICE_BOOK_STOP', '暫停申請');
define('_MD_KWDEVICE_BOOK_ENABLE', '送出申請');
define('_MD_KWDEVICE_BOOK_DEL', '刪');
define('_MD_KWDEVICE_BOOK_EDIT', '編');
define('_MD_KWDEVICE_BOOK_PASS', '同意');
define('_MD_KWDEVICE_BOOK_DENY', '拒絕');
define('_MD_KWDEVICE_BOOK_UNDENY', '已拒絕');
define('_MD_KWDEVICE_BOOK_TAKEN', '領取設備');
define('_MD_KWDEVICE_BOOK_UNTAKEN', '領取逾期取消借用');
define('_MD_KWDEVICE_BOOK_RETURN', '設備歸還');
define('_MD_KWDEVICE_BOOK_DENYNOTE', '請輸入拒絕原因或備註(可不填)');

define('_MD_KWDEVICE_MAIL_OK', '將「%s」寄送到 %s 完成！\\n');
define('_MD_KWDEVICE_MAIL_FAIL', '將「%s」寄送到 %s 失敗！\\n');
define('_MD_KWDEVICE_MAIL_TITLE', '%s 申請設備借用審核結果通知');
define('_MD_KWDEVICE_MAIL_CONTENT', '您好：<p>您設備借用編號%s審核結果：「同意」。</p><p>審核備註：%s，請依借用時間盡速領取設備</p>謝謝！<p align="right">此信由系統自動發出，請勿直接回信。</p>');
define('_MD_KWDEVICE_MAIL_CONTENT_DENY', '您好：<p>您設備借用編號%s審核結果：「拒絕」。</p><p>拒絕理由：%s</p><p align="right">此信由系統自動發出，請勿直接回信。</p>');
define('_MD_KWDEVICE_BOOKMAIL_TITLE', '%s 申請設備：「%s」借用');
define('_MD_KWDEVICE_BOOKMAIL_CONTENT', '設備審核者您好：<p>有使用者於 %s 申請設備：「%s」借用。</p><p>請盡速到下列網址審核謝謝！</p><p>%s</p><p align="right">此信由系統自動發出，請勿直接回信。</p>');
