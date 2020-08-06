<!--套用formValidator驗證機制-->
<form action="config.php" method="post" id="equForm" enctype="multipart/form-data" class="myForm " role="form">

    <!--類型標題-->
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_KWDEVICE_EQU_TITLE}>
        </label>
        <div class="col-sm-10">
            <input type="text" name="equ_title" id="equ_title" class="form-control validate[required]" value="<{$EQU_title}>" placeholder="<{$smarty.const._MD_KWDEVICE_EQU_TITLE}>">
        </div>
    </div>

    <!--類型排序-->
 <div class="form-group row">
    <label class="col-sm-2 col-form-label text-sm-right">
        <{$smarty.const._MD_KWDEVICE_equ_SORT}>
    </label>
    <div class="col-sm-10">
        <input type="text" name="equ_sort" id="equ_sort" class="form-control validate[required]" value="<{$equ_sort}>" placeholder="<{$smarty.const._MD_KWDEVICE_EQU_SORT}>">
    </div>
</div>


    <!--狀態-->
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_KWDEVICE_ISENABLE}>
        </label>
        <div class="col-sm-10">
          <div class="form-check form-check-inline">
                <input type="radio" name="equ_enable" id="equ_enable_1" value="1" <{if $equ_enable != "0"}>checked<{/if}>>
                <label class="form-check-label" for="ate_enable_1"><{$smarty.const._YES}></label>
         
                <input type="radio" name="equ_enable" id="equ_enable_0" value="0" <{if $equ_enable == "0"}>checked<{/if}>>
                <label class="form-check-label" for="ate_enable_0"><{$smarty.const._NO}></label>
            
          </div>
        </div>
    </div>

    <div class="text-center">
        
        <{$equ_token}>

    <!--類型排序-->
       
        <input type="hidden" name="type" value="equ">
        <input type="hidden" name="op" value="<{$equ_op}>">
        <input type="hidden" name="equ_id" value="<{$equ_id}>">
        <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
    </div>
</form>
