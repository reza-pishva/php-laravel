@extends('layouts.ansaldo_layouts.app_savabegh_insert')
@section('content')
<script>
    $(document).ready(function() {

        var eq_karkard1=0
        var karkard_mo3=0
        var karkard_mo2=0
        

        var bazsazi_sub_no=0
        var anbar_sub_no=0
        var karkard=0
        var karkard_mo=0
        var select_prog=0
        var id_t_bazsazi1=0
        var id_t_bazsazi2=0
        var program=0;
        var id_t_barnameh_tamirat=0
        var primary_or_secondary=1
        var radif1=0
        var radif2=0
        var radif3=0
        var select_program=0
        var button_type=0
        var select_history=0
        var id_s=0
        var sav_type=0
        var insert_type=0
        var id_g_global=0
        var id_e = 0
        var id_t_prev = 0
        var id_t1 = 0
        var id_t2 = 0
        var id_t3 = 0
        var id_sub = 0
        var id_sub1 = 0
        var id_sub2 = 0
        var id_sub3 = 0
        var type_sabegheh = 0
        var mizan_kharabi = 0
        var vaz_nasb=0
        var karkard=0
        var description=''
        var group1 =0
        var group2 =0
        var ghataat1 =[]
        var ghataat2 =[]
        var ghataat3 =[]
        var ghataat4 =0
        var ID_E_ARRAY=[]
        var ghataats=[]
        $("#DATE_BEGIN_SH_REP").persianDatepicker({
            format: 'YYYY/MM/DD'
         });
        $("#DATE_END_SH_REP").persianDatepicker({
            format: 'YYYY/MM/DD'
         });
        $("#DATE_BEGIN_BAZSAZI_REP").persianDatepicker({
            format: 'YYYY/MM/DD'
         });
        $("#DATE_END_BAZSAZI_REP").persianDatepicker({
            format: 'YYYY/MM/DD'
         });
        $("#DATE_BEGIN_ANBAR_REP").persianDatepicker({
            format: 'YYYY/MM/DD'
         });
        $("#DATE_END_ANBAR_REP").persianDatepicker({
            format: 'YYYY/MM/DD'
         });
        $("#DATE_BEGIN_BUY_REP").persianDatepicker({
            format: 'YYYY/MM/DD'
         });
        $("#DATE_END_BUY_REP").persianDatepicker({
            format: 'YYYY/MM/DD'
         });
        $("#DATE_BEGIN_EXX_REP").persianDatepicker({
            format: 'YYYY/MM/DD'
         });
        $("#DATE_END_EXX_REP").persianDatepicker({
            format: 'YYYY/MM/DD'
         });
        $("#vaz_nasb").bind('change', function () {
           var k=Number(eq_karkard1)+Number(karkard_mo3)-Number(karkard_mo2)
           if($("#vaz_nasb").val()>1 && $("#vaz_nasb").val()<4){
               $("#karkard").val(k)
           }else{
               $("#karkard").val(eq_karkard1)
           }
           k=0;
         });
        $(".select_group").on('click',function (event) {

            $("#table_history").empty();
            $("#tamirat_table_report2").empty();
            $("#update_historty").fadeOut(500)
            $("#delete_historty").fadeOut(500)
            select_program=0
            ghataat1=[];
            ghataat3=[];

            $('.ghataat2').prop('checked', false);
            $('.ghataat3').prop('checked', false);
            $('#mizan_kharabi').prop("disabled",true);
            $('#vaz_nasb').prop("disabled",true);
            $('#karkard').prop("disabled",true);
            $('#description').prop("disabled",true);
            $('#insert_historty').prop("disabled",true);
            $('#mizan_kharabi').val(0)
            $('#vaz_nasb').val(0)
            $('#karkard').val('')
            $('#description').val('')

            group1=$(this).closest('tr').find('td:eq(1)').text();
            group2=0;
            $("tr.table1").css("background-color", "white");
            $("tr.table1").css("color", "black");
            $(this).closest('tr.table1').css("background-color", "#2975cd");
            $(this).closest('tr.table1').css("color", "white");
            $("#table4").empty();
            var id_g = $(this).closest('tr').find('td:eq(1)').text();
            id_g_global = id_g;
            id_e = $(this).closest('tr').find('td:eq(4)').text();

            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: '/gh-gr/' + id_g,
                method: 'GET',
                beforeSend: function(){
                    $("#first_spinner").show();
                    $("#table2").hide();
                },
                success: function (response) {
                    $("#first_spinner").hide();
                    $("#table2").show();
                    $("#update_historty").fadeOut(500)
                    $("#delete_historty").fadeOut(500)
                    var row_count = 0
                    var select = 0
                    var row_count2 =''
                    var chk = ''
                    var t1 = ''
                    var ID_E = ''
                    var ID_E2 = ''
                    var SERIYAL_NUMBER = ''
                    var SERIAL_NUMBER2 = ''
                    var REAL_SOURE = ''
                    var MAKER = ''
                    var MAKER2 = ''
                    var ID_G = ''
                    var row = ''
                    var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td style="text-align: center;width:5%">#</td><td style="text-align: center">ردیف</td><td style="text-align: center">کد قطعه</td><td style="text-align: center">شماره سریال</td><td>کارکرد</td><td style="text-align: center">تعداد بازسازی</td><td style="text-align: center">اصالت قطعه</td><td style="text-align: center">شرکت سازنده</td></tr>')
                    $(".table_1").empty();
                    $(".table_1").append(th)
                    for (var i = 0; i < response.results.length; i++) {
                        row_count++;
                        select = $('<td><button type="button" class="btn-sm border-info select_group" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;height: 20px;padding-top:1px"><p>>></p></button></td>').on('click', function (event) {
                            
                            radif3 = $(this).closest('tr').find('td:eq(1)').text();
                            ghataat4=$(this).closest('tr').find('td:eq(2)').text();
                            select_program=1;
                            $("tr.table2").css("background-color", "white");
                            $("tr.table2").css("color", "black");
                            $(this).closest('tr.table2').css("background-color", "#66cc7c");
                            $(this).closest('tr.table2').css("color", "white");
                            id_e = $(this).closest('tr').find('td:eq(2)').text();
                            // radif1=id_e;
                            // radif2=id_e;
                            karkard = $(this).closest('tr').find('td:eq(4)').text();
                            eq_karkard1=$(this).closest('tr').find('td:eq(4)').text();
                            event.preventDefault();
                            $.ajaxSetup({
                                headers: {
                                    'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            var _token = $("input[name='_token']").val();
                            $.ajax({
                                url: '/get-history/' + id_e,
                                method: 'GET',
                                beforeSend: function(){
                                    $("#second_spinner").show();
                                    $("#table_history").hide();
                                },
                                success: function (response) {
                                    $("#update_historty").fadeOut(500)
                                    $("#delete_historty").fadeOut(500)
                                    $("#second_spinner").hide();
                                    $("#table_history").show();
                                    
                                    var radif=0
                                    var RADIF1=''
                                    var t1 = ''
                                    var t2 = ''
                                    var t3 = ''
                                    var edit = ''
                                    var select = ''
                                    var del = ''
                                    var day = ''
                                    var month = ''
                                    var year = ''
                                    var ID_S = ''
                                    var ID_SUB = ''
                                    var ID_T = ''
                                    var SAV_TYPE = ''
                                    var TIME_WORK = ''
                                    var DAMAGE_PERCENT = ''
                                    var DESCRIPTION = ''
                                    var PEYMANKAR = ''
                                    var TYPE_INSTAL = ''
                                    var TYPE_OP = ''
                                    var UNIT_NO = ''
                                    var DATE1 = ''
                                    var DATE2 = ''
                                    var row = ''
                                    var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td>#</td><td style="text-align: center">ردیف</td><td style="text-align: center">مکان قطعه</td><td style="text-align: center">نوع عملیات</td><td style="text-align: center">ساعت کارکرد</td><td style="text-align: center">تاریخ شروع</td><td style="text-align: center">تاریخ پایان</td><td style="text-align: center">وضعیت نصب</td><td style="text-align: center">میزان خرابی</td><td style="text-align: center">نام شرکت</td><td style="text-align: center">توضیحات</td><td>#</td></tr>')
                                    $("#table_history").empty();
                                    $("#table_history").append(th)
                                    for (var i = 0; i < response.results.length; i++) {
                                        radif=radif+1
                                        
                                        RADIF1 = $('<td style="text-align: center;font-family: Tahoma;font-size: x-small">' + radif + '</td>')
                                        ID_S = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['ID_S'] + '</td>')
                                        ID_T = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['ID_T'] + '</td>')
                                        SAV_TYPE = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['SAV_TYPE'] + '</td>')
                                        TIME_WORK = $('<td style="width:7%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TIME_WORK'] + '</td>')
                                        DAMAGE_PERCENT = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DAMAGE_PERCENT'] + '</td>')
                                        TYPE_INSTAL = $('<td style="width:10%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TYPE_INSTAL'] + '</td>')
                                        DESCRIPTION = $('<td style="width:50%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DISCRIPTION'] + '</td>')
                                        select = $('<button type="button" class="btn-sm border-info select_group" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;height: 20px;padding-top:1px"><p>>></p></button>').on('click', function (event) {
                                            $("tr.table3").css("background-color", "white");
                                            $("tr.table3").css("color", "black");
                                            $(this).closest('tr.table3').css("background-color", "#92282a");
                                            $(this).closest('tr.table3').css("color", "white");
                                            $('#id_s_edit').val($(this).closest('tr').find('td:eq(1)').text())
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سالم و تمیزکاری'){
                                                $('#mizan_kharabi_edit').val(1)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سبک'){
                                                $('#mizan_kharabi_edit').val(2)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='متوسط'){
                                                $('#mizan_kharabi_edit').val(3)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سنگین'){
                                                $('#mizan_kharabi_edit').val(4)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='مونتاژ'){
                                                $('#vaz_nasb_edit').val(1)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ'){
                                                $('#vaz_nasb_edit').val(2)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ و مونتاژ'){
                                                $('#vaz_nasb_edit').val(3)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='بدون تغییر'){
                                                $('#vaz_nasb_edit').val(4)
                                            }
                                            $('#karkard_edit').val($(this).closest('tr').find('td:eq(5)').text())
                                            $('#description_edit').val($(this).closest('tr').find('td:eq(11)').text())
                                            id_s=$(this).closest('tr').find('td:eq(1)').text()
                                            id_t1=$(this).closest('tr').find('td:eq(14)').text()
                                            id_t_prev=id_t1
                                            sav_type=$(this).closest('tr').find('td:eq(15)').text()
                                            id_sub=$(this).closest('tr').find('td:eq(16)').text()
                                            $('#id_t1_edit').val(id_t1)
                                            $('#barnameh_edit').val($(this).closest('tr').find('td:eq(4)').text())
                                            $("#update_historty").fadeIn()
                                            $("#delete_historty").fadeIn()
                                            $("#tamirat_table_report2").empty();

                                            $('#mizan_kharabi').prop("disabled",true);
                                            $('#vaz_nasb').prop("disabled",true);
                                            $('#karkard').prop("disabled",true);
                                            $('#description').prop("disabled",true);
                                            $('#insert_historty').prop("disabled",true);

                                            $('#mizan_kharabi').val(0)
                                            $('#vaz_nasb').val(0)
                                            $('#karkard').val('')
                                            $('#description').val('')

                                        })
                                        edit = $('<button type="button" class="btn-sm border-success edit1" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px" data-toggle="modal" data-target="#myModal4">ویرایش</button>').on('click', function () {
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'حقیقی') {
                                                $('#REAL_SOURE_EDIT').val('1')
                                            }
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'مجازی') {
                                                $('#REAL_SOURE_EDIT').val('2')
                                            }
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'ریجکت') {
                                                $('#REAL_SOURE_EDIT').val('3')
                                            }
                                            $('#ID_E_EDIT').val($(this).closest('tr').find('td:eq(0)').text())
                                            $('#ID_G_EDIT').val($(this).closest('tr').find('td:eq(5)').text())
                                            $('#SERIYAL_NUMBER_EDIT').val($(this).closest('tr').find('td:eq(1)').text())
                                            $('#SERIAL_NUMBER2_EDIT').val($(this).closest('tr').find('td:eq(2)').text())

                                            $('#MAKER_EDIT').val($(this).closest('tr').find('td:eq(6)').text())

                                        })
                                        del = $('<button hidden type="button" class="btn-sm del_send border-danger" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px">حذف</button>').attr('id', response.results[i]['ID_S'] + 3000).on('click', function () {
                                            var id_s = $(this).closest('tr').find('td:eq(1)').text();
                                            var token = $("meta[name='csrf-token']").attr("content");
                                            Swal.fire({
                                                title: 'مایل به حذف این این سابقه هستید؟',
                                                showDenyButton: true,
                                                cancelButtonText: `بازگشت`,
                                                confirmButtonText: `انصراف از حذف`,
                                                denyButtonText: 'حذف شود',
                                            }).then((result) => {
                                                if (result.isConfirmed) {

                                                    Swal.fire('سابقه انتخابی حذف نشد', '', 'info')
                                                } else if (result.isDenied) {

                                                    $.ajax({
                                                        url: "/history-delete/" + id_s,
                                                        type: 'DELETE',
                                                        data: {
                                                            "id": id_s,
                                                            "_token": token,
                                                        },
                                                        success: function (response) {
                                                            Swal.fire('حذف شد', '', 'success');
                                                            $('#' + (Number(id_s) + 3000)).closest('tr').remove();
                                                        }
                                                    });
                                                }
                                            })
                                        })
                                        t1 = $('<td style="width: 4%"></td>')
                                        t1.append(select)
                                        t2 = $('<td hidden style="width: 4%"></td>')
                                        t2.append(edit)
                                        t3 = $('<td style="width: 4%"></td>')
                                        t3.append(del)
                                        row = $('<tr class="table3"></tr>')
                                        var id_t = 0;
                                        var id_sub = 0;
                                        if(response.results[i]['SAV_TYPE']=='T'){

                                            for (var t = 0; t < response.tamir_prog.length; t++) {
                                                if(response.results[i]['ID_T']==response.tamir_prog[t]['ID_T']){
                                                    karkard_mo2=response.tamir_prog[t]['TIME_WORK_EQUAL'];
                                                    year = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(0, 4);
                                                    month = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(4, 2);
                                                    day = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    year = response.tamir_prog[t]['DATE_END_SH'].substr(0, 4);
                                                    month = response.tamir_prog[t]['DATE_END_SH'].substr(4, 2);
                                                    day = response.tamir_prog[t]['DATE_END_SH'].substr(6, 2);
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    ID_SUB = $('<td hidden style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    for (var g = 0; g < response.id_tts.length; g++) {
                                                        if(response.tamir_prog[t]['ID_TT']== response.id_tts[g]['ID_TT']){
                                                            TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tts[g]['TAMIRAT_TYPE'] + '</td>')
                                                        }
                                                    }
                                                    for (var r = 0; r < response.id_tas.length; r++) {
                                                        if(response.tamir_prog[t]['ID_TA']== response.id_tas[r]['ID_TA']){
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tas[r]['TAMIRKAR'] + '</td>')
                                                        }
                                                    }
                                                    for (var f = 0; f < response.id_uns.length; f++) {
                                                        if(response.tamir_prog[t]['ID_UN']== response.id_uns[f]['ID_UN']){
                                                            UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_uns[f]['UNIT_NUMBER'] + '</td>')
                                                        }
                                                    }
                                                }

                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)
                                        }
                                        if(response.results[i]['SAV_TYPE']=='A'){
                                            id_t = response.results[i]['ID_T']
                                            id_sub = response.results[i]['ID_SUB']
                                            if(id_sub == 0){
                                                for (var t = 0; t < response.anbar1.length; t++) {
                                                    if(response.results[i]['ID_T']==response.anbar1[t]['ID_T']){
                                                        year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if(response.anbar1[t]['DATE_SHAMSI']!='---'){
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }else{
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE)
                                                            $("#table_history").append(row)
                                                    }
                                                }
                                            }
                                            if(id_sub > 0){
                                                for (var t = 0; t < response.anbar1.length; t++) {
                                                    if (response.results[i]['ID_T'] == response.anbar1[t]['ID_T']) {
                                                        year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if (response.anbar1[t]['DATE_SHAMSI'] != '---') {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        } else {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                for (var t = 0; t < response.anbar2.length; t++) {
                                                    if(response.results[i]['ID_T']==response.anbar2[t]['ID_T'] && response.results[i]['ID_SUB']==response.anbar2[t]['ID_SUB']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.anbar2[t]['ID_SUB'] + '</td>')
                                                        year = response.anbar2[t]['DATE_SHAMSI2'].substr(0, 4);
                                                        month = response.anbar2[t]['DATE_SHAMSI2'].substr(4, 2);
                                                        day = response.anbar2[t]['DATE_SHAMSI2'].substr(6, 2);
                                                        if(response.anbar2[t]['DATE_SHAMSI2']!='---'){
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        }else{
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }
                                        }
                                        if(response.results[i]['SAV_TYPE']=='B'){
                                            id_t = response.results[i]['ID_T']
                                            id_sub = response.results[i]['ID_SUB']
                                            if(id_sub == 0){
                                                for (var t = 0; t < response.bazsazi1.length; t++) {
                                                    if(response.results[i]['ID_T']==response.bazsazi1[t]['ID_T']){
                                                        year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                        month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                        day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if(response.bazsazi1[t]['DATE_BEGIN1']!='---'){
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }else{
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                        row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                        $("#table_history").append(row)
                                                    }
                                                }
                                            }
                                            if(id_sub > 0){
                                                for (var t = 0; t < response.bazsazi1.length; t++) {
                                                    if (response.results[i]['ID_T'] == response.bazsazi1[t]['ID_T']) {
                                                        year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                        month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                        day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if (response.bazsazi1[t]['DATE_BEGIN1'] != '---') {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        } else {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                for (var t = 0; t < response.bazsazi2.length; t++) {
                                                    if(response.results[i]['ID_T']==response.bazsazi2[t]['ID_T'] && response.results[i]['ID_SUB']==response.bazsazi2[t]['ID_SUB']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.bazsazi2[t]['ID_SUB'] + '</td>')
                                                        year = response.bazsazi2[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.bazsazi2[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.bazsazi2[t]['DATE_SHAMSI'].substr(6, 2);
                                                        if(response.bazsazi2[t]['DATE_SHAMSI']!='---'){
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        }else{
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }
                                        }
                                        if(response.results[i]['SAV_TYPE']=='KH'){
                                            for (var t = 0; t < response.buy1.length; t++) {
                                                if(response.results[i]['ID_T']==response.buy1[t]['ID_T']){
                                                    ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">خرید</td>')
                                                    UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                    year = response.buy1[t]['DATE_SHAMSI'].substr(0, 4);
                                                    month = response.buy1[t]['DATE_SHAMSI'].substr(4, 2);
                                                    day = response.buy1[t]['DATE_SHAMSI'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                    for (var r = 0; r < response.id_se.length; r++) {
                                                        if(response.buy1[t]['ID_SE']== response.id_se[r]['ID_SE']){
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_se[r]['SELLER'] + '</td>')
                                                        }
                                                    }
                                                }
                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)

                                        }
                                        if(response.results[i]['SAV_TYPE']=='O'){
                                            for (var t = 0; t < response.eex.length; t++) {
                                                if(response.results[i]['ID_T']==response.eex[t]['ID_T']){
                                                    ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    year = response.eex[t]['DATE_SHAMSI'].substr(0, 4);
                                                    month = response.eex[t]['DATE_SHAMSI'].substr(4, 2);
                                                    day = response.eex[t]['DATE_SHAMSI'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                    TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج</td>')
                                                    UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                    PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.eex[t]['LOCATION_NAME'] + '</td>')
                                                }
                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)
                                        }


                                    }
                                }
                            })
                        })
                        row_count2 = $('<td style="width:5%;text-align: center;">' + row_count + '</td>')
                        ID_E = $('<td  style="width:10%;text-align: center;border-right:1px dotted black;font-size: 10px" class="ID_E">' + response.results[i]['ID_E'] + '</td>')
                        ID_E2 = $('<td style="width:12%;text-align: center;font-size: 10px;border-right:1px dotted black" class="ID_E">' + response.kar[i]+ '</td>')
                        ghataat1.push($(this).closest('tr').find('td:eq(1)').text());
                        ID_E_ARRAY.push(response.results[i]['ID_E']);
                        ID_G = $('<td  hidden style="text-align: center">' + response.results[i]['ID_G'] + '</td>')
                        SERIYAL_NUMBER = $('<td style="width: 12%;text-align: center;font-size: 10px;border-right:1px dotted black">' + response.results[i]['SERIYAL_NUMBER'] + '</td>')
                        SERIAL_NUMBER2 = $('<td style="width: 5%;text-align: center;font-size: 10px;border-right:1px dotted black">' + response.baz[i] + '</td>')

                        if (response.results[i]['REAL_SOURE']==0) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">--</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==1) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">اصلی</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==2) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">خرید ارزی</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==3) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">خرید داخل</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==4) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">ساخت داخل</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==5) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">امانی</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==6) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">نامشخص</td>')
                        }

                        for (var j = 0; j < response.SAZS.length; j++) {
                            if (response.SAZS[j]['ID_S'] == response.results[i]['MAKER']) {
                                MAKER = $('<td style="width: 30%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.SAZS[j]['SAZANDEH'] + '</td>');
                                MAKER2 = $('<td hidden>' + response.SAZS[j]['ID_S'] + '</td>')
                                break;
                            }
                        }
                        t1 = $('<td style="width: 4%"></td>')
                        t1.append(chk)
                        row = $('<tr class="table2"></tr>')
                        row.append(select,row_count2,ID_E,SERIYAL_NUMBER,ID_E2,SERIAL_NUMBER2, REAL_SOURE, MAKER,ID_G,MAKER2)
                        $(".table_1").append(row)
                    }

                }
            })
         })
        $("#final_insert").on('click',function (event) {
            // alert('RADIF1')
            // alert(radif1)
            // alert('RADIF2')
            // alert(radif2)
            select_program=0
            if(program==1){
                id_sub1=0;
                id_t1=id_t_bazsazi1;
            }
            if(program==2){
                id_t1=id_t_bazsazi1;
                id_sub1=id_t_bazsazi2;
                // id_t_bazsazi1=0;
                // id_t_bazsazi2=0;
            }
            if(insert_type==3){
                radif1=$("#radif_insert1").val()
                radif2=$("#radif_insert2").val()
            }
            if(insert_type!=0){
                $('.ghataat2').prop('checked', false);
            $('.ghataat3').prop('checked', false);
            mizan_kharabi=$('#mizan_kharabi').val()
            vaz_nasb=$('#vaz_nasb').val()
            karkard=$('#karkard').val()
            description=$('#description').val()
            if(mizan_kharabi>0 & vaz_nasb>0 & karkard>=0 & description.length<400){
                if(description ==''){
                    description='ندارد'
                }


                $.ajaxSetup({
                    headers: {
                        'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                var _token = $("input[name='_token']").val();
                $.ajax({
                    url: '/savabegh-insert/' + type_sabegheh +'/'+ mizan_kharabi+'/'+ vaz_nasb+'/'+ karkard+'/'+ description+'/'+ id_t1+'/'+id_sub1+'/'+id_g_global+'/'+insert_type+'/'+ghataat4+'/'+radif1+'/'+radif2+'/'+program+'/'+id_t_bazsazi1+'/'+id_t_bazsazi2,
                    method: 'GET',
                    beforeSend: function(){
                        $("#third_spinner").show();
                        $("#table_view").hide();
                    },
                    success: function (response) {
                        // alert('RADIF1')
                        // alert(radif1)
                        // alert('RADIF2')
                        // alert(radif2)
                        radif1=0
                        radif2=0
                        insert_type=0
                        $("#INSERT_TYPE").val(0)
                        $("#radif_insert1").val(0)
                        $("#radif_insert2").val(0)
                        $("#INSERT_TYPE_DIV").fadeOut(500);
                        $("#third_spinner").hide();
                        $("#table_view").show();
                        $('#myModal8').modal('hide');
                        if(response.insert_type==1){
                            if(response.reapeted_no){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'هشدار',
                                    text: 'برای قطعه با کد '+response.reapeted_no+'  این برنامه قبلا ثبت شده و امکان تخصیص مجدد این برنامه به این قطعه وجود ندارد',
                                })
                            }else{
                                Swal.fire('برای قطعه با کد '+response.id_e+' یک سابقه بر اساس برنامه انتخابی ایجاد گردید', '', 'info')
                            }
                        }
                        if(response.insert_type==2){
                            if(response.reapeted_no){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'هشدار',
                                    text: 'برای قطعه با کد '+response.reapeted_no+'  این برنامه قبلا ثبت شده و امکان تخصیص مجدد این برنامه به این قطعه وجود ندارد',
                                })
                            }else{
                                Swal.fire('برای تعداد  '+response.ghataat_count+'  قطعه از گروه انتخابی سابقه بر اساس برنامه مشخص شده ایجاد گردید', '', 'info')
                            }
                        }
                        var id_s = response.ID_S-response.ghataat_count
                        event.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        var _token = $("input[name='_token']").val();
                       
                        $.ajax({
                                url: '/get-history/' + id_e,
                                method: 'GET',
                                beforeSend: function(){
                                    $("#second_spinner").show();
                                    $("#table_history").hide();
                                },
                                success: function (response) {
                                    $("#update_historty").fadeOut(500)
                                    $("#delete_historty").fadeOut(500)
                                    $("#second_spinner").hide();
                                    $("#table_history").show();
                                    
                                    var radif=0
                                    var RADIF1=''
                                    var t1 = ''
                                    var t2 = ''
                                    var t3 = ''
                                    var edit = ''
                                    var select = ''
                                    var del = ''
                                    var day = ''
                                    var month = ''
                                    var year = ''
                                    var ID_S = ''
                                    var ID_SUB = ''
                                    var ID_T = ''
                                    var SAV_TYPE = ''
                                    var TIME_WORK = ''
                                    var DAMAGE_PERCENT = ''
                                    var DESCRIPTION = ''
                                    var PEYMANKAR = ''
                                    var TYPE_INSTAL = ''
                                    var TYPE_OP = ''
                                    var UNIT_NO = ''
                                    var DATE1 = ''
                                    var DATE2 = ''
                                    var row = ''
                                    var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td>#</td><td style="text-align: center">ردیف</td><td style="text-align: center">مکان قطعه</td><td style="text-align: center">نوع عملیات</td><td style="text-align: center">ساعت کارکرد</td><td style="text-align: center">تاریخ شروع</td><td style="text-align: center">تاریخ پایان</td><td style="text-align: center">وضعیت نصب</td><td style="text-align: center">میزان خرابی</td><td style="text-align: center">نام شرکت</td><td style="text-align: center">توضیحات</td><td>#</td></tr>')
                                    $("#table_history").empty();
                                    $("#table_history").append(th)
                                    for (var i = 0; i < response.results.length; i++) {
                                        radif=radif+1
                                        
                                        RADIF1 = $('<td style="text-align: center;font-family: Tahoma;font-size: x-small">' + radif + '</td>')
                                        ID_S = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['ID_S'] + '</td>')
                                        ID_T = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['ID_T'] + '</td>')
                                        SAV_TYPE = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['SAV_TYPE'] + '</td>')
                                        TIME_WORK = $('<td style="width:7%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TIME_WORK'] + '</td>')
                                        DAMAGE_PERCENT = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DAMAGE_PERCENT'] + '</td>')
                                        TYPE_INSTAL = $('<td style="width:10%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TYPE_INSTAL'] + '</td>')
                                        DESCRIPTION = $('<td style="width:50%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DISCRIPTION'] + '</td>')
                                        select = $('<button type="button" class="btn-sm border-info select_group" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;height: 20px;padding-top:1px"><p>>></p></button>').on('click', function (event) {
                                            $("tr.table3").css("background-color", "white");
                                            $("tr.table3").css("color", "black");
                                            $(this).closest('tr.table3').css("background-color", "#92282a");
                                            $(this).closest('tr.table3').css("color", "white");
                                            $('#id_s_edit').val($(this).closest('tr').find('td:eq(1)').text())
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سالم و تمیزکاری'){
                                                $('#mizan_kharabi_edit').val(1)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سبک'){
                                                $('#mizan_kharabi_edit').val(2)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='متوسط'){
                                                $('#mizan_kharabi_edit').val(3)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سنگین'){
                                                $('#mizan_kharabi_edit').val(4)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='مونتاژ'){
                                                $('#vaz_nasb_edit').val(1)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ'){
                                                $('#vaz_nasb_edit').val(2)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ و مونتاژ'){
                                                $('#vaz_nasb_edit').val(3)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='بدون تغییر'){
                                                $('#vaz_nasb_edit').val(4)
                                            }
                                            $('#karkard_edit').val($(this).closest('tr').find('td:eq(5)').text())
                                            $('#description_edit').val($(this).closest('tr').find('td:eq(11)').text())
                                            id_s=$(this).closest('tr').find('td:eq(1)').text()
                                            id_t1=$(this).closest('tr').find('td:eq(14)').text()
                                            id_t_prev=id_t1
                                            sav_type=$(this).closest('tr').find('td:eq(15)').text()
                                            id_sub=$(this).closest('tr').find('td:eq(16)').text()
                                            $('#id_t1_edit').val(id_t1)
                                            $('#barnameh_edit').val($(this).closest('tr').find('td:eq(4)').text())
                                            $("#update_historty").fadeIn()
                                            $("#delete_historty").fadeIn()
                                            $("#tamirat_table_report2").empty();

                                            $('#mizan_kharabi').prop("disabled",true);
                                            $('#vaz_nasb').prop("disabled",true);
                                            $('#karkard').prop("disabled",true);
                                            $('#description').prop("disabled",true);
                                            $('#insert_historty').prop("disabled",true);

                                            $('#mizan_kharabi').val(0)
                                            $('#vaz_nasb').val(0)
                                            $('#karkard').val('')
                                            $('#description').val('')

                                        })
                                        edit = $('<button type="button" class="btn-sm border-success edit1" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px" data-toggle="modal" data-target="#myModal4">ویرایش</button>').on('click', function () {
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'حقیقی') {
                                                $('#REAL_SOURE_EDIT').val('1')
                                            }
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'مجازی') {
                                                $('#REAL_SOURE_EDIT').val('2')
                                            }
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'ریجکت') {
                                                $('#REAL_SOURE_EDIT').val('3')
                                            }
                                            $('#ID_E_EDIT').val($(this).closest('tr').find('td:eq(0)').text())
                                            $('#ID_G_EDIT').val($(this).closest('tr').find('td:eq(5)').text())
                                            $('#SERIYAL_NUMBER_EDIT').val($(this).closest('tr').find('td:eq(1)').text())
                                            $('#SERIAL_NUMBER2_EDIT').val($(this).closest('tr').find('td:eq(2)').text())

                                            $('#MAKER_EDIT').val($(this).closest('tr').find('td:eq(6)').text())

                                        })
                                        del = $('<button hidden type="button" class="btn-sm del_send border-danger" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px">حذف</button>').attr('id', response.results[i]['ID_S'] + 3000).on('click', function () {
                                            var id_s = $(this).closest('tr').find('td:eq(1)').text();
                                            var token = $("meta[name='csrf-token']").attr("content");
                                            Swal.fire({
                                                title: 'مایل به حذف این این سابقه هستید؟',
                                                showDenyButton: true,
                                                cancelButtonText: `بازگشت`,
                                                confirmButtonText: `انصراف از حذف`,
                                                denyButtonText: 'حذف شود',
                                            }).then((result) => {
                                                if (result.isConfirmed) {

                                                    Swal.fire('سابقه انتخابی حذف نشد', '', 'info')
                                                } else if (result.isDenied) {

                                                    $.ajax({
                                                        url: "/history-delete/" + id_s,
                                                        type: 'DELETE',
                                                        data: {
                                                            "id": id_s,
                                                            "_token": token,
                                                        },
                                                        success: function (response) {
                                                            Swal.fire('حذف شد', '', 'success');
                                                            $('#' + (Number(id_s) + 3000)).closest('tr').remove();
                                                        }
                                                    });
                                                }
                                            })
                                        })
                                        t1 = $('<td style="width: 4%"></td>')
                                        t1.append(select)
                                        t2 = $('<td hidden style="width: 4%"></td>')
                                        t2.append(edit)
                                        t3 = $('<td style="width: 4%"></td>')
                                        t3.append(del)
                                        row = $('<tr class="table3"></tr>')
                                        var id_t = 0;
                                        var id_sub = 0;
                                        if(response.results[i]['SAV_TYPE']=='T'){

                                            for (var t = 0; t < response.tamir_prog.length; t++) {
                                                if(response.results[i]['ID_T']==response.tamir_prog[t]['ID_T']){
                                                    karkard_mo2=response.tamir_prog[t]['TIME_WORK_EQUAL'];
                                                    year = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(0, 4);
                                                    month = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(4, 2);
                                                    day = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    year = response.tamir_prog[t]['DATE_END_SH'].substr(0, 4);
                                                    month = response.tamir_prog[t]['DATE_END_SH'].substr(4, 2);
                                                    day = response.tamir_prog[t]['DATE_END_SH'].substr(6, 2);
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    ID_SUB = $('<td hidden style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    for (var g = 0; g < response.id_tts.length; g++) {
                                                        if(response.tamir_prog[t]['ID_TT']== response.id_tts[g]['ID_TT']){
                                                            TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tts[g]['TAMIRAT_TYPE'] + '</td>')
                                                        }
                                                    }
                                                    for (var r = 0; r < response.id_tas.length; r++) {
                                                        if(response.tamir_prog[t]['ID_TA']== response.id_tas[r]['ID_TA']){
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tas[r]['TAMIRKAR'] + '</td>')
                                                        }
                                                    }
                                                    for (var f = 0; f < response.id_uns.length; f++) {
                                                        if(response.tamir_prog[t]['ID_UN']== response.id_uns[f]['ID_UN']){
                                                            UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_uns[f]['UNIT_NUMBER'] + '</td>')
                                                        }
                                                    }
                                                }

                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)
                                        }
                                        if(response.results[i]['SAV_TYPE']=='A'){
                                            id_t = response.results[i]['ID_T']
                                            id_sub = response.results[i]['ID_SUB']
                                            if(id_sub == 0){
                                                for (var t = 0; t < response.anbar1.length; t++) {
                                                    if(response.results[i]['ID_T']==response.anbar1[t]['ID_T']){
                                                        year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if(response.anbar1[t]['DATE_SHAMSI']!='---'){
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }else{
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE)
                                                            $("#table_history").append(row)
                                                    }
                                                }
                                            }
                                            if(id_sub > 0){
                                                for (var t = 0; t < response.anbar1.length; t++) {
                                                    if (response.results[i]['ID_T'] == response.anbar1[t]['ID_T']) {
                                                        year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if (response.anbar1[t]['DATE_SHAMSI'] != '---') {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        } else {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                for (var t = 0; t < response.anbar2.length; t++) {
                                                    if(response.results[i]['ID_T']==response.anbar2[t]['ID_T'] && response.results[i]['ID_SUB']==response.anbar2[t]['ID_SUB']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.anbar2[t]['ID_SUB'] + '</td>')
                                                        year = response.anbar2[t]['DATE_SHAMSI2'].substr(0, 4);
                                                        month = response.anbar2[t]['DATE_SHAMSI2'].substr(4, 2);
                                                        day = response.anbar2[t]['DATE_SHAMSI2'].substr(6, 2);
                                                        if(response.anbar2[t]['DATE_SHAMSI2']!='---'){
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        }else{
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }
                                        }
                                        if(response.results[i]['SAV_TYPE']=='B'){
                                            id_t = response.results[i]['ID_T']
                                            id_sub = response.results[i]['ID_SUB']
                                            if(id_sub == 0){
                                                for (var t = 0; t < response.bazsazi1.length; t++) {
                                                    if(response.results[i]['ID_T']==response.bazsazi1[t]['ID_T']){
                                                        year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                        month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                        day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if(response.bazsazi1[t]['DATE_BEGIN1']!='---'){
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }else{
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                        row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                        $("#table_history").append(row)
                                                    }
                                                }
                                            }
                                            if(id_sub > 0){
                                                for (var t = 0; t < response.bazsazi1.length; t++) {
                                                    if (response.results[i]['ID_T'] == response.bazsazi1[t]['ID_T']) {
                                                        year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                        month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                        day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if (response.bazsazi1[t]['DATE_BEGIN1'] != '---') {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        } else {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                for (var t = 0; t < response.bazsazi2.length; t++) {
                                                    if(response.results[i]['ID_T']==response.bazsazi2[t]['ID_T'] && response.results[i]['ID_SUB']==response.bazsazi2[t]['ID_SUB']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.bazsazi2[t]['ID_SUB'] + '</td>')
                                                        year = response.bazsazi2[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.bazsazi2[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.bazsazi2[t]['DATE_SHAMSI'].substr(6, 2);
                                                        if(response.bazsazi2[t]['DATE_SHAMSI']!='---'){
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        }else{
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }
                                        }
                                        if(response.results[i]['SAV_TYPE']=='KH'){
                                            for (var t = 0; t < response.buy1.length; t++) {
                                                if(response.results[i]['ID_T']==response.buy1[t]['ID_T']){
                                                    ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">خرید</td>')
                                                    UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                    year = response.buy1[t]['DATE_SHAMSI'].substr(0, 4);
                                                    month = response.buy1[t]['DATE_SHAMSI'].substr(4, 2);
                                                    day = response.buy1[t]['DATE_SHAMSI'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                    for (var r = 0; r < response.id_se.length; r++) {
                                                        if(response.buy1[t]['ID_SE']== response.id_se[r]['ID_SE']){
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_se[r]['SELLER'] + '</td>')
                                                        }
                                                    }
                                                }
                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)

                                        }
                                        if(response.results[i]['SAV_TYPE']=='O'){
                                            for (var t = 0; t < response.eex.length; t++) {
                                                if(response.results[i]['ID_T']==response.eex[t]['ID_T']){
                                                    ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    year = response.eex[t]['DATE_SHAMSI'].substr(0, 4);
                                                    month = response.eex[t]['DATE_SHAMSI'].substr(4, 2);
                                                    day = response.eex[t]['DATE_SHAMSI'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                    TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج</td>')
                                                    UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                    PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.eex[t]['LOCATION_NAME'] + '</td>')
                                                }
                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)
                                        }


                                    }
                                }
                            })

            $.ajax({
                    url: '/gh-gr/' + id_g_global,
                    method: 'GET',
                    beforeSend: function(){
                        $("#first_spinner").show();
                        $("#table2").hide();
                    },
                    success: function (response) {
                        $("#first_spinner").hide();
                        $("#table2").show();
                        $("#update_historty").fadeOut(500)
                        $("#delete_historty").fadeOut(500)
                        var row_count = 0
                        var select = 0
                        var row_count2 =''
                        var chk = ''
                        var t1 = ''
                        var ID_E = ''
                        var ID_E2 = ''
                        var SERIYAL_NUMBER = ''
                        var SERIAL_NUMBER2 = ''
                        var REAL_SOURE = ''
                        var MAKER = ''
                        var MAKER2 = ''
                        var ID_G = ''
                        var row = ''
                        var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td style="text-align: center;width:5%">#</td><td style="text-align: center">ردیف</td><td style="text-align: center">کد قطعه</td><td style="text-align: center">شماره سریال</td><td>کارکرد</td><td style="text-align: center">تعداد بازسازی</td><td style="text-align: center">اصالت قطعه</td><td style="text-align: center">شرکت سازنده</td></tr>')
                        $(".table_1").empty();
                        $(".table_1").append(th)
                        for (var i = 0; i < response.results.length; i++) {
                            row_count++;
                            select = $('<td><button type="button" class="btn-sm border-info select_group" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;height: 20px;padding-top:1px"><p>>></p></button></td>').on('click', function (event) {
                                radif3 = $(this).closest('tr').find('td:eq(1)').text();
                                ghataat4=$(this).closest('tr').find('td:eq(2)').text();
                                select_program=1;
                                $("tr.table2").css("background-color", "white");
                                $("tr.table2").css("color", "black");
                                $(this).closest('tr.table2').css("background-color", "#66cc7c");
                                $(this).closest('tr.table2').css("color", "white");
                                id_e = $(this).closest('tr').find('td:eq(2)').text();
                                radif1=id_e;
                                radif2=id_e;
                                karkard = $(this).closest('tr').find('td:eq(4)').text();
                                eq_karkard1=$(this).closest('tr').find('td:eq(4)').text();
                                event.preventDefault();
                                $.ajaxSetup({
                                    headers: {
                                        'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                    }
                                });
                                var _token = $("input[name='_token']").val();
                                $.ajax({
                                    url: '/get-history/' + id_e,
                                    method: 'GET',
                                    beforeSend: function(){
                                        $("#second_spinner").show();
                                        $("#table_history").hide();
                                    },
                                    success: function (response) {
                                        $("#update_historty").fadeOut(500)
                                        $("#delete_historty").fadeOut(500)
                                        $("#second_spinner").hide();
                                        $("#table_history").show();
                                        
                                        var radif=0
                                        var RADIF1=''
                                        var t1 = ''
                                        var t2 = ''
                                        var t3 = ''
                                        var edit = ''
                                        var select = ''
                                        var del = ''
                                        var day = ''
                                        var month = ''
                                        var year = ''
                                        var ID_S = ''
                                        var ID_SUB = ''
                                        var ID_T = ''
                                        var SAV_TYPE = ''
                                        var TIME_WORK = ''
                                        var DAMAGE_PERCENT = ''
                                        var DESCRIPTION = ''
                                        var PEYMANKAR = ''
                                        var TYPE_INSTAL = ''
                                        var TYPE_OP = ''
                                        var UNIT_NO = ''
                                        var DATE1 = ''
                                        var DATE2 = ''
                                        var row = ''
                                        var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td>#</td><td style="text-align: center">ردیف</td><td style="text-align: center">مکان قطعه</td><td style="text-align: center">نوع عملیات</td><td style="text-align: center">ساعت کارکرد</td><td style="text-align: center">تاریخ شروع</td><td style="text-align: center">تاریخ پایان</td><td style="text-align: center">وضعیت نصب</td><td style="text-align: center">میزان خرابی</td><td style="text-align: center">نام شرکت</td><td style="text-align: center">توضیحات</td><td>#</td></tr>')
                                        $("#table_history").empty();
                                        $("#table_history").append(th)
                                        for (var i = 0; i < response.results.length; i++) {
                                            radif=radif+1
                                            
                                            RADIF1 = $('<td style="text-align: center;font-family: Tahoma;font-size: x-small">' + radif + '</td>')
                                            ID_S = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['ID_S'] + '</td>')
                                            ID_T = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['ID_T'] + '</td>')
                                            SAV_TYPE = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['SAV_TYPE'] + '</td>')
                                            TIME_WORK = $('<td style="width:7%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TIME_WORK'] + '</td>')
                                            DAMAGE_PERCENT = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DAMAGE_PERCENT'] + '</td>')
                                            TYPE_INSTAL = $('<td style="width:10%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TYPE_INSTAL'] + '</td>')
                                            DESCRIPTION = $('<td style="width:50%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DISCRIPTION'] + '</td>')
                                            select = $('<button type="button" class="btn-sm border-info select_group" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;height: 20px;padding-top:1px"><p>>></p></button>').on('click', function (event) {
                                                $("tr.table3").css("background-color", "white");
                                                $("tr.table3").css("color", "black");
                                                $(this).closest('tr.table3').css("background-color", "#92282a");
                                                $(this).closest('tr.table3').css("color", "white");
                                                $('#id_s_edit').val($(this).closest('tr').find('td:eq(1)').text())
                                                if($(this).closest('tr').find('td:eq(9)').text()=='سالم و تمیزکاری'){
                                                    $('#mizan_kharabi_edit').val(1)
                                                }
                                                if($(this).closest('tr').find('td:eq(9)').text()=='سبک'){
                                                    $('#mizan_kharabi_edit').val(2)
                                                }
                                                if($(this).closest('tr').find('td:eq(9)').text()=='متوسط'){
                                                    $('#mizan_kharabi_edit').val(3)
                                                }
                                                if($(this).closest('tr').find('td:eq(9)').text()=='سنگین'){
                                                    $('#mizan_kharabi_edit').val(4)
                                                }
                                                if($(this).closest('tr').find('td:eq(8)').text()=='مونتاژ'){
                                                    $('#vaz_nasb_edit').val(1)
                                                }
                                                if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ'){
                                                    $('#vaz_nasb_edit').val(2)
                                                }
                                                if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ و مونتاژ'){
                                                    $('#vaz_nasb_edit').val(3)
                                                }
                                                if($(this).closest('tr').find('td:eq(8)').text()=='بدون تغییر'){
                                                    $('#vaz_nasb_edit').val(4)
                                                }
                                                $('#karkard_edit').val($(this).closest('tr').find('td:eq(5)').text())
                                                $('#description_edit').val($(this).closest('tr').find('td:eq(11)').text())
                                                id_s=$(this).closest('tr').find('td:eq(1)').text()
                                                id_t1=$(this).closest('tr').find('td:eq(14)').text()
                                                id_t_prev=id_t1
                                                sav_type=$(this).closest('tr').find('td:eq(15)').text()
                                                id_sub=$(this).closest('tr').find('td:eq(16)').text()
                                                $('#id_t1_edit').val(id_t1)
                                                $('#barnameh_edit').val($(this).closest('tr').find('td:eq(4)').text())
                                                $("#update_historty").fadeIn()
                                                $("#delete_historty").fadeIn()
                                                $("#tamirat_table_report2").empty();

                                                $('#mizan_kharabi').prop("disabled",true);
                                                $('#vaz_nasb').prop("disabled",true);
                                                $('#karkard').prop("disabled",true);
                                                $('#description').prop("disabled",true);
                                                $('#insert_historty').prop("disabled",true);

                                                $('#mizan_kharabi').val(0)
                                                $('#vaz_nasb').val(0)
                                                $('#karkard').val('')
                                                $('#description').val('')

                                            })
                                            edit = $('<button type="button" class="btn-sm border-success edit1" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px" data-toggle="modal" data-target="#myModal4">ویرایش</button>').on('click', function () {
                                                if ($(this).closest('tr').find('td:eq(3)').text() == 'حقیقی') {
                                                    $('#REAL_SOURE_EDIT').val('1')
                                                }
                                                if ($(this).closest('tr').find('td:eq(3)').text() == 'مجازی') {
                                                    $('#REAL_SOURE_EDIT').val('2')
                                                }
                                                if ($(this).closest('tr').find('td:eq(3)').text() == 'ریجکت') {
                                                    $('#REAL_SOURE_EDIT').val('3')
                                                }
                                                $('#ID_E_EDIT').val($(this).closest('tr').find('td:eq(0)').text())
                                                $('#ID_G_EDIT').val($(this).closest('tr').find('td:eq(5)').text())
                                                $('#SERIYAL_NUMBER_EDIT').val($(this).closest('tr').find('td:eq(1)').text())
                                                $('#SERIAL_NUMBER2_EDIT').val($(this).closest('tr').find('td:eq(2)').text())

                                                $('#MAKER_EDIT').val($(this).closest('tr').find('td:eq(6)').text())

                                            })
                                            del = $('<button hidden type="button" class="btn-sm del_send border-danger" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px">حذف</button>').attr('id', response.results[i]['ID_S'] + 3000).on('click', function () {
                                                var id_s = $(this).closest('tr').find('td:eq(1)').text();
                                                var token = $("meta[name='csrf-token']").attr("content");
                                                Swal.fire({
                                                    title: 'مایل به حذف این این سابقه هستید؟',
                                                    showDenyButton: true,
                                                    cancelButtonText: `بازگشت`,
                                                    confirmButtonText: `انصراف از حذف`,
                                                    denyButtonText: 'حذف شود',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {

                                                        Swal.fire('سابقه انتخابی حذف نشد', '', 'info')
                                                    } else if (result.isDenied) {

                                                        $.ajax({
                                                            url: "/history-delete/" + id_s,
                                                            type: 'DELETE',
                                                            data: {
                                                                "id": id_s,
                                                                "_token": token,
                                                            },
                                                            success: function (response) {
                                                                Swal.fire('حذف شد', '', 'success');
                                                                $('#' + (Number(id_s) + 3000)).closest('tr').remove();
                                                            }
                                                        });
                                                    }
                                                })
                                            })
                                            t1 = $('<td style="width: 4%"></td>')
                                            t1.append(select)
                                            t2 = $('<td hidden style="width: 4%"></td>')
                                            t2.append(edit)
                                            t3 = $('<td style="width: 4%"></td>')
                                            t3.append(del)
                                            row = $('<tr class="table3"></tr>')
                                            var id_t = 0;
                                            var id_sub = 0;
                                            if(response.results[i]['SAV_TYPE']=='T'){

                                                for (var t = 0; t < response.tamir_prog.length; t++) {
                                                    if(response.results[i]['ID_T']==response.tamir_prog[t]['ID_T']){
                                                        karkard_mo2=response.tamir_prog[t]['TIME_WORK_EQUAL'];
                                                        year = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(0, 4);
                                                        month = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(4, 2);
                                                        day = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(6, 2);
                                                        DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        year = response.tamir_prog[t]['DATE_END_SH'].substr(0, 4);
                                                        month = response.tamir_prog[t]['DATE_END_SH'].substr(4, 2);
                                                        day = response.tamir_prog[t]['DATE_END_SH'].substr(6, 2);
                                                        DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        ID_SUB = $('<td hidden style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                        for (var g = 0; g < response.id_tts.length; g++) {
                                                            if(response.tamir_prog[t]['ID_TT']== response.id_tts[g]['ID_TT']){
                                                                TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tts[g]['TAMIRAT_TYPE'] + '</td>')
                                                            }
                                                        }
                                                        for (var r = 0; r < response.id_tas.length; r++) {
                                                            if(response.tamir_prog[t]['ID_TA']== response.id_tas[r]['ID_TA']){
                                                                PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tas[r]['TAMIRKAR'] + '</td>')
                                                            }
                                                        }
                                                        for (var f = 0; f < response.id_uns.length; f++) {
                                                            if(response.tamir_prog[t]['ID_UN']== response.id_uns[f]['ID_UN']){
                                                                UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_uns[f]['UNIT_NUMBER'] + '</td>')
                                                            }
                                                        }
                                                    }

                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }
                                            if(response.results[i]['SAV_TYPE']=='A'){
                                                id_t = response.results[i]['ID_T']
                                                id_sub = response.results[i]['ID_SUB']
                                                if(id_sub == 0){
                                                    for (var t = 0; t < response.anbar1.length; t++) {
                                                        if(response.results[i]['ID_T']==response.anbar1[t]['ID_T']){
                                                            year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                            month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                            day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                            TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                            UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                            if(response.anbar1[t]['DATE_SHAMSI']!='---'){
                                                                DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                                DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            }else{
                                                                DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                                DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            }
                                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE)
                                                                $("#table_history").append(row)
                                                        }
                                                    }
                                                }
                                                if(id_sub > 0){
                                                    for (var t = 0; t < response.anbar1.length; t++) {
                                                        if (response.results[i]['ID_T'] == response.anbar1[t]['ID_T']) {
                                                            year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                            month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                            day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                            TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                            UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                            if (response.anbar1[t]['DATE_SHAMSI'] != '---') {
                                                                DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            } else {
                                                                DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            }
                                                        }
                                                    }
                                                    for (var t = 0; t < response.anbar2.length; t++) {
                                                        if(response.results[i]['ID_T']==response.anbar2[t]['ID_T'] && response.results[i]['ID_SUB']==response.anbar2[t]['ID_SUB']){
                                                            ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.anbar2[t]['ID_SUB'] + '</td>')
                                                            year = response.anbar2[t]['DATE_SHAMSI2'].substr(0, 4);
                                                            month = response.anbar2[t]['DATE_SHAMSI2'].substr(4, 2);
                                                            day = response.anbar2[t]['DATE_SHAMSI2'].substr(6, 2);
                                                            if(response.anbar2[t]['DATE_SHAMSI2']!='---'){
                                                                DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            }else{
                                                                DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            }
                                                        }
                                                    }
                                                    row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                    $("#table_history").append(row)
                                                }
                                            }
                                            if(response.results[i]['SAV_TYPE']=='B'){
                                                id_t = response.results[i]['ID_T']
                                                id_sub = response.results[i]['ID_SUB']
                                                if(id_sub == 0){
                                                    for (var t = 0; t < response.bazsazi1.length; t++) {
                                                        if(response.results[i]['ID_T']==response.bazsazi1[t]['ID_T']){
                                                            year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                            month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                            day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                            TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                            UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                            if(response.bazsazi1[t]['DATE_BEGIN1']!='---'){
                                                                DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                                DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            }else{
                                                                DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                                DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            }
                                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                            $("#table_history").append(row)
                                                        }
                                                    }
                                                }
                                                if(id_sub > 0){
                                                    for (var t = 0; t < response.bazsazi1.length; t++) {
                                                        if (response.results[i]['ID_T'] == response.bazsazi1[t]['ID_T']) {
                                                            year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                            month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                            day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                            TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                            UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                            if (response.bazsazi1[t]['DATE_BEGIN1'] != '---') {
                                                                DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            } else {
                                                                DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            }
                                                        }
                                                    }
                                                    for (var t = 0; t < response.bazsazi2.length; t++) {
                                                        if(response.results[i]['ID_T']==response.bazsazi2[t]['ID_T'] && response.results[i]['ID_SUB']==response.bazsazi2[t]['ID_SUB']){
                                                            ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.bazsazi2[t]['ID_SUB'] + '</td>')
                                                            year = response.bazsazi2[t]['DATE_SHAMSI'].substr(0, 4);
                                                            month = response.bazsazi2[t]['DATE_SHAMSI'].substr(4, 2);
                                                            day = response.bazsazi2[t]['DATE_SHAMSI'].substr(6, 2);
                                                            if(response.bazsazi2[t]['DATE_SHAMSI']!='---'){
                                                                DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            }else{
                                                                DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            }
                                                        }
                                                    }
                                                    row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                    $("#table_history").append(row)
                                                }
                                            }
                                            if(response.results[i]['SAV_TYPE']=='KH'){
                                                for (var t = 0; t < response.buy1.length; t++) {
                                                    if(response.results[i]['ID_T']==response.buy1[t]['ID_T']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                        TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">خرید</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        year = response.buy1[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.buy1[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.buy1[t]['DATE_SHAMSI'].substr(6, 2);
                                                        DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        for (var r = 0; r < response.id_se.length; r++) {
                                                            if(response.buy1[t]['ID_SE']== response.id_se[r]['ID_SE']){
                                                                PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_se[r]['SELLER'] + '</td>')
                                                            }
                                                        }
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)

                                            }
                                            if(response.results[i]['SAV_TYPE']=='O'){
                                                for (var t = 0; t < response.eex.length; t++) {
                                                    if(response.results[i]['ID_T']==response.eex[t]['ID_T']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                        year = response.eex[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.eex[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.eex[t]['DATE_SHAMSI'].substr(6, 2);
                                                        DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.eex[t]['LOCATION_NAME'] + '</td>')
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }


                                        }
                                    }
                                })
                            })
                            row_count2 = $('<td style="width:5%;text-align: center;">' + row_count + '</td>')
                            ID_E = $('<td  style="width:10%;text-align: center;border-right:1px dotted black;font-size: 10px" class="ID_E">' + response.results[i]['ID_E'] + '</td>')
                            ID_E2 = $('<td style="width:12%;text-align: center;font-size: 10px;border-right:1px dotted black" class="ID_E">' + response.kar[i]+ '</td>')
                            ghataat1.push($(this).closest('tr').find('td:eq(1)').text());
                            ID_E_ARRAY.push(response.results[i]['ID_E']);
                            ID_G = $('<td  hidden style="text-align: center">' + response.results[i]['ID_G'] + '</td>')
                            SERIYAL_NUMBER = $('<td style="width: 12%;text-align: center;font-size: 10px;border-right:1px dotted black">' + response.results[i]['SERIYAL_NUMBER'] + '</td>')
                            SERIAL_NUMBER2 = $('<td style="width: 5%;text-align: center;font-size: 10px;border-right:1px dotted black">' + response.baz[i] + '</td>')

                            if (response.results[i]['REAL_SOURE']==0) {
                                REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">--</td>')
                            }
                            if (response.results[i]['REAL_SOURE']==1) {
                                REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">اصلی</td>')
                            }
                            if (response.results[i]['REAL_SOURE']==2) {
                                REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">خرید ارزی</td>')
                            }
                            if (response.results[i]['REAL_SOURE']==3) {
                                REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">خرید داخل</td>')
                            }
                            if (response.results[i]['REAL_SOURE']==4) {
                                REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">ساخت داخل</td>')
                            }
                            if (response.results[i]['REAL_SOURE']==5) {
                                REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">امانی</td>')
                            }
                            if (response.results[i]['REAL_SOURE']==6) {
                                REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">نامشخص</td>')
                            }

                            for (var j = 0; j < response.SAZS.length; j++) {
                                if (response.SAZS[j]['ID_S'] == response.results[i]['MAKER']) {
                                    MAKER = $('<td style="width: 30%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.SAZS[j]['SAZANDEH'] + '</td>');
                                    MAKER2 = $('<td hidden>' + response.SAZS[j]['ID_S'] + '</td>')
                                    break;
                                }
                            }
                            t1 = $('<td style="width: 4%"></td>')
                            t1.append(chk)
                            row = $('<tr class="table2"></tr>')
                            row.append(select,row_count2,ID_E,SERIYAL_NUMBER,ID_E2,SERIAL_NUMBER2, REAL_SOURE, MAKER,ID_G,MAKER2)
                            $(".table_1").append(row)
                        }

                    }
                })



                        }
                    })
                }else{
                    Swal.fire('اطلاعات در فرم سابقه بصورت ناقص پر شده', '', 'info')
                }
                }else{
                    Swal.fire( 'یکی از روشهای ایجاد سابقه انتخاب شود', '', 'info')
                }


            })
        $("#final_edit").on('click',function (event){   
            select_program=0
            if(description==''){
                description='ندارد'
            }
            // alert('mizan_kharabi')
            // alert(mizan_kharabi)
            // alert('vaz_nasb')
            // alert(vaz_nasb)
            // alert('karkard')
            // alert(karkard)
            // alert('description')
            // alert(description)
            // alert('sav_type')
            // alert(sav_type)
            // alert('id_t1')
            // alert(id_t1)
            // alert('id_t2')
            // alert(id_t2)
            // alert('id_t3')
            // alert(id_t3)
            // alert('id_s')
            // alert(id_s)
            // alert('id_sub')
            // alert(id_sub)
            // alert('id_t_bazsazi1')
            // alert(id_t_bazsazi1)
            // alert('id_t_bazsazi2')
            // alert(id_t_bazsazi2)
            // alert('id_g_global')
            // alert(id_g_global)
            // alert('insert_type')
            // alert(insert_type)










            if(insert_type==3){
                radif1=$("#radif_update1").val()
                radif2=$("#radif_update2").val()
            }else{
                radif1=0
                radif2=0
            }
            if(insert_type!=0){
                $.ajaxSetup({
                headers: {
                    'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: '/savabegh-update/' + sav_type +'/'+ mizan_kharabi+'/'+ vaz_nasb+'/'+ karkard+'/'+ description+'/'+insert_type+'/'+id_s+'/'+id_g_global+'/'+id_sub+'/'+id_t1+'/'+id_e+'/'+id_t_prev+'/'+radif1+'/'+radif2,
                method: 'GET' ,
                beforeSend: function(){
                    $("#forth_spinner").show();
                    $("#edit_div").hide();
                },
                success: function (response) {
                    radif1=0
                    radif2=0
                    insert_type=0
                    $("#INSERT_TYPE").val(0)
                    $("#radif_update1").val(0)
                    $("#radif_update2").val(0)
                    // $("#radif_update1").hide();
                    // $("#radif_update2").hide();
                    $("#forth_spinner").hide();
                    $("#UPDATE_TYPE_DIV").fadeOut(500);
                    $("#edit_div").show();
                    if(response.insert_type==1){
                        if(response.reapeted_no){
                            Swal.fire({
                                icon: 'error',
                                title: 'هشدار',
                                text: 'برای قطعه با کد '+response.reapeted_no+'  این برنامه قبلا ثبت شده و امکان تخصیص مجدد این برنامه به این قطعه وجود ندارد',
                            })
                        }else{
                            Swal.fire( 'این سابقه مربوط به قطعه انتخابی اصلاح گردید', '', 'info')
                            $('#myModal7').modal('hide');
                        }
                    }
                    if(response.insert_type==2){
                        if(response.reapeted_no){
                            Swal.fire({
                                icon: 'error',
                                title: 'هشدار',
                                text: 'برای قطعه با کد '+response.reapeted_no+'  این برنامه قبلا ثبت شده و امکان تخصیص مجدد این برنامه به این قطعه وجود ندارد',
                            })
                        }else{
                            Swal.fire('تغییرات در کلیه قطعات این گروه که دارای برنامه یکسان هستند اعمال گردید', '', 'info')
                            $('#myModal7').modal('hide');
                        }

                    }
                    if(response.insert_type==3){
                        if(response.reapeted_no){
                            Swal.fire({
                                icon: 'error',
                                title: 'هشدار',
                                text: 'برای قطعه با کد '+response.reapeted_no+'  این برنامه قبلا ثبت شده و امکان تخصیص مجدد این برنامه به این قطعه وجود ندارد',
                            })
                        }else{
                            Swal.fire('تغییرات در شماره ردیفهای انتخابی این گروه که دارای برنامه یکسان هستند اعمال گردید', '', 'info')
                            $('#myModal7').modal('hide');
                        }

                    }
                    $('#myModal7').modal('hide');

                    event.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    var _token = $("input[name='_token']").val();
                    $.ajax({
                                url: '/get-history/' + id_e,
                                method: 'GET',
                                beforeSend: function(){
                                    $("#second_spinner").show();
                                    $("#table_history").hide();
                                },
                                success: function (response) {
                                    $("#update_historty").fadeOut(500)
                                    $("#delete_historty").fadeOut(500)
                                    $("#second_spinner").hide();
                                    $("#table_history").show();
                                    
                                    var radif=0
                                    var RADIF1=''
                                    var t1 = ''
                                    var t2 = ''
                                    var t3 = ''
                                    var edit = ''
                                    var select = ''
                                    var del = ''
                                    var day = ''
                                    var month = ''
                                    var year = ''
                                    var ID_S = ''
                                    var ID_SUB = ''
                                    var ID_T = ''
                                    var SAV_TYPE = ''
                                    var TIME_WORK = ''
                                    var DAMAGE_PERCENT = ''
                                    var DESCRIPTION = ''
                                    var PEYMANKAR = ''
                                    var TYPE_INSTAL = ''
                                    var TYPE_OP = ''
                                    var UNIT_NO = ''
                                    var DATE1 = ''
                                    var DATE2 = ''
                                    var row = ''
                                    var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td>#</td><td style="text-align: center">ردیف</td><td style="text-align: center">مکان قطعه</td><td style="text-align: center">نوع عملیات</td><td style="text-align: center">ساعت کارکرد</td><td style="text-align: center">تاریخ شروع</td><td style="text-align: center">تاریخ پایان</td><td style="text-align: center">وضعیت نصب</td><td style="text-align: center">میزان خرابی</td><td style="text-align: center">نام شرکت</td><td style="text-align: center">توضیحات</td><td>#</td></tr>')
                                    $("#table_history").empty();
                                    $("#table_history").append(th)
                                    for (var i = 0; i < response.results.length; i++) {
                                        radif=radif+1
                                        
                                        RADIF1 = $('<td style="text-align: center;font-family: Tahoma;font-size: x-small">' + radif + '</td>')
                                        ID_S = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['ID_S'] + '</td>')
                                        ID_T = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['ID_T'] + '</td>')
                                        SAV_TYPE = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['SAV_TYPE'] + '</td>')
                                        TIME_WORK = $('<td style="width:7%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TIME_WORK'] + '</td>')
                                        DAMAGE_PERCENT = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DAMAGE_PERCENT'] + '</td>')
                                        TYPE_INSTAL = $('<td style="width:10%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TYPE_INSTAL'] + '</td>')
                                        DESCRIPTION = $('<td style="width:50%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DISCRIPTION'] + '</td>')
                                        select = $('<button type="button" class="btn-sm border-info select_group" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;height: 20px;padding-top:1px"><p>>></p></button>').on('click', function (event) {
                                            $("tr.table3").css("background-color", "white");
                                            $("tr.table3").css("color", "black");
                                            $(this).closest('tr.table3').css("background-color", "#92282a");
                                            $(this).closest('tr.table3').css("color", "white");
                                            $('#id_s_edit').val($(this).closest('tr').find('td:eq(1)').text())
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سالم و تمیزکاری'){
                                                $('#mizan_kharabi_edit').val(1)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سبک'){
                                                $('#mizan_kharabi_edit').val(2)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='متوسط'){
                                                $('#mizan_kharabi_edit').val(3)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سنگین'){
                                                $('#mizan_kharabi_edit').val(4)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='مونتاژ'){
                                                $('#vaz_nasb_edit').val(1)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ'){
                                                $('#vaz_nasb_edit').val(2)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ و مونتاژ'){
                                                $('#vaz_nasb_edit').val(3)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='بدون تغییر'){
                                                $('#vaz_nasb_edit').val(4)
                                            }
                                            $('#karkard_edit').val($(this).closest('tr').find('td:eq(5)').text())
                                            $('#description_edit').val($(this).closest('tr').find('td:eq(11)').text())
                                            id_s=$(this).closest('tr').find('td:eq(1)').text()
                                            id_t1=$(this).closest('tr').find('td:eq(14)').text()
                                            id_t_prev=id_t1
                                            sav_type=$(this).closest('tr').find('td:eq(15)').text()
                                            id_sub=$(this).closest('tr').find('td:eq(16)').text()
                                            $('#id_t1_edit').val(id_t1)
                                            $('#barnameh_edit').val($(this).closest('tr').find('td:eq(4)').text())
                                            $("#update_historty").fadeIn()
                                            $("#delete_historty").fadeIn()
                                            $("#tamirat_table_report2").empty();

                                            $('#mizan_kharabi').prop("disabled",true);
                                            $('#vaz_nasb').prop("disabled",true);
                                            $('#karkard').prop("disabled",true);
                                            $('#description').prop("disabled",true);
                                            $('#insert_historty').prop("disabled",true);

                                            $('#mizan_kharabi').val(0)
                                            $('#vaz_nasb').val(0)
                                            $('#karkard').val('')
                                            $('#description').val('')

                                        })
                                        edit = $('<button type="button" class="btn-sm border-success edit1" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px" data-toggle="modal" data-target="#myModal4">ویرایش</button>').on('click', function () {
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'حقیقی') {
                                                $('#REAL_SOURE_EDIT').val('1')
                                            }
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'مجازی') {
                                                $('#REAL_SOURE_EDIT').val('2')
                                            }
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'ریجکت') {
                                                $('#REAL_SOURE_EDIT').val('3')
                                            }
                                            $('#ID_E_EDIT').val($(this).closest('tr').find('td:eq(0)').text())
                                            $('#ID_G_EDIT').val($(this).closest('tr').find('td:eq(5)').text())
                                            $('#SERIYAL_NUMBER_EDIT').val($(this).closest('tr').find('td:eq(1)').text())
                                            $('#SERIAL_NUMBER2_EDIT').val($(this).closest('tr').find('td:eq(2)').text())

                                            $('#MAKER_EDIT').val($(this).closest('tr').find('td:eq(6)').text())

                                        })
                                        del = $('<button hidden type="button" class="btn-sm del_send border-danger" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px">حذف</button>').attr('id', response.results[i]['ID_S'] + 3000).on('click', function () {
                                            var id_s = $(this).closest('tr').find('td:eq(1)').text();
                                            var token = $("meta[name='csrf-token']").attr("content");
                                            Swal.fire({
                                                title: 'مایل به حذف این این سابقه هستید؟',
                                                showDenyButton: true,
                                                cancelButtonText: `بازگشت`,
                                                confirmButtonText: `انصراف از حذف`,
                                                denyButtonText: 'حذف شود',
                                            }).then((result) => {
                                                if (result.isConfirmed) {

                                                    Swal.fire('سابقه انتخابی حذف نشد', '', 'info')
                                                } else if (result.isDenied) {

                                                    $.ajax({
                                                        url: "/history-delete/" + id_s,
                                                        type: 'DELETE',
                                                        data: {
                                                            "id": id_s,
                                                            "_token": token,
                                                        },
                                                        success: function (response) {
                                                            Swal.fire('حذف شد', '', 'success');
                                                            $('#' + (Number(id_s) + 3000)).closest('tr').remove();
                                                        }
                                                    });
                                                }
                                            })
                                        })
                                        t1 = $('<td style="width: 4%"></td>')
                                        t1.append(select)
                                        t2 = $('<td hidden style="width: 4%"></td>')
                                        t2.append(edit)
                                        t3 = $('<td style="width: 4%"></td>')
                                        t3.append(del)
                                        row = $('<tr class="table3"></tr>')
                                        var id_t = 0;
                                        var id_sub = 0;
                                        if(response.results[i]['SAV_TYPE']=='T'){

                                            for (var t = 0; t < response.tamir_prog.length; t++) {
                                                if(response.results[i]['ID_T']==response.tamir_prog[t]['ID_T']){
                                                    karkard_mo2=response.tamir_prog[t]['TIME_WORK_EQUAL'];
                                                    year = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(0, 4);
                                                    month = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(4, 2);
                                                    day = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    year = response.tamir_prog[t]['DATE_END_SH'].substr(0, 4);
                                                    month = response.tamir_prog[t]['DATE_END_SH'].substr(4, 2);
                                                    day = response.tamir_prog[t]['DATE_END_SH'].substr(6, 2);
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    ID_SUB = $('<td hidden style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    for (var g = 0; g < response.id_tts.length; g++) {
                                                        if(response.tamir_prog[t]['ID_TT']== response.id_tts[g]['ID_TT']){
                                                            TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tts[g]['TAMIRAT_TYPE'] + '</td>')
                                                        }
                                                    }
                                                    for (var r = 0; r < response.id_tas.length; r++) {
                                                        if(response.tamir_prog[t]['ID_TA']== response.id_tas[r]['ID_TA']){
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tas[r]['TAMIRKAR'] + '</td>')
                                                        }
                                                    }
                                                    for (var f = 0; f < response.id_uns.length; f++) {
                                                        if(response.tamir_prog[t]['ID_UN']== response.id_uns[f]['ID_UN']){
                                                            UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_uns[f]['UNIT_NUMBER'] + '</td>')
                                                        }
                                                    }
                                                }

                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)
                                        }
                                        if(response.results[i]['SAV_TYPE']=='A'){
                                            id_t = response.results[i]['ID_T']
                                            id_sub = response.results[i]['ID_SUB']
                                            if(id_sub == 0){
                                                for (var t = 0; t < response.anbar1.length; t++) {
                                                    if(response.results[i]['ID_T']==response.anbar1[t]['ID_T']){
                                                        year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if(response.anbar1[t]['DATE_SHAMSI']!='---'){
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }else{
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE)
                                                            $("#table_history").append(row)
                                                    }
                                                }
                                            }
                                            if(id_sub > 0){
                                                for (var t = 0; t < response.anbar1.length; t++) {
                                                    if (response.results[i]['ID_T'] == response.anbar1[t]['ID_T']) {
                                                        year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if (response.anbar1[t]['DATE_SHAMSI'] != '---') {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        } else {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                for (var t = 0; t < response.anbar2.length; t++) {
                                                    if(response.results[i]['ID_T']==response.anbar2[t]['ID_T'] && response.results[i]['ID_SUB']==response.anbar2[t]['ID_SUB']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.anbar2[t]['ID_SUB'] + '</td>')
                                                        year = response.anbar2[t]['DATE_SHAMSI2'].substr(0, 4);
                                                        month = response.anbar2[t]['DATE_SHAMSI2'].substr(4, 2);
                                                        day = response.anbar2[t]['DATE_SHAMSI2'].substr(6, 2);
                                                        if(response.anbar2[t]['DATE_SHAMSI2']!='---'){
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        }else{
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }
                                        }
                                        if(response.results[i]['SAV_TYPE']=='B'){
                                            id_t = response.results[i]['ID_T']
                                            id_sub = response.results[i]['ID_SUB']
                                            if(id_sub == 0){
                                                for (var t = 0; t < response.bazsazi1.length; t++) {
                                                    if(response.results[i]['ID_T']==response.bazsazi1[t]['ID_T']){
                                                        year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                        month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                        day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if(response.bazsazi1[t]['DATE_BEGIN1']!='---'){
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }else{
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                        row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                        $("#table_history").append(row)
                                                    }
                                                }
                                            }
                                            if(id_sub > 0){
                                                for (var t = 0; t < response.bazsazi1.length; t++) {
                                                    if (response.results[i]['ID_T'] == response.bazsazi1[t]['ID_T']) {
                                                        year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                        month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                        day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if (response.bazsazi1[t]['DATE_BEGIN1'] != '---') {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        } else {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                for (var t = 0; t < response.bazsazi2.length; t++) {
                                                    if(response.results[i]['ID_T']==response.bazsazi2[t]['ID_T'] && response.results[i]['ID_SUB']==response.bazsazi2[t]['ID_SUB']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.bazsazi2[t]['ID_SUB'] + '</td>')
                                                        year = response.bazsazi2[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.bazsazi2[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.bazsazi2[t]['DATE_SHAMSI'].substr(6, 2);
                                                        if(response.bazsazi2[t]['DATE_SHAMSI']!='---'){
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        }else{
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }
                                        }
                                        if(response.results[i]['SAV_TYPE']=='KH'){
                                            for (var t = 0; t < response.buy1.length; t++) {
                                                if(response.results[i]['ID_T']==response.buy1[t]['ID_T']){
                                                    ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">خرید</td>')
                                                    UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                    year = response.buy1[t]['DATE_SHAMSI'].substr(0, 4);
                                                    month = response.buy1[t]['DATE_SHAMSI'].substr(4, 2);
                                                    day = response.buy1[t]['DATE_SHAMSI'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                    for (var r = 0; r < response.id_se.length; r++) {
                                                        if(response.buy1[t]['ID_SE']== response.id_se[r]['ID_SE']){
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_se[r]['SELLER'] + '</td>')
                                                        }
                                                    }
                                                }
                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)

                                        }
                                        if(response.results[i]['SAV_TYPE']=='O'){
                                            for (var t = 0; t < response.eex.length; t++) {
                                                if(response.results[i]['ID_T']==response.eex[t]['ID_T']){
                                                    ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    year = response.eex[t]['DATE_SHAMSI'].substr(0, 4);
                                                    month = response.eex[t]['DATE_SHAMSI'].substr(4, 2);
                                                    day = response.eex[t]['DATE_SHAMSI'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                    TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج</td>')
                                                    UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                    PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.eex[t]['LOCATION_NAME'] + '</td>')
                                                }
                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)
                                        }


                                    }
                                }
                            })

                }
            })
            }else{
                Swal.fire( 'یکی از روشهای ویرایش سابقه انتخاب شود', '', 'info')
            }
            mizan_kharabi=$('#mizan_kharabi_edit').val()
            vaz_nasb=$('#vaz_nasb_edit').val()
            karkard=$('#karkard_edit').val()
            description=$('#description_edit').val()


            $.ajax({
                url: '/gh-gr/' + id_g_global,
                method: 'GET',
                beforeSend: function(){
                    $("#first_spinner").show();
                    $("#table2").hide();
                },
                success: function (response) {
                    $("#first_spinner").hide();
                    $("#table2").show();
                    $("#update_historty").fadeOut(500)
                    $("#delete_historty").fadeOut(500)
                    var row_count = 0
                    var select = 0
                    var row_count2 =''
                    var chk = ''
                    var t1 = ''
                    var ID_E = ''
                    var ID_E2 = ''
                    var SERIYAL_NUMBER = ''
                    var SERIAL_NUMBER2 = ''
                    var REAL_SOURE = ''
                    var MAKER = ''
                    var MAKER2 = ''
                    var ID_G = ''
                    var row = ''
                    var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td style="text-align: center;width:5%">#</td><td style="text-align: center">ردیف</td><td style="text-align: center">کد قطعه</td><td style="text-align: center">شماره سریال</td><td>کارکرد</td><td style="text-align: center">تعداد بازسازی</td><td style="text-align: center">اصالت قطعه</td><td style="text-align: center">شرکت سازنده</td></tr>')
                    $(".table_1").empty();
                    $(".table_1").append(th)
                    for (var i = 0; i < response.results.length; i++) {
                        row_count++;
                        select = $('<td><button type="button" class="btn-sm border-info select_group" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;height: 20px;padding-top:1px"><p>>></p></button></td>').on('click', function (event) {
                            radif3 = $(this).closest('tr').find('td:eq(1)').text();
                            ghataat4=$(this).closest('tr').find('td:eq(2)').text();
                            select_program=1;
                            $("tr.table2").css("background-color", "white");
                            $("tr.table2").css("color", "black");
                            $(this).closest('tr.table2').css("background-color", "#66cc7c");
                            $(this).closest('tr.table2').css("color", "white");
                            id_e = $(this).closest('tr').find('td:eq(2)').text();
                            radif1=id_e;
                            radif2=id_e;
                            karkard = $(this).closest('tr').find('td:eq(4)').text();
                            eq_karkard1=$(this).closest('tr').find('td:eq(4)').text();
                            event.preventDefault();
                            $.ajaxSetup({
                                headers: {
                                    'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            var _token = $("input[name='_token']").val();
                            $.ajax({
                                url: '/get-history/' + id_e,
                                method: 'GET',
                                beforeSend: function(){
                                    $("#second_spinner").show();
                                    $("#table_history").hide();
                                },
                                success: function (response) {
                                    $("#update_historty").fadeOut(500)
                                    $("#delete_historty").fadeOut(500)
                                    $("#second_spinner").hide();
                                    $("#table_history").show();
                                    
                                    var radif=0
                                    var RADIF1=''
                                    var t1 = ''
                                    var t2 = ''
                                    var t3 = ''
                                    var edit = ''
                                    var select = ''
                                    var del = ''
                                    var day = ''
                                    var month = ''
                                    var year = ''
                                    var ID_S = ''
                                    var ID_SUB = ''
                                    var ID_T = ''
                                    var SAV_TYPE = ''
                                    var TIME_WORK = ''
                                    var DAMAGE_PERCENT = ''
                                    var DESCRIPTION = ''
                                    var PEYMANKAR = ''
                                    var TYPE_INSTAL = ''
                                    var TYPE_OP = ''
                                    var UNIT_NO = ''
                                    var DATE1 = ''
                                    var DATE2 = ''
                                    var row = ''
                                    var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td>#</td><td style="text-align: center">ردیف</td><td style="text-align: center">مکان قطعه</td><td style="text-align: center">نوع عملیات</td><td style="text-align: center">ساعت کارکرد</td><td style="text-align: center">تاریخ شروع</td><td style="text-align: center">تاریخ پایان</td><td style="text-align: center">وضعیت نصب</td><td style="text-align: center">میزان خرابی</td><td style="text-align: center">نام شرکت</td><td style="text-align: center">توضیحات</td><td>#</td></tr>')
                                    $("#table_history").empty();
                                    $("#table_history").append(th)
                                    for (var i = 0; i < response.results.length; i++) {
                                        radif=radif+1
                                        
                                        RADIF1 = $('<td style="text-align: center;font-family: Tahoma;font-size: x-small">' + radif + '</td>')
                                        ID_S = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['ID_S'] + '</td>')
                                        ID_T = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['ID_T'] + '</td>')
                                        SAV_TYPE = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['SAV_TYPE'] + '</td>')
                                        TIME_WORK = $('<td style="width:7%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TIME_WORK'] + '</td>')
                                        DAMAGE_PERCENT = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DAMAGE_PERCENT'] + '</td>')
                                        TYPE_INSTAL = $('<td style="width:10%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TYPE_INSTAL'] + '</td>')
                                        DESCRIPTION = $('<td style="width:50%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DISCRIPTION'] + '</td>')
                                        select = $('<button type="button" class="btn-sm border-info select_group" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;height: 20px;padding-top:1px"><p>>></p></button>').on('click', function (event) {
                                            $("tr.table3").css("background-color", "white");
                                            $("tr.table3").css("color", "black");
                                            $(this).closest('tr.table3').css("background-color", "#92282a");
                                            $(this).closest('tr.table3').css("color", "white");
                                            $('#id_s_edit').val($(this).closest('tr').find('td:eq(1)').text())
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سالم و تمیزکاری'){
                                                $('#mizan_kharabi_edit').val(1)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سبک'){
                                                $('#mizan_kharabi_edit').val(2)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='متوسط'){
                                                $('#mizan_kharabi_edit').val(3)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سنگین'){
                                                $('#mizan_kharabi_edit').val(4)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='مونتاژ'){
                                                $('#vaz_nasb_edit').val(1)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ'){
                                                $('#vaz_nasb_edit').val(2)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ و مونتاژ'){
                                                $('#vaz_nasb_edit').val(3)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='بدون تغییر'){
                                                $('#vaz_nasb_edit').val(4)
                                            }
                                            $('#karkard_edit').val($(this).closest('tr').find('td:eq(5)').text())
                                            $('#description_edit').val($(this).closest('tr').find('td:eq(11)').text())
                                            id_s=$(this).closest('tr').find('td:eq(1)').text()
                                            id_t1=$(this).closest('tr').find('td:eq(14)').text()
                                            id_t_prev=id_t1
                                            sav_type=$(this).closest('tr').find('td:eq(15)').text()
                                            id_sub=$(this).closest('tr').find('td:eq(16)').text()
                                            $('#id_t1_edit').val(id_t1)
                                            $('#barnameh_edit').val($(this).closest('tr').find('td:eq(4)').text())
                                            $("#update_historty").fadeIn()
                                            $("#delete_historty").fadeIn()
                                            $("#tamirat_table_report2").empty();

                                            $('#mizan_kharabi').prop("disabled",true);
                                            $('#vaz_nasb').prop("disabled",true);
                                            $('#karkard').prop("disabled",true);
                                            $('#description').prop("disabled",true);
                                            $('#insert_historty').prop("disabled",true);

                                            $('#mizan_kharabi').val(0)
                                            $('#vaz_nasb').val(0)
                                            $('#karkard').val('')
                                            $('#description').val('')

                                        })
                                        edit = $('<button type="button" class="btn-sm border-success edit1" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px" data-toggle="modal" data-target="#myModal4">ویرایش</button>').on('click', function () {
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'حقیقی') {
                                                $('#REAL_SOURE_EDIT').val('1')
                                            }
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'مجازی') {
                                                $('#REAL_SOURE_EDIT').val('2')
                                            }
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'ریجکت') {
                                                $('#REAL_SOURE_EDIT').val('3')
                                            }
                                            $('#ID_E_EDIT').val($(this).closest('tr').find('td:eq(0)').text())
                                            $('#ID_G_EDIT').val($(this).closest('tr').find('td:eq(5)').text())
                                            $('#SERIYAL_NUMBER_EDIT').val($(this).closest('tr').find('td:eq(1)').text())
                                            $('#SERIAL_NUMBER2_EDIT').val($(this).closest('tr').find('td:eq(2)').text())

                                            $('#MAKER_EDIT').val($(this).closest('tr').find('td:eq(6)').text())

                                        })
                                        del = $('<button hidden type="button" class="btn-sm del_send border-danger" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px">حذف</button>').attr('id', response.results[i]['ID_S'] + 3000).on('click', function () {
                                            var id_s = $(this).closest('tr').find('td:eq(1)').text();
                                            var token = $("meta[name='csrf-token']").attr("content");
                                            Swal.fire({
                                                title: 'مایل به حذف این این سابقه هستید؟',
                                                showDenyButton: true,
                                                cancelButtonText: `بازگشت`,
                                                confirmButtonText: `انصراف از حذف`,
                                                denyButtonText: 'حذف شود',
                                            }).then((result) => {
                                                if (result.isConfirmed) {

                                                    Swal.fire('سابقه انتخابی حذف نشد', '', 'info')
                                                } else if (result.isDenied) {

                                                    $.ajax({
                                                        url: "/history-delete/" + id_s,
                                                        type: 'DELETE',
                                                        data: {
                                                            "id": id_s,
                                                            "_token": token,
                                                        },
                                                        success: function (response) {
                                                            Swal.fire('حذف شد', '', 'success');
                                                            $('#' + (Number(id_s) + 3000)).closest('tr').remove();
                                                        }
                                                    });
                                                }
                                            })
                                        })
                                        t1 = $('<td style="width: 4%"></td>')
                                        t1.append(select)
                                        t2 = $('<td hidden style="width: 4%"></td>')
                                        t2.append(edit)
                                        t3 = $('<td style="width: 4%"></td>')
                                        t3.append(del)
                                        row = $('<tr class="table3"></tr>')
                                        var id_t = 0;
                                        var id_sub = 0;
                                        if(response.results[i]['SAV_TYPE']=='T'){

                                            for (var t = 0; t < response.tamir_prog.length; t++) {
                                                if(response.results[i]['ID_T']==response.tamir_prog[t]['ID_T']){
                                                    karkard_mo2=response.tamir_prog[t]['TIME_WORK_EQUAL'];
                                                    year = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(0, 4);
                                                    month = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(4, 2);
                                                    day = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    year = response.tamir_prog[t]['DATE_END_SH'].substr(0, 4);
                                                    month = response.tamir_prog[t]['DATE_END_SH'].substr(4, 2);
                                                    day = response.tamir_prog[t]['DATE_END_SH'].substr(6, 2);
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    ID_SUB = $('<td hidden style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    for (var g = 0; g < response.id_tts.length; g++) {
                                                        if(response.tamir_prog[t]['ID_TT']== response.id_tts[g]['ID_TT']){
                                                            TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tts[g]['TAMIRAT_TYPE'] + '</td>')
                                                        }
                                                    }
                                                    for (var r = 0; r < response.id_tas.length; r++) {
                                                        if(response.tamir_prog[t]['ID_TA']== response.id_tas[r]['ID_TA']){
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tas[r]['TAMIRKAR'] + '</td>')
                                                        }
                                                    }
                                                    for (var f = 0; f < response.id_uns.length; f++) {
                                                        if(response.tamir_prog[t]['ID_UN']== response.id_uns[f]['ID_UN']){
                                                            UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_uns[f]['UNIT_NUMBER'] + '</td>')
                                                        }
                                                    }
                                                }

                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)
                                        }
                                        if(response.results[i]['SAV_TYPE']=='A'){
                                            id_t = response.results[i]['ID_T']
                                            id_sub = response.results[i]['ID_SUB']
                                            if(id_sub == 0){
                                                for (var t = 0; t < response.anbar1.length; t++) {
                                                    if(response.results[i]['ID_T']==response.anbar1[t]['ID_T']){
                                                        year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if(response.anbar1[t]['DATE_SHAMSI']!='---'){
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }else{
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE)
                                                            $("#table_history").append(row)
                                                    }
                                                }
                                            }
                                            if(id_sub > 0){
                                                for (var t = 0; t < response.anbar1.length; t++) {
                                                    if (response.results[i]['ID_T'] == response.anbar1[t]['ID_T']) {
                                                        year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if (response.anbar1[t]['DATE_SHAMSI'] != '---') {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        } else {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                for (var t = 0; t < response.anbar2.length; t++) {
                                                    if(response.results[i]['ID_T']==response.anbar2[t]['ID_T'] && response.results[i]['ID_SUB']==response.anbar2[t]['ID_SUB']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.anbar2[t]['ID_SUB'] + '</td>')
                                                        year = response.anbar2[t]['DATE_SHAMSI2'].substr(0, 4);
                                                        month = response.anbar2[t]['DATE_SHAMSI2'].substr(4, 2);
                                                        day = response.anbar2[t]['DATE_SHAMSI2'].substr(6, 2);
                                                        if(response.anbar2[t]['DATE_SHAMSI2']!='---'){
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        }else{
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }
                                        }
                                        if(response.results[i]['SAV_TYPE']=='B'){
                                            id_t = response.results[i]['ID_T']
                                            id_sub = response.results[i]['ID_SUB']
                                            if(id_sub == 0){
                                                for (var t = 0; t < response.bazsazi1.length; t++) {
                                                    if(response.results[i]['ID_T']==response.bazsazi1[t]['ID_T']){
                                                        year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                        month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                        day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if(response.bazsazi1[t]['DATE_BEGIN1']!='---'){
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }else{
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                        row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                        $("#table_history").append(row)
                                                    }
                                                }
                                            }
                                            if(id_sub > 0){
                                                for (var t = 0; t < response.bazsazi1.length; t++) {
                                                    if (response.results[i]['ID_T'] == response.bazsazi1[t]['ID_T']) {
                                                        year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                        month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                        day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if (response.bazsazi1[t]['DATE_BEGIN1'] != '---') {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        } else {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                for (var t = 0; t < response.bazsazi2.length; t++) {
                                                    if(response.results[i]['ID_T']==response.bazsazi2[t]['ID_T'] && response.results[i]['ID_SUB']==response.bazsazi2[t]['ID_SUB']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.bazsazi2[t]['ID_SUB'] + '</td>')
                                                        year = response.bazsazi2[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.bazsazi2[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.bazsazi2[t]['DATE_SHAMSI'].substr(6, 2);
                                                        if(response.bazsazi2[t]['DATE_SHAMSI']!='---'){
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        }else{
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }
                                        }
                                        if(response.results[i]['SAV_TYPE']=='KH'){
                                            for (var t = 0; t < response.buy1.length; t++) {
                                                if(response.results[i]['ID_T']==response.buy1[t]['ID_T']){
                                                    ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">خرید</td>')
                                                    UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                    year = response.buy1[t]['DATE_SHAMSI'].substr(0, 4);
                                                    month = response.buy1[t]['DATE_SHAMSI'].substr(4, 2);
                                                    day = response.buy1[t]['DATE_SHAMSI'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                    for (var r = 0; r < response.id_se.length; r++) {
                                                        if(response.buy1[t]['ID_SE']== response.id_se[r]['ID_SE']){
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_se[r]['SELLER'] + '</td>')
                                                        }
                                                    }
                                                }
                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)

                                        }
                                        if(response.results[i]['SAV_TYPE']=='O'){
                                            for (var t = 0; t < response.eex.length; t++) {
                                                if(response.results[i]['ID_T']==response.eex[t]['ID_T']){
                                                    ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    year = response.eex[t]['DATE_SHAMSI'].substr(0, 4);
                                                    month = response.eex[t]['DATE_SHAMSI'].substr(4, 2);
                                                    day = response.eex[t]['DATE_SHAMSI'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                    TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج</td>')
                                                    UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                    PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.eex[t]['LOCATION_NAME'] + '</td>')
                                                }
                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)
                                        }


                                    }
                                }
                            })
                        })
                        row_count2 = $('<td style="width:5%;text-align: center;">' + row_count + '</td>')
                        ID_E = $('<td  style="width:10%;text-align: center;border-right:1px dotted black;font-size: 10px" class="ID_E">' + response.results[i]['ID_E'] + '</td>')
                        ID_E2 = $('<td style="width:12%;text-align: center;font-size: 10px;border-right:1px dotted black" class="ID_E">' + response.kar[i]+ '</td>')
                        ghataat1.push($(this).closest('tr').find('td:eq(1)').text());
                        ID_E_ARRAY.push(response.results[i]['ID_E']);
                        ID_G = $('<td  hidden style="text-align: center">' + response.results[i]['ID_G'] + '</td>')
                        SERIYAL_NUMBER = $('<td style="width: 12%;text-align: center;font-size: 10px;border-right:1px dotted black">' + response.results[i]['SERIYAL_NUMBER'] + '</td>')
                        SERIAL_NUMBER2 = $('<td style="width: 5%;text-align: center;font-size: 10px;border-right:1px dotted black">' + response.baz[i] + '</td>')

                        if (response.results[i]['REAL_SOURE']==0) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">--</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==1) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">اصلی</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==2) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">خرید ارزی</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==3) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">خرید داخل</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==4) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">ساخت داخل</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==5) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">امانی</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==6) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">نامشخص</td>')
                        }

                        for (var j = 0; j < response.SAZS.length; j++) {
                            if (response.SAZS[j]['ID_S'] == response.results[i]['MAKER']) {
                                MAKER = $('<td style="width: 30%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.SAZS[j]['SAZANDEH'] + '</td>');
                                MAKER2 = $('<td hidden>' + response.SAZS[j]['ID_S'] + '</td>')
                                break;
                            }
                        }
                        t1 = $('<td style="width: 4%"></td>')
                        t1.append(chk)
                        row = $('<tr class="table2"></tr>')
                        row.append(select,row_count2,ID_E,SERIYAL_NUMBER,ID_E2,SERIAL_NUMBER2, REAL_SOURE, MAKER,ID_G,MAKER2)
                        $(".table_1").append(row)
                    }

                }
            })


         })
        $("#final_delete").on('click',function (event){
            select_program=0
            if(insert_type==3){
                radif1=$("#radif_update3").val()
                radif2=$("#radif_update4").val()
            }
            if(insert_type!=0){
                mizan_kharabi = 0
            vaz_nasb = 0
            karkard = 0
            description = 0
            Swal.fire({
                                                title: 'مایل به حذف این این سابقه هستید؟',
                                                showDenyButton: true,
                                                cancelButtonText: `بازگشت`,
                                                confirmButtonText: `انصراف از حذف`,
                                                denyButtonText: 'حذف شود',
                                            }).then((result) => {
                                                if (result.isConfirmed) {

                                                    Swal.fire('سابقه انتخابی حذف نشد', '', 'info')
                                                } else if (result.isDenied) {

                                                    $.ajaxSetup({
                headers: {
                    'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: '/savabegh-delete/' + sav_type +'/'+ mizan_kharabi+'/'+ vaz_nasb+'/'+ karkard+'/'+ description+'/'+id_t1+'/'+id_sub+'/'+id_g_global+'/'+insert_type+'/'+id_s+'/'+id_t2+'/'+id_t3+'/'+ghataat4+'/'+radif1+'/'+radif2+'/'+id_t_bazsazi1+'/'+id_t_bazsazi2+'/'+radif3,
                method: 'GET' ,
                beforeSend: function(){
                    $("#forth_spinner").show();
                    $("#delete_div").hide();
                },
                success: function (response) {
                    $("#DELETE_TYPE").val(0)
                    $("#radif_update3").val(0)
                    $("#radif_update4").val(0)
                    $("#DELETE_TYPE_DIV").fadeOut(500);

                    $("#forth_spinner").hide();
                    Swal.fire('عمل حذف سوابق انتخابی انجام شد', '', 'info')
                    $('#myModal13').modal('hide');
                    event.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    var _token = $("input[name='_token']").val();
                    $.ajax({
                                url: '/get-history/' + id_e,
                                method: 'GET',
                                beforeSend: function(){
                                    $("#second_spinner").show();
                                    $("#table_history").hide();
                                },
                                success: function (response) {
                                    $("#update_historty").fadeOut(500)
                                    $("#delete_historty").fadeOut(500)
                                    $("#second_spinner").hide();
                                    $("#table_history").show();
                                    
                                    var radif=0
                                    var RADIF1=''
                                    var t1 = ''
                                    var t2 = ''
                                    var t3 = ''
                                    var edit = ''
                                    var select = ''
                                    var del = ''
                                    var day = ''
                                    var month = ''
                                    var year = ''
                                    var ID_S = ''
                                    var ID_SUB = ''
                                    var ID_T = ''
                                    var SAV_TYPE = ''
                                    var TIME_WORK = ''
                                    var DAMAGE_PERCENT = ''
                                    var DESCRIPTION = ''
                                    var PEYMANKAR = ''
                                    var TYPE_INSTAL = ''
                                    var TYPE_OP = ''
                                    var UNIT_NO = ''
                                    var DATE1 = ''
                                    var DATE2 = ''
                                    var row = ''
                                    var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td>#</td><td style="text-align: center">ردیف</td><td style="text-align: center">مکان قطعه</td><td style="text-align: center">نوع عملیات</td><td style="text-align: center">ساعت کارکرد</td><td style="text-align: center">تاریخ شروع</td><td style="text-align: center">تاریخ پایان</td><td style="text-align: center">وضعیت نصب</td><td style="text-align: center">میزان خرابی</td><td style="text-align: center">نام شرکت</td><td style="text-align: center">توضیحات</td><td>#</td></tr>')
                                    $("#table_history").empty();
                                    $("#table_history").append(th)
                                    for (var i = 0; i < response.results.length; i++) {
                                        radif=radif+1
                                        
                                        RADIF1 = $('<td style="text-align: center;font-family: Tahoma;font-size: x-small">' + radif + '</td>')
                                        ID_S = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['ID_S'] + '</td>')
                                        ID_T = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['ID_T'] + '</td>')
                                        SAV_TYPE = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['SAV_TYPE'] + '</td>')
                                        TIME_WORK = $('<td style="width:7%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TIME_WORK'] + '</td>')
                                        DAMAGE_PERCENT = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DAMAGE_PERCENT'] + '</td>')
                                        TYPE_INSTAL = $('<td style="width:10%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TYPE_INSTAL'] + '</td>')
                                        DESCRIPTION = $('<td style="width:50%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DISCRIPTION'] + '</td>')
                                        select = $('<button type="button" class="btn-sm border-info select_group" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;height: 20px;padding-top:1px"><p>>></p></button>').on('click', function (event) {
                                            $("tr.table3").css("background-color", "white");
                                            $("tr.table3").css("color", "black");
                                            $(this).closest('tr.table3').css("background-color", "#92282a");
                                            $(this).closest('tr.table3').css("color", "white");
                                            $('#id_s_edit').val($(this).closest('tr').find('td:eq(1)').text())
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سالم و تمیزکاری'){
                                                $('#mizan_kharabi_edit').val(1)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سبک'){
                                                $('#mizan_kharabi_edit').val(2)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='متوسط'){
                                                $('#mizan_kharabi_edit').val(3)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سنگین'){
                                                $('#mizan_kharabi_edit').val(4)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='مونتاژ'){
                                                $('#vaz_nasb_edit').val(1)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ'){
                                                $('#vaz_nasb_edit').val(2)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ و مونتاژ'){
                                                $('#vaz_nasb_edit').val(3)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='بدون تغییر'){
                                                $('#vaz_nasb_edit').val(4)
                                            }
                                            $('#karkard_edit').val($(this).closest('tr').find('td:eq(5)').text())
                                            $('#description_edit').val($(this).closest('tr').find('td:eq(11)').text())
                                            id_s=$(this).closest('tr').find('td:eq(1)').text()
                                            id_t1=$(this).closest('tr').find('td:eq(14)').text()
                                            id_t_prev=id_t1
                                            sav_type=$(this).closest('tr').find('td:eq(15)').text()
                                            id_sub=$(this).closest('tr').find('td:eq(16)').text()
                                            $('#id_t1_edit').val(id_t1)
                                            $('#barnameh_edit').val($(this).closest('tr').find('td:eq(4)').text())
                                            $("#update_historty").fadeIn()
                                            $("#delete_historty").fadeIn()
                                            $("#tamirat_table_report2").empty();

                                            $('#mizan_kharabi').prop("disabled",true);
                                            $('#vaz_nasb').prop("disabled",true);
                                            $('#karkard').prop("disabled",true);
                                            $('#description').prop("disabled",true);
                                            $('#insert_historty').prop("disabled",true);

                                            $('#mizan_kharabi').val(0)
                                            $('#vaz_nasb').val(0)
                                            $('#karkard').val('')
                                            $('#description').val('')

                                        })
                                        edit = $('<button type="button" class="btn-sm border-success edit1" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px" data-toggle="modal" data-target="#myModal4">ویرایش</button>').on('click', function () {
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'حقیقی') {
                                                $('#REAL_SOURE_EDIT').val('1')
                                            }
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'مجازی') {
                                                $('#REAL_SOURE_EDIT').val('2')
                                            }
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'ریجکت') {
                                                $('#REAL_SOURE_EDIT').val('3')
                                            }
                                            $('#ID_E_EDIT').val($(this).closest('tr').find('td:eq(0)').text())
                                            $('#ID_G_EDIT').val($(this).closest('tr').find('td:eq(5)').text())
                                            $('#SERIYAL_NUMBER_EDIT').val($(this).closest('tr').find('td:eq(1)').text())
                                            $('#SERIAL_NUMBER2_EDIT').val($(this).closest('tr').find('td:eq(2)').text())

                                            $('#MAKER_EDIT').val($(this).closest('tr').find('td:eq(6)').text())

                                        })
                                        del = $('<button hidden type="button" class="btn-sm del_send border-danger" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px">حذف</button>').attr('id', response.results[i]['ID_S'] + 3000).on('click', function () {
                                            var id_s = $(this).closest('tr').find('td:eq(1)').text();
                                            var token = $("meta[name='csrf-token']").attr("content");
                                            Swal.fire({
                                                title: 'مایل به حذف این این سابقه هستید؟',
                                                showDenyButton: true,
                                                cancelButtonText: `بازگشت`,
                                                confirmButtonText: `انصراف از حذف`,
                                                denyButtonText: 'حذف شود',
                                            }).then((result) => {
                                                if (result.isConfirmed) {

                                                    Swal.fire('سابقه انتخابی حذف نشد', '', 'info')
                                                } else if (result.isDenied) {

                                                    $.ajax({
                                                        url: "/history-delete/" + id_s,
                                                        type: 'DELETE',
                                                        data: {
                                                            "id": id_s,
                                                            "_token": token,
                                                        },
                                                        success: function (response) {
                                                            Swal.fire('حذف شد', '', 'success');
                                                            $('#' + (Number(id_s) + 3000)).closest('tr').remove();
                                                        }
                                                    });
                                                }
                                            })
                                        })
                                        t1 = $('<td style="width: 4%"></td>')
                                        t1.append(select)
                                        t2 = $('<td hidden style="width: 4%"></td>')
                                        t2.append(edit)
                                        t3 = $('<td style="width: 4%"></td>')
                                        t3.append(del)
                                        row = $('<tr class="table3"></tr>')
                                        var id_t = 0;
                                        var id_sub = 0;
                                        if(response.results[i]['SAV_TYPE']=='T'){

                                            for (var t = 0; t < response.tamir_prog.length; t++) {
                                                if(response.results[i]['ID_T']==response.tamir_prog[t]['ID_T']){
                                                    karkard_mo2=response.tamir_prog[t]['TIME_WORK_EQUAL'];
                                                    year = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(0, 4);
                                                    month = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(4, 2);
                                                    day = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    year = response.tamir_prog[t]['DATE_END_SH'].substr(0, 4);
                                                    month = response.tamir_prog[t]['DATE_END_SH'].substr(4, 2);
                                                    day = response.tamir_prog[t]['DATE_END_SH'].substr(6, 2);
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    ID_SUB = $('<td hidden style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    for (var g = 0; g < response.id_tts.length; g++) {
                                                        if(response.tamir_prog[t]['ID_TT']== response.id_tts[g]['ID_TT']){
                                                            TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tts[g]['TAMIRAT_TYPE'] + '</td>')
                                                        }
                                                    }
                                                    for (var r = 0; r < response.id_tas.length; r++) {
                                                        if(response.tamir_prog[t]['ID_TA']== response.id_tas[r]['ID_TA']){
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tas[r]['TAMIRKAR'] + '</td>')
                                                        }
                                                    }
                                                    for (var f = 0; f < response.id_uns.length; f++) {
                                                        if(response.tamir_prog[t]['ID_UN']== response.id_uns[f]['ID_UN']){
                                                            UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_uns[f]['UNIT_NUMBER'] + '</td>')
                                                        }
                                                    }
                                                }

                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)
                                        }
                                        if(response.results[i]['SAV_TYPE']=='A'){
                                            id_t = response.results[i]['ID_T']
                                            id_sub = response.results[i]['ID_SUB']
                                            if(id_sub == 0){
                                                for (var t = 0; t < response.anbar1.length; t++) {
                                                    if(response.results[i]['ID_T']==response.anbar1[t]['ID_T']){
                                                        year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if(response.anbar1[t]['DATE_SHAMSI']!='---'){
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }else{
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE)
                                                            $("#table_history").append(row)
                                                    }
                                                }
                                            }
                                            if(id_sub > 0){
                                                for (var t = 0; t < response.anbar1.length; t++) {
                                                    if (response.results[i]['ID_T'] == response.anbar1[t]['ID_T']) {
                                                        year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if (response.anbar1[t]['DATE_SHAMSI'] != '---') {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        } else {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                for (var t = 0; t < response.anbar2.length; t++) {
                                                    if(response.results[i]['ID_T']==response.anbar2[t]['ID_T'] && response.results[i]['ID_SUB']==response.anbar2[t]['ID_SUB']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.anbar2[t]['ID_SUB'] + '</td>')
                                                        year = response.anbar2[t]['DATE_SHAMSI2'].substr(0, 4);
                                                        month = response.anbar2[t]['DATE_SHAMSI2'].substr(4, 2);
                                                        day = response.anbar2[t]['DATE_SHAMSI2'].substr(6, 2);
                                                        if(response.anbar2[t]['DATE_SHAMSI2']!='---'){
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        }else{
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }
                                        }
                                        if(response.results[i]['SAV_TYPE']=='B'){
                                            id_t = response.results[i]['ID_T']
                                            id_sub = response.results[i]['ID_SUB']
                                            if(id_sub == 0){
                                                for (var t = 0; t < response.bazsazi1.length; t++) {
                                                    if(response.results[i]['ID_T']==response.bazsazi1[t]['ID_T']){
                                                        year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                        month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                        day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if(response.bazsazi1[t]['DATE_BEGIN1']!='---'){
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }else{
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                        row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                        $("#table_history").append(row)
                                                    }
                                                }
                                            }
                                            if(id_sub > 0){
                                                for (var t = 0; t < response.bazsazi1.length; t++) {
                                                    if (response.results[i]['ID_T'] == response.bazsazi1[t]['ID_T']) {
                                                        year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                        month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                        day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if (response.bazsazi1[t]['DATE_BEGIN1'] != '---') {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        } else {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                for (var t = 0; t < response.bazsazi2.length; t++) {
                                                    if(response.results[i]['ID_T']==response.bazsazi2[t]['ID_T'] && response.results[i]['ID_SUB']==response.bazsazi2[t]['ID_SUB']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.bazsazi2[t]['ID_SUB'] + '</td>')
                                                        year = response.bazsazi2[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.bazsazi2[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.bazsazi2[t]['DATE_SHAMSI'].substr(6, 2);
                                                        if(response.bazsazi2[t]['DATE_SHAMSI']!='---'){
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        }else{
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }
                                        }
                                        if(response.results[i]['SAV_TYPE']=='KH'){
                                            for (var t = 0; t < response.buy1.length; t++) {
                                                if(response.results[i]['ID_T']==response.buy1[t]['ID_T']){
                                                    ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">خرید</td>')
                                                    UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                    year = response.buy1[t]['DATE_SHAMSI'].substr(0, 4);
                                                    month = response.buy1[t]['DATE_SHAMSI'].substr(4, 2);
                                                    day = response.buy1[t]['DATE_SHAMSI'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                    for (var r = 0; r < response.id_se.length; r++) {
                                                        if(response.buy1[t]['ID_SE']== response.id_se[r]['ID_SE']){
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_se[r]['SELLER'] + '</td>')
                                                        }
                                                    }
                                                }
                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)

                                        }
                                        if(response.results[i]['SAV_TYPE']=='O'){
                                            for (var t = 0; t < response.eex.length; t++) {
                                                if(response.results[i]['ID_T']==response.eex[t]['ID_T']){
                                                    ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    year = response.eex[t]['DATE_SHAMSI'].substr(0, 4);
                                                    month = response.eex[t]['DATE_SHAMSI'].substr(4, 2);
                                                    day = response.eex[t]['DATE_SHAMSI'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                    TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج</td>')
                                                    UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                    PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.eex[t]['LOCATION_NAME'] + '</td>')
                                                }
                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)
                                        }


                                    }
                                }
                            })
                }
            })

            $.ajax({
                url: '/gh-gr/' + id_g_global,
                method: 'GET',
                beforeSend: function(){
                    $("#first_spinner").show();
                    $("#table2").hide();
                },
                success: function (response) {
                    $("#first_spinner").hide();
                    $("#table2").show();
                    $("#update_historty").fadeOut(500)
                    $("#delete_historty").fadeOut(500)
                    var row_count = 0
                    var select = 0
                    var row_count2 =''
                    var chk = ''
                    var t1 = ''
                    var ID_E = ''
                    var ID_E2 = ''
                    var SERIYAL_NUMBER = ''
                    var SERIAL_NUMBER2 = ''
                    var REAL_SOURE = ''
                    var MAKER = ''
                    var MAKER2 = ''
                    var ID_G = ''
                    var row = ''
                    var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td style="text-align: center;width:5%">#</td><td style="text-align: center">ردیف</td><td style="text-align: center">کد قطعه</td><td style="text-align: center">شماره سریال</td><td>کارکرد</td><td style="text-align: center">تعداد بازسازی</td><td style="text-align: center">اصالت قطعه</td><td style="text-align: center">شرکت سازنده</td></tr>')
                    $(".table_1").empty();
                    $(".table_1").append(th)
                    for (var i = 0; i < response.results.length; i++) {
                        row_count++;
                        select = $('<td><button type="button" class="btn-sm border-info select_group" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;height: 20px;padding-top:1px"><p>>></p></button></td>').on('click', function (event) {
                            radif3 = $(this).closest('tr').find('td:eq(1)').text();
                            ghataat4=$(this).closest('tr').find('td:eq(2)').text();
                            select_program=1;
                            $("tr.table2").css("background-color", "white");
                            $("tr.table2").css("color", "black");
                            $(this).closest('tr.table2').css("background-color", "#66cc7c");
                            $(this).closest('tr.table2').css("color", "white");
                            id_e = $(this).closest('tr').find('td:eq(2)').text();
                            radif1=id_e;
                            radif2=id_e;
                            karkard = $(this).closest('tr').find('td:eq(4)').text();
                            eq_karkard1=$(this).closest('tr').find('td:eq(4)').text();
                            event.preventDefault();
                            $.ajaxSetup({
                                headers: {
                                    'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            var _token = $("input[name='_token']").val();
                            $.ajax({
                                url: '/get-history/' + id_e,
                                method: 'GET',
                                beforeSend: function(){
                                    $("#second_spinner").show();
                                    $("#table_history").hide();
                                },
                                success: function (response) {
                                    $("#update_historty").fadeOut(500)
                                    $("#delete_historty").fadeOut(500)
                                    $("#second_spinner").hide();
                                    $("#table_history").show();
                                    
                                    var radif=0
                                    var RADIF1=''
                                    var t1 = ''
                                    var t2 = ''
                                    var t3 = ''
                                    var edit = ''
                                    var select = ''
                                    var del = ''
                                    var day = ''
                                    var month = ''
                                    var year = ''
                                    var ID_S = ''
                                    var ID_SUB = ''
                                    var ID_T = ''
                                    var SAV_TYPE = ''
                                    var TIME_WORK = ''
                                    var DAMAGE_PERCENT = ''
                                    var DESCRIPTION = ''
                                    var PEYMANKAR = ''
                                    var TYPE_INSTAL = ''
                                    var TYPE_OP = ''
                                    var UNIT_NO = ''
                                    var DATE1 = ''
                                    var DATE2 = ''
                                    var row = ''
                                    var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td>#</td><td style="text-align: center">ردیف</td><td style="text-align: center">مکان قطعه</td><td style="text-align: center">نوع عملیات</td><td style="text-align: center">ساعت کارکرد</td><td style="text-align: center">تاریخ شروع</td><td style="text-align: center">تاریخ پایان</td><td style="text-align: center">وضعیت نصب</td><td style="text-align: center">میزان خرابی</td><td style="text-align: center">نام شرکت</td><td style="text-align: center">توضیحات</td><td>#</td></tr>')
                                    $("#table_history").empty();
                                    $("#table_history").append(th)
                                    for (var i = 0; i < response.results.length; i++) {
                                        radif=radif+1
                                        
                                        RADIF1 = $('<td style="text-align: center;font-family: Tahoma;font-size: x-small">' + radif + '</td>')
                                        ID_S = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['ID_S'] + '</td>')
                                        ID_T = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['ID_T'] + '</td>')
                                        SAV_TYPE = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['SAV_TYPE'] + '</td>')
                                        TIME_WORK = $('<td style="width:7%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TIME_WORK'] + '</td>')
                                        DAMAGE_PERCENT = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DAMAGE_PERCENT'] + '</td>')
                                        TYPE_INSTAL = $('<td style="width:10%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TYPE_INSTAL'] + '</td>')
                                        DESCRIPTION = $('<td style="width:50%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DISCRIPTION'] + '</td>')
                                        select = $('<button type="button" class="btn-sm border-info select_group" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;height: 20px;padding-top:1px"><p>>></p></button>').on('click', function (event) {
                                            $("tr.table3").css("background-color", "white");
                                            $("tr.table3").css("color", "black");
                                            $(this).closest('tr.table3').css("background-color", "#92282a");
                                            $(this).closest('tr.table3').css("color", "white");
                                            $('#id_s_edit').val($(this).closest('tr').find('td:eq(1)').text())
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سالم و تمیزکاری'){
                                                $('#mizan_kharabi_edit').val(1)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سبک'){
                                                $('#mizan_kharabi_edit').val(2)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='متوسط'){
                                                $('#mizan_kharabi_edit').val(3)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سنگین'){
                                                $('#mizan_kharabi_edit').val(4)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='مونتاژ'){
                                                $('#vaz_nasb_edit').val(1)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ'){
                                                $('#vaz_nasb_edit').val(2)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ و مونتاژ'){
                                                $('#vaz_nasb_edit').val(3)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='بدون تغییر'){
                                                $('#vaz_nasb_edit').val(4)
                                            }
                                            $('#karkard_edit').val($(this).closest('tr').find('td:eq(5)').text())
                                            $('#description_edit').val($(this).closest('tr').find('td:eq(11)').text())
                                            id_s=$(this).closest('tr').find('td:eq(1)').text()
                                            id_t1=$(this).closest('tr').find('td:eq(14)').text()
                                            id_t_prev=id_t1
                                            sav_type=$(this).closest('tr').find('td:eq(15)').text()
                                            id_sub=$(this).closest('tr').find('td:eq(16)').text()
                                            $('#id_t1_edit').val(id_t1)
                                            $('#barnameh_edit').val($(this).closest('tr').find('td:eq(4)').text())
                                            $("#update_historty").fadeIn()
                                            $("#delete_historty").fadeIn()
                                            $("#tamirat_table_report2").empty();

                                            $('#mizan_kharabi').prop("disabled",true);
                                            $('#vaz_nasb').prop("disabled",true);
                                            $('#karkard').prop("disabled",true);
                                            $('#description').prop("disabled",true);
                                            $('#insert_historty').prop("disabled",true);

                                            $('#mizan_kharabi').val(0)
                                            $('#vaz_nasb').val(0)
                                            $('#karkard').val('')
                                            $('#description').val('')

                                        })
                                        edit = $('<button type="button" class="btn-sm border-success edit1" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px" data-toggle="modal" data-target="#myModal4">ویرایش</button>').on('click', function () {
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'حقیقی') {
                                                $('#REAL_SOURE_EDIT').val('1')
                                            }
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'مجازی') {
                                                $('#REAL_SOURE_EDIT').val('2')
                                            }
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'ریجکت') {
                                                $('#REAL_SOURE_EDIT').val('3')
                                            }
                                            $('#ID_E_EDIT').val($(this).closest('tr').find('td:eq(0)').text())
                                            $('#ID_G_EDIT').val($(this).closest('tr').find('td:eq(5)').text())
                                            $('#SERIYAL_NUMBER_EDIT').val($(this).closest('tr').find('td:eq(1)').text())
                                            $('#SERIAL_NUMBER2_EDIT').val($(this).closest('tr').find('td:eq(2)').text())

                                            $('#MAKER_EDIT').val($(this).closest('tr').find('td:eq(6)').text())

                                        })
                                        del = $('<button hidden type="button" class="btn-sm del_send border-danger" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px">حذف</button>').attr('id', response.results[i]['ID_S'] + 3000).on('click', function () {
                                            var id_s = $(this).closest('tr').find('td:eq(1)').text();
                                            var token = $("meta[name='csrf-token']").attr("content");
                                            Swal.fire({
                                                title: 'مایل به حذف این این سابقه هستید؟',
                                                showDenyButton: true,
                                                cancelButtonText: `بازگشت`,
                                                confirmButtonText: `انصراف از حذف`,
                                                denyButtonText: 'حذف شود',
                                            }).then((result) => {
                                                if (result.isConfirmed) {

                                                    Swal.fire('سابقه انتخابی حذف نشد', '', 'info')
                                                } else if (result.isDenied) {

                                                    $.ajax({
                                                        url: "/history-delete/" + id_s,
                                                        type: 'DELETE',
                                                        data: {
                                                            "id": id_s,
                                                            "_token": token,
                                                        },
                                                        success: function (response) {
                                                            Swal.fire('حذف شد', '', 'success');
                                                            $('#' + (Number(id_s) + 3000)).closest('tr').remove();
                                                        }
                                                    });
                                                }
                                            })
                                        })
                                        t1 = $('<td style="width: 4%"></td>')
                                        t1.append(select)
                                        t2 = $('<td hidden style="width: 4%"></td>')
                                        t2.append(edit)
                                        t3 = $('<td style="width: 4%"></td>')
                                        t3.append(del)
                                        row = $('<tr class="table3"></tr>')
                                        var id_t = 0;
                                        var id_sub = 0;
                                        if(response.results[i]['SAV_TYPE']=='T'){

                                            for (var t = 0; t < response.tamir_prog.length; t++) {
                                                if(response.results[i]['ID_T']==response.tamir_prog[t]['ID_T']){
                                                    karkard_mo2=response.tamir_prog[t]['TIME_WORK_EQUAL'];
                                                    year = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(0, 4);
                                                    month = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(4, 2);
                                                    day = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    year = response.tamir_prog[t]['DATE_END_SH'].substr(0, 4);
                                                    month = response.tamir_prog[t]['DATE_END_SH'].substr(4, 2);
                                                    day = response.tamir_prog[t]['DATE_END_SH'].substr(6, 2);
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    ID_SUB = $('<td hidden style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    for (var g = 0; g < response.id_tts.length; g++) {
                                                        if(response.tamir_prog[t]['ID_TT']== response.id_tts[g]['ID_TT']){
                                                            TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tts[g]['TAMIRAT_TYPE'] + '</td>')
                                                        }
                                                    }
                                                    for (var r = 0; r < response.id_tas.length; r++) {
                                                        if(response.tamir_prog[t]['ID_TA']== response.id_tas[r]['ID_TA']){
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tas[r]['TAMIRKAR'] + '</td>')
                                                        }
                                                    }
                                                    for (var f = 0; f < response.id_uns.length; f++) {
                                                        if(response.tamir_prog[t]['ID_UN']== response.id_uns[f]['ID_UN']){
                                                            UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_uns[f]['UNIT_NUMBER'] + '</td>')
                                                        }
                                                    }
                                                }

                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)
                                        }
                                        if(response.results[i]['SAV_TYPE']=='A'){
                                            id_t = response.results[i]['ID_T']
                                            id_sub = response.results[i]['ID_SUB']
                                            if(id_sub == 0){
                                                for (var t = 0; t < response.anbar1.length; t++) {
                                                    if(response.results[i]['ID_T']==response.anbar1[t]['ID_T']){
                                                        year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if(response.anbar1[t]['DATE_SHAMSI']!='---'){
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }else{
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE)
                                                            $("#table_history").append(row)
                                                    }
                                                }
                                            }
                                            if(id_sub > 0){
                                                for (var t = 0; t < response.anbar1.length; t++) {
                                                    if (response.results[i]['ID_T'] == response.anbar1[t]['ID_T']) {
                                                        year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if (response.anbar1[t]['DATE_SHAMSI'] != '---') {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        } else {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                for (var t = 0; t < response.anbar2.length; t++) {
                                                    if(response.results[i]['ID_T']==response.anbar2[t]['ID_T'] && response.results[i]['ID_SUB']==response.anbar2[t]['ID_SUB']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.anbar2[t]['ID_SUB'] + '</td>')
                                                        year = response.anbar2[t]['DATE_SHAMSI2'].substr(0, 4);
                                                        month = response.anbar2[t]['DATE_SHAMSI2'].substr(4, 2);
                                                        day = response.anbar2[t]['DATE_SHAMSI2'].substr(6, 2);
                                                        if(response.anbar2[t]['DATE_SHAMSI2']!='---'){
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        }else{
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }
                                        }
                                        if(response.results[i]['SAV_TYPE']=='B'){
                                            id_t = response.results[i]['ID_T']
                                            id_sub = response.results[i]['ID_SUB']
                                            if(id_sub == 0){
                                                for (var t = 0; t < response.bazsazi1.length; t++) {
                                                    if(response.results[i]['ID_T']==response.bazsazi1[t]['ID_T']){
                                                        year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                        month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                        day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if(response.bazsazi1[t]['DATE_BEGIN1']!='---'){
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }else{
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                        row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                        $("#table_history").append(row)
                                                    }
                                                }
                                            }
                                            if(id_sub > 0){
                                                for (var t = 0; t < response.bazsazi1.length; t++) {
                                                    if (response.results[i]['ID_T'] == response.bazsazi1[t]['ID_T']) {
                                                        year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                        month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                        day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if (response.bazsazi1[t]['DATE_BEGIN1'] != '---') {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        } else {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                for (var t = 0; t < response.bazsazi2.length; t++) {
                                                    if(response.results[i]['ID_T']==response.bazsazi2[t]['ID_T'] && response.results[i]['ID_SUB']==response.bazsazi2[t]['ID_SUB']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.bazsazi2[t]['ID_SUB'] + '</td>')
                                                        year = response.bazsazi2[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.bazsazi2[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.bazsazi2[t]['DATE_SHAMSI'].substr(6, 2);
                                                        if(response.bazsazi2[t]['DATE_SHAMSI']!='---'){
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        }else{
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }
                                        }
                                        if(response.results[i]['SAV_TYPE']=='KH'){
                                            for (var t = 0; t < response.buy1.length; t++) {
                                                if(response.results[i]['ID_T']==response.buy1[t]['ID_T']){
                                                    ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">خرید</td>')
                                                    UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                    year = response.buy1[t]['DATE_SHAMSI'].substr(0, 4);
                                                    month = response.buy1[t]['DATE_SHAMSI'].substr(4, 2);
                                                    day = response.buy1[t]['DATE_SHAMSI'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                    for (var r = 0; r < response.id_se.length; r++) {
                                                        if(response.buy1[t]['ID_SE']== response.id_se[r]['ID_SE']){
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_se[r]['SELLER'] + '</td>')
                                                        }
                                                    }
                                                }
                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)

                                        }
                                        if(response.results[i]['SAV_TYPE']=='O'){
                                            for (var t = 0; t < response.eex.length; t++) {
                                                if(response.results[i]['ID_T']==response.eex[t]['ID_T']){
                                                    ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    year = response.eex[t]['DATE_SHAMSI'].substr(0, 4);
                                                    month = response.eex[t]['DATE_SHAMSI'].substr(4, 2);
                                                    day = response.eex[t]['DATE_SHAMSI'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                    TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج</td>')
                                                    UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                    PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.eex[t]['LOCATION_NAME'] + '</td>')
                                                }
                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)
                                        }


                                    }
                                }
                            })
                        })
                        row_count2 = $('<td style="width:5%;text-align: center;">' + row_count + '</td>')
                        ID_E = $('<td  style="width:10%;text-align: center;border-right:1px dotted black;font-size: 10px" class="ID_E">' + response.results[i]['ID_E'] + '</td>')
                        ID_E2 = $('<td style="width:12%;text-align: center;font-size: 10px;border-right:1px dotted black" class="ID_E">' + response.kar[i]+ '</td>')
                        ghataat1.push($(this).closest('tr').find('td:eq(1)').text());
                        ID_E_ARRAY.push(response.results[i]['ID_E']);
                        ID_G = $('<td  hidden style="text-align: center">' + response.results[i]['ID_G'] + '</td>')
                        SERIYAL_NUMBER = $('<td style="width: 12%;text-align: center;font-size: 10px;border-right:1px dotted black">' + response.results[i]['SERIYAL_NUMBER'] + '</td>')
                        SERIAL_NUMBER2 = $('<td style="width: 5%;text-align: center;font-size: 10px;border-right:1px dotted black">' + response.baz[i] + '</td>')

                        if (response.results[i]['REAL_SOURE']==0) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">--</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==1) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">اصلی</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==2) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">خرید ارزی</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==3) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">خرید داخل</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==4) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">ساخت داخل</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==5) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">امانی</td>')
                        }
                        if (response.results[i]['REAL_SOURE']==6) {
                            REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">نامشخص</td>')
                        }

                        for (var j = 0; j < response.SAZS.length; j++) {
                            if (response.SAZS[j]['ID_S'] == response.results[i]['MAKER']) {
                                MAKER = $('<td style="width: 30%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.SAZS[j]['SAZANDEH'] + '</td>');
                                MAKER2 = $('<td hidden>' + response.SAZS[j]['ID_S'] + '</td>')
                                break;
                            }
                        }
                        t1 = $('<td style="width: 4%"></td>')
                        t1.append(chk)
                        row = $('<tr class="table2"></tr>')
                        row.append(select,row_count2,ID_E,SERIYAL_NUMBER,ID_E2,SERIAL_NUMBER2, REAL_SOURE, MAKER,ID_G,MAKER2)
                        $(".table_1").append(row)
                    }

                }
            })
           }
          })
            }else{
                Swal.fire( 'یکی از روشهای حذف سابقه انتخاب شود', '', 'info')
            }

         })
        $("#group_report_form").on('submit', function (event) {
            $("#table_history").empty();
            $("#tamirat_table_report2").empty();
            $("#update_historty").fadeOut(500)
            $("#delete_historty").fadeOut(500)
            select_program=0
            ghataat1=[];
            ghataat3=[];

            $('.ghataat2').prop('checked', false);
            $('.ghataat3').prop('checked', false);
            $('#mizan_kharabi').prop("disabled",true);
            $('#vaz_nasb').prop("disabled",true);
            $('#karkard').prop("disabled",true);
            $('#description').prop("disabled",true);
            $('#insert_historty').prop("disabled",true);
            $('#mizan_kharabi').val(0)
            $('#vaz_nasb').val(0)
            $('#karkard').val('')
            $('#description').val('')

            group1=$(this).closest('tr').find('td:eq(1)').text();
            group2=0;
            $("tr.table1").css("background-color", "white");
            $("tr.table1").css("color", "black");
            $(this).closest('tr.table1').css("background-color", "#2975cd");
            $(this).closest('tr.table1').css("color", "white");
            $("#table4").empty();
            var id_g = $(this).closest('tr').find('td:eq(1)').text();
            id_g_global = id_g;
            id_e = $(this).closest('tr').find('td:eq(4)').text();
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: "/group-rep",
                method: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.results.length>0){
                        $('#myModal5').modal('hide');
                        $("#add_recieve").hide();
                        $("#edit_recieve").hide();
                        $("#description2").text('');
                        $("#ID_T_SUB2").text('');
                        $("#table2").empty();
                        $("#table3").empty();
                        $("#table4").empty();
                        var edit1 = ''
                        var del2 = ''
                        var detail1 = ''
                        var select = ''
                        var ID_G = ''
                        var ID_USER = ''
                        var ID_TG = ''
                        var ID_TG2 = ''
                        var GROUP_CODE = ''
                        var GROUP_TYPE = ''
                        var GROUP_TYPE2 = ''
                        var t1 = ''
                        var t2 = ''
                        var t3 = ''
                        var t4 = ''
                        var row = ''
                        var th = $('<tr style="background-color: #3c525f">\n' +
                            '                                    <th style="width: 5%;font-size: 10px;font-family: Tahoma;color:white">#</th>\n' +
                            '                                    <th style="width: 15%;font-size: 10px;font-family: Tahoma;color:white">کد گروه</th>\n' +
                            '                                    <th style="width: 70%;font-size: 10px;font-family: Tahoma;color:white">نوع قطعه</th>\n' +
                            '                                </tr>')
                        $("#first_table").empty();
                        $("#first_table").append(th)
                        for (var i = 0; i < response.results.length; i++) {
                            for (var j = 0; j < response.ID_TGS.length; j++) {
                                if (response.ID_TGS[j]['ID_TG'] == response.results[i]['ID_TG']) {
                                    ID_TG = $('<td style="width: 20%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.ID_TGS[j]['GHATAAT_NAME'] + '</td>');
                                    ID_TG2 = $('<td hidden style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_TGS[j]['ID_TG'] + '</td>');
                                    break;
                                }
                            }
                            for (var z = 0; z < response.ID_USERS.length; z++) {
                                if (response.ID_USERS[z]['id'] == response.results[i]['ID_USER']) {
                                    ID_USER = $('<td hidden style="width: 7%">' + response.ID_USERS[z]['l_name'] + '</td>')
                                    break;
                                }
                            }
                            select = $('<button type="button" class="btn-sm border-info select_group" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;height: 20px;padding-top:1px"><p>>></p></button>').on('click', function (event) {
                                

                                $("#table_history").empty();
                                $("#tamirat_table_report2").empty();
                                $("#update_historty").fadeOut(500)
                                $("#delete_historty").fadeOut(500)

                                ghataat1=[];
                                ghataat3=[];

                                $('.ghataat2').prop('checked', false);
                                $('.ghataat3').prop('checked', false);
                                $('#mizan_kharabi').prop("disabled",true);
                                $('#vaz_nasb').prop("disabled",true);
                                $('#karkard').prop("disabled",true);
                                $('#description').prop("disabled",true);
                                $('#insert_historty').prop("disabled",true);
                                $('#mizan_kharabi').val(0)
                                $('#vaz_nasb').val(0)
                                $('#karkard').val('')
                                $('#description').val('')

                                group1=$(this).closest('tr').find('td:eq(1)').text();
                                group2=0;
                                $("tr.table1").css("background-color", "white");
                                $("tr.table1").css("color", "black");
                                $(this).closest('tr.table1').css("background-color", "#2975cd");
                                $(this).closest('tr.table1').css("color", "white");
                                $("#table4").empty();
                                var id_g = $(this).closest('tr').find('td:eq(1)').text();
                                id_g_global = id_g;
                                id_e = $(this).closest('tr').find('td:eq(4)').text();





                                event.preventDefault();
                                $.ajaxSetup({
                                    headers: {
                                        'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                    }
                                });
                                var _token = $("input[name='_token']").val();
                                $.ajax({
                                    url: '/gh-gr/' + id_g,
                                    method: 'GET',
                                    beforeSend: function(){
                                        $("#first_spinner").show();
                                        $("#table2").hide();
                                    },
                                    success: function (response) {
                                        $("#first_spinner").hide();
                                        $("#table2").show();
                                        $("#update_historty").fadeOut(500)
                                        $("#delete_historty").fadeOut(500)
                                        var row_count = 0
                                        var select = 0
                                        var row_count2 =''
                                        var chk = ''
                                        var t1 = ''
                                        var ID_E = ''
                                        var ID_E2 = ''
                                        var SERIYAL_NUMBER = ''
                                        var SERIAL_NUMBER2 = ''
                                        var REAL_SOURE = ''
                                        var MAKER = ''
                                        var MAKER2 = ''
                                        var ID_G = ''
                                        var row = ''
                                        var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td style="text-align: center;width:5%">#</td><td style="text-align: center">ردیف</td><td style="text-align: center">کد قطعه</td><td style="text-align: center">شماره سریال</td><td>کارکرد</td><td style="text-align: center">تعداد بازسازی</td><td style="text-align: center">اصالت قطعه</td><td style="text-align: center">شرکت سازنده</td></tr>')
                                        $(".table_1").empty();
                                        $(".table_1").append(th)
                                        for (var i = 0; i < response.results.length; i++) {
                                            row_count++;
                                            select = $('<td><button type="button" class="btn-sm border-info select_group" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;height: 20px;padding-top:1px"><p>>></p></button></td>').on('click', function (event) {
                                                $('#mizan_kharabi').val(0)
                                                $('#vaz_nasb').val(0)
                                                $('#karkard').val('')
                                                $('#description').val('')
                                                ghataat4=$(this).closest('tr').find('td:eq(2)').text();
                                                select_program=1;
                                                $("tr.table2").css("background-color", "white");
                                                $("tr.table2").css("color", "black");
                                                $(this).closest('tr.table2').css("background-color", "#66cc7c");
                                                $(this).closest('tr.table2').css("color", "white");
                                                id_e = $(this).closest('tr').find('td:eq(2)').text();
                                                radif1=id_e;
                                                radif2=id_e;
                                                karkard = $(this).closest('tr').find('td:eq(4)').text();
                                                eq_karkard1=$(this).closest('tr').find('td:eq(4)').text();
                                                event.preventDefault();
                                                $.ajaxSetup({
                                                    headers: {
                                                        'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                                    }
                                                });
                                                var _token = $("input[name='_token']").val();
                                                $.ajax({
                                url: '/get-history/' + id_e,
                                method: 'GET',
                                beforeSend: function(){
                                    $("#second_spinner").show();
                                    $("#table_history").hide();
                                },
                                success: function (response) {
                                    $("#update_historty").fadeOut(500)
                                    $("#delete_historty").fadeOut(500)
                                    $("#second_spinner").hide();
                                    $("#table_history").show();
                                    
                                    var radif=0
                                    var RADIF1=''
                                    var t1 = ''
                                    var t2 = ''
                                    var t3 = ''
                                    var edit = ''
                                    var select = ''
                                    var del = ''
                                    var day = ''
                                    var month = ''
                                    var year = ''
                                    var ID_S = ''
                                    var ID_SUB = ''
                                    var ID_T = ''
                                    var SAV_TYPE = ''
                                    var TIME_WORK = ''
                                    var DAMAGE_PERCENT = ''
                                    var DESCRIPTION = ''
                                    var PEYMANKAR = ''
                                    var TYPE_INSTAL = ''
                                    var TYPE_OP = ''
                                    var UNIT_NO = ''
                                    var DATE1 = ''
                                    var DATE2 = ''
                                    var row = ''
                                    var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td>#</td><td style="text-align: center">ردیف</td><td style="text-align: center">مکان قطعه</td><td style="text-align: center">نوع عملیات</td><td style="text-align: center">ساعت کارکرد</td><td style="text-align: center">تاریخ شروع</td><td style="text-align: center">تاریخ پایان</td><td style="text-align: center">وضعیت نصب</td><td style="text-align: center">میزان خرابی</td><td style="text-align: center">نام شرکت</td><td style="text-align: center">توضیحات</td><td>#</td></tr>')
                                    $("#table_history").empty();
                                    $("#table_history").append(th)
                                    for (var i = 0; i < response.results.length; i++) {
                                        radif=radif+1
                                        
                                        RADIF1 = $('<td style="text-align: center;font-family: Tahoma;font-size: x-small">' + radif + '</td>')
                                        ID_S = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['ID_S'] + '</td>')
                                        ID_T = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['ID_T'] + '</td>')
                                        SAV_TYPE = $('<td hidden style="text-align: center;font-family: Tahoma;font-size: x-small">' + response.results[i]['SAV_TYPE'] + '</td>')
                                        TIME_WORK = $('<td style="width:7%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TIME_WORK'] + '</td>')
                                        DAMAGE_PERCENT = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DAMAGE_PERCENT'] + '</td>')
                                        TYPE_INSTAL = $('<td style="width:10%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['TYPE_INSTAL'] + '</td>')
                                        DESCRIPTION = $('<td style="width:50%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.results[i]['DISCRIPTION'] + '</td>')
                                        select = $('<button type="button" class="btn-sm border-info select_group" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;height: 20px;padding-top:1px"><p>>></p></button>').on('click', function (event) {
                                            $("tr.table3").css("background-color", "white");
                                            $("tr.table3").css("color", "black");
                                            $(this).closest('tr.table3').css("background-color", "#92282a");
                                            $(this).closest('tr.table3').css("color", "white");
                                            $('#id_s_edit').val($(this).closest('tr').find('td:eq(1)').text())
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سالم و تمیزکاری'){
                                                $('#mizan_kharabi_edit').val(1)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سبک'){
                                                $('#mizan_kharabi_edit').val(2)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='متوسط'){
                                                $('#mizan_kharabi_edit').val(3)
                                            }
                                            if($(this).closest('tr').find('td:eq(9)').text()=='سنگین'){
                                                $('#mizan_kharabi_edit').val(4)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='مونتاژ'){
                                                $('#vaz_nasb_edit').val(1)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ'){
                                                $('#vaz_nasb_edit').val(2)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='دمونتاژ و مونتاژ'){
                                                $('#vaz_nasb_edit').val(3)
                                            }
                                            if($(this).closest('tr').find('td:eq(8)').text()=='بدون تغییر'){
                                                $('#vaz_nasb_edit').val(4)
                                            }
                                            $('#karkard_edit').val($(this).closest('tr').find('td:eq(5)').text())
                                            $('#description_edit').val($(this).closest('tr').find('td:eq(11)').text())
                                            id_s=$(this).closest('tr').find('td:eq(1)').text()
                                            id_t1=$(this).closest('tr').find('td:eq(14)').text()
                                            id_t_prev=id_t1
                                            sav_type=$(this).closest('tr').find('td:eq(15)').text()
                                            id_sub=$(this).closest('tr').find('td:eq(16)').text()
                                            $('#id_t1_edit').val(id_t1)
                                            $('#barnameh_edit').val($(this).closest('tr').find('td:eq(4)').text())
                                            $("#update_historty").fadeIn()
                                            $("#delete_historty").fadeIn()
                                            $("#tamirat_table_report2").empty();

                                            $('#mizan_kharabi').prop("disabled",true);
                                            $('#vaz_nasb').prop("disabled",true);
                                            $('#karkard').prop("disabled",true);
                                            $('#description').prop("disabled",true);
                                            $('#insert_historty').prop("disabled",true);

                                            $('#mizan_kharabi').val(0)
                                            $('#vaz_nasb').val(0)
                                            $('#karkard').val('')
                                            $('#description').val('')

                                        })
                                        edit = $('<button type="button" class="btn-sm border-success edit1" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px" data-toggle="modal" data-target="#myModal4">ویرایش</button>').on('click', function () {
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'حقیقی') {
                                                $('#REAL_SOURE_EDIT').val('1')
                                            }
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'مجازی') {
                                                $('#REAL_SOURE_EDIT').val('2')
                                            }
                                            if ($(this).closest('tr').find('td:eq(3)').text() == 'ریجکت') {
                                                $('#REAL_SOURE_EDIT').val('3')
                                            }
                                            $('#ID_E_EDIT').val($(this).closest('tr').find('td:eq(0)').text())
                                            $('#ID_G_EDIT').val($(this).closest('tr').find('td:eq(5)').text())
                                            $('#SERIYAL_NUMBER_EDIT').val($(this).closest('tr').find('td:eq(1)').text())
                                            $('#SERIAL_NUMBER2_EDIT').val($(this).closest('tr').find('td:eq(2)').text())

                                            $('#MAKER_EDIT').val($(this).closest('tr').find('td:eq(6)').text())

                                        })
                                        del = $('<button hidden type="button" class="btn-sm del_send border-danger" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;border-radius: 6px">حذف</button>').attr('id', response.results[i]['ID_S'] + 3000).on('click', function () {
                                            var id_s = $(this).closest('tr').find('td:eq(1)').text();
                                            var token = $("meta[name='csrf-token']").attr("content");
                                            Swal.fire({
                                                title: 'مایل به حذف این این سابقه هستید؟',
                                                showDenyButton: true,
                                                cancelButtonText: `بازگشت`,
                                                confirmButtonText: `انصراف از حذف`,
                                                denyButtonText: 'حذف شود',
                                            }).then((result) => {
                                                if (result.isConfirmed) {

                                                    Swal.fire('سابقه انتخابی حذف نشد', '', 'info')
                                                } else if (result.isDenied) {

                                                    $.ajax({
                                                        url: "/history-delete/" + id_s,
                                                        type: 'DELETE',
                                                        data: {
                                                            "id": id_s,
                                                            "_token": token,
                                                        },
                                                        success: function (response) {
                                                            Swal.fire('حذف شد', '', 'success');
                                                            $('#' + (Number(id_s) + 3000)).closest('tr').remove();
                                                        }
                                                    });
                                                }
                                            })
                                        })
                                        t1 = $('<td style="width: 4%"></td>')
                                        t1.append(select)
                                        t2 = $('<td hidden style="width: 4%"></td>')
                                        t2.append(edit)
                                        t3 = $('<td style="width: 4%"></td>')
                                        t3.append(del)
                                        row = $('<tr class="table3"></tr>')
                                        var id_t = 0;
                                        var id_sub = 0;
                                        if(response.results[i]['SAV_TYPE']=='T'){

                                            for (var t = 0; t < response.tamir_prog.length; t++) {
                                                if(response.results[i]['ID_T']==response.tamir_prog[t]['ID_T']){
                                                    karkard_mo2=response.tamir_prog[t]['TIME_WORK_EQUAL'];
                                                    year = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(0, 4);
                                                    month = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(4, 2);
                                                    day = response.tamir_prog[t]['DATE_BEGIN_SH'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    year = response.tamir_prog[t]['DATE_END_SH'].substr(0, 4);
                                                    month = response.tamir_prog[t]['DATE_END_SH'].substr(4, 2);
                                                    day = response.tamir_prog[t]['DATE_END_SH'].substr(6, 2);
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    ID_SUB = $('<td hidden style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    for (var g = 0; g < response.id_tts.length; g++) {
                                                        if(response.tamir_prog[t]['ID_TT']== response.id_tts[g]['ID_TT']){
                                                            TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tts[g]['TAMIRAT_TYPE'] + '</td>')
                                                        }
                                                    }
                                                    for (var r = 0; r < response.id_tas.length; r++) {
                                                        if(response.tamir_prog[t]['ID_TA']== response.id_tas[r]['ID_TA']){
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_tas[r]['TAMIRKAR'] + '</td>')
                                                        }
                                                    }
                                                    for (var f = 0; f < response.id_uns.length; f++) {
                                                        if(response.tamir_prog[t]['ID_UN']== response.id_uns[f]['ID_UN']){
                                                            UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_uns[f]['UNIT_NUMBER'] + '</td>')
                                                        }
                                                    }
                                                }

                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)
                                        }
                                        if(response.results[i]['SAV_TYPE']=='A'){
                                            id_t = response.results[i]['ID_T']
                                            id_sub = response.results[i]['ID_SUB']
                                            if(id_sub == 0){
                                                for (var t = 0; t < response.anbar1.length; t++) {
                                                    if(response.results[i]['ID_T']==response.anbar1[t]['ID_T']){
                                                        year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if(response.anbar1[t]['DATE_SHAMSI']!='---'){
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }else{
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE)
                                                            $("#table_history").append(row)
                                                    }
                                                }
                                            }
                                            if(id_sub > 0){
                                                for (var t = 0; t < response.anbar1.length; t++) {
                                                    if (response.results[i]['ID_T'] == response.anbar1[t]['ID_T']) {
                                                        year = response.anbar1[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.anbar1[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.anbar1[t]['DATE_SHAMSI'].substr(6, 2);
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج انبار</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if (response.anbar1[t]['DATE_SHAMSI'] != '---') {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        } else {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                for (var t = 0; t < response.anbar2.length; t++) {
                                                    if(response.results[i]['ID_T']==response.anbar2[t]['ID_T'] && response.results[i]['ID_SUB']==response.anbar2[t]['ID_SUB']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.anbar2[t]['ID_SUB'] + '</td>')
                                                        year = response.anbar2[t]['DATE_SHAMSI2'].substr(0, 4);
                                                        month = response.anbar2[t]['DATE_SHAMSI2'].substr(4, 2);
                                                        day = response.anbar2[t]['DATE_SHAMSI2'].substr(6, 2);
                                                        if(response.anbar2[t]['DATE_SHAMSI2']!='---'){
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        }else{
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }
                                        }
                                        if(response.results[i]['SAV_TYPE']=='B'){
                                            id_t = response.results[i]['ID_T']
                                            id_sub = response.results[i]['ID_SUB']
                                            if(id_sub == 0){
                                                for (var t = 0; t < response.bazsazi1.length; t++) {
                                                    if(response.results[i]['ID_T']==response.bazsazi1[t]['ID_T']){
                                                        year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                        month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                        day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if(response.bazsazi1[t]['DATE_BEGIN1']!='---'){
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }else{
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                        row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                        $("#table_history").append(row)
                                                    }
                                                }
                                            }
                                            if(id_sub > 0){
                                                for (var t = 0; t < response.bazsazi1.length; t++) {
                                                    if (response.results[i]['ID_T'] == response.bazsazi1[t]['ID_T']) {
                                                        year = response.bazsazi1[t]['DATE_BEGIN1'].substr(0, 4);
                                                        month = response.bazsazi1[t]['DATE_BEGIN1'].substr(4, 2);
                                                        day = response.bazsazi1[t]['DATE_BEGIN1'].substr(6, 2);
                                                        TYPE_OP = $('<td style="width:5%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">بازسازی</td>')
                                                        UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                        if (response.bazsazi1[t]['DATE_BEGIN1'] != '---') {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        } else {
                                                            DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                for (var t = 0; t < response.bazsazi2.length; t++) {
                                                    if(response.results[i]['ID_T']==response.bazsazi2[t]['ID_T'] && response.results[i]['ID_SUB']==response.bazsazi2[t]['ID_SUB']){
                                                        ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.bazsazi2[t]['ID_SUB'] + '</td>')
                                                        year = response.bazsazi2[t]['DATE_SHAMSI'].substr(0, 4);
                                                        month = response.bazsazi2[t]['DATE_SHAMSI'].substr(4, 2);
                                                        day = response.bazsazi2[t]['DATE_SHAMSI'].substr(6, 2);
                                                        if(response.bazsazi2[t]['DATE_SHAMSI']!='---'){
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                        }else{
                                                            DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                        }
                                                    }
                                                }
                                                row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                                $("#table_history").append(row)
                                            }
                                        }
                                        if(response.results[i]['SAV_TYPE']=='KH'){
                                            for (var t = 0; t < response.buy1.length; t++) {
                                                if(response.results[i]['ID_T']==response.buy1[t]['ID_T']){
                                                    ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">خرید</td>')
                                                    UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                    year = response.buy1[t]['DATE_SHAMSI'].substr(0, 4);
                                                    month = response.buy1[t]['DATE_SHAMSI'].substr(4, 2);
                                                    day = response.buy1[t]['DATE_SHAMSI'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                    for (var r = 0; r < response.id_se.length; r++) {
                                                        if(response.buy1[t]['ID_SE']== response.id_se[r]['ID_SE']){
                                                            PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.id_se[r]['SELLER'] + '</td>')
                                                        }
                                                    }
                                                }
                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)

                                        }
                                        if(response.results[i]['SAV_TYPE']=='O'){
                                            for (var t = 0; t < response.eex.length; t++) {
                                                if(response.results[i]['ID_T']==response.eex[t]['ID_T']){
                                                    ID_SUB = $('<td hidden style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">0</td>')
                                                    year = response.eex[t]['DATE_SHAMSI'].substr(0, 4);
                                                    month = response.eex[t]['DATE_SHAMSI'].substr(4, 2);
                                                    day = response.eex[t]['DATE_SHAMSI'].substr(6, 2);
                                                    DATE1 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                    DATE2 = $('<td style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">--</td>')
                                                    TYPE_OP = $('<td style="width:12%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">ورود و خروج</td>')
                                                    UNIT_NO = $('<td style="width:6%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">--</td>')
                                                    PEYMANKAR = $('<td style="width:15%;text-align: center;font-family: Tahoma;font-size: x-small;border-right:1px dotted black">' + response.eex[t]['LOCATION_NAME'] + '</td>')
                                                }
                                            }
                                            row.append(t1,ID_S,RADIF1,UNIT_NO,TYPE_OP,TIME_WORK,DATE1,DATE2,TYPE_INSTAL,DAMAGE_PERCENT,PEYMANKAR,DESCRIPTION,t2,t3,ID_T,SAV_TYPE,ID_SUB)
                                            $("#table_history").append(row)
                                        }


                                    }
                                }
                            })
                                            })
                                            row_count2 = $('<td style="width:5%;text-align: center;">' + row_count + '</td>')
                                            ID_E = $('<td  style="width:10%;text-align: center;border-right:1px dotted black;font-size: 10px" class="ID_E">' + response.results[i]['ID_E'] + '</td>')
                                            ID_E2 = $('<td style="width:12%;text-align: center;font-size: 10px;border-right:1px dotted black" class="ID_E">' + response.kar[i]+ '</td>')
                                            ghataat1.push($(this).closest('tr').find('td:eq(1)').text());
                                            ID_E_ARRAY.push(response.results[i]['ID_E']);
                                            ID_G = $('<td  hidden style="text-align: center">' + response.results[i]['ID_G'] + '</td>')
                                            SERIYAL_NUMBER = $('<td style="width: 12%;text-align: center;font-size: 10px;border-right:1px dotted black">' + response.results[i]['SERIYAL_NUMBER'] + '</td>')
                                            SERIAL_NUMBER2 = $('<td style="width: 5%;text-align: center;font-size: 10px;border-right:1px dotted black">' + response.baz[i] + '</td>')

                                            if (response.results[i]['REAL_SOURE']==0) {
                                                REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">--</td>')
                                            }
                                            if (response.results[i]['REAL_SOURE']==1) {
                                                REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">اصلی</td>')
                                            }
                                            if (response.results[i]['REAL_SOURE']==2) {
                                                REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">خرید ارزی</td>')
                                            }
                                            if (response.results[i]['REAL_SOURE']==3) {
                                                REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">خرید داخل</td>')
                                            }
                                            if (response.results[i]['REAL_SOURE']==4) {
                                                REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">ساخت داخل</td>')
                                            }
                                            if (response.results[i]['REAL_SOURE']==5) {
                                                REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">امانی</td>')
                                            }
                                            if (response.results[i]['REAL_SOURE']==6) {
                                                REAL_SOURE = $('<td style="width: 15%;text-align: center;font-size: 10px;border-right:1px dotted black">نامشخص</td>')
                                            }

                                            for (var j = 0; j < response.SAZS.length; j++) {
                                                if (response.SAZS[j]['ID_S'] == response.results[i]['MAKER']) {
                                                    MAKER = $('<td style="width: 30%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.SAZS[j]['SAZANDEH'] + '</td>');
                                                    MAKER2 = $('<td hidden>' + response.SAZS[j]['ID_S'] + '</td>')
                                                    break;
                                                }
                                            }
                                            t1 = $('<td style="width: 4%"></td>')
                                            t1.append(chk)
                                            row = $('<tr class="table2"></tr>')
                                            row.append(select,row_count2,ID_E,SERIYAL_NUMBER,ID_E2,SERIAL_NUMBER2, REAL_SOURE, MAKER,ID_G,MAKER2)
                                            // $("#table2").append(row)
                                            $(".table_1").append(row)
                                        }

                                    }
                                })

                            })
                            ID_G = $('<td hidden style="width: 4%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['ID_G'] + '</td>')
                            GROUP_CODE = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['GROUP_CODE'] + '</td>')
                            GROUP_TYPE = $('<td hidden style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['GROUP_TYPE'] + '</td>')
                            if(response.results[i]['GROUP_TYPE']==1){
                                GROUP_TYPE2 = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">حقیقی</td>')
                            }
                            if(response.results[i]['GROUP_TYPE']==2){
                                GROUP_TYPE2 = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">مجازی</td>')
                            }
                            if(response.results[i]['GROUP_TYPE']==3){
                                GROUP_TYPE2 = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">ریجکت</td>')
                            }

                            t1 = $('<td style="width: 4%"></td>')
                            t1.append(edit1)
                            t2 = $('<td style="width: 4%"></td>')
                            t2.append(del2)
                            t3 = $('<td style="width: 4%"></td>')
                            t3.append(detail1)
                            t4 = $('<td style="width: 4%"></td>')
                            t4.append(select)
                            row = $('<tr style="color:black;text-align: center;font-size: 10px;font-family: Tahoma;height:20px" class="table1">')
                            row.append(t4,ID_G,GROUP_CODE,ID_TG,ID_TG2)
                            $("#first_table").append(row)
                        }
                    }else{
                        Swal.fire('موردی یافت نشد', '', 'info')
                    }

                }
            });
          })
        $(".ghataat2").bind('change', function () {

            if ($(this).is(':checked')){
                $('.ghataat3').prop('checked', true);
                $('.table2').css("background-color", "#40af6b");
                $('.table2').css("color", "white");
            }else{
                $('.table2').css("background-color", "white");
                $('.table2').css("color", "black");
                $('.ghataat3').prop('checked', false);
                ghataat2 =[]
                ghataat3=[]
                ghataat1=[]
            }
            var rows = $('#table2 tr').length;
            ghataat1 =[]
            var checkboxes = new Array();
            checkboxes = document.getElementsByTagName('input');
            for (var i=0; i<rows; i++)  {
                if (checkboxes[i].type == 'checkbox')   {
                    if(checkboxes[i].checked == true){
                        ghataat1.push(ID_E_ARRAY[i-1]);
                    }
                }
            }
            var f=ghataat1.length;
            for(var d=0;d<=ghataat1.length;d++){
                ghataat3.push(ghataat1[d-1]);
            }
            ghataat3 = ghataat3.filter(function (el) {

                return el != null && el != "";

            });
            ghataat1=[]
            ghataat1=ghataat3
         });
        $("#INSERT_TYPE").on('change',function(){
            radif1=0
            radif2=0
            $("#radif_insert1").val(0)
            $("#radif_insert2").val(0)
            if($("#INSERT_TYPE").val()==0){
                $("#INSERT_TYPE_DIV").fadeOut(500);
                insert_type=0
            }
            if($("#INSERT_TYPE").val()==1){
                $("#INSERT_TYPE_DIV").fadeOut(500);
                insert_type=1
            }
            if($("#INSERT_TYPE").val()==2){
                $("#INSERT_TYPE_DIV").fadeOut(500);
                insert_type=2
            }
            if($("#INSERT_TYPE").val()==3){
                $("#INSERT_TYPE_DIV").fadeIn(500);
                insert_type=3

            }
         })
        $("#UPDATE_TYPE").on('change',function(){

            if($("#UPDATE_TYPE").val()==0){
                $("#UPDATE_TYPE_DIV").fadeOut(500);
                insert_type=0
            }
            if($("#UPDATE_TYPE").val()==1){
                $("#UPDATE_TYPE_DIV").fadeOut(500);
                insert_type=1
            }
            if($("#UPDATE_TYPE").val()==2){
                $("#UPDATE_TYPE_DIV").fadeOut(500);
                insert_type=2
            }
            if($("#UPDATE_TYPE").val()==3){
                $("#UPDATE_TYPE_DIV").fadeIn(500);
                insert_type=3
            }
            mizan_kharabi = $("#mizan_kharabi_edit").val()
            vaz_nasb = $("#vaz_nasb_edit").val()
            karkard = $("#karkard_edit").val()
            description = $("#description_edit").val()
            

         })
        $("#DELETE_TYPE").on('change',function(){

            if($("#DELETE_TYPE").val()==0){
                $("#DELETE_TYPE_DIV").fadeOut(500);
                insert_type=0
            }
            if($("#DELETE_TYPE").val()==1){
                $("#DELETE_TYPE_DIV").fadeOut(500);
                insert_type=1
            }
            if($("#DELETE_TYPE").val()==2){
                $("#DELETE_TYPE_DIV").fadeOut(500);
                insert_type=2
            }
            if($("#DELETE_TYPE").val()==3){
                $("#DELETE_TYPE_DIV").fadeIn(500);
                insert_type=3
            }
         })
        $("#btn23").on('click',function (event) {
            select_program=0
            $('#myModal5').modal('show');
         })
        $("#update_historty").on('click',function (event) {
            $("#UPDATE_TYPE").val(0)
            id_t_bazsazi1=0
            id_t_bazsazi2=0
            $('#myModal7').modal('show');
         })
        $("#delete_historty").on('click',function (event) {
            $("#UPDATE_TYPE").val(0)
            id_t_bazsazi1=0
            id_t_bazsazi2=0
            $('#myModal13').modal('show');
         })
        $("#insert_historty").on('click',function (event) {
            $('#myModal8').modal('show');
         })
        $("#btn_tamirat").on('click',function (event) {
            $('#mizan_kharabi').prop("disabled",true);
            $('#vaz_nasb').prop("disabled",true);
            $('#karkard').prop("disabled",true);
            $('#description').prop("disabled",true);
            $('#insert_historty').prop("disabled",true);
            $("#tamirat_table_report2").empty();
            $("#tamirat_table_report2").empty();
            $("#update_historty").fadeOut(500)
            $("#delete_historty").fadeOut(500)
            if(select_program==1){
                program=1
                sav_type='T';
                Swal.fire({
                    title: 'آیا مایل به انتخاب برنامه تعمیرات دوره ای جهت ایجاد سابقه جدید بر روی این قطعه هستید؟',
                    showDenyButton: true,
                    cancelButtonText: `بازگشت`,
                    confirmButtonText: `انصراف`,
                    denyButtonText: 'برنامه تعمیرات دوره ای انتخاب گردد',
                }).then((result) => {
                    if (result.isConfirmed) {

                        Swal.fire('از انتخاب برنامه تعمیرات دوره ای انصراف داده شد', '', 'info')
                    } else if (result.isDenied) {

                        $('#myModal6').modal('show');
                        button_type=1;
                        $("#table_history").empty();
                        $("#update_historty").fadeOut()
                        $("#delete_historty").fadeOut(500)
                        $('#mizan_kharabi').val(0)
                        $('#vaz_nasb').val(0)
                        $('#karkard').val('')
                        $('#description').val('')
                    }
                })

            }else{
                Swal.fire('ابتدا نسبت به انتخاب گروه و یکی از قطعات متعلق به آن گروه اقدام گردد', '', 'info')
            }
         })
        $("#btn_tamirat2").on('click',function (event) {
            $('#mizan_kharabi').prop("disabled",true);
            $('#vaz_nasb').prop("disabled",true);
            $('#karkard').prop("disabled",true);
            $('#description').prop("disabled",true);
            $('#insert_historty').prop("disabled",true);
            $("#tamirat_table_report2").empty();
            $("#tamirat_table_report2").empty();
            $("#update_historty").fadeOut(500)
            $("#delete_historty").fadeOut(500)
           $('#myModal6').modal('show');
            program=1
            button_type=2;
            sav_type='T';
         })
        $("#btn_bazsazi").on('click',function (event) {
            $('#mizan_kharabi').prop("disabled",true);
            $('#vaz_nasb').prop("disabled",true);
            $('#karkard').prop("disabled",true);
            $('#description').prop("disabled",true);
            $('#insert_historty').prop("disabled",true);
            $("#tamirat_table_report2").empty();
            $("#tamirat_table_report2").empty();
            $("#update_historty").fadeOut(500)
            $("#delete_historty").fadeOut(500)
            if(select_program==1){
                sav_type='B';
                program=2
                Swal.fire({
                    title: 'آیا مایل به انتخاب برنامه ارسال برای بازسازی جهت ایجاد سابقه جدید بر روی این قطعه هستید؟',
                    showDenyButton: true,
                    cancelButtonText: `بازگشت`,
                    confirmButtonText: `انصراف`,
                    denyButtonText: 'برنامه انتخاب گردد',
                }).then((result) => {
                    if (result.isConfirmed) {

                        Swal.fire('از انتخاب برنامه بازسازی انصراف داده شد', '', 'info')
                    } else if (result.isDenied) {

                        $('#myModal9').modal('show');
                        button_type=1;
                        $("#table_history").empty();
                        $("#update_historty").fadeOut()
                        $("#delete_historty").fadeOut()
                        $('#mizan_kharabi').val(0)
                        $('#vaz_nasb').val(0)
                        $('#karkard').val('')
                        $('#description').val('')
                    }
                })

            }else{
                Swal.fire('ابتدا نسبت به انتخاب گروه و یکی از قطعات متعلق به آن گروه اقدام گردد', '', 'info')
            }
         })
        $("#btn_bazsazi2").on('click',function (event) {
            $('#mizan_kharabi').prop("disabled",true);
            $('#vaz_nasb').prop("disabled",true);
            $('#karkard').prop("disabled",true);
            $('#description').prop("disabled",true);
            $('#insert_historty').prop("disabled",true);
            $("#tamirat_table_report2").empty();
            $("#tamirat_table_report2").empty();
            $("#update_historty").fadeOut(500)
            $("#delete_historty").fadeOut(500)
            $('#myModal9').modal('show');
            sav_type='B',
            button_type=2;
            program=2
         })
        $("#btn_anbar").on('click',function (event) {
            $('#mizan_kharabi').prop("disabled",true);
            $('#vaz_nasb').prop("disabled",true);
            $('#karkard').prop("disabled",true);
            $('#description').prop("disabled",true);
            $('#insert_historty').prop("disabled",true);
            $("#tamirat_table_report2").empty();
            $("#tamirat_table_report2").empty();
            $("#update_historty").fadeOut(500)
            $("#delete_historty").fadeOut(500)
            if(select_program==1){
                sav_type='A';
                program=2
                Swal.fire({
                    title: 'آیا مایل به انتخاب برنامه ورود و خروج به انبار جهت ایجاد سابقه جدید بر روی این قطعه هستید؟',
                    showDenyButton: true,
                    cancelButtonText: `بازگشت`,
                    confirmButtonText: `انصراف`,
                    denyButtonText: 'برنامه انتخاب گردد',
                }).then((result) => {
                    if (result.isConfirmed) {

                        Swal.fire('از انتخاب برنامه ورود و خروج انبار انصراف داده شد', '', 'info')
                    } else if (result.isDenied) {

                        $('#myModal10').modal('show');
                        button_type=1;
                        $("#table_history").empty();
                        $("#update_historty").fadeOut()
                        $("#delete_historty").fadeOut(500)
                        $('#mizan_kharabi').val(0)
                        $('#vaz_nasb').val(0)
                        $('#karkard').val('')
                        $('#description').val('')
                    }
                })

            }else{
                Swal.fire('ابتدا نسبت به انتخاب گروه و یکی از قطعات متعلق به آن گروه اقدام گردد', '', 'info')
            }
         })
        $("#btn_anbar2").on('click',function (event) {
            $('#mizan_kharabi').prop("disabled",true);
            $('#vaz_nasb').prop("disabled",true);
            $('#karkard').prop("disabled",true);
            $('#description').prop("disabled",true);
            $('#insert_historty').prop("disabled",true);
            $("#tamirat_table_report2").empty();
            $("#tamirat_table_report2").empty();
            $("#update_historty").fadeOut(500)
            $("#delete_historty").fadeOut(500)
            $('#myModal10').modal('show');
            program=1
            button_type=2;
            sav_type='A';
         })
        $("#btn_buy").on('click',function (event) {
            $('#mizan_kharabi').prop("disabled",true);
            $('#vaz_nasb').prop("disabled",true);
            $('#karkard').prop("disabled",true);
            $('#description').prop("disabled",true);
            $('#insert_historty').prop("disabled",true);
            $("#tamirat_table_report2").empty();
            $("#tamirat_table_report2").empty();
            $("#update_historty").fadeOut(500)
            $("#delete_historty").fadeOut(500)
            if(select_program==1){
                program=1
                Swal.fire({
                    title: 'آیا مایل به انتخاب برنامه خرید جهت ایجاد سابقه جدید بر روی این قطعه هستید؟',
                    showDenyButton: true,
                    cancelButtonText: `بازگشت`,
                    confirmButtonText: `انصراف`,
                    denyButtonText: 'برنامه انتخاب گردد',
                }).then((result) => {
                    if (result.isConfirmed) {

                        Swal.fire('از انتخاب برنامه خرید انصراف داده شد', '', 'info')
                    } else if (result.isDenied) {

                        $('#myModal11').modal('show');
                        button_type=1;
                        $("#table_history").empty();
                        $("#update_historty").fadeOut()
                        $("#delete_historty").fadeOut()
                        $('#mizan_kharabi').val(0)
                        $('#vaz_nasb').val(0)
                        $('#karkard').val('')
                        $('#description').val('')
                    }
                })

            }else{
                Swal.fire('ابتدا نسبت به انتخاب گروه و یکی از قطعات متعلق به آن گروه اقدام گردد', '', 'info')
            }
         })
        $("#btn_buy2").on('click',function (event) {
            $('#mizan_kharabi').prop("disabled",true);
            $('#vaz_nasb').prop("disabled",true);
            $('#karkard').prop("disabled",true);
            $('#description').prop("disabled",true);
            $('#insert_historty').prop("disabled",true);
            $("#tamirat_table_report2").empty();
            $("#tamirat_table_report2").empty();
            $("#update_historty").fadeOut(500)
            $("#delete_historty").fadeOut(500)
            $('#myModal11').modal('show');
            program=1
            button_type=2;
            sav_type='KH';
         })
        $("#btn_eex").on('click',function (event) {
            $('#mizan_kharabi').prop("disabled",true);
            $('#vaz_nasb').prop("disabled",true);
            $('#karkard').prop("disabled",true);
            $('#description').prop("disabled",true);
            $('#insert_historty').prop("disabled",true);
            $("#tamirat_table_report2").empty();
            $("#tamirat_table_report2").empty();
            $("#update_historty").fadeOut(500)
            $("#delete_historty").fadeOut(500)
            if(select_program==1){
                program=1
                Swal.fire({
                    title: 'آیا مایل به انتخاب برنامه ورود و خروج جهت ایجاد سابقه جدید بر روی این قطعه هستید؟',
                    showDenyButton: true,
                    cancelButtonText: `بازگشت`,
                    confirmButtonText: `انصراف`,
                    denyButtonText: 'برنامه انتخاب گردد',
                }).then((result) => {
                    if (result.isConfirmed) {

                        Swal.fire('از انتخاب برنامه ورود و خروج انصراف داده شد', '', 'info')
                    } else if (result.isDenied) {

                        $('#myModal12').modal('show');
                        button_type=1;
                        $("#table_history").empty();
                        $("#update_historty").fadeOut()
                        $("#delete_historty").fadeOut()
                        $('#mizan_kharabi').val(0)
                        $('#vaz_nasb').val(0)
                        $('#karkard').val('')
                        $('#description').val('')
                    }
                })

            }else{
                Swal.fire('ابتدا نسبت به انتخاب گروه و یکی از قطعات متعلق به آن گروه اقدام گردد', '', 'info')
            }
         })
        $("#btn_eex2").on('click',function (event) {
            $('#mizan_kharabi').prop("disabled",true);
            $('#vaz_nasb').prop("disabled",true);
            $('#karkard').prop("disabled",true);
            $('#description').prop("disabled",true);
            $('#insert_historty').prop("disabled",true);
            $("#tamirat_table_report2").empty();
            $("#tamirat_table_report2").empty();
            $("#update_historty").fadeOut(500)
            $("#delete_historty").fadeOut(500)
            $('#myModal12').modal('show');
            program=1
            button_type=2;
            sav_type='O';
         })

        $("#confirm1").on('click',function (event) {
            $("#tamirat_table_report").empty();
            $('.ghataat3').prop('checked', false);
            type_sabegheh='T';
            id_sub=0
            $('#history_type').show();
            if(select_prog==1){
                Swal.fire('برنامه تعمیرات دوره ای انتخاب گردید', '', 'info')
                select_prog=0
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                var _token = $("input[name='_token']").val();
                $.ajax({
                    url: '/tapr-rep3/'+id_t1,
                    method: 'GET',
                    success: function (response) {
                        $('#mizan_kharabi').prop("disabled",false);
                        $('#vaz_nasb').prop("disabled",false);
                        $('#karkard').prop("disabled",false);
                        $('#description').prop("disabled",false);
                        $('#insert_historty').prop("disabled",false);


                        if(response.results.length>0){
                            var day = ''
                            var month = ''
                            var year = ''
                            var ID_T2 = ''
                            var ID_UN = ''
                            var ID_UN2 = ''
                            var ID_TT = ''
                            var ID_TT2 = ''
                            var ID_TA = ''
                            var ID_TA2 = ''
                            var TIME_WORK_REAL = ''
                            var TIME_WORK_EQUAL = ''
                            var DATE_BEGIN_SH = ''
                            var DATE_END_SH = ''
                            var row = ''
                            var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;border-radius: 5px"><td>کد</td><td style="text-align: center">واحد</td><td style="text-align: center">نوع تعمیرات</td><td style="text-align: center">شرکت تعمیرکار</td><td style="text-align: center">شروع تعمیرات</td><td style="text-align: center">پایان تعمیرات</td><td>کارکرد واقعی</td><td>کارکرد معادل</td></tr>')
                            $("#tamirat_table_report2").empty();
                            $("#tamirat_table_report2").append(th)
                            for (var i = 0; i < response.results.length; i++) {
                                for (var j = 0; j < response.ID_UNS.length; j++) {
                                    if (response.ID_UNS[j]['ID_UN'] == response.results[i]['ID_UN']) {
                                        ID_UN = $('<td style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.ID_UNS[j]['UNIT_NUMBER'] + '</td>');
                                        ID_UN2 = $('<td hidden style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_UNS[j]['ID_UN'] + '</td>');
                                        break;
                                    }
                                }
                                for (var j = 0; j < response.ID_TAS.length; j++) {
                                    if (response.ID_TAS[j]['ID_TA'] == response.results[i]['ID_TA']) {
                                        ID_TA = $('<td style="width: 20%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.ID_TAS[j]['TAMIRKAR'] + '</td>');
                                        ID_TA2 = $('<td hidden style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_TAS[j]['ID_TA'] + '</td>');
                                        break;
                                    }
                                }
                                for (var j = 0; j < response.ID_TTS.length; j++) {
                                    if (response.ID_TTS[j]['ID_TT'] == response.results[i]['ID_TT']) {
                                        ID_TT = $('<td style="width: 14%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.ID_TTS[j]['TAMIRAT_TYPE'] + '</td>');
                                        ID_TT2 = $('<td hidden style="width: 17%;font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_TTS[j]['ID_TT'] + '</td>');
                                        break;
                                    }
                                }
                                ID_T2 = $('<td style="font-family: Tahoma;font-size: 10px;text-align: center;width: 5%">' + response.results[i]['ID_T'] + '</td>')
                                TIME_WORK_REAL = $('<td style="width: 6%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.results[i]['TIME_WORK_REAL'] + '</td>')
                                TIME_WORK_EQUAL = $('<td style="width: 6%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.results[i]['TIME_WORK_EQUAL'] + '</td>')
                                year = response.results[i]['DATE_BEGIN_SH'].substr(0, 4);
                                month = response.results[i]['DATE_BEGIN_SH'].substr(4, 2);
                                day = response.results[i]['DATE_BEGIN_SH'].substr(6, 2);
                                DATE_BEGIN_SH = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                year = response.results[i]['DATE_END_SH'].substr(0, 4);
                                month = response.results[i]['DATE_END_SH'].substr(4, 2);
                                day = response.results[i]['DATE_END_SH'].substr(6, 2);
                                DATE_END_SH = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                row = $('<tr class="tamirat_table_report" style="color: #1a45f9;border-radius: 5px"></tr>')
                                row.append(ID_T2, ID_UN, ID_TT, ID_TA, DATE_BEGIN_SH, DATE_END_SH, TIME_WORK_REAL, TIME_WORK_EQUAL,ID_UN2, ID_TA2, ID_TT2)
                                $("#tamirat_table_report2").append(row)
                                karkard_mo3=response.results[i]['TIME_WORK_EQUAL'];
                            }
                        }
                    }
                });
                $('#myModal6').modal('hide');
            }else{
                $('#mizan_kharabi').prop("disabled",true);
                $('#vaz_nasb').prop("disabled",true);
                $('#karkard').prop("disabled",true);
                $('#description').prop("disabled",true);
                $('#insert_historty').prop("disabled",true);
                Swal.fire('برنامه ای توسط شما انتخاب نشد', '', 'Error')
                $("#tamirat_table_report2").empty();
                select_prog=0
            }


         })
        $("#confirm2").on('click',function (event) {
            if(bazsazi_sub_no==0 & id_sub3>0){
                Swal.fire('برای این برنامه بازسازی ،تاریخی تقریبی برای بازگشت قطعات لحاظ نشده. لطفا نسبت به ایجاد آن اقدام گردد', '', 'info')
            }else{
                if(bazsazi_sub_no>0 & id_sub1>0){
                    type_sabegheh='B';
                    // id_sub=0
                    $("#bazsazi_table_report").empty();
                    $("#bazsazi_table_report_secend").empty();
                    if(primary_or_secondary==1){
                        $('#history_type').show();
                        if(select_prog==1){
                            Swal.fire('برنامه بازسازی انتخاب گردید', '', 'info')
                            select_prog=0
                            $('#mizan_kharabi').prop("disabled",false);
                            $('#vaz_nasb').prop("disabled",false);
                            $('#karkard').prop("disabled",false);
                            $('#description').prop("disabled",false);
                            $('#insert_historty').prop("disabled",false);
                        }else{
                            $('#mizan_kharabi').prop("disabled",true);
                            $('#vaz_nasb').prop("disabled",true);
                            $('#karkard').prop("disabled",true);
                            $('#description').prop("disabled",true);
                            $('#insert_historty').prop("disabled",true);
                            $("#tamirat_table_report2").empty();
                            Swal.fire('برنامه ای توسط شما انتخاب نشد', '', 'Error')

                            select_prog=0
                        }
                    }
                    if(primary_or_secondary==2){
                        $('#history_type').show();
                        if(select_prog==1){
                            $('#mizan_kharabi').prop("disabled",false);
                            $('#vaz_nasb').prop("disabled",false);
                            $('#karkard').prop("disabled",false);
                            $('#description').prop("disabled",false);
                            $('#insert_historty').prop("disabled",false);
                            Swal.fire('برنامه بازسازی انتخاب گردید', '', 'info')
                            select_prog=0
                            event.preventDefault();
                            $.ajaxSetup({
                                headers: {
                                    'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            var _token = $("input[name='_token']").val();
                            $.ajax({
                                url: '/tapsr-rep4/'+id_sub1,
                                method: 'GET',
                                success: function (response) {
                                    var day = ''
                                    var month = ''
                                    var year = ''
                                    var ID_SUB  = ''
                                    var ID_SUB2  = ''
                                    var ID_T = ''
                                    var ID_USER = ''
                                    var RESV = ''
                                    var RESV2 = ''
                                    var COUNT_GH = ''
                                    var DATE_SHAMSI = ''
                                    var row = ''
                                    var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td>کد درخواست دریافت</td><td style="text-align: center">وضعیت دریافت</td><td style="text-align: center">تعداد قطعات دریافتی</td><td style="text-align: center">تاریخ دریافت</td></tr>')
                                    $("#tamirat_table_report2").empty();
                                    $("#tamirat_table_report2").append(th)

                                    for (var i = 0; i < response.results.length; i++) {

                                        ID_SUB2 = $('<td style="width: 20%;text-align: center;border-right:1px dotted black">' + response.results[i]['ID_SUB'] + '</td>')
                                        ID_T = $('<td  hidden style="width: 40%;text-align: center">' + response.results[i]['ID_T'] + '</td>')
                                        ID_USER = $('<td hidden style="width: 40%;text-align: center">' + response.results[i]['ID_USER'] + '</td>')
                                        RESV = $('<td hidden style="width: 3%;text-align: center">' + response.results[i]['RESV'] + '</td>')
                                        if(response.results[i]['RESV'] == 1) {
                                            RESV2 = $('<td style="width: 15%;text-align: center;border-right:1px dotted black"><img src="checked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                                        }
                                        if(response.results[i]['RESV'] == 2) {
                                            RESV2 = $('<td style="width: 8%;text-align: center;border-right:1px dotted black"><img src="unchecked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                                        }
                                        year = response.results[i]['DATE_SHAMSI'].substr(0, 4);
                                        month = response.results[i]['DATE_SHAMSI'].substr(4, 2);
                                        day = response.results[i]['DATE_SHAMSI'].substr(6, 2);
                                        DATE_SHAMSI = $('<td style="width: 16%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                        COUNT_GH = $('<td style="width: 15%;text-align: center;border-right:1px dotted black">' + response.results[i]['COUNT_GH'] + '</td>')
                                        row = $('<tr class="bazsazi_table_report_second"></tr>')
                                        row.append(ID_SUB2, ID_T, ID_USER, RESV,RESV2, COUNT_GH, DATE_SHAMSI)
                                        $("#tamirat_table_report2").append(row)
                                    }
                                }
                            });
                        }else{
                            Swal.fire('برنامه ای توسط شما انتخاب نشد', '', 'Error')
                            $('#mizan_kharabi').prop("disabled",true);
                            $('#vaz_nasb').prop("disabled",true);
                            $('#karkard').prop("disabled",true);
                            $('#description').prop("disabled",true);
                            $('#insert_historty').prop("disabled",true);
                            select_prog=0
                            $("#tamirat_table_report2").empty();
                        }

                    }

                    $('#myModal9').modal('hide');
                }else{
                    $('#mizan_kharabi').prop("disabled",true);
                    $('#vaz_nasb').prop("disabled",true);
                    $('#karkard').prop("disabled",true);
                    $('#description').prop("disabled",true);
                    $('#insert_historty').prop("disabled",true);
                    Swal.fire('یکی از برنامه های دریافت از بازسازی انتخاب گردد', '', 'info')
                }
            }


         })
        $("#confirm3").on('click',function (event) {
            if(anbar_sub_no==0 & id_sub3>0){
                Swal.fire('برای این برنامه ورود به انبار ،تاریخی تقریبی برای خروج قطعات لحاظ نشده. لطفا نسبت به ایجاد آن اقدام گردد', '', 'info')
            }else{
                if(anbar_sub_no>0 & id_sub1>0){
                    $("#anbar_table_report").empty();
                    $("#anbar_table_report_secend").empty();
                    type_sabegheh='A';
                    // id_sub=0
                    $('#mizan_kharabi').prop("disabled",false);
                    $('#vaz_nasb').prop("disabled",false);
                    $('#karkard').prop("disabled",false);
                    $('#description').prop("disabled",false);
                    $('#insert_historty').prop("disabled",false);
                    if(primary_or_secondary==1){
                        $('#history_type').show();
                        if(select_prog==1){
                            Swal.fire('برنامه ورود و خروج انبار انتخاب گردید', '', 'info')
                            select_prog=0


                            $.ajaxSetup({
                                headers: {
                                    'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            var _token = $("input[name='_token']").val();
                            $.ajax({
                                url: '/tain-rep4/'+id_t_bazsazi1,
                                method: 'GET',
                                success: function (response) {
                                    var day = ''
                                    var month = ''
                                    var year = ''
                                    var edit1 = ''
                                    var del2 = ''
                                    var detail1 = ''
                                    var select = ''
                                    var ID_T = ''
                                    var ID_USER = ''
                                    var ID_TG = ''
                                    var ID_TG2 = ''
                                    var ID_BA = ''
                                    var ID_BA2 = ''
                                    var GHATAAT_DAMAGE = ''
                                    var GROUP_COUNT=''
                                    var DATE_BEGIN1 = ''
                                    var DISCRIPTION = ''
                                    var row = ''
                                    var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;"><td>کد</td><td style="text-align: center">نوع قطعات</td><td style="text-align: center">وضعیت قطعات</td><td style="text-align: center">تاریخ ارسال</td><td style="text-align: center">تعداد قطعات</td></tr>')
                                    $("#tamirat_table_report2").empty();
                                    $("#tamirat_table_report2").append(th)
                                    for (var i = 0; i < response.results.length; i++) {
                                        for (var j = 0; j < response.ID_TGS.length; j++) {
                                            if (response.ID_TGS[j]['ID_TG'] == response.results[i]['ID_TG']) {
                                                ID_TG = $('<td style="width: 20%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.ID_TGS[j]['GHATAAT_NAME'] + '</td>');
                                                ID_TG2 = $('<td hidden style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_TGS[j]['ID_TG'] + '</td>');
                                                break;
                                            }
                                        }




                                        ID_T = $('<td style="width: 4%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['ID_T'] + '</td>')
                                        GHATAAT_DAMAGE = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.results[i]['GHATAAT_DAMAGE'] + '</td>')
                                        GROUP_COUNT = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.results[i]['GROUP_COUNT'] + '</td>')
                                        DISCRIPTION = $('<td hidden style="width: 40%;text-align: center">' + response.results[i]['DISCRIPTION'] + '</td>')
                                        year = response.results[i]['DATE_SHAMSI'].substr(0, 4);
                                        month = response.results[i]['DATE_SHAMSI'].substr(4, 2);
                                        day = response.results[i]['DATE_SHAMSI'].substr(6, 2);
                                        DATE_BEGIN1 = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                        row = $('<tr></tr>')
                                        row.append(ID_T,ID_TG,GHATAAT_DAMAGE,DATE_BEGIN1, DISCRIPTION,GROUP_COUNT,ID_TG2)
                                        $("#tamirat_table_report2").append(row)
                                    }
                                }


                            });

                        }else{
                            Swal.fire('برنامه ای توسط شما انتخاب نشد', '', 'Error')
                            $('#mizan_kharabi').prop("disabled",true);
                            $('#vaz_nasb').prop("disabled",true);
                            $('#karkard').prop("disabled",true);
                            $('#description').prop("disabled",true);
                            $('#insert_historty').prop("disabled",true);
                            $("#tamirat_table_report2").empty();
                            select_prog=0
                        }
                        event.preventDefault();

                    }
                    if(primary_or_secondary==2){
                        if(select_prog==1){
                            Swal.fire('برنامه ورود و خروج انبار انتخاب گردید', '', 'info')
                            select_prog=0

                            event.preventDefault();
                            $.ajaxSetup({
                                headers: {
                                    'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            var _token = $("input[name='_token']").val();
                            $.ajax({
                                url: '/tain-rep5/'+id_t_bazsazi2,
                                method: 'GET',
                                success: function (response) {

                                    $('#mizan_kharabi').prop("disabled",false);
                                    $('#vaz_nasb').prop("disabled",false);
                                    $('#karkard').prop("disabled",false);
                                    $('#description').prop("disabled",false);
                                    $('#insert_historty').prop("disabled",false);
                                    var day = ''
                                    var month = ''
                                    var year = ''
                                    var ID_SUB  = ''
                                    var ID_SUB2  = ''
                                    var ID_T = ''
                                    var ID_USER = ''
                                    var RESV = ''
                                    var RESV2 = ''
                                    var COUNT_GH = ''
                                    var DATE_SHAMSI = ''
                                    var row = ''
                                    var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td>کد درخواست دریافت</td><td style="text-align: center">وضعیت دریافت</td><td style="text-align: center">تعداد قطعات دریافتی</td><td style="text-align: center">تاریخ دریافت</td></tr>')
                                    $("#tamirat_table_report2").empty();
                                    $("#tamirat_table_report2").append(th)
                                    ID_SUB2 = $('<td style="width: 20%;text-align: center">' + response.results[0]['ID_SUB'] + '</td>')
                                    ID_T = $('<td  hidden style="width: 40%;text-align: center">' + response.results[0]['ID_T'] + '</td>')
                                    RESV = $('<td hidden style="width: 3%;text-align: center">' + response.results[0]['RESV'] + '</td>')
                                    if(response.results[0]['RESV'] == 1) {
                                        RESV2 = $('<td style="width: 15%;text-align: center;border-right:1px dotted black"><img src="checked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                                    }
                                    if(response.results[0]['RESV'] == 2) {
                                        RESV2 = $('<td style="width: 15%;text-align: center;border-right:1px dotted black"><img src="unchecked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                                    }
                                    year = response.results[0]['DATE_SHAMSI2'].substr(0, 4);
                                    month = response.results[0]['DATE_SHAMSI2'].substr(4, 2);
                                    day = response.results[0]['DATE_SHAMSI2'].substr(6, 2);
                                    DATE_SHAMSI = $('<td style="width: 16%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                    COUNT_GH = $('<td style="width: 15%;text-align: center;border-right:1px dotted black">' + response.results[0]['COUNT_GH'] + '</td>')
                                    row = $('<tr class="anbar_table_report_second"></tr>')
                                    row.append(ID_SUB2, ID_T, RESV,RESV2, COUNT_GH, DATE_SHAMSI)
                                    $("#tamirat_table_report2").append(row)
                                }
                            });

                        }else{
                            Swal.fire('برنامه ای توسط شما انتخاب نشد', '', 'Error')
                            $('#mizan_kharabi').prop("disabled",true);
                            $('#vaz_nasb').prop("disabled",true);
                            $('#karkard').prop("disabled",true);
                            $('#description').prop("disabled",true);
                            $('#insert_historty').prop("disabled",true);
                            $("#tamirat_table_report2").empty();
                            select_prog=0
                        }

                    }

                    $('#myModal10').modal('hide');
                }else{
                    Swal.fire('یکی از برنامه های خروج از انبار انتخاب گردد', '', 'info')
                    $('#mizan_kharabi').prop("disabled",true);
                    $('#vaz_nasb').prop("disabled",true);
                    $('#karkard').prop("disabled",true);
                    $('#description').prop("disabled",true);
                    $('#insert_historty').prop("disabled",true);
                    $("#tamirat_table_report2").empty();
                }
            }

         })
        $("#confirm4").on('click',function (event) {
            $("buy_table_report").empty();
            $("buy_table_report_report").empty();
            type_sabegheh='KH';
            id_sub=0
            $('#mizan_kharabi').prop("disabled",false);
            $('#vaz_nasb').prop("disabled",false);
            $('#karkard').prop("disabled",false);
            $('#description').prop("disabled",false);
            $('#insert_historty').prop("disabled",false);
            if(true){
                $('#history_type').show();
                if(select_prog==1){
                    Swal.fire('برنامه خرید انتخاب گردید', '', 'info')
                    $("#tamirat_table_report").empty();
                    select_prog=0
                    event.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    var _token = $("input[name='_token']").val();
                    $.ajax({
                        url: '/buy-rep5/'+id_t_bazsazi1,
                        method: 'GET',
                        success: function (response) {
                            if(true){
                                var day = ''
                                var month = ''
                                var year = ''
                                var edit1 = ''
                                var del2 = ''
                                var detail1 = ''
                                var select = ''
                                var ID_T = ''
                                var ID_USER = ''
                                var ID_TG = ''
                                var ID_TG2 = ''
                                var ID_SE = ''
                                var ID_SE2 = ''
                                var GROUP_COUNT=''
                                var DATE_SHAMSI = ''
                                var DISCRIPTION = ''
                                var SHOMAREH_GHARAR = ''
                                var BUY_CONDITION = ''
                                var BUY_CONDITION2 = ''
                                var RESV = ''
                                var RESV2 = ''
                                var t1 = ''
                                var t2 = ''
                                var t3 = ''
                                var t4 = ''
                                var row = ''
                                var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;"><td>کد</td><td style="text-align: right">نوع قطعات</td><td style="text-align: right">فروشنده</td><td style="text-align: center">تاریخ خرید</td><td style="text-align: center">تعداد قطعات</td><td style="text-align: center">شماره قرارداد</td><td style="text-align: center">وضعیت خرید</td></tr>')
                                $("#tamirat_table_report2").empty();
                                $("#tamirat_table_report2").append(th)

                                for (var i = 0; i < response.results.length; i++) {
                                    for (var j = 0; j < response.ID_TGS.length; j++) {
                                        if (response.ID_TGS[j]['ID_TG'] == response.results[i]['ID_TG']) {
                                            ID_TG = $('<td style="width: 30%;font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_TGS[j]['GHATAAT_NAME'] + '</td>');
                                            ID_TG2 = $('<td hidden style="font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_TGS[j]['ID_TG'] + '</td>');
                                            break;
                                        }
                                    }
                                    for (var j = 0; j < response.ID_SES.length; j++) {
                                        if (response.ID_SES[j]['ID_SE'] == response.results[i]['ID_SE']) {
                                            ID_SE = $('<td style="width: 30%;font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_SES[j]['SELLER'] + '</td>');
                                            ID_SE2 = $('<td hidden style="font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_SES[j]['ID_SE'] + '</td>');
                                            break;
                                        }
                                    }
                                    ID_T = $('<td style="width: 4%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['ID_T'] + '</td>')
                                    SHOMAREH_GHARAR = $('<td style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['SHOMAREH_GHARAR'] + '</td>')
                                    BUY_CONDITION2 = $('<td hidden style="text-align: center;font-size: x-small">' + response.results[i]['BUY_CONDITION'] + '</td>')
                                    if (response.results[i]['BUY_CONDITION'] == 1) {
                                        BUY_CONDITION = $('<td hidden style="width: 23%;text-align: center;font-size: x-small">یک</td>')
                                    }
                                    if (response.results[i]['BUY_CONDITION'] == 2) {
                                        BUY_CONDITION = $('<td hidden style="width: 23%;text-align: center;font-size: x-small">دو</td>')
                                    }
                                    if (response.results[i]['BUY_CONDITION'] == 3) {
                                        BUY_CONDITION = $('<td hidden style="width: 23%;text-align: center;font-size: x-small">سه</td>')
                                    }
                                    if (response.results[i]['BUY_CONDITION'] == 4) {
                                        BUY_CONDITION = $('<td hidden style="width: 23%;text-align: center;font-size: x-small">چهار</td>')
                                    }
                                    GROUP_COUNT = $('<td style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['GROUP_COUNT'] + '</td>')
                                    RESV2 = $('<td hidden style="font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['RESV'] + '</td>')
                                    DISCRIPTION = $('<td hidden style="text-align: right">' + response.results[i]['DISCRIPTION'] + '</td>')
                                    if (response.results[i]['RESV'] == 1) {
                                        RESV = $('<td style="width: 5%;text-align: center"><img src="checked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                                    }
                                    if (response.results[i]['RESV'] == 2) {
                                        RESV = $('<td style="width: 5%;text-align: center"><img src="unchecked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                                    }
                                    year = response.results[i]['DATE_SHAMSI'].substr(0, 4);
                                    month = response.results[i]['DATE_SHAMSI'].substr(4, 2);
                                    day = response.results[i]['DATE_SHAMSI'].substr(6, 2);
                                    DATE_SHAMSI = $('<td style="width: 6%;font-family: Tahoma;font-size: 10px;text-align: center">' + year + '/' + month + '/' + day + '</td>')
                                    row = $('<tr class="table1"></tr>')
                                    row = $('<tr class="table1"></tr>')

                                    row.append(ID_T,ID_TG,ID_SE, DATE_SHAMSI,GROUP_COUNT,SHOMAREH_GHARAR,DISCRIPTION,BUY_CONDITION,ID_TG2,ID_SE2,RESV,RESV2,BUY_CONDITION2)
                                    $("#tamirat_table_report2").append(row)
                                }
                            }

                        }

                    });
                }else{
                    Swal.fire('برنامه ای توسط شما انتخاب نشد', '', 'Error')
                    $('#mizan_kharabi').prop("disabled",true);
                    $('#vaz_nasb').prop("disabled",true);
                    $('#karkard').prop("disabled",true);
                    $('#description').prop("disabled",true);
                    $('#insert_historty').prop("disabled",true);
                    $("#tamirat_table_report2").empty();
                    select_prog=0
                }

            }
            $('#myModal11').modal('hide');
         })
        $("#confirm5").on('click',function (event) {

            type_sabegheh='O';
            id_sub=0
            $('#mizan_kharabi').prop("disabled",false);
            $('#vaz_nasb').prop("disabled",false);
            $('#karkard').prop("disabled",false);
            $('#description').prop("disabled",false);
            $('#insert_historty').prop("disabled",false);
            if(true){
                $('#history_type').show();
                if(select_prog==1){
                    Swal.fire('برنامه ورود و خروج انتخاب گردید', '', 'info')
                    select_prog=0
                    event.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    var _token = $("input[name='_token']").val();
                    $.ajax({
                        url: '/out-rep5/'+id_t_bazsazi1,
                        method: 'GET',
                        success: function (response) {
                            if (response.results.length > 0) {
                                toastr.info('اطلاعات درخواستی دریافت شد');
                                $("#add_recieve").hide();
                                $("#description2").text('');
                                $("#ID_T_SUB2").text('');
                                $("#tamirat_table_report2").empty();
                                var day = ''
                                var month = ''
                                var year = ''
                                var edit1 = ''
                                var del2 = ''
                                var detail1 = ''
                                var select = ''
                                var ID_T = ''
                                var ID_USER = ''
                                var ID_TG = ''
                                var ID_TG2 = ''
                                var ID_BA = ''
                                var ID_BA2 = ''
                                var GROUP_COUNT = ''
                                var DATE_SHAMSI = ''
                                var DISCRIPTION = ''
                                var LOCATION_NAME=''
                                var OUT_IN = ''
                                var OUT_IN2 = ''
                                var t1 = ''
                                var t2 = ''
                                var t3 = ''
                                var t4 = ''
                                var row = ''
                                var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;"><td>#</td><td>کد</td><td style="text-align: center">نوع قطعات</td><td style="text-align: center">مبدا یا مقصد</td><td style="text-align: center">تاریخ ارسال</td><td style="text-align: center">تعداد قطعات</td><td style="text-align: center">نوع ارسال</td></tr>')
                                $("#tamirat_table_report2").empty();
                                $("#tamirat_table_report2").append(th)
                                for (var i = 0; i < response.results.length; i++) {
                                    for (var j = 0; j < response.ID_TGS.length; j++) {
                                        if (response.ID_TGS[j]['ID_TG'] == response.results[i]['ID_TG']) {
                                            ID_TG = $('<td style="width: 20%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.ID_TGS[j]['GHATAAT_NAME'] + '</td>');
                                            ID_TG2 = $('<td hidden style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.ID_TGS[j]['ID_TG'] + '</td>');
                                            break;
                                        }
                                    }

                                    select = $('<button type="button" class="btn-sm border-info select_send" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%">>></button>').on('click', function (event) {
                                        var id_t1 = $(this).closest('tr').find('td:eq(1)').text()
                                        id_t_bazsazi1=id_t1
                                        id_t_bazsazi2=0
                                        $("tr.table1").css("background-color", "white");
                                        $("tr.table1").css("color", "black");
                                        $(this).closest('tr.table1').css("background-color", "cornflowerblue");
                                        $(this).closest('tr.table1').css("color", "white");
                                        select_prog=1;
                                    })

                                    ID_T = $('<td style="width: 4%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['ID_T'] + '</td>')
                                    LOCATION_NAME = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['LOCATION_NAME'] + '</td>')
                                    GROUP_COUNT = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['GROUP_COUNT'] + '</td>')
                                    DISCRIPTION = $('<td hidden style="width: 40%;text-align: center">' + response.results[i]['DISCRIPTION'] + '</td>')
                                    if(response.results[i]['OUT_IN']==1){
                                        OUT_IN = $('<td style="width: 4%;text-align: center;font-family: Tahoma;font-size: 10px">ورود</td>')
                                    }
                                    if(response.results[i]['OUT_IN']==2){
                                        OUT_IN = $('<td style="width: 4%;text-align: center;font-family: Tahoma;font-size: 10px">خروج</td>')
                                    }
                                    OUT_IN2 = $('<td hidden style="width: 40%;text-align: center">' + response.results[i]['OUT_IN'] + '</td>')
                                    year = response.results[i]['DATE_SHAMSI'].substr(0, 4);
                                    month = response.results[i]['DATE_SHAMSI'].substr(4, 2);
                                    day = response.results[i]['DATE_SHAMSI'].substr(6, 2);
                                    DATE_SHAMSI = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center">' + year + '/' + month + '/' + day + '</td>')
                                    t1 = $('<td style="width: 4%"></td>')
                                    t1.append(edit1)
                                    t2 = $('<td style="width: 4%"></td>')
                                    t2.append(del2)
                                    t3 = $('<td style="width: 4%"></td>')
                                    t3.append(detail1)
                                    t4 = $('<td style="width: 4%"></td>')
                                    t4.append(select)
                                    row = $('<tr class="table1"></tr>')
                                    row.append(t4, ID_T, ID_TG, LOCATION_NAME, DATE_SHAMSI, DISCRIPTION, GROUP_COUNT, ID_TG2,OUT_IN,OUT_IN2)
                                    $("#tamirat_table_report2").append(row)
                                }
                            }else{
                                Swal.fire('موردی یافت نشد', '', 'info')
                                $("#tamirat_table_report2").empty();
                                $("#description2").text('');
                            }
                        }
                    });
                    $('#myModal12').modal('hide');
                }else{
                    Swal.fire('برنامه ای توسط شما انتخاب نشد', '', 'Error')
                    $('#mizan_kharabi').prop("disabled",true);
                    $('#vaz_nasb').prop("disabled",true);
                    $('#karkard').prop("disabled",true);
                    $('#description').prop("disabled",true);
                    $('#insert_historty').prop("disabled",true);
                    $("#tamirat_table_report2").empty();
                    select_prog=0
                }

            }

         })

        $("#tprep_form").on('submit', function (event) {

            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: "/tapr-rep",
                method: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.results.length>0){
                        var day = ''
                        var month = ''
                        var year = ''
                        var select = ''
                        var del2 = ''
                        var detail1 = ''
                        var ID_T = ''
                        var ID_T2 = ''
                        var ID_USER = ''
                        var ID_UN = ''
                        var ID_UN2 = ''
                        var ID_TT = ''
                        var ID_TT2 = ''
                        var ID_TA = ''
                        var ID_TA2 = ''
                        var TIME_WORK_REAL = ''
                        var TIME_WORK_EQUAL = ''
                        var DISCRIPTION = ''
                        var ANGAM = ''
                        var CONFIR = ''
                        var ANGAM2 = ''
                        var CONFIR2 = ''
                        var DATE_BEGIN_SH = ''
                        var DATE_END_SH = ''
                        var FILE_NAME = ''
                        var t1 = ''
                        var t2 = ''
                        var t3 = ''
                        var row = ''
                        var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;"><td>#</td><td>کد</td><td style="text-align: center">واحد</td><td style="text-align: center">نوع تعمیرات</td><td style="text-align: center">شرکت تعمیرکار</td><td style="text-align: center">شروع تعمیرات</td><td style="text-align: center">پایان تعمیرات</td><td style="text-align: center">کارکرد واقعی</td><td style="text-align: center">کارکرد معادل</td><td style="text-align: center">تایید شد</td><td style="text-align: center">انجام شد</td></tr>')
                        $("#tamirat_table_report").empty();
                        $("#tamirat_table_report").append(th)
                        for (var i = 0; i < response.results.length; i++) {
                            for (var j = 0; j < response.ID_UNS.length; j++) {
                                if (response.ID_UNS[j]['ID_UN'] == response.results[i]['ID_UN']) {
                                    ID_UN = $('<td style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.ID_UNS[j]['UNIT_NUMBER'] + '</td>');
                                    ID_UN2 = $('<td hidden style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.ID_UNS[j]['ID_UN'] + '</td>');
                                    break;
                                }
                            }
                            for (var j = 0; j < response.ID_TAS.length; j++) {
                                if (response.ID_TAS[j]['ID_TA'] == response.results[i]['ID_TA']) {
                                    ID_TA = $('<td style="width: 20%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.ID_TAS[j]['TAMIRKAR'] + '</td>');
                                    ID_TA2 = $('<td hidden style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.ID_TAS[j]['ID_TA'] + '</td>');
                                    break;
                                }
                            }
                            for (var j = 0; j < response.ID_TTS.length; j++) {
                                if (response.ID_TTS[j]['ID_TT'] == response.results[i]['ID_TT']) {
                                    ID_TT = $('<td style="width: 14%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.ID_TTS[j]['TAMIRAT_TYPE'] + '</td>');
                                    ID_TT2 = $('<td hidden style="width: 17%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.ID_TTS[j]['ID_TT'] + '</td>');
                                    break;
                                }
                            }
                            for (var z = 0; z < response.ID_USERS.length; z++) {
                                if (response.ID_USERS[z]['id'] == response.results[i]['ID_USER']) {
                                    ID_USER = $('<td hidden style="width: 7%">' + response.ID_USERS[z]['l_name'] + '</td>')
                                    break;
                                }
                            }
                            select = $('<button type="button" class="btn-sm border-info select_group" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%;height: 20px;padding-top:1px"><p>>></p></button>').on('click', function (event) {
                                if(button_type==1){
                                    id_t1 = $(this).closest('tr').find('td:eq(1)').text()
                                    id_t_bazsazi1=id_t1
                                }
                                if(button_type==2){
                                    id_t2 = $(this).closest('tr').find('td:eq(1)').text()
                                    id_t_bazsazi1=id_t2

                                }
                                $('#id_t1_edit').val($(this).closest('tr').find('td:eq(1)').text())
                                $('#barnameh_edit').val($(this).closest('tr').find('td:eq(3)').text())
                                id_t3 = $(this).closest('tr').find('td:eq(1)').text()
                                id_t1 = $(this).closest('tr').find('td:eq(1)').text()
                                karkard_mo = $(this).closest('tr').find('td:eq(8)').text()
                                id_t_bazsazi1=id_t3
                                id_sub = 0;
                                $("tr.tamirat_table_report").css("background-color", "white");
                                $("tr.tamirat_table_report").css("color", "black");
                                $(this).closest('tr.tamirat_table_report').css("background-color", "#66CDAA");
                                $(this).closest('tr.tamirat_table_report').css("color", "white");
                                select_prog=1;

                            })
                            ID_T2 = $('<td style="font-family: Tahoma;font-size: 10px;text-align: center;width: 5%">' + response.results[i]['ID_T'] + '</td>')
                            if (response.results[i]['FILE_NAME'] == "فایل پیوست ندارد") {
                                ID_T = $('<td class="id_gr" style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black"><a style="visibility: hidden" href=' + 'images/' + response.results[i]['FILE_NAME'] + '><img src="attachment.jpg" class="rounded-circle" alt="Cinque Terre"></a>' + response.results[i]['ID_T'] + '</td>')
                            } else {
                                ID_T = $('<td class="id_gr" style="width: 8%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black"><a href=' + 'images/' + response.results[i]['FILE_NAME'] + '><img src="attachment.jpg" class="rounded-circle" alt="Cinque Terre"></a>' + response.results[i]['ID_T'] + '</td>')
                            }
                            TIME_WORK_REAL = $('<td style="width: 6%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.results[i]['TIME_WORK_REAL'] + '</td>')
                            TIME_WORK_EQUAL = $('<td style="width: 6%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.results[i]['TIME_WORK_EQUAL'] + '</td>')
                            DISCRIPTION = $('<td hidden style="width: 40%;text-align: center">' + response.results[i]['DISCRIPTION;border-right:1px dotted black'] + '</td>')
                            ANGAM = $('<td hidden style="width: 40%;text-align: center">' + response.results[i]['ANGAM'] + '</td>')
                            CONFIR = $('<td hidden style="width: 40%;text-align: center">' + response.results[i]['CONFIR'] + '</td>')
                            if (response.results[i]['ANGAM'] == 1) {
                                ANGAM2 = $('<td  style="width: 5%;text-align: center;border-right:1px dotted black"><img src="checked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                            }
                            if (response.results[i]['ANGAM'] == 2) {
                                ANGAM2 = $('<td  style="width: 5%;text-align: center;border-right:1px dotted black"><img src="unchecked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                            }
                            if (response.results[i]['CONFIR'] == 1) {
                                CONFIR2 = $('<td  style="width: 5%;text-align: center;border-right:1px dotted black"><img src="checked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                            }
                            if (response.results[i]['CONFIR'] == 2) {
                                CONFIR2 = $('<td  style="width: 5%;text-align: center;border-right:1px dotted black"><img src="unchecked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                            }
                            year = response.results[i]['DATE_BEGIN_SH'].substr(0, 4);
                            month = response.results[i]['DATE_BEGIN_SH'].substr(4, 2);
                            day = response.results[i]['DATE_BEGIN_SH'].substr(6, 2);
                            DATE_BEGIN_SH = $('<td style="width: 5%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                            year = response.results[i]['DATE_END_SH'].substr(0, 4);
                            month = response.results[i]['DATE_END_SH'].substr(4, 2);
                            day = response.results[i]['DATE_END_SH'].substr(6, 2);
                            DATE_END_SH = $('<td style="width: 5%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                            FILE_NAME = $('<td hidden style="width: 40%;text-align: right;border-right:1px dotted black">' + response.results[i]['FILE_NAME'] + '</td>')
                            t1 = $('<td style="width: 5%"></td>')
                            t1.append(select)
                            row = $('<tr class="tamirat_table_report"></tr>')
                            row.append(t1,ID_T2, ID_UN, ID_TT, ID_TA, DATE_BEGIN_SH, DATE_END_SH, TIME_WORK_REAL, TIME_WORK_EQUAL, DISCRIPTION, ANGAM, CONFIR, FILE_NAME, ID_USER, ID_UN2, ID_TA2, ID_TT2, CONFIR2,ANGAM2)
                            $("#tamirat_table_report").append(row)
                        }
                    }else{
                        Swal.fire('موردی یافت نشد', '', 'info')
                        $("#tamirat_table_report").empty();
                    }


                }


          });
         })
        $("#tp_baz_rep_form").on('submit', function (event) {

            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: "/tapsr-rep",
                method: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success: function (response) {

                    $("#add_recieve").hide();
                    $("#description2").text('');
                    $("#ID_T_SUB2").text('');
                    $("#bazsazi_table_report_secend").empty();
                    var select=''
                    var day = ''
                    var month = ''
                    var year = ''
                    var edit1 = ''
                    var del2 = ''
                    var detail1 = ''
                    var select = ''
                    var ID_T = ''
                    var ID_USER = ''
                    var ID_TG = ''
                    var ID_TG2 = ''
                    var ID_BA = ''
                    var ID_BA2 = ''
                    var SHOMAREH_GHARAR = ''
                    var GROUP_COUNT=''
                    var DATE_BEGIN1 = ''
                    var DISCRIPTION = ''
                    var t1 = ''
                    var t2 = ''
                    var t3 = ''
                    var t4 = ''
                    var row = ''
                    var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;"><td>#</td><td>کد</td><td style="text-align: center">شماره قرارداد</td><td style="text-align: center">نوع قطعات</td><td style="text-align: center">بازسازی کننده</td><td style="text-align: center">تاریخ ارسال</td><td style="text-align: center">تعداد قطعات</td></tr>')
                    $("#bazsazi_table_report").empty();
                    $("#bazsazi_table_report").append(th)

                    for (var i = 0; i < response.results.length; i++) {
                        for (var j = 0; j < response.ID_TGS.length; j++) {
                            if (response.ID_TGS[j]['ID_TG'] == response.results[i]['ID_TG']) {
                                ID_TG = $('<td style="width: 20%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.ID_TGS[j]['GHATAAT_NAME'] + '</td>');
                                ID_TG2 = $('<td hidden style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_TGS[j]['ID_TG'] + '</td>');
                                break;
                            }
                        }
                        for (var j = 0; j < response.ID_BAS.length; j++) {
                            if (response.ID_BAS[j]['ID_BA'] == response.results[i]['ID_BA']) {
                                ID_BA = $('<td style="width: 20%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.ID_BAS[j]['BAZSAZ'] + '</td>');
                                ID_BA2 = $('<td hidden style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_BAS[j]['ID_BA'] + '</td>');
                                break;
                            }
                        }
                        for (var z = 0; z < response.ID_USERS.length; z++) {
                            if (response.ID_USERS[z]['id'] == response.results[i]['ID_USER']) {
                                ID_USER = $('<td hidden style="width: 7%">' + response.ID_USERS[z]['l_name'] + '</td>')
                                break;
                            }
                        }

                        select = $('<button type="button" class="btn-sm btn-info select_send" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%">>></button>').on('click',function (event) {
                            bazsazi_sub_no=0
                            id_sub1=0;
                            $("#bazsazi_table_report_secend").empty();
                            event.preventDefault();
                            if(button_type==1){
                                id_t1 = $(this).closest('tr').find('td:eq(1)').text()
                            }
                            if(button_type==2){
                                id_t2 = $(this).closest('tr').find('td:eq(1)').text()
                            }
                            id_t1 = $(this).closest('tr').find('td:eq(1)').text()
                            $('#id_t1_edit').val($(this).closest('tr').find('td:eq(1)').text())
                            $('#barnameh_edit').val($(this).closest('tr').find('td:eq(3)').text())
                            id_sub3 = $(this).closest('tr').find('td:eq(1)').text()
                            id_t_bazsazi1 = $(this).closest('tr').find('td:eq(1)').text()
                            id_t_bazsazi2=0
                            // id_sub = 0;
                            $("tr.bazsazi_table_report").css("background-color", "white");
                            $("tr.bazsazi_table_report").css("color", "black");
                            $(this).closest('tr.bazsazi_table_report').css("background-color", "#9abacd");
                            $(this).closest('tr.bazsazi_table_report').css("color", "white");
                            select_prog=1;
                            primary_or_secondary=1;
                            $.ajaxSetup({
                                headers: {
                                    'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            var _token = $("input[name='_token']").val();
                            $.ajax({
                                url: '/resvs_for_send/' + id_sub3,
                                method:'GET',
                                success: function (response) {
                                    bazsazi_sub_no=response.results.length
                                    var select=''
                                    var day = ''
                                    var month = ''
                                    var year = ''
                                    var edit1 = ''
                                    var del2 = ''
                                    var detail1 = ''
                                    var ID_SUB  = ''
                                    var ID_SUB2  = ''
                                    var ID_T = ''
                                    var ID_USER = ''
                                    var RESV = ''
                                    var RESV2 = ''
                                    var COUNT_GH = ''
                                    var DATE_SHAMSI = ''
                                    var FILE_NAME = ''
                                    var t1 = ''
                                    var t2 = ''
                                    var t3 = ''
                                    var row = ''
                                    var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td>#</td><td>کد درخواست دریافت</td><td style="text-align: center">وضعیت دریافت</td><td style="text-align: center">تعداد قطعات دریافتی</td><td style="text-align: center">تاریخ دریافت</td></tr>')
                                    $("#bazsazi_table_report_secend").empty();
                                    $("#bazsazi_table_report_secend").append(th)
                                    for (var i = 0; i < response.results.length; i++) {
                                        select = $('<button type="button" class="btn-sm btn-info select_send" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%">>></button>').on('click',function (event) {
                                            event.preventDefault();
                                            if(button_type==1){
                                                id_t1 = $(this).closest('tr').find('td:eq(1)').text()
                                            }
                                            if(button_type==2){
                                                id_t2 = $(this).closest('tr').find('td:eq(1)').text()
                                            }
                                            $('#id_t1_edit').val($(this).closest('tr').find('td:eq(1)').text())
                                            $('#barnameh_edit').val($(this).closest('tr').find('td:eq(3)').text())
                                            id_sub1 = $(this).closest('tr').find('td:eq(1)').text()
                                            id_t_bazsazi2 = $(this).closest('tr').find('td:eq(1)').text()

                                            id_sub = id_sub1;
                                            $("tr.bazsazi_table_report_second").css("background-color", "white");
                                            $("tr.bazsazi_table_report_second").css("color", "black");
                                            $(this).closest('tr.bazsazi_table_report_second').css("background-color", "#66CDAA");
                                            $(this).closest('tr.bazsazi_table_report_second').css("color", "white");
                                            primary_or_secondary=2;



                                        })
                                        if(response.results[i]['FILE_NAME']=="فایل پیوست ندارد"){
                                            ID_SUB = $('<td class="id_gr" style="width: 15%;font-family: Tahoma;font-size: 10px;text-align: center"><a style="visibility: hidden" href='+'images/'+response.results[i]['FILE_NAME']+'><img src="attachment2.png" class="rounded-circle" alt="Cinque Terre"></a>' + response.results[i]['ID_SUB'] + '</td>')
                                        }else{
                                            ID_SUB = $('<td class="id_gr" style="width: 15%;font-family: Tahoma;font-size: 10px;text-align: center"><a href='+'images/'+response.results[i]['FILE_NAME']+'><img src="attachment2.png" class="rounded-circle" alt="Cinque Terre"></a>' + response.results[i]['ID_SUB'] + '</td>')
                                        }
                                        ID_SUB2 = $('<td  hidden style="width: 40%;text-align: right">' + response.results[i]['ID_SUB'] + '</td>')
                                        ID_T = $('<td  hidden style="width: 40%;text-align: right">' + response.results[i]['ID_T'] + '</td>')
                                        ID_USER = $('<td hidden style="width: 40%;text-align: right">' + response.results[i]['ID_USER'] + '</td>')
                                        RESV = $('<td hidden style="width: 3%;text-align: right">' + response.results[i]['RESV'] + '</td>')
                                        if(response.results[i]['RESV'] == 1) {
                                            RESV2 = $('<td style="width: 15%;text-align: center;border-right:1px dotted black"><img src="checked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                                        }
                                        if(response.results[i]['RESV'] == 2) {
                                            RESV2 = $('<td style="width: 8%;text-align: center;border-right:1px dotted black"><img src="unchecked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                                        }
                                        if(response.results[i]['DATE_SHAMSI'] != '---') {
                                            year = response.results[i]['DATE_SHAMSI'].substr(0, 4);
                                            month = response.results[i]['DATE_SHAMSI'].substr(4, 2);
                                            day = response.results[i]['DATE_SHAMSI'].substr(6, 2);
                                            DATE_SHAMSI = $('<td style="width: 16%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                        }else{
                                            DATE_SHAMSI = $('<td style="width: 16%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">بدون تاریخ</td>')
                                        }

                                        FILE_NAME = $('<td hidden style="width: 40%;text-align: center;border-right:1px dotted black">' + response.results[i]['FILE_NAME'] + '</td>')
                                        COUNT_GH = $('<td style="width: 15%;text-align: center;border-right:1px dotted black">' + response.results[i]['COUNT_GH'] + '</td>')
                                        t1 = $('<td style="width: 5%"></td>')
                                        t1.append(select)
                                        row = $('<tr class="bazsazi_table_report_second"></tr>')
                                        row.append(t1,ID_SUB, ID_T, ID_USER, RESV,RESV2, COUNT_GH, DATE_SHAMSI, FILE_NAME,ID_SUB2)
                                        $("#bazsazi_table_report_secend").append(row)
                                    }
                                }
                            })


                        })
                        ID_T = $('<td style="width: 4%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['ID_T'] + '</td>')
                        SHOMAREH_GHARAR = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.results[i]['SHOMAREH_GHARAR'] + '</td>')
                        GROUP_COUNT = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.results[i]['GROUP_COUNT'] + '</td>')
                        DISCRIPTION = $('<td hidden style="width: 40%">' + response.results[i]['DISCRIPTION'] + '</td>')
                        year = response.results[i]['DATE_BEGIN1'].substr(0, 4);
                        month = response.results[i]['DATE_BEGIN1'].substr(4, 2);
                        day = response.results[i]['DATE_BEGIN1'].substr(6, 2);
                        DATE_BEGIN1 = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                        t4 = $('<td style="width: 4%"></td>')
                        t4.append(select)
                        row = $('<tr class="bazsazi_table_report"></tr>')
                        row.append(t4,ID_T, SHOMAREH_GHARAR,ID_TG,ID_BA, DATE_BEGIN1, DISCRIPTION,GROUP_COUNT,ID_TG2,ID_BA2)
                        $("#bazsazi_table_report").append(row)
                    }
                }
            });
         })
        $("#tp_anbar_rep_form").on('submit', function (event) {
           $("#anbar_table_report_secend").empty();
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                var _token = $("input[name='_token']").val();
                $.ajax({
                    url: "/tain-rep",
                    method: 'POST',
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        var day = ''
                        var month = ''
                        var year = ''
                        var edit1 = ''
                        var del2 = ''
                        var detail1 = ''
                        var select = ''
                        var ID_T = ''
                        var ID_USER = ''
                        var ID_TG = ''
                        var ID_TG2 = ''
                        var ID_BA = ''
                        var ID_BA2 = ''
                        var GHATAAT_DAMAGE = ''
                        var GROUP_COUNT=''
                        var DATE_BEGIN1 = ''
                        var DISCRIPTION = ''
                        var t1 = ''
                        var t2 = ''
                        var t3 = ''
                        var t4 = ''
                        var row = ''
                        var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;"><td>#</td><td>کد</td><td style="text-align: center">نوع قطعات</td><td style="text-align: center">وضعیت قطعات</td><td style="text-align: center">تاریخ ارسال</td><td style="text-align: center">تعداد قطعات</td></tr>')
                        $("#anbar_table_report").empty();
                        $("#anbar_table_report").append(th)

                        for (var i = 0; i < response.results.length; i++) {
                            for (var j = 0; j < response.ID_TGS.length; j++) {
                                if (response.ID_TGS[j]['ID_TG'] == response.results[i]['ID_TG']) {
                                    ID_TG = $('<td style="width: 20%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.ID_TGS[j]['GHATAAT_NAME'] + '</td>');
                                    ID_TG2 = $('<td hidden style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_TGS[j]['ID_TG'] + '</td>');
                                    break;
                                }
                            }
                            for (var z = 0; z < response.ID_USERS.length; z++) {
                                if (response.ID_USERS[z]['id'] == response.results[i]['ID_USER']) {
                                    ID_USER = $('<td hidden style="width: 7%">' + response.ID_USERS[z]['l_name'] + '</td>')
                                    break;
                                }
                            }

                            select = $('<button type="button" class="btn-sm border-info select_send" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%">>></button>').on('click',function (event) {
                                anbar_sub_no=0
                                id_sub1=0;
                                $("#bazsazi_table_report_secend").empty();
                                $("#add_recieve").show()
                                event.preventDefault();
                                $('#description2').text($(this).closest('tr').find('td:eq(5)').text())

                                var id_t=$(this).closest('tr').find('td:eq(1)').text()
                                id_t1=id_t;
                                id_t_bazsazi1=id_t

                                id_sub3 = $(this).closest('tr').find('td:eq(1)').text()
                                id_t_bazsazi1 = $(this).closest('tr').find('td:eq(1)').text()
                                id_t_bazsazi2=0
                                // id_sub = id_sub3;

                                $("tr.anbar_table_report").css("background-color", "white");
                                $("tr.anbar_table_report").css("color", "black");
                                $(this).closest('tr.anbar_table_report').css( "background-color","#66CDAA");
                                $(this).closest('tr.anbar_table_report').css( "color", "white" );
                                select_prog=1;
                                $('#ID_T_SUB2').val($(this).closest('tr').find('td:eq(1)').text())
                                primary_or_secondary=1
                                $.ajaxSetup({
                                    headers: {
                                        'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                    }
                                });
                                var _token = $("input[name='_token']").val();
                                $.ajax({
                                    url: '/resvs_for_out/' + id_t,
                                    method:'GET',
                                    success: function (response) {
                                        anbar_sub_no=response.results.length
                                        var day = ''
                                        var month = ''
                                        var year = ''
                                        var select = ''
                                        var ID_SUB2  = ''
                                        var ID_T = ''
                                        var ID_USER = ''
                                        var RESV = ''
                                        var RESV2 = ''
                                        var COUNT_GH = ''
                                        var DATE_SHAMSI = ''
                                        var t1 = ''
                                        var row = ''
                                        var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td>#</td><td>کد خروج</td><td style="text-align: center">وضعیت خروج</td><td style="text-align: center">تعداد خارج شده</td><td style="text-align: center">تاریخ خروج</td></tr>')
                                        $("#anbar_table_report_secend").empty();
                                        $("#anbar_table_report_secend").append(th)
                                        for (var i = 0; i < response.results.length; i++) {
                                            select = $('<button type="button" class="btn-sm btn-info select_send" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%">>></button>').on('click',function (event) {
                                                event.preventDefault();
                                                if(button_type==1){
                                                    id_t1 = $(this).closest('tr').find('td:eq(1)').text()
                                                }
                                                if(button_type==2){
                                                    id_t2 = $(this).closest('tr').find('td:eq(1)').text()
                                                }
                                                $('#id_t1_edit').val($(this).closest('tr').find('td:eq(1)').text())
                                                $('#barnameh_edit').val($(this).closest('tr').find('td:eq(3)').text())
                                                id_sub1 = $(this).closest('tr').find('td:eq(1)').text()
                                                id_t_bazsazi2 = $(this).closest('tr').find('td:eq(1)').text()

                                                id_sub = id_sub1;
                                                $("tr.anbar_table_report_secend").css("background-color", "white");
                                                $("tr.anbar_table_report_secend").css("color", "black");
                                                $(this).closest('tr.anbar_table_report_secend').css("background-color", "#9abacd");
                                                $(this).closest('tr.anbar_table_report_secend').css("color", "white");
                                                primary_or_secondary=2

                                                $.ajaxSetup({
                                                    headers: {
                                                        'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                                    }
                                                });
                                                var _token = $("input[name='_token']").val();
                                                $.ajax({
                                                    url: '/resvs_for_send/' + id_sub3,
                                                    method:'GET',
                                                    success: function (response) {
                                                        var select=''
                                                        var day = ''
                                                        var month = ''
                                                        var year = ''
                                                        var ID_SUB  = ''
                                                        var ID_SUB2  = ''
                                                        var ID_T = ''
                                                        var ID_USER = ''
                                                        var RESV = ''
                                                        var RESV2 = ''
                                                        var COUNT_GH = ''
                                                        var DATE_SHAMSI = ''
                                                        var FILE_NAME = ''
                                                        var t1 = ''
                                                        var t2 = ''
                                                        var t3 = ''
                                                        var row = ''
                                                        var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;text-align: center"><td>#</td><td>کد درخواست دریافت</td><td style="text-align: center">وضعیت دریافت</td><td style="text-align: center">تعداد قطعات دریافتی</td><td style="text-align: center">تاریخ دریافت</td></tr>')
                                                        $("#bazsazi_table_report_secend").empty();
                                                        $("#bazsazi_table_report_secend").append(th)
                                                        for (var i = 0; i < response.results.length; i++) {
                                                            select = $('<button type="button" class="btn-sm btn-info select_send" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%">>></button>').on('click',function (event) {
                                                                event.preventDefault();
                                                                if(button_type==1){
                                                                    id_t1 = $(this).closest('tr').find('td:eq(1)').text()
                                                                }
                                                                if(button_type==2){
                                                                    id_t2 = $(this).closest('tr').find('td:eq(1)').text()
                                                                }
                                                                $('#id_t1_edit').val($(this).closest('tr').find('td:eq(1)').text())
                                                                $('#barnameh_edit').val($(this).closest('tr').find('td:eq(3)').text())
                                                                id_sub1 = $(this).closest('tr').find('td:eq(1)').text()
                                                                id_t_bazsazi2 = $(this).closest('tr').find('td:eq(1)').text()

                                                                id_sub = 0;
                                                                $("tr.bazsazi_table_report_second").css("background-color", "white");
                                                                $("tr.bazsazi_table_report_second").css("color", "black");
                                                                $(this).closest('tr.bazsazi_table_report_second').css("background-color", "#66CDAA");
                                                                $(this).closest('tr.bazsazi_table_report_second').css("color", "white");
                                                                primary_or_secondary=2;



                                                            })
                                                            if(response.results[i]['FILE_NAME']=="فایل پیوست ندارد"){
                                                                ID_SUB = $('<td class="id_gr" style="width: 15%;font-family: Tahoma;font-size: 10px;text-align: center"><a style="visibility: hidden" href='+'images/'+response.results[i]['FILE_NAME']+'><img src="attachment2.png" class="rounded-circle" alt="Cinque Terre"></a>' + response.results[i]['ID_SUB'] + '</td>')
                                                            }else{
                                                                ID_SUB = $('<td class="id_gr" style="width: 15%;font-family: Tahoma;font-size: 10px;text-align: center"><a href='+'images/'+response.results[i]['FILE_NAME']+'><img src="attachment2.png" class="rounded-circle" alt="Cinque Terre"></a>' + response.results[i]['ID_SUB'] + '</td>')
                                                            }
                                                            ID_SUB2 = $('<td  hidden style="width: 40%;text-align: right">' + response.results[i]['ID_SUB'] + '</td>')
                                                            ID_T = $('<td  hidden style="width: 40%;text-align: right">' + response.results[i]['ID_T'] + '</td>')
                                                            ID_USER = $('<td hidden style="width: 40%;text-align: right">' + response.results[i]['ID_USER'] + '</td>')
                                                            RESV = $('<td hidden style="width: 3%;text-align: right">' + response.results[i]['RESV'] + '</td>')
                                                            if(response.results[i]['RESV'] == 1) {
                                                                RESV2 = $('<td style="width: 15%;text-align: center;border-right:1px dotted black"><img src="checked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                                                            }
                                                            if(response.results[i]['RESV'] == 2) {
                                                                RESV2 = $('<td style="width: 8%;text-align: center;border-right:1px dotted black"><img src="unchecked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                                                            }
                                                            if(response.results[i]['DATE_SHAMSI'] != '---') {
                                                                year = response.results[i]['DATE_SHAMSI'].substr(0, 4);
                                                                month = response.results[i]['DATE_SHAMSI'].substr(4, 2);
                                                                day = response.results[i]['DATE_SHAMSI'].substr(6, 2);
                                                                DATE_SHAMSI = $('<td style="width: 16%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                                            }else{
                                                                DATE_SHAMSI = $('<td style="width: 16%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">بدون تاریخ</td>')
                                                            }

                                                            FILE_NAME = $('<td hidden style="width: 40%;text-align: center;border-right:1px dotted black">' + response.results[i]['FILE_NAME'] + '</td>')
                                                            COUNT_GH = $('<td style="width: 15%;text-align: center;border-right:1px dotted black">' + response.results[i]['COUNT_GH'] + '</td>')
                                                            t1 = $('<td style="width: 5%"></td>')
                                                            t1.append(select)
                                                            row = $('<tr class="bazsazi_table_report_second"></tr>')
                                                            row.append(t1,ID_SUB, ID_T, ID_USER, RESV,RESV2, COUNT_GH, DATE_SHAMSI, FILE_NAME,ID_SUB2)
                                                            $("#bazsazi_table_report_secend").append(row)
                                                        }
                                                    }
                                                })


                                            })
                                            ID_SUB2 = $('<td style="width:15%;text-align: center">' + response.results[i]['ID_SUB'] + '</td>')
                                            ID_T = $('<td  hidden style="width: 40%;text-align: right">' + response.results[i]['ID_T'] + '</td>')
                                            ID_USER = $('<td hidden style="width: 40%;text-align: right">' + response.results[i]['ID_USER'] + '</td>')
                                            RESV = $('<td hidden style="width: 3%;text-align: right">' + response.results[i]['RESV'] + '</td>')
                                            if(response.results[i]['RESV'] == 1) {
                                                RESV2 = $('<td style="width: 15%;text-align: center;border-right:1px dotted black"><img src="checked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                                            }
                                            if(response.results[i]['RESV'] == 2) {
                                                RESV2 = $('<td style="width: 8%;text-align: center;border-right:1px dotted black"><img src="unchecked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                                            }
                                            if(response.results[i]['DATE_SHAMSI2']=="---"){
                                                DATE_SHAMSI = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">بدون تاریخ</td>')
                                            }else{
                                                year = response.results[i]['DATE_SHAMSI2'].substr(0, 4);
                                                month = response.results[i]['DATE_SHAMSI2'].substr(4, 2);
                                                day = response.results[i]['DATE_SHAMSI2'].substr(6, 2);
                                                DATE_SHAMSI = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                                            }

                                            COUNT_GH = $('<td style="width: 15%;text-align: center;border-right:1px dotted black">' + response.results[i]['COUNT_GH'] + '</td>')
                                            t1 = $('<td style="width: 10%"></td>')
                                            t1.append(select)
                                            row = $('<tr class="anbar_table_report_secend"></tr>')
                                            row.append(t1,ID_SUB2, ID_T, ID_USER, RESV,RESV2, COUNT_GH, DATE_SHAMSI)
                                            $("#anbar_table_report_secend").append(row)
                                        }
                                    }
                                })
                            })

                            ID_T = $('<td style="width: 4%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['ID_T'] + '</td>')
                            GHATAAT_DAMAGE = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.results[i]['GHATAAT_DAMAGE'] + '</td>')
                            GROUP_COUNT = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + response.results[i]['GROUP_COUNT'] + '</td>')
                            DISCRIPTION = $('<td hidden style="width: 40%;text-align: right">' + response.results[i]['DISCRIPTION'] + '</td>')
                            if(response.results[i]['DATE_SHAMSI']=="---"){
                                DATE_BEGIN1 = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">بدون تاریخ</td>')
                            }else{
                                year = response.results[i]['DATE_SHAMSI'].substr(0, 4);
                                month = response.results[i]['DATE_SHAMSI'].substr(4, 2);
                                day = response.results[i]['DATE_SHAMSI'].substr(6, 2);
                                DATE_BEGIN1 = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center;border-right:1px dotted black">' + year + '/' + month + '/' + day + '</td>')
                            }
                            t1 = $('<td style="width: 4%"></td>')
                            t1.append(edit1)
                            t2 = $('<td style="width: 4%"></td>')
                            t2.append(del2)
                            t3 = $('<td style="width: 4%"></td>')
                            t3.append(detail1)
                            t4 = $('<td style="width: 4%"></td>')
                            t4.append(select)
                            row = $('<tr class="anbar_table_report"></tr>')
                            row.append(t4,ID_T,ID_TG,GHATAAT_DAMAGE,DATE_BEGIN1, DISCRIPTION,GROUP_COUNT,ID_TG2)
                            $("#anbar_table_report").append(row)
                        }
                    }
                });
         })
        $("#tp_buy_rep_form").on('submit', function (event) {

                                            event.preventDefault();
                                            $.ajaxSetup({
                                                headers: {
                                                    'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                                }
                                            });
                                            var _token = $("input[name='_token']").val();
                                            $.ajax({
                                                url: "/buy-rep",
                                                method: 'POST',
                                                data: new FormData(this),
                                                dataType: 'JSON',
                                                contentType: false,
                                                processData: false,
                                                success: function (response) {
                                                    if(response.results.length>0){
                                                        var day = ''
                                                        var month = ''
                                                        var year = ''
                                                        var edit1 = ''
                                                        var del2 = ''
                                                        var detail1 = ''
                                                        var select = ''
                                                        var ID_T = ''
                                                        var ID_USER = ''
                                                        var ID_TG = ''
                                                        var ID_TG2 = ''
                                                        var ID_SE = ''
                                                        var ID_SE2 = ''
                                                        var GROUP_COUNT=''
                                                        var DATE_SHAMSI = ''
                                                        var DISCRIPTION = ''
                                                        var SHOMAREH_GHARAR = ''
                                                        var BUY_CONDITION = ''
                                                        var BUY_CONDITION2 = ''
                                                        var RESV = ''
                                                        var RESV2 = ''
                                                        var t1 = ''
                                                        var t2 = ''
                                                        var t3 = ''
                                                        var t4 = ''
                                                        var row = ''
                                                        var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;"><td>#</td><td>کد</td><td style="text-align: right">نوع قطعات</td><td style="text-align: right">فروشنده</td><td style="text-align: center">تاریخ خرید</td><td style="text-align: center">تعداد قطعات</td><td style="text-align: center">شماره قرارداد</td><td style="text-align: center">وضعیت خرید</td></tr>')
                                                        $("#buy_table_report").empty();
                                                        $("#buy_table_report").append(th)

                                                        for (var i = 0; i < response.results.length; i++) {
                                                            for (var j = 0; j < response.ID_TGS.length; j++) {
                                                                if (response.ID_TGS[j]['ID_TG'] == response.results[i]['ID_TG']) {
                                                                    ID_TG = $('<td style="width: 30%;font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_TGS[j]['GHATAAT_NAME'] + '</td>');
                                                                    ID_TG2 = $('<td hidden style="font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_TGS[j]['ID_TG'] + '</td>');
                                                                    break;
                                                                }
                                                            }
                                                            for (var j = 0; j < response.ID_SES.length; j++) {
                                                                if (response.ID_SES[j]['ID_SE'] == response.results[i]['ID_SE']) {
                                                                    ID_SE = $('<td style="width: 30%;font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_SES[j]['SELLER'] + '</td>');
                                                                    ID_SE2 = $('<td hidden style="font-family: Tahoma;font-size: 10px;text-align: right">' + response.ID_SES[j]['ID_SE'] + '</td>');
                                                                    break;
                                                                }
                                                            }
                                                            for (var z = 0; z < response.ID_USERS.length; z++) {
                                                                if (response.ID_USERS[z]['id'] == response.results[i]['ID_USER']) {
                                                                    ID_USER = $('<td hidden>' + response.ID_USERS[z]['l_name'] + '</td>')
                                                                    break;
                                                                }
                                                            }

                                                            select = $('<button type="button" class="btn-sm border-info select_send" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%">>></button>').on('click',function (event) {
                                                                id_t_bazsazi1 =$(this).closest('tr').find('td:eq(1)').text()
                                                                id_t1 =$(this).closest('tr').find('td:eq(1)').text()
                                                                id_sub=0;
                                                                id_t_bazsazi2=0
                                                                $("tr.table1").css("background-color", "white");
                                                                $("tr.table1").css("color", "black");
                                                                $(this).closest('tr.table1').css("background-color", "#66CDAA");
                                                                $(this).closest('tr.table1').css("color", "white");
                                                                select_prog=1;
                                                            })

                                                            ID_T = $('<td style="width: 4%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['ID_T'] + '</td>')
                                                            SHOMAREH_GHARAR = $('<td style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['SHOMAREH_GHARAR'] + '</td>')
                                                            BUY_CONDITION2 = $('<td hidden style="text-align: center;font-size: x-small">' + response.results[i]['BUY_CONDITION'] + '</td>')
                                                            if (response.results[i]['BUY_CONDITION'] == 1) {
                                                                BUY_CONDITION = $('<td hidden style="width: 23%;text-align: center;font-size: x-small">یک</td>')
                                                            }
                                                            if (response.results[i]['BUY_CONDITION'] == 2) {
                                                                BUY_CONDITION = $('<td hidden style="width: 23%;text-align: center;font-size: x-small">دو</td>')
                                                            }
                                                            if (response.results[i]['BUY_CONDITION'] == 3) {
                                                                BUY_CONDITION = $('<td hidden style="width: 23%;text-align: center;font-size: x-small">سه</td>')
                                                            }
                                                            if (response.results[i]['BUY_CONDITION'] == 4) {
                                                                BUY_CONDITION = $('<td hidden style="width: 23%;text-align: center;font-size: x-small">چهار</td>')
                                                            }
                                                            // BUY_CONDITION = $('<td style="width: 23%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['BUY_CONDITION'] + '</td>')
                                                            GROUP_COUNT = $('<td style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['GROUP_COUNT'] + '</td>')
                                                            RESV2 = $('<td hidden style="font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['RESV'] + '</td>')
                                                            DISCRIPTION = $('<td hidden style="text-align: right">' + response.results[i]['DISCRIPTION'] + '</td>')
                                                            if (response.results[i]['RESV'] == 1) {
                                                                RESV = $('<td style="width: 5%;text-align: center"><img src="checked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                                                            }
                                                            if (response.results[i]['RESV'] == 2) {
                                                                RESV = $('<td style="width: 5%;text-align: center"><img src="unchecked.jpg" class="rounded-circle" alt="Cinque Terre"></td>')
                                                            }
                                                            year = response.results[i]['DATE_SHAMSI'].substr(0, 4);
                                                            month = response.results[i]['DATE_SHAMSI'].substr(4, 2);
                                                            day = response.results[i]['DATE_SHAMSI'].substr(6, 2);
                                                            DATE_SHAMSI = $('<td style="width: 6%;font-family: Tahoma;font-size: 10px;text-align: center">' + year + '/' + month + '/' + day + '</td>')
                                                            t3 = $('<td style="width: 2%"></td>')
                                                            t3.append(select)
                                                            row = $('<tr class="table1"></tr>')
                                                            row = $('<tr class="table1"></tr>')

                                                            row.append(t3,ID_T,ID_TG,ID_SE, DATE_SHAMSI,GROUP_COUNT,SHOMAREH_GHARAR,DISCRIPTION,BUY_CONDITION,ID_TG2,ID_SE2,RESV,RESV2,BUY_CONDITION2)
                                                            $("#buy_table_report").append(row)
                                                        }
                                                    }else{
                                                        Swal.fire('موردی یافت نشد', '', 'info')
                                                        $("#table1").empty();
                                                        $("#description2").text('');
                                                    }

                                                }
                                            });
                                     })
        $("#tp_exx_rep_form").on('submit', function (event) {

                    event.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    var _token = $("input[name='_token']").val();
                    $.ajax({
                        url: "/out-rep",
                        method: 'POST',
                        data: new FormData(this),
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (response.results.length > 0) {
                                toastr.info('اطلاعات درخواستی دریافت شد');
                                $("#add_recieve").hide();
                                $("#description2").text('');
                                $("#ID_T_SUB2").text('');
                                $("#tamirat_table_report2").empty();
                                var day = ''
                                var month = ''
                                var year = ''
                                var edit1 = ''
                                var del2 = ''
                                var detail1 = ''
                                var select = ''
                                var ID_T = ''
                                var ID_USER = ''
                                var ID_TG = ''
                                var ID_TG2 = ''
                                var ID_BA = ''
                                var ID_BA2 = ''
                                var GROUP_COUNT = ''
                                var DATE_SHAMSI = ''
                                var DISCRIPTION = ''
                                var LOCATION_NAME=''
                                var OUT_IN = ''
                                var OUT_IN2 = ''
                                var t1 = ''
                                var t2 = ''
                                var t3 = ''
                                var t4 = ''
                                var row = ''
                                var th = $('<tr class="bg-primary" style="color: white;font-size:x-small;"><td>#</td><td>کد</td><td style="text-align: center">نوع قطعات</td><td style="text-align: center">مبدا یا مقصد</td><td style="text-align: center">تاریخ ارسال</td><td style="text-align: center">تعداد قطعات</td><td style="text-align: center">نوع ارسال</td></tr>')
                                $("#eex_table_report").empty();
                                $("#eex_table_report").append(th)
                                    for (var i = 0; i < response.results.length; i++) {
                                        for (var j = 0; j < response.ID_TGS.length; j++) {
                                            if (response.ID_TGS[j]['ID_TG'] == response.results[i]['ID_TG']) {
                                                ID_TG = $('<td style="width: 20%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.ID_TGS[j]['GHATAAT_NAME'] + '</td>');
                                                ID_TG2 = $('<td hidden style="width: 7%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.ID_TGS[j]['ID_TG'] + '</td>');
                                                break;
                                            }
                                        }

                                        select = $('<button type="button" class="btn-sm border-info select_send" style="font-family: Tahoma;font-size: x-small;text-align: center;width: 100%">>></button>').on('click', function (event) {
                                            id_t1 = $(this).closest('tr').find('td:eq(1)').text()
                                            id_sub=0
                                            id_t_bazsazi1=id_t1
                                            id_t_bazsazi2=0
                                            $("tr.table1").css("background-color", "white");
                                            $("tr.table1").css("color", "black");
                                            $(this).closest('tr.table1').css("background-color", "cornflowerblue");
                                            $(this).closest('tr.table1').css("color", "white");
                                            select_prog=1;
                                        })

                                        ID_T = $('<td style="width: 4%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['ID_T'] + '</td>')
                                        LOCATION_NAME = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['LOCATION_NAME'] + '</td>')
                                        GROUP_COUNT = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center">' + response.results[i]['GROUP_COUNT'] + '</td>')
                                        DISCRIPTION = $('<td hidden style="width: 40%;text-align: center">' + response.results[i]['DISCRIPTION'] + '</td>')
                                        if(response.results[i]['OUT_IN']==1){
                                            OUT_IN = $('<td style="width: 4%;text-align: center;font-family: Tahoma;font-size: 10px">ورود</td>')
                                        }
                                        if(response.results[i]['OUT_IN']==2){
                                            OUT_IN = $('<td style="width: 4%;text-align: center;font-family: Tahoma;font-size: 10px">خروج</td>')
                                        }
                                        OUT_IN2 = $('<td hidden style="width: 40%;text-align: center">' + response.results[i]['OUT_IN'] + '</td>')
                                        year = response.results[i]['DATE_SHAMSI'].substr(0, 4);
                                        month = response.results[i]['DATE_SHAMSI'].substr(4, 2);
                                        day = response.results[i]['DATE_SHAMSI'].substr(6, 2);
                                        DATE_SHAMSI = $('<td style="width: 10%;font-family: Tahoma;font-size: 10px;text-align: center">' + year + '/' + month + '/' + day + '</td>')
                                        t1 = $('<td style="width: 4%"></td>')
                                        t1.append(edit1)
                                        t2 = $('<td style="width: 4%"></td>')
                                        t2.append(del2)
                                        t3 = $('<td style="width: 4%"></td>')
                                        t3.append(detail1)
                                        t4 = $('<td style="width: 4%"></td>')
                                        t4.append(select)
                                        row = $('<tr class="table1"></tr>')
                                        row.append(t4, ID_T, ID_TG, LOCATION_NAME, DATE_SHAMSI, DISCRIPTION, GROUP_COUNT, ID_TG2,OUT_IN,OUT_IN2)
                                        $("#eex_table_report").append(row)
                                    }
                                }else{
                                    Swal.fire('موردی یافت نشد', '', 'info')
                                    $("#table1").empty();
                                    $("#description2").text('');
                                }
                            }
                        });
                    })


         })

</script>
<div class="container" style="width: 100%;height:6%;border-radius: 2px">
   @include('AnsaldoComponents.component01')
   @include('AnsaldoComponents.component02')
   @include('AnsaldoComponents.component03')
   @include('AnsaldoComponents.component04')
   @include('AnsaldoComponents.component05')
   @include('AnsaldoComponents.component06')
   @include('AnsaldoComponents.component07')
   @include('AnsaldoComponents.component08')
   @include('AnsaldoComponents.component09')
   @include('AnsaldoComponents.component10')
   @include('AnsaldoComponents.component11')
   @include('AnsaldoComponents.component12')
</div>        
@endsection
