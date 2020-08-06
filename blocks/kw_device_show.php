<?php
function Kw_device_show()
{
    require_once XOOPS_ROOT_PATH . '/modules/Kw_device/function_block.php';
    $block = club_class_list('', 'return');

    return $block;
}
