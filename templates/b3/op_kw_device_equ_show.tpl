<div class="container">
    <div class="row align-items-start">
      <div class="col">
        One of three columns
      </div>
      <div class="col">
        One of three columns
      </div>
      <div class="col">
        One of three columns
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col">
        One of three columns
      </div>
      <div class="col">
        One of three columns
      </div>
      <div class="col">
        One of three columns
      </div>
    </div>
    <div class="row align-items-end">
      <div class="col">
        One of three columns
      </div>
      <div class="col">
        One of three columns
      </div>
      <div class="col">
        One of three columns
      </div>
    </div>
  </div>


<h2 class="text-center">
    <span class="badge badge-info"><{$cate_id_title}></span>
    <{$class_title}>
    <!--是否開班-->
    <{if $iskwDeviceAdmin}>
        <span class="badge">
            <{if $class_ischecked=='1'}>
                <{$smarty.const._MD_KWDEVICE_EQU_ENABLE}>
            <{elseif $class_ischecked=='0'}>
                <{$smarty.const._MD_KWDEVICE_EQU_UNABLE}>
            <{else}>
                <{$smarty.const._MD_KWDEVICE_EQU_UNDONE}>
            <{/if}>
        </span>
    <{/if}>

    <p class="text-center" style="font-size: 0.6em; margin: 30px auto 5px; padding:20px; border-top: 1px dashed #5f8aca;">
        <a href="index.php?club_year=<{$club_year}>" class="club_year_text"><{$club_year}></a>
        <{$smarty.const._MD_KWDEVICE_APPLY_DATE}><{$smarty.const._TAD_FOR}><span style="color:rgb(190, 63, 4);"><{$smarty.session.club_start_date|date_format:"%Y/%m/%d %H:%M"}> ~ <{$smarty.session.club_end_date|date_format:"%Y/%m/%d %H:%M"}></span>
    </p>
</h2>

<div class="row" style="margin: 30px auto;">
   
    <div class="col-sm-6">
        <!--設備描述注意事項-->
         <!--設備使用注意事項-->
         <li class="vm w2"></li>
         <{if $data.equ_note or ($data.equ_available == 0 )}>
               <div style="font-size: 0.9em; color: rgb(151, 3, 107);">
                   <i class="fa fa-commenting" aria-hidden="true"></i>
                   <{$data.equ_note}>

                   
               </div>
           <{/if}>
       </li>
       
        <div class="card card-body bg-light m-1">
            <{$equ_desc}>
        </div>
    </div>
    <div class="col-sm-6">

        <!--開課教師-->
        <div class="row">
            <label class="col-sm-3 text-right">
                <{$smarty.const._MD_KWDEVICE_TEACHER_ID}>
            </label>
            <div class="col-sm-9">
                    <a href="index.php?op=teacher#<{$teacher_id}>"><{$teacher_id_title}></a>
            </div>
        </div>

        <!--上課地點-->
        <div class="row">
            <label class="col-sm-3 text-right">
                <{$smarty.const._MD_KWDEVICE_PLACE_ID}>
            </label>
            <div class="col-sm-9">
                <{$place_id_title}>
            </div>
        </div>

        <!--招收對象-->
        <div class="row">
            <label class="col-sm-3 text-right">
                <{$smarty.const._MD_KWDEVICE_EQU_GRADE}>
            </label>
            <div class="col-sm-9">
                <{$class_grade}>
            </div>
        </div>

        <!--上課日-->
        <div class="row">
            <label class="col-sm-3 text-right">
                <{$smarty.const._MD_KWDEVICE_EQU_DATE}>
            </label>
            <div class="col-sm-9">
                <span class="number_b">
                    <{$class_date_open|date_format:"%Y/%m/%d"}>
                </span>
                <{$smarty.const._MD_KWDEVICE_APPLY_FROM_TO}>
                <span class="number_b">
                    <{$class_date_close|date_format:"%Y/%m/%d"}>
                </span>
                <div>
                    <!--上課星期-->
                    <{$smarty.const._MD_KWDEVICE_W|sprintf:$class_week}>
                    <span class="number_o">
                        <{$class_time_start|date_format:"%H:%M"}>
                    </span>
                    <{$smarty.const._MD_KWDEVICE_APPLY_FROM_TO}>
                    <span class="number_o">
                        <{$class_time_end|date_format:"%H:%M"}>
                    </span>
                </div>
            </div>
        </div>


        <!--社團學費-->
        <div class="row">
            <label class="col-sm-3 text-right">
                <{$smarty.const._MD_KWDEVICE_EQU_MONEY}>
            </label>
            <div class="col-sm-9">
                <{$class_money}> <{$smarty.const._MD_KWDEVICE_DOLLAR}>
                <{if $class_fee}>
                    (<{$smarty.const._MD_KWDEVICE_EQU_FEE}> <{$class_fee}> <{$smarty.const._MD_KWDEVICE_DOLLAR}>)
                <{/if}>
            </div>
        </div>

        <!--招收人數-->
        <div class="row">
            <label class="col-sm-3 text-right">
                <{$smarty.const._MD_KWDEVICE_EQU_MENBER}>
            </label>
            <div class="col-sm-9">
                <{$class_member}> <{$smarty.const._MD_KWDEVICE_PEOPLE}>
            </div>
        </div>

        <!--報名人數-->
        <div class="row">
            <label class="col-sm-3 text-right">
                <{$smarty.const._MD_KWDEVICE_EQU_REGNUM}>
            </label>
            <div class="col-sm-9">
                <{$class_regnum}> <{$smarty.const._MD_KWDEVICE_PEOPLE}>
            </div>
        </div>

        <!--社團備註-->
        <{if $class_note}>
            <div class="row">
                <label class="col-sm-3 text-right">
                    <{$smarty.const._MD_KWDEVICE_EQU_NOTE}>
                </label>
                <div class="col-sm-9">
                    <{$class_note}>
                </div>
            </div>
        <{/if}>

    </div>
