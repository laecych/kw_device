<div class="row">
    <div class="col-sm-10">
        <h1><{$smarty.const._MD_KWDEVICE_BOOK_CHECK}></h1>
    </div>
</div>
<{$smarty.const._MD_KWDEVICE_TODAY}><{$smarty.const._TAD_FOR}><{$today}>


<div class="alert alert-info" style="margin: 10px auto;"><{$smarty.const._MD_KWDEVICE_BOOK_YEAR}>
    <select name="book_year" id="book_year" onChange="location.href='admin.php?op=kw_device_check_list&book_year=' + $('#book_year').val() + '&review=' + $('#review').val() ;">
        <option value=""><{$smarty.const._MD_KWDEVICE_BOOK_YEAR}></option>
        <option value="<{$semester.this_year}><{$semester.this_semester}>" <{if $book_year==$semester.year}> selected <{/if}>>
             <{$semester.year}></option>
        <{if $semester.this_semester == 01}>
            <option value="<{$semester.this_year-1}>02" <{if $book_year==($semester.this_year-1.02)}> selected <{/if}>>
                <{$semester.this_year-1}>02</option>
            <option value="<{$semester.this_year-1}>01" <{if $book_year==($semester.this_year-1.01)}> selected <{/if}>>
                <{$semester.this_year-1}>01</option>
        <{else}>
            <option value="<{$semester.this_year}>01" <{if $book_year==($semester.this_year.01)}> selected <{/if}>>
                <{$semester.this_year}>01</option>
            <option value="<{$semester.this_year-1}>02" <{if $book_year==($semester.this_year-1.02)}> selected <{/if}>>
                <{$semester.this_year-1}>02</option>
        <{/if}>
      
    </select>
    <select name="review" id="review" onChange="location.href='admin.php?op=kw_device_check_list&book_year=' + $('#book_year').val() + '&review=' + $('#review').val() ;">
        <option value=""><{$smarty.const._MD_KWDEVICE_BOOK_SORT}></option>
        <option value="book_time" <{if $review=='book_time'}>selected<{/if}>><{$smarty.const._MD_KWDEVICE_BOOK_DATE}></option>
        <option value="book_islate" <{if $review=='book_islate'}>selected<{/if}>><{$smarty.const._MD_KWDEVICE_BOOK_LATE}></option>
        <option value="book_isdeny" <{if $review=='book_isdeny'}>selected<{/if}>><{$smarty.const._MD_KWDEVICE_BOOK_DENY}></option>
        <option value="book_isreturn" <{if $review=='book_isreturn'}>selected<{/if}>><{$smarty.const._MD_KWDEVICE_BOOK_RETRUN}></option>
        <option value="book_isenable" <{if $review=='book_isenable'}>selected<{/if}>><{$smarty.const._MD_KWDEVICE_BOOK_ENABLE}></option>
        <option value="book_ischeck" <{if $review=='book_ischeck'}>selected<{/if}>><{$smarty.const._MD_KWDEVICE_BOOK_CHECK}></option>
    </select>
</div>

