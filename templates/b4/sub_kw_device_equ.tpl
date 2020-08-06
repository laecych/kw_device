<div class="row">
    <div class="col-sm-10">
        <h2><{$smarty.const._MD_KWDEVICE_EQU_LIST}></h2>
    </div>
    <div class="col-sm-2" style="padding-top: 40px;">
     <a href="index.php?op=kw_device_equ_form" class="btn btn-primary btn-block" ><i class="fa fa-plus" aria-hidden="true"></i> 
                <{$smarty.const._MD_KWDEVICE_ADD_EQU}></a>
    </div>  
    <div class="col-sm-12">
        <{if $all_equ_content}>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#kw_device_equ_sort").sortable({ opacity: 0.6, cursor: "move", update: function() {
                        var order = $(this).sortable("serialize");
                        $.post("<{$xoops_url}>/modules/kw_device/save_sort.php", order + "&op=update_kw_device_equ_sort", function(theResponse){
                        $("#kw_device_equ_save_msg").html(theResponse);
                        });
                    }
                    });
                });
            </script>
            <div id="kw_device_equ_save_msg"></div>
            <ul class="list-group" id="kw_device_equ_sort">
                <{foreach from=$all_equ_content item=data}>
                    <li id="equli_<{$data.equ_id}>" class="list-group-item">
                        (<{$data.equ_sort}>)<{$data.equ_title}>
                   
                            <img src="<{$xoops_url}>/modules/tadtools/treeTable/images/updown_s.png" style="cursor: s-resize;margin:0px 4px;" alt="<{$smarty.const._TAD_SORTABLE}>" title="<{$smarty.const._TAD_SORTABLE}>">
                            <a href="javascript:delete_equ_func(<{$data.equ_id}>);" class="btn btn-sm btn-danger"><{$smarty.const._TAD_DEL}></a>
                            <a href="<{$xoops_url}>/modules/kw_device/index.php?type=equ&equ_id=<{$data.equ_id}>" class="btn btn-sm btn-warning"><{$smarty.const._TAD_EDIT}></a>
                    </li>
                <{/foreach}>
            </ul>
        <{/if}>
    </div>
</div>
