<div class="row">
    <div class="col-sm-10">
        <h1><{$smarty.const._MD_KWDEVICE}></h1>
    </div>
    <{if $iskwDeviceAdmin || $iskwDeviceCheck}>
    <div class="col-sm-2" style="padding-top: 40px;">
        <a href="index.php?op=kw_device_equ_form" class="btn btn-primary btn-block" ><i class="fa fa-plus" aria-hidden="true"></i> 
            <{$smarty.const._MD_KWDEVICE_ADD_EQU}></a>
        </a>
    </div>  
    <{/if}> 
</div>
<{$smarty.const._MD_KWDEVICE_TODAY}><{$smarty.const._TAD_FOR}><{$today}>
<div class="vtable alert alert-info" style="margin: 10px auto; border-width:0px;">
   <!--借用日期說明-->

   <li class="vm w1">
    <{$smarty.const._MD_KWDEVICE_APPLY_FROM_FROM}>
    <span class="number_b">
        <{$arr_semester.start_date}>
    </span></br>
    <{$smarty.const._MD_KWDEVICE_APPLY_FROM_TO}>
    <span class="number_b">
        <{$arr_semester.end_date}>
    </span>
    <!--起始時間-->
</li>
<li class="vm w2">
<!-- 下拉選單 --><{$review}><{$value}>
<{$smarty.const._MD_KWDEVICE_EQU_SEARCH}>
<{$smarty.const._MD_KWDEVICE_CONFIG_TITLE}>
<select name="type_id_f" id="type_id_f" onChange="location.href='index.php?review=config&value='+$('#type_id_f').val();">
    <option  value="" ><{$smarty.const._MD_KWDEVICE_EQU_SELECT}></option>
    <{foreach from=$all_config_arr key=id item=arr_f}>
    <option  value="<{$id}>"  <{if $value == "$id" }>selected<{/if}>><{$arr_f}></option>
    <{/foreach}>
</select>
<{$smarty.const._MD_KWDEVICE_EQU_CATE}>
<select name="type_id_c" id="type_id_c" onChange="location.href='index.php?review=cate&value='+$('#type_id_c').val();">
    <option  value="" ><{$smarty.const._MD_KWDEVICE_EQU_SELECT}></option>
    <{foreach from=$all_cate_arr key=id item=arr_c}>
    <option  value="<{$id}>"  <{if $value == "$id"}>selected<{/if}>><{$arr_c}></option>
    <{/foreach}>
</select>
<{$smarty.const._MD_KWDEVICE_EQU_PLACE}>
<select name="type_id_p" id="type_id_p" onChange="location.href='index.php?review=place&value='+$('#type_id_p').val();">
    <option  value="" ><{$smarty.const._MD_KWDEVICE_EQU_SELECT}></option>
    <{foreach from=$all_place_arr key=id item=arr_p}>
    <option  value="<{$id}>"  <{if $value == "$id"}>selected<{/if}>><{$arr_p}></option>
    <{/foreach}>
</select>


<!-- <select name="review" id="review" onChange="location.href='index.php?review=' + $('#review').val() ;">
    <option value="" <{if $review==''}>selected<{/if}>><{$smarty.const._MD_KWDEVICE_EQU_ALL}></option>
    <option value="cate" <{if $review=='equ_sort'}>selected<{/if}>><{$smarty.const._MD_KWDEVICE_}></option>
    <option value="place" <{if $review=='equ_id'}>selected<{/if}>><{$smarty.const._MD_KWDEVICE_EQU_DATE}></option>
    <option value="config" <{if $review=='equ_cate'}>selected<{/if}>><{$smarty.const._MD_KWDEVICE_EQU_CATE}></option>
    <option value="equ_isenable" <{if $review=='equ_isenable'}>selected<{/if}>><{$smarty.const._MD_KWDEVICE_EQU_ENABLE}></option>
</select> -->