</div>


<div class="alert alert-info text-center">
    <{if $is_full}>
        <a href="#" class="btn btn-danger disabled"><i class="fa fa-user-plus" aria-hidden="true"></i>
            <{$smarty.const._MD_KWDEVICE_FULL_REGISTRATION}></a>
    <{elseif $class_regnum >= $class_member}>
        <a href="index.php?op=reg_form&class_id=<{$class_id}>&is_full=1" class="btn btn-warning"><i class="fa fa-user-plus" aria-hidden="true"></i>
            <{$smarty.const._MD_KWDEVICE_SIGNUP_TO_MAKE_UP}></a>
    <{elseif $chk_time}>
        <a href="index.php?op=reg_form&class_id=<{$class_id}>" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i>
            <{$smarty.const._MD_KWDEVICE_SIGNUP}></a>
    <{else}>
        <a href="#" class="btn btn-danger disabled"><i class="fa fa-user-plus" aria-hidden="true"></i>
            <{$smarty.const._MD_KWDEVICE_NON_REGISTRATION_TIME}></a>
    <{/if}>
</div>


<{if $iskwDeviceAdmin || $smarty.session.isclubUser }>
    <div class="alert alert-success text-center">
        <a href="club.php?club_year=<{$club_year}>" class="btn btn-primary" <{if !$can_operate}>data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWDEVICE_OVER_END_TIME}>" disabled<{/if}>>
            <i class="fa fa-plus" aria-hidden="true"></i>
            <{$smarty.const._MD_KWDEVICE_ADD_CLUB}>
        </a>
        <{if $iskwDeviceAdmin || $uid == $class_uid }>
            <{if $class_regnum == 0}>
                <a href="javascript:delete_class_func(<{$class_id}>);" class="btn btn-danger">
                    <i class="fa fa-trash" aria-hidden="true"></i><{$smarty.const._TAD_DEL}>
                </a>
            <{/if}>

            <a href="club.php?class_id=<{$class_id}>" class="btn btn-warning" <{if !$can_operate}>data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWDEVICE_OVER_END_TIME}>" disabled<{/if}>>
                <i class="fa fa-pencil-square" aria-hidden="true"></i>
                <{$smarty.const._MD_KWDEVICE_MODIFY_CLUB}>
            </a>

            <{if $iskwDeviceAdmin}>
                <a href="index.php?op=reg_form&class_id=<{$class_id}>" class="btn btn-success"><i class="fa fa-user-plus" aria-hidden="true"></i>
                <{$smarty.const._MD_KWDEVICE_SIGNUP_FOR_STU}></a>
            <{/if}>
        <{/if}>
    </div>
<{/if}>

<br>

<h3>
    <a href="index.php?club_year=<{$club_year}>" class="club_year_text"><{$club_year}></a>
    <span style="color:green"><{$class_title}></span>
    <{$smarty.const._MD_KWDEVICE_REGISTERED_LIST}>
    <small><{$smarty.const._MD_KWDEVICE_PAGEBAR_TOTAL|sprintf:$total}></small>
</h3>

<{includeq file="$xoops_rootpath/modules/kw_device/templates/sub_kw_device_reg_list_table.tpl"}>
