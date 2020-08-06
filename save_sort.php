<?php
require dirname(dirname(__DIR__)) . '/mainfile.php';
$sort = '1';
$op   = $_REQUEST['op'];
if ('update_kw_device_cate_sort' === $op) {
    foreach ($_POST['cateli'] as $cate_id) {
        $sql = 'update ' . $xoopsDB->prefix('kw_device_cate') . " set `cate_sort`='{$sort}' where `cate_id`='{$cate_id}'";
        $xoopsDB->queryF($sql) or die(_TAD_SORT_FAIL . ' (' . date('Y-m-d H:i:s') . ')');
        $sort++;
    }
} elseif ('update_kw_device_place_sort' === $op) {
    foreach ($_POST['placeli'] as $place_id) {
        $sql = 'update ' . $xoopsDB->prefix('kw_device_place') . " set `place_sort`='{$sort}' where `place_id`='{$place_id}'";
        $xoopsDB->queryF($sql) or die(_TAD_SORT_FAIL . ' (' . date('Y-m-d H:i:s') . ')');
        $sort++;
    }
} elseif ('update_kw_device_config_sort' === $op) {
    foreach ($_POST['configli'] as $config_id) {
        $sql = 'update ' . $xoopsDB->prefix('kw_device_config') . " set `config_sort`='{$sort}' where `config_id`='{$config_id}'";
        $xoopsDB->queryF($sql) or die(_TAD_SORT_FAIL . ' (' . date('Y-m-d H:i:s') . ')');
        $sort++;
    }
} elseif ('update_kw_device_equ_sort' === $op) {
    foreach ($_POST['equli'] as $equ_id) {
        $sql = 'update ' . $xoopsDB->prefix('kw_device_equ') . " set `equ_sort`='{$sort}' where `equ_id`='{$equ_id}'";
        $xoopsDB->queryF($sql) or die(_TAD_SORT_FAIL . ' (' . date('Y-m-d H:i:s') . ')');
        $sort++;
    }
} else {
    $php_errormsg = 'NO op!';
}
$sort = 1;

echo 'Sort saved! (' . date('Y-m-d H:i:s') . ')';
