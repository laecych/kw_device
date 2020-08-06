<div id="setupTab">
  <ul class="resp-tabs-list vert">
      <li><{$smarty.const._MD_KWDEVICE_CONFIG_SETUP}></li>
      <li><{$smarty.const._MD_KWDEVICE_CATE_SETUP}></li>
      <li><{$smarty.const._MD_KWDEVICE_PLACE_SETUP}></li>
      <li><{$smarty.const._MD_KWDEVICE_EQU_SETUP}></li>
  </ul>

  <div class="resp-tabs-container vert">
    <div><{includeq file="$xoops_rootpath/modules/kw_device/templates/sub_kw_device_config.tpl"}></div>
    <div><{includeq file="$xoops_rootpath/modules/kw_device/templates/sub_kw_device_cate.tpl"}></div>
    <div><{includeq file="$xoops_rootpath/modules/kw_device/templates/sub_kw_device_place.tpl"}></div>
    <div><{includeq file="$xoops_rootpath/modules/kw_device/templates/sub_kw_device_equ.tpl"}></div>
  </div>
</div>
