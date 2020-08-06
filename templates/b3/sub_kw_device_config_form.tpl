<!--套用formValidator驗證機制-->
<form action="config.php" method="post" id="configForm" enctype="multipart/form-data" class="myForm " role="form">

    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_KWDEVICE_CONFIG_PICKER}>
        </label>
        <div class="col-sm-10">
            <select class="form-control validate[required]" size="1" name="config_uid" id="config_uid" title="<{$smarty.const._MD_KWDEVICE_CONFIG_PICKER}>">
                <{foreach from=$user_arr key=id item=arr_u}>
                    <option value="<{$arr_u.uid}>" <{if $config_uid==$arr_u.uid}>selected<{/if}>>
                        (<{$arr_u.uid}>)<{$arr_u.uname}>【<{$arr_u.name}>】
                    </option>
                <{/foreach}>
            </select>

        </div>
    
    </div>

    <!--職稱-->
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_KWDEVICE_CONFIG_TITLE}>
        </label>
        <div class="col-sm-10">
            <input type="text" name="config_title" id="config_title" class="form-control validate[required]" value="<{$config_title}>" placeholder="<{$smarty.const._MD_KWDEVICE_CONFIG_TITLE}>">
        </div>
    </div>

    <!--類型排序-->
 <div class="form-group row">
    <label class="col-sm-2 col-form-label text-sm-right">
        <{$smarty.const._MD_KWDEVICE_CONFIG_SORT}>
    </label>
    <div class="col-sm-10">
        <input type="text" name="config_sort" id="config_sort" class="form-control validate[required]" value="<{$config_sort}>" placeholder="<{$smarty.const._MD_KWDEVICE_PLACE_SORT}>">
    </div>
</div>
    

    <!--狀態-->
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_KWDEVICE_ISENABLE}>
        </label>
        <div class="col-sm-10">
             <div class="form-check form-check-inline">
                <input type="radio" name="config_enable" id="config_enable_1" value="1" <{if $config_enable != "0"}>checked<{/if}>> <label class="form-check-label" for="config_enable_1"><{$smarty.const._YES}></label>
                <input type="radio" name="config_enable" id="config_enable_0" value="0" <{if $config_enable == "0"}>checked<{/if}>> <label class="form-check-label" for="config_enable_0"><{$smarty.const._NO}></label>
            </div>
        </div>
    </div>
    <div class="text-center">

        <{$conf_token}>

            <!--類型排序-->
          
            <input type="hidden" name="type" value="config">
            <input type="hidden" name="op" value="<{$config_op}>">
            <input type="hidden" name="config_id" value="<{$config_id}>">
            <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
    </div>
</form>