<{if $all_book}>

     <div class="vtable" style="margin: 10px auto 20px;">
        <ul class="vhead">
            <!--設備排序-->
            <li class="vm w1 text-left">
                <{$smarty.const._MD_KWDEVICE_BOOK_ID}>/<br><{$smarty.const._MD_KWDEVICE_BOOK_YEAR}><br>
            </li>
               <!--設備類型 名稱-->
             <li class="vm w2 text-left">
                <{$smarty.const._MD_KWDEVICE_EQU_TITLE}>
            </li>
             <!--設備類型 名稱-->
            <li class="vm w1 text-left">
                <{$smarty.const._MD_KWDEVICE_BOOK_NUMBER}>
            </li>
              <!--借用模式 日期-->
            <li class="vm w1 text-left">
                <{$smarty.const._MD_KWDEVICE_BOOK_MODE}>/<{$smarty.const._MD_KWDEVICE_BOOK_DATE}>
            </li>                  
            <!--借用用途-->
            <li class="vm w2 text-center">
                <{$smarty.const._MD_KWDEVICE_BOOK_DESC}>
            </li>
              <!--借用者-->
              <li class="vm w1 text-left">
                <{$smarty.const._MD_KWDEVICE_BOOK_UID}>
            </li>
             <!--借用狀態-->
             <li class="vm w1 text-left">
                <{$smarty.const._MD_KWDEVICE_BOOK_STATU}>
            </li>

           
          
        </ul>
    </div>

   <{foreach from=$all_book key=id item=data}>
    <div class="vtable" style="margin: 10px auto 20px;">
        <ul id="tr_<{$data.book_id}>">
            <!--設備排序 年度 編號-->
            <li class="vm w1">(<{$data.book_id}>)<br><{$data.book_year}></li>

             <!--設備類型 名稱-->
             <li class="vm w2">
                <span class="badge badge-info"><{$data.cate_id}></span>
                <{$data.equ_title}></br>
                <i class="fa fa-map-marker" aria-hidden="true" title="<{$smarty.const._MD_KWDEVICE_PLACE_ID}>"></i>
                <{$data.place_id}> </br>
                <i class="fa fa-user-circle-o" aria-hidden="true" title="<{$smarty.const._MD_KWDEVICE_CONFIG_ID}>"></i>
                <{$data.config_id}>
           </li>

            <!--借用數量-->
            <li class="vm w1"><{$data.book_number}></li>

            <!--借用模式 日期-->
            <li class="vm w2">
                <{if $data.book_mode == 'day' }>
                <span class="badge badge-primary"><{$smarty.const._MD_KWDEVICE_BOOK_SHORT}> </span><br>
                <{elseif $data.book_mode == 'week'}>
                <span class="badge badge-success"><{$smarty.const._MD_KWDEVICE_BOOK_MIDDLE}> </span><br>
                <{else}>
                <span class="badge badge-danger"><{$smarty.const._MD_KWDEVICE_BOOK_LONG}> </span><br>
                <{/if}>
                <{$data.book_time_start}>~<br><{$data.book_time_end}>
            </li>

              <!--借用用途-->
             <li class="vm w2"><{$data.book_desc}></li>

            <!--借用者-->
            <li class="vm w1">
                <span class="badge badge-secondary"><{$data.book_uidname}></span>
            </li>
          

          
           <!--借用狀態-->
           <li class="vm w1 text-center">
            <{if $data.book_isenable == 1}><!--借用申請-->
            <{if $data.book_isdeny == 0}>
                <{if $data.book_ischecked == 1}>
                    <{if $data.book_istaken == 1}>
                            <{if $data.book_islate == 0}>    
                                    <{if $data.book_isreturn == 1}>    
                                            <{if $data.book_isfinish == 1}>   
                                            <span class="badge badge-secondary"><{$smarty.const._MD_KWDEVICE_BOOK_FINISH}></span></a>
                                            <{else}>    
                                            <span class="badge badge-primary"><{$smarty.const._MD_KWDEVICE_BOOK_RETURN}></span></a>
                                            <{/if}>
                                    <{else}>    
                                    <span class="badge badge-success"><{$smarty.const._MD_KWDEVICE_BOOK_INUSE}></span></a>
                                    <{/if}>
                            <{else}>    
                            <span class="badge badge-danger"><{$smarty.const._MD_KWDEVICE_BOOK_LATE}></span></a>
                            <{/if}>
                    <{else}>
                    <span class="badge badge-info"> <{$smarty.const._MD_KWDEVICE_BOOK_CHECKED}></span>
                    <{/if}>
                <{else}>
                <span class="badge badge-warning"> <{$smarty.const._MD_KWDEVICE_BOOK_INCHECK}></span>
                 <{/if}>
            <{else}>
            <span class="badge badge-danger"> <{$smarty.const._MD_KWDEVICE_BOOK_DENY}></span>
            <{/if}>
        <{else}><!--借用不申請-->
        <span class="badge badge-secondary"><{$smarty.const._MD_KWDEVICE_BOOK_STOP}></span>
        <{/if}>  
        <br><{$data.book_checknote}>
    </li>
    </ul>
    </div>



    <{if $iskwDeviceAdmin || $uid == $data.config_uid}>
    <!--審核管理-->
    <div class="row">
        <div class="col-md-1"><{$smarty.const._MD_KWDEVICE_BOOK_CHECK}>：</div>
        <div class="col-md-10">     
            <ul class="vhead">
            <li class="vm w1 text-left">
             <{if $iskwDeviceAdmin || $iskwDeviceCheck }>
                 <{if $data.book_ischecked == 0 && $data.book_isdeny== 0 }>
                    <input class="form-control" type="text" name="book_note<{$data.book_id}>" id="book_note<{$data.book_id}>" size="30" maxlength="255" value="<{$data.book_checknote}>"  placeholder="<{$smarty.const._MD_KWDEVICE_BOOK_DENYNOTE}>" >
                
                    <a href="" onclick="getaddr(this, <{$data.book_id}>,'ischecked' );"  class="btn btn-sm btn-success">
                    <{$smarty.const._MD_KWDEVICE_BOOK_PASS}></a>
                    <a href="" onclick="getaddr(this, <{$data.book_id}>,'isdeny' );" class="btn btn-sm btn-danger"> 
                        <{$smarty.const._MD_KWDEVICE_BOOK_DENY}> </a>
                <{elseif $data.book_isdeny== 1 && $data.book_ischecked == 0}>
                    <span class="badge badge-secondary"><{$smarty.const._MD_KWDEVICE_BOOK_PASS}></span>
                    <span class="badge badge-secondary"><{$smarty.const._MD_KWDEVICE_BOOK_UNDENY}></span>
                <{else}>
                    <span class="badge badge-secondary"><{$smarty.const._MD_KWDEVICE_BOOK_PASS}></span>
                    <span class="badge badge-secondary"><{$smarty.const._MD_KWDEVICE_BOOK_DENY}></span>
                <{/if}>
   
                <{if $data.book_ischecked == 1 && $data.book_deny == 0}>              
                    <{if $data.book_ischecked == '1' && $data.book_istaken == '0' }>
                        <a href="admin.php?op=kw_device_check_list&book_id=<{$data.book_id}>&type=istaken&isvalue=1" class="btn btn-sm btn-warning"> <{$smarty.const._MD_KWDEVICE_BOOK_TAKEN}></a>
                    <{else}>
                        <span class="badge badge-secondary"><{$smarty.const._MD_KWDEVICE_BOOK_TAKEN}></span>
                    <{/if}>  
                    <{if $data.book_isreturn == '0' && $data.book_islate == '1'}>
                        <a href="#" class="btn btn-sm btn-danger"><{$smarty.const._MD_KWDEVICE_BOOK_LATE}></a>  
                    <{else}>
                        <span class="badge badge-secondary"><{$smarty.const._MD_KWDEVICE_BOOK_LATE}></span>
                    <{/if}>  
                    <{if $data.book_ischecked == '1' && $data.book_istaken == '1' && $data.book_isreturn == '0'}> 
                        <a href="admin.php?op=kw_device_check_list&book_id=<{$data.book_id}>&type=isreturn&isvalue=1" class="btn btn-sm btn-info"><{$smarty.const._MD_KWDEVICE_BOOK_RETURN}></a>
                    <{else}>
                        <span class="badge badge-secondary"><{$smarty.const._MD_KWDEVICE_BOOK_RETURN}></span>
                    <{/if}>  

                    <{if $data.book_ischecked == '1' && $data.book_istaken == '1' && $data.book_isreturn == '1' && $data.book_isfinish == '0'}>
                        <a href="admin.php?op=kw_device_check_list&book_id=<{$data.book_id}>&type=isfinish&isvalue=1" class="btn btn-sm btn-primary"><{$smarty.const._MD_KWDEVICE_BOOK_FINISH}></a>
                    <{else}>
                        <span class="badge badge-secondary"><{$smarty.const._MD_KWDEVICE_BOOK_FINISH}></span>
                    <{/if}>
                <{/if}> 
            <{/if}>
    
            </li></ul>
         </div>
    </div>
    <{/if}>
 
    <{/foreach}>

<{else}>
    <div class="alert alert-danger">
        <{$smarty.const._MD_KWDEVICE_NO_CHECK}>
    </div>
<{/if}>


<{$bar}>

<script type="text/javascript">
        function getaddr(a, id, type) {
        if(type == 'isdeny')
            var pms = 'op=kw_device_check_list&book_id='+ id + '&type=isdeny&isvalue=1&note=' + document.getElementById("book_note"+id).value;
        if(type=='ischecked')
            var pms = 'op=kw_device_check_list&book_id='+ id + '&type=ischecked&isvalue=1&note=' + document.getElementById("book_note"+id).value;
        a.href = 'admin.php?' + pms;
      }
</script>   

