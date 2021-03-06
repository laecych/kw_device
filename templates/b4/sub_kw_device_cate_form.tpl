<!--套用formValidator驗證機制-->
<form action="config.php" method="post" id="cateForm" enctype="multipart/form-data" class="myForm " role="form">

    <!--類型標題-->
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_KWDEVICE_CATE_TITLE}>
        </label>
        <div class="col-sm-10">
            <input type="text" name="cate_title" id="cate_title" class="form-control validate[required]" value="<{$cate_title}>" placeholder="<{$smarty.const._MD_KWDEVICE_CATE_TITLE}>">
        </div>
    </div>

    <!--類型排序-->
 <div class="form-group row">
    <label class="col-sm-2 col-form-label text-sm-right">
        <{$smarty.const._MD_KWDEVICE_CATE_SORT}>
    </label>
    <div class="col-sm-10">
        <input type="text" name="cate_sort" id="cate_sort" class="form-control validate[required]" value="<{$cate_sort}>" placeholder="<{$smarty.const._MD_KWDEVICE_CATE_SORT}>">
    </div>
</div>


    <!--狀態-->
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_KWDEVICE_ISENABLE}>
        </label>
        <div class="col-sm-10">
          <div class="form-check form-check-inline">
                <input type="radio" name="cate_enable" id="cate_enable_1" value="1" <{if $cate_enable != "0"}>checked<{/if}>>
                <label class="form-check-label" for="ate_enable_1"><{$smarty.const._YES}></label>
         
                <input type="radio" name="cate_enable" id="cate_enable_0" value="0" <{if $cate_enable == "0"}>checked<{/if}>>
                <label class="form-check-label" for="ate_enable_0"><{$smarty.const._NO}></label>
            
          </div>
        </div>
    </div>

    <div class="text-center">
        
        <{$cate_token}>

    <!--類型排序-->
      
        <input type="hidden" name="type" value="cate">
        <input type="hidden" name="op" value="<{$cate_op}>">
        <input type="hidden" name="cate_id" value="<{$cate_id}>">
        <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
    </div>
</form>
