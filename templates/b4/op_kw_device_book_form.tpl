


<div class="row">
        <div class="col-sm-10">
                <h2>  <{$semester.year}><{$smarty.const._MD_KWDEVICE_BOOK_APPLY}> | <{$equ.equ_title}></h2>
        </div> 
    </div>
  
    <span class="badge badge-primary">  <{$smarty.const._MD_KWDEVICE_BOOK_DATE_LIMIT}>
        <{$semester.start_date_dc}> ~~ <{$semester.end_date_dc}></span>
    <br>

    <div class="vtable" style="margin: 10px auto 20px;">
        <ul class="vhead">
             <!--設備採購年度 編碼-->
             <li class="w1 text-left">
                <{$smarty.const._MD_KWDEVICE_EQU_YEAR}>/<br> <{$smarty.const._MD_KWDEVICE_EQU_CODE}>
            </li>
             <!--設備類型 名稱-->
            <li class="w2 text-left">
                <{$smarty.const._MD_KWDEVICE_EQU_CATE}>/<{$smarty.const._MD_KWDEVICE_EQU_TITLE}>
            </li>
             <!--保管地點-->
            <li class="w2 text-left">
                <{$smarty.const._MD_KWDEVICE_EQU_PLACE}>/<{$smarty.const._MD_KWDEVICE_EQU_CONFIG}>
            </li>
              <!--設備數量-->
            <li class="w1 text-left">
                <{$smarty.const._MD_KWDEVICE_EQU_NUMBER}>
            </li>                    
              <!--可借數量-->
              <li class="w1 text-left">
                <{$smarty.const._MD_KWDEVICE_EQU_AVALIABLE}>
            </li>   
              <!--可借數量-->
              <li class="w1 text-left">
                <{$smarty.const._MD_KWDEVICE_EQU_COUNT}>
            </li> 
        </ul>
        </div>
        <div class="vtable" style="margin: 10px auto 20px;">
            <ul id="tr_<{$data.equ_id}>">
                 <!--設備年度 編號-->
                 <li class="vm w1"><{$equ.equ_year}> / <{$equ.equ_code}></li>

                <!--設備類型 名稱-->
                <li class="vm w2">
                    <span class="badge badge-info"><{$cate}></span>                         
                    <a href="index.php?equ_id=<{$data.equ_id}>"><{$equ.equ_title}></a>
                </li>
                <!--保管地點-->
                <li class="vm w2">
                    <i class="fa fa-map-marker" aria-hidden="true" title="<{$smarty.const._MD_KWDEVICE_PLACE_ID}>"></i>
                    <{$place}> /
                    <i class="fa fa-user-circle-o" aria-hidden="true" title="<{$smarty.const._MD_KWDEVICE_CONFIG_ID}>"></i>
                    <{$config}>
                </li>
                <!--設備數量 可借數量-->
                <li class="vm w1 text-center">
                    <span class="badge badge-secondary"><{$equ.equ_number}></span>
                </li>
                  <!--可借數量-->
                <li class="vm w1 text-center"> 
                    <span class="badge badge-primary"><{$equ.equ_available}> </span>
                </li>   
                <!--可借數量-->
                 <li class="vm w1 text-center">
                    <span class="badge badge-success"><{$equ.equ_count}></span>
                </li> 
            </div>
            <span class="badge badge-danger"><{$smarty.const._MD_KWDEVICE_BOOK_NOTE}></span>
            <!-- <br><p><{$equ.equ_note}></p> <br> -->
            <div class="col-md-12 alert alert-info"><{$equ.equ_note}></div>

