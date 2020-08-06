<div class="row">
    <div class="col-sm-6">
        <h2>
            <{$smarty.const._MD_KWDEVICE_CONFIG_SETUP}>
        </h2>
        <{includeq file="$xoops_rootpath/modules/kw_device/templates/sub_kw_device_config_form.tpl" }>
    </div>
    <div class="col-sm-6">
        <h2>
            <{$smarty.const._MD_KWDEVICE_CONFIG_LIST}>
        </h2>
        <{if $all_config_content}>
            <script type="text/javascript">
                $(document).ready(function () {
                    $("#kw_device_config_sort").sortable({
                        opacity: 0.6, cursor: "move", update: function () {
                            var order = $(this).sortable("serialize");
                            $.post("<{$xoops_url}>/modules/kw_device/save_sort.php", order + "&op=update_kw_device_config_sort", function (theResponse) {
                                $("#kw_device_config_save_msg").html(theResponse);
                            });
                        }
                    });
                });
            </script>
            <div id="kw_device_config_save_msg"></div>
            <ul class="list-group" id="kw_device_config_sort">
                <{foreach from=$all_config_content item=data}>
                    <li id="configli_<{$data.config_id}>" class="list-group-item">
                        <{if $data.config_isenable == 0}>
                        <span class="badge badge-secondary">(<{$data.config_sort}>)<{$data.config_title}>(<{$data.config_uid}>)</span>
                        <{else}>
                        (<{$data.config_sort}>)<{$data.config_title}>(<{$data.config_uid}>)
                        <{/if}>

                            <{if $iskwDeviceAdmin}>
                                <img src="<{$xoops_url}>/modules/tadtools/treeTable/images/updown_s.png" style="cursor: s-resize;margin:0px 4px;" alt="<{$smarty.const._TAD_SORTABLE}>" title="<{$smarty.const._TAD_SORTABLE}>">
                                <a href="javascript:delete_config_func(<{$data.config_id}>);" class="btn btn-sm btn-danger"><{$smarty.const._TAD_DEL}></a>
                                
                                <a href="<{$xoops_url}>/modules/kw_device/config.php?type=config&config_id=<{$data.config_id}>#setupTab1" class="btn btn-sm btn-warning"><{$smarty.const._TAD_EDIT}></a>
                                
                            <{/if}>
                           
                    </li>
                    <{/foreach}>
            </ul>
            <{/if}>
    </div>
</div>