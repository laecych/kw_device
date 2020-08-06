<div class="row">
    <div class="col-sm-10">
        <h1><{$smarty.const._MD_KWDEVICE_BOOK}></h1>
    </div>
</div>
<{$smarty.const._MD_KWDEVICE_TODAY}><{$smarty.const._TAD_FOR}><{$today}>

<div class="alert alert-info" style="margin: 10px auto;"><{$smarty.const._MD_KWDEVICE_BOOK_YEAR}>
    <select name="book_year" id="book_year" onChange="location.href='admin.php?book_year=' + $('#book_year').val() + '&review=' + $('#review').val() ;">
        <option value=""><{$smarty.const._MD_KWDEVICE_BOOK_YEAR}></option>
        <option value="<{$semester.this_year}><{$semester.this_semester}>" <{if $book_year == $semester.year }> selected <{/if}>>
             <{$semester.year}></option>
        <{if $semester.this_semester == 01}>
            <option value="<{$semester.this_year-1}>02" <{if $book_year == "($semester.this_year-1.02)" }> selected <{/if}>>
                <{$semester.this_year-1}>02</option>
            <option value="<{$semester.this_year-1}>01" <{if $book_year == "($semester.this_year-1.01)" }> selected <{/if}>>
                <{$semester.this_year-1}>01</option>
        <{else}>
            <option value="<{$semester.this_year}>01" <{if $book_year == "($semester.this_year.01)"}> selected <{/if}>>
                <{$semester.this_year}>01</option>
            <option value="<{$semester.this_year-1}>02" <{if $book_year == "($semester.this_year-1.02)"}> selected <{/if}>>
                <{$semester.this_year-1}>02</option>
        <{/if}>
    </select>
    <select name="review" id="review" onChange="location.href='admin.php?book_year=' + $('#book_year').val() + '&review=' + $('#review').val() ;">
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
                <{$smarty.const._MD_KWDEVICE_BOOK_ID}><br>
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
             <!--借用管理-->
             <li class="vm w1 text-left">
                <{$smarty.const._MD_KWDEVICE_BOOK_ADMID}>
            </li>
         
           
          
        </ul>
    </div>

   <{foreach from=$all_book item=data}>
    <div class="vtable" style="margin: 10px auto 20px;">
        <ul id="tr_<{$data.book_id}>">
            <!--設備排序 年度 編號-->
            <li class="vm w1"><{$data.book_year}><{$data.book_id}></li>

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


       
            <!--借用管理-->
             <li class="vm w1 text-center">
    
                <{if $data.book_ischecked =='0' && $data.book_isdeny =='0'}>   
                <a href="admin.php?op=kw_device_update_book_enable&book_id=<{$data.book_id}>&book_isenable=<{if $data.book_isenable==1}>0<{else}>1<{/if}>" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MD_KWDEVICE_CLICK_TO}>  <{if $data.book_isenable==1}><{$smarty.const._MD_KWDEVICE_BOOK_STOP}><{else}><{$smarty.const._MD_KWDEVICE_BOOK_ENABLE}><{/if}>">
                    <{if $data.book_isenable==1}> <span class="badge badge-danger"><{$smarty.const._MD_KWDEVICE_BOOK_STOP}></span>
                    <{else}><span class="badge badge-info"><{$smarty.const._MD_KWDEVICE_BOOK_ENABLE}></span>
                    <{/if}>
                </a>
                <{else}>
                <span class="badge badge-secondary"><{$smarty.const._MD_KWDEVICE_BOOK_ENABLE}></span>
                <{/if}>
                <br>
                <{if  $data.book_ischecked =='0' && $data.book_isdeny =='0'}>   
                        <a href="admin.php?op=kw_device_book_form&book_id=<{$data.book_id}>">
                        <span class="badge badge-warning"><{$smarty.const._MD_KWDEVICE_BOOK_EDIT}></span></a> /
                        <a href="javascript:delete_book_func(<{$data.book_id}>);" >
                        <span class="badge badge-danger"><{$smarty.const._MD_KWDEVICE_BOOK_DEL}></span></a>
                <{elseif  $data.book_isdeny =='1'}> 
                        <span class="badge badge-secondary"><{$smarty.const._MD_KWDEVICE_BOOK_EDIT}></span> /
                        <a href="javascript:delete_book_func(<{$data.book_id}>);" >
                        <span class="badge badge-danger"><{$smarty.const._MD_KWDEVICE_BOOK_DEL}></span></a>
                <{else}>
                        <span class="badge badge-secondary"><{$smarty.const._MD_KWDEVICE_BOOK_EDIT}></span> /
                        <span class="badge badge-secondary"><{$smarty.const._MD_KWDEVICE_BOOK_DEL}></span>
                <{/if}>
               
            </li>
       
        </ul>
    </div>

    <{/foreach}>

<{else}>
    <div class="alert alert-danger">
        <{$smarty.const._MD_KWDEVICE_NO_BOOK}>
    </div>
<{/if}>


<{$bar}>
