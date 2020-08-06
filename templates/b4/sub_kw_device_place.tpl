<div class="row">
    <div class="col-sm-6">
        <h2><{$smarty.const._MD_KWDEVICE_PLACE_SETUP}></h2>
        <{includeq file="$xoops_rootpath/modules/kw_device/templates/sub_kw_device_place_form.tpl"}>
    </div>
    <div class="col-sm-6">
        <h2><{$smarty.const._MD_KWDEVICE_PLACE_LIST}></h2>
        <{if $all_place_content}>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#kw_device_place_sort").sortable({ opacity: 0.6, cursor: "move", update: function() {
                        var order = $(this).sortable("serialize");
                        $.post("<{$xoops_url}>/modules/kw_device/save_sort.php", order + "&op=update_kw_device_place_sort", function(theResponse){
                        $("#kw_device_place_save_msg").html(theResponse);
                        });
                    }
                    });
                });
            </script>
            <div id="kw_device_place_save_msg"></div>
            <ul class="list-group" id="kw_device_place_sort">
                <{foreach from=$all_place_content item=data}>
                    <li id="placeli_<{$data.place_id}>" class="list-group-item">
                        <{if $data.place_isenable == 0}>
                        <span class="badge badge-secondary"> (<{$data.place_sort}>)<{$data.place_title}></span>
                        <{else}>
                            (<{$data.place_sort}>)<{$data.place_title}>
                        <{/if}>
                        <{if $iskwDeviceAdmin}>
                            <img src="<{$xoops_url}>/modules/tadtools/treeTable/images/updown_s.png" style="cursor: s-resize;margin:0px 4px;" alt="<{$smarty.const._TAD_SORTABLE}>" title="<{$smarty.const._TAD_SORTABLE}>">
                            <a href="javascript:delete_place_func(<{$data.place_id}>);" class="btn btn-sm btn-danger"><{$smarty.const._TAD_DEL}></a>
                            <a href="<{$xoops_url}>/modules/kw_device/config.php?type=place&place_id=<{$data.place_id}>#setupTab3" class="btn btn-sm btn-warning"><{$smarty.const._TAD_EDIT}></a>
                        <{/if}>
                    </li>
                <{/foreach}>
            </ul>
        <{/if}>
    </div>
</div>
