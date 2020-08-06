<{if $equ_id==""}>
    <h2><{$smarty.const._MD_KWDEVICE_ADD_EQU}></h2>
<{else}>
    <h2><{$smarty.const._MD_KWDEVICE_EDIT_EQU}>：
        <small><span class="equ_year"><{$equ_title}></span></small>
    </h2>
<{/if}>

<form name="equform" id="equform" action="index.php" method="post" enctype="multipart/form-data">

   
     <!-- 採購年度 -->
     <div class="form-group row">
        <label for="equ_week" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_EQU_YEAR}><span class="caption-required">*</span></label>
        <div class="col-sm-10">
            <input class='form-control validate[required]' type='text' name='equ_year' title='<{$smarty.const._MD_KWDEVICE_EQU_YEAR}>' id='equ_year' size='10' maxlength='10' value='<{$equ_year}>'>
          
        </div>
    </div>
     <!-- 設備編號 -->
    <div class="form-group row">
        <label for="equ_code" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_EQU_CODE}><span class="caption-required">*</span></label>
        <div class="col-sm-10"><input class='form-control validate[required]' type='text' name='equ_code' title='<{$smarty.const._MD_KWDEVICE_EQU_CODENOT}>' id='equ_code' size='30' maxlength='255' value='<{$equ_code}>'>
        </div>
    </div>

      <!--設備類型 -->
      <div class="form-group row">
        <label for="cate_id" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_CATE_TITLE}><span class="caption-required">*</span></label>
        <div class="col-sm-5">
            <select class="form-control validate[required]" size="1" name="cate_id" id="cate_id" title="<{$smarty.const._MD_KWDEVICE_CATE_ID}>">
                <{foreach from=$arr_cate key=id item=arr_c}>
                    <option value="<{$id}>" <{if $cate_id==$id}>selected<{/if}>><{$arr_c}></option>
                <{/foreach}>
            </select>
        </div>
        <div class="col-sm-5">
            <!-- <div class="form-text text-muted">
                <{$smarty.const._MD_KWDEVICE_EDIT_CATE_NOTE}>
            </div> -->
        </div>
    </div>

    <!-- 設備名稱 -->
    <div class="form-group row">
        <label for="equ_title" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_EQU_TITLE}><span class="caption-required">*</span></label>
        <div class="col-sm-10">
            <{if $equ_num && $equ_title && $equ_id==""}>
                <{$equ_num}>_<{$equ_title}>
            <{else}>
                <input class='form-control validate[required]' type='text' name='equ_title' title='<{$smarty.const._MD_KWDEVICE_EQU_TITLE}>' id='equ_title' value='<{$equ_title}>'>
            <{/if}>
        </div>
    </div>


     <!-- 保管地點 -->
     <div class="form-group row">
        <label for="place_id" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_PLACE_TITLE}><span class="caption-required">*</span></label>
        <div class="col-sm-5">
            <select class="form-control validate[required]" size="1" name="place_id" id="place_id" title="">
                <{foreach from=$arr_place key="id"  item="arr_p" }>
                <option value="<{$id}>" <{if $place_id==$id}>selected<{/if}>><{$arr_p}></option>
                <{/foreach}>
            </select>
        </div>

       
    </div>

    <!-- 審核者 -->
    <div class="form-group row">
        <label for="teacher_id" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_CONFIG_TITLE}><span class="caption-required">*</span></label>
        <div class="col-sm-5">
            <select class="form-control validate[required]" size="1" name="config_uid" id="config_uid" title="<{$smarty.const._MD_KWDEVICE_CONFIG_ID}>">
                <{foreach from=$arr_config key=id item=arr_f}>
                    <option value="<{$id}>" <{if $config_uid==$id}>selected<{/if}>><{$arr_f}></option>
                <{/foreach}>
            </select>
            <!-- <select class="form-control validate[required]" size="1" name="teacher_id" id="teacher_id" title="<{$smarty.const._MD_KWDEVICE_TEACHER_NAME}>">
                <{foreach from=$arr_teacher key="tid" item="teacher" }>
                    <option value="<{$tid}>" <{if ($tid==$uid and $equ_id=='') or ($tid==$teacher_id and $equ_id=='' and $equ_num!='')}>selected<{/if}>><{$teacher.title}> (<{$teacher.desc}>)</option>
                <{/foreach}>
            </select> -->
        </div>
        <div class="col-sm-5">
            <!-- <div class="form-text text-muted">
                <{$smarty.const._MD_KWDEVICE_EDIT_CONFIG_TITLE}>
            </div> -->
        </div>
    </div>

   <!-- 設備數量 -->
    <div class="form-group row">
        <label for="equ_member" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_EQU_NUMBER}><span class="caption-required">*</span></label>
        <div class="col-sm-10"><input class='form-control validate[required]' type='text' name='equ_number' title='<{$smarty.const._MD_KWDEVICE_EQU_NUMBER}>' id='equ_number' size='30' maxlength='255' value='<{$equ_number}>'>
        </div>
    </div>

   <!-- 設備排序 -->
   <div class="form-group row">
    <label for="equ_sort" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_EQU_SORT}><span class="caption-required">*</span></label>
    <div class="col-sm-10"><input class='form-control validate[required]' type='text' name='equ_sort' title='<{$smarty.const._MD_KWDEVICE_EQU_SORT}>' id='equ_sort' size='30' maxlength='255' value='<{$equ_sort}>'>
    </div>
</div>

    <!-- 是否啟用 -->
    <div class="form-group row">
            <label for="equ_isenable" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_EQU_ISENABLE}><span class="caption-required">*</span></label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type='radio' name='equ_isenable' id='equ_isenable1' title='<{$smarty.const._YES}>' value='1' <{if $equ_isenable!='0'}>checked<{/if}>>
                    <label class="form-check-label" for="equ_isenable1"><{$smarty.const._YES}></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type='radio' name='equ_isenable' id='equ_isenable2' title='<{$smarty.const._NO}>' value='0' <{if $equ_isenable=='0'}>checked<{/if}>>
                    <label class="form-check-label" for="equ_isenable2"><{$smarty.const._NO}></label>
                </div>

            </div>
    </div>
   

    <!-- 設備使用注意事項 -->
    <div class="form-group row">
        <label for="equ_note" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_EQU_NOTE}><span class="caption-required">*</span></label>
        <div class="col-sm-10">
            <{$equ_note_editor}>
        </div>
    </div>

    <{if $equ_id }>
        <input type="hidden" name="equ_id" id="equ_id" value="<{$equ_id}>">
        <input type="hidden" name="op" value="kw_device_equ_update">
    <{else}>
        <input type="hidden" name="op" value="kw_device_equ_insert">
    <{/if}>
       
    <{$token}>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right"> </label>
        <div class="col-sm-10">
            <button type='submit' class='btn btn-primary'><{$smarty.const._TAD_SAVE}></button>
        </div>
    </div>
</form>