<!--套用formValidator驗證機制-->
<form action="admin.php" method="post" id="bookForm" enctype="multipart/form-data" class="myForm " role="form">
  
   
    <div class="col-sm-7">
    <input class="validate[required]" size="1" type='checkbox'  name='book_check' id="book_check" title='' value='yes'>
    <{$smarty.const._MD_KWDEVICE_BOOK_NOTE_YES}>
    </div>

     
     
     <!-- 借用數量 -->
     <div class="form-group row">
        <label for="book_number" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_BOOK_NUMBER}><span class="caption-required">*</span></label>
        <div class="col-sm-5">
            <select class="form-control validate[required]" size="1" name="book_number" id="book_number" title="">
            <{foreach from = $book_available  item="value"}>
                <option value='<{$value}>' <{if $book_number == $value}> selected<{/if}>><{$value}></option>
             <{/foreach}>
                
            </select>
        </div>
    </div>

     <!-- 借用日期模式 -->
     <div class="form-group row">
        <label for="book_mode" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_BOOK_MODE}><span class="caption-required">*</span></label>
        <div class="col-sm-5">
            <select class="form-control validate[required]" size="1" name="book_mode" id="book_mode" title="">
                <option value="day" <{if $book_mode=='day'}>selected<{/if}>><{$smarty.const._MD_KWDEVICE_BOOK_SHORT}></option>
                <option value="week" <{if $book_mode=='week'}>selected<{/if}>><{$smarty.const._MD_KWDEVICE_BOOK_MIDDLE}></option>
                <option value="month" <{if $book_mode=='month'}>selected<{/if}>><{$smarty.const._MD_KWDEVICE_BOOK_MONTH}></option>
                <option value="semester" <{if $book_mode=='semester'}>selected<{/if}>><{$smarty.const._MD_KWDEVICE_BOOK_LONG}></option>
            </select>
        </div>
    </div>

 <!-- 借用日期 -->
 <div class="form-group row">
   <!-- 日期借用 -->
    <label for="book_time_start" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_BOOK_DATE}>
       <span class="caption-required">*</span> <br><{if $today !=$book_time_start}><{$book_time_start}><{/if}></label>
    <div class="col-sm-2">
        <input class="form-control validate[required]" type="text" name="book_time_start" id="book_time_start" size="30" maxlength="25" value="<{$today}>" onclick="WdatePicker({minDate:'<{$semester.start_date_dc}>', maxDate:'<{$semester.end_date_dc}>'})">
    </div>
    <label for="book_time_end" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_BOOK_CLOSE}><span class="caption-required">*</span></label>
    <div class="col-sm-2">
        <input class="form-control validate[required]" type="text" name="book_time_end" id="book_time_end" size="30" maxlength="25" value="<{$book_time_end}>" onclick="WdatePicker({minDate:'#F{$dp.$D(\'book_time_start\',{d:1});}', maxDate:'<{$semester.end_date_dc}>'})">
    </div>
</div>
 <!-- 是否啟用 -->

 <div class="form-group row">
     <label for="book_isenable" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_BOOK_ISENABLE}><span class="caption-required">*</span></label>
     <div class="col-sm-10">
         <div class="form-check form-check-inline">
             <input class="form-check-input" type='radio' name='book_isenable' id='book_isenable1' title='<{$smarty.const._YES}>' value='1' <{if $book_isenable!='0'}>checked<{/if}>>
             <label class="form-check-label" for="book_isenable1"><{$smarty.const._YES}></label>
         </div>
         <div class="form-check form-check-inline">
             <input class="form-check-input" type='radio' name='book_isenable' id='book_isenable2' title='<{$smarty.const._NO}>' value='0' <{if $book_isenable=='0'}>checked<{/if}>>
             <label class="form-check-label" for="book_isenable2"><{$smarty.const._NO}></label>
         </div>

     </div>
 </div>


<!-- 借用設備用途 -->
<div class="form-group row">
    <label for="class_desc" class="col-sm-2 col-form-label text-sm-right"><{$smarty.const._MD_KWDEVICE_BOOK_DESC}><span class="caption-required">*</span></label>
    <div class="col-sm-10 " >
        <{$book_desc_editor}>
    </div>
</div>


    <div class="text-center">

        <{$book_token}>

        <{if $book_id }>
        <input type="hidden" name="book_id"  value="<{$book_id}>" >
        <input type="hidden" name="op" value="kw_device_book_update">
        <{else}>
        <input type="hidden" name="equ_id"  value="<{$equ_id}>" >
        <input type="hidden" name="op" value="kw_device_book_insert">
        <{/if}>
        <{if ($book_ischecked=='0' &&  $book_isdeny=='0') || !$book_ischecked }>
            <button type="submit" class="btn btn-primary"><{$smarty.const._MD_KWDEVICE_CHECK_OK}></button>
        <{/if}>
    </div>
</form>


<script>
    $(document).ready(function(){
        $('#book_uid').change(function(){
            $.post('ajax.php', { book_uid: $('#book_uid').val(), op: "search_book_uid" },
            function(data) {
                $('#book_name').val(data);
            });
        });
    });
</script>