</li>
</div>

    <{if $all_equ_content}>
        <div class="vtable" style="margin: 10px auto 20px;">
            <ul class="vhead">
                <!--設備排序-->
                <li class="w1 text-left">
                    <{$smarty.const._MD_KWDEVICE_EQU_SORT}><br>
                </li>
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
                    <{$smarty.const._MD_KWDEVICE_EQU_NUMBER}>/<br> <{$smarty.const._MD_KWDEVICE_EQU_AVALIABLE}>
                </li>                  
                <!--借用申請-->
                <li class="w1 text-left">
                    <{$smarty.const._MD_KWDEVICE_EQU_BOOK}>
                </li>
                
            </ul>
        </div>
            <{foreach from=$all_equ_content item=data}>
            <div class="vtable" style="margin: 10px auto 20px;">
                <ul id="tr_<{$data.equ_id}>">
                    <!--設備排序-->
                    <li class="vm w1"><{$data.equ_sort}>
                        <{if $iskwDeviceAdmin || $uid == $data.config_uid}>
                            <{if $data.equ_available == $data.equ_number}>
                            <a href="index.php?op=kw_device_update_equ_enable&equ_isenable=<{if $data.equ_isenable==1}>0<{else}>1<{/if}>&equ_id=<{$data.equ_id}>" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MD_KWDEVICE_CLICK_TO}>  <{if $data.equ_isenable==1}><{$smarty.const._MD_KWDEVICE_UNABLE}><{else}><{$smarty.const._MD_KWDEVICE_ENABLE}><{/if}>">
                            <{$data.equ_isenable_pic}>
                            </a>
                            <{/if}>
                        <{/if}>
                    </li>
                     <!--設備年度 編號-->
                     <li class="vm w1">
                         <{$data.equ_year}> /</br>
                             <{$data.equ_code}>
                     </li>

                    <!--設備類型 名稱-->
                    <li class="vm w2">
                        <span class="badge badge-info"><{$data.cate_id}></span>  
                        <{if $uid}>                       
                        <a href="admin.php?op=kw_device_book_form&equ_id=<{$data.equ_id}>"><{$data.equ_title}></a>
                        <{else}>
                            <{$data.equ_title}>
                        <{/if}>
                    </li>
                    <!--保管地點-->
                    <li class="vm w2">
                        <i class="fa fa-map-marker" aria-hidden="true" title="<{$smarty.const._MD_KWDEVICE_PLACE_ID}>"></i>
                        <{$data.place_id}> /
                        <i class="fa fa-user-circle-o" aria-hidden="true" title="<{$smarty.const._MD_KWDEVICE_CONFIG_ID}>"></i>
                        <{$data.config_id}>
                    </li>

                    <!--設備數量 可借數量-->
                    <li class="vm w1 text-center">
                        <span class="badge badge-secondary"><{$data.equ_number}></span>/
                       <{if $data.equ_available == 0 }>
                            <span class="circle" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWDEVICE_NUMBER_OF_APPLICANTS}> <{$data.equ_available}>"><{$smarty.const._MD_KWDEVICE_EQU_FULL}>
                                </span>
                        <{else}>
                            <span class="badge badge-primary"><{$data.equ_available}> </span>
                        <{/if}>
                        <br> ( <span class="badge badge-success"><{$data.equ_count}></span>)
                    </li>

                   <!--申請借用-->
                    <li class="vm w1 text-center">
                      <!--是否開放借用設定-->
                        <{if $data.equ_isenable == 1}>
                            <span class="badge badge-success"><{$smarty.const._MD_KWDEVICE_EQU_ENABLE}></span></br>
                                <{if $data.equ_available <= 0}>
                                <span class="badge badge-danger"> <{$smarty.const._MD_KWDEVICE_EQU_BLANK}></span>
                                <{else}>
                                    <{if $uid}>    
                                    <a href="admin.php?op=kw_device_book_form&equ_id=<{$data.equ_id}> " data-toggle="tooltip" data-placement="top">
                                        <span class="badge badge-primary"><{$smarty.const._MD_KWDEVICE_EQU_UNBLANK}></span></a>
                                    <{else}>
                                        <span class="badge badge-primary"><{$smarty.const._MD_KWDEVICE_EQU_UNBLANK}></span>
                                    <{/if}>
                                <{/if}>
                        <{else}>
                            <span class="badge badge-secondary"><{$smarty.const._MD_KWDEVICE_EQU_UNABLE}></span>
                        <{/if}>  
                        </br>
                          <!--設備管理-->
                          <{if $iskwDeviceAdmin || $uid==$data.config_uid}>
                              <a href="index.php?op=kw_device_equ_form&equ_id=<{$data.equ_id}>"
                                  class="btn btn-sm btn-warning">
                                  <{$smarty.const._TAD_EDIT}>
                              </a>
                              <{if $data.equ_available==$data.equ_number}>
                                  <!--無借用可刪-->
                                  <a href="javascript:delete_equ_func(<{$data.equ_id}>);" class="btn btn-sm btn-danger">
                                      <{$smarty.const._TAD_DEL}>
                                  </a>
                              <{/if}> 
                        <{/if}>
                    </li>
                </ul>
            </div>
            
               
            <{/foreach}>
        

    <{else}>
        <div class="alert alert-warning">
            <{$smarty.const._MD_KWDEVICE_EMPTY_EQU}><{$smarty.const._MD_KWDEVICE_NEED_CONFIG}>
        </div>
    <{/if}>

    <{$bar}>





