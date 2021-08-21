$('#soc-sec-sickleave').on('change',function(){
    if ($(this).val() == 1) {
        $('.sickleave-row').show();
        $('.sickleave').css('visibility','visible');
    } else if($(this).val() == 2) {
        $('.sickleave-row').show();
        $('.sickleave').css('visibility','hidden');
    } else {
        $('.sickleave-row').hide();
        $('.sickleave').css('visibility','hidden');
    }
});
$('#maternity').on('change',function (){
    if ($(this).val() == 1) {
        $('.maternity-row').show();
        $('.maternity-leave').css('visibility','visible');
    } else if($(this).val() == 2 || $(this).val() == 3) {
        $('.maternity-row').show();
        $('.maternity-leave').css('visibility','hidden');
    } else {
        $('.maternity-row').hide();
        $('.maternity-leave').css('visibility','hidden');
    }
});
$('#inv-pension').on('change',function (){
    if ($(this).val() == 1) {
        $('.inv-pension-row').show();
        $('.inv-pension-to').css('visibility','hidden');
    } else if($(this).val() == 2 || $(this).val() == 3) {
        $('.inv-pension-row').show();
        $('.inv-pension-to').css('visibility','hidden');
    } else {
        $('.inv-pension-row').hide();
        $('.inv-pension-to').css('visibility','hidden');
    }
});
$('#pension').on('change',function (){
    if ($(this).val() == 1 || ($(this).val() == 2)) {
        $('.pension-row').show();
    }  else {
        $('.pension-row').hide();
    }
});

$('#nourishing').on('change',function(){
    if ($(this).val() == 'y') {
        $('.vyzivne').show();
    } else {
        $('.vyzivne').hide();
    }
});

$('#perm-addr1').on('click',function(){
    $('.client-other-addr').each(function(){
        $(this).hide();
    });
});
$('#perm-addr2').on('click',function(){
    $('.client-other-addr').each(function(){
        $(this).show();
    });
});
$('#application-source').on('change',function(){
    var v = $(this).val();
    if( v == 'nodef' && v != 'refcode') {
        $('#other-src').show();
        $('#referal-code').hide();
    } else if( v == 'refcode' && v != 'nodef') {
        $('#referal-code').show();
        $('#other-src').hide();
    } else {
        $('#referal-code').hide();
        $('#other-src').hide();
    }
});
$('#pay-cash').on('click',function(){
    $('.payroll').each(function(){
        $(this).hide();
    });
});
$('#pay-acc').on('click',function(){
    $('.payroll').each(function(){
        $(this).show();
    });
});

$('#call-type').on('change',function (){

    var callTypes = {
        "cont-vid":{
            "skype":"Skype",
            "viber":"Viber",
            "whatsapp":"Whatsapp",
            "fb-mess":"Facebook Messanger",
            "zoom": "Zoom",
            "teams": "Microsoft Teams"
        },
        "cont-phone": {
            "phone": "Telefón",
            "viber": "Viber",
            "whatsapp":"Whatsapp",
            "fb-mess":"Facebook Messanger",
            "skype":"Skype"
        },
        "written": {
            "skype":"Skype",
            "viber":"Viber",
            "whatsapp":"Whatsapp",
            "fb-mess":"Facebook Messanger",
            "sms": "SMS",
            "email": "E-mail"
        }
    };
    var t = $(this).val();
    $('#call-source').empty();
    $.each(callTypes[t],function (k,v){
        $('#call-source').append($('<option>', {
            value: k,
            text : v
        }));
    });

});

$('#add-document').on('click',function(){
    var lastOne = $('div.doc:last');
    var lastClone = lastOne.clone(true);
    var lastOneOrder = parseInt(lastOne.data('order')) + 1;

    var h5 = $(lastClone).find("h5");
    var h5Title = h5.html().split('.');
    h5.html(h5Title[0] + '.' + lastOneOrder);

    var toUpdate = $(lastClone).find(".client-docs");
    $.each(toUpdate,function(k,v){
        $(v).attr('data-order',lastOneOrder);
    });

    lastClone.attr('data-order',lastOneOrder);
    lastOne.after(lastClone);
});

function cloneLoansField(e,f)
{
    var lastOne = $('div.'+ e +':last');
    var lastClone = lastOne.clone(true);
    var lastOneOrder = parseInt(lastOne.data('order')) + 1;

    var toUpdate = $(lastClone).find('.' + f );
    $.each(toUpdate,function(k,v){
        $(v).attr('data-order',lastOneOrder);
    });

    lastClone.attr('data-order',lastOneOrder);
    lastOne.after(lastClone);
}

$('.add-loan').on('click',function(){
   cloneLoansField('loan-1','p-loan-1');
});

$('.add-limit').on('click',function(){
   cloneLoansField('limit-1','p-limit-1');
});

$('#cl-bas-data-back').on('click',function(){
    $('#client-papers').show();
    $('#client-basic-data').hide();
});

$('#cl-pap-next').on('click',function(){
    $('#client-papers').hide();
    $('#client-basic-data').show();
});

$('#cl-pap-back').on('click',function(){
    $('#p-1').show();
    $('#client-req').show();
    $('#referal').show();
    $('#client-contact').show();
    $('#client-papers').hide();
});

$('#cl-addr-back').on('click',function(){
    $('#client-address').hide();
    $('#client-basic-data').show();
});

$('#cl-persdat-back').on('click',function(){
    $('#client-personal-data').hide();
    $('#client-address').show();
});
$('#cust-docs-back').on('click',function(){
    $('#client-docs').hide();
    $('#client-personal-data').show();
});
$('#cl-famdata-back').on('click',function(){
    $('#family-data').hide();
    $('#client-docs').show();

});

function slovakSSN(ssn,gender)
{
    var bdate = '';
    var ssncontrol = '';
    var by = '', bm = '', bd = '';

    if (ssn.indexOf('/') != -1) {
        bdate = (ssn.split('/'))[0];
        ssncontrol = (ssn.split('/'))[1];
    } else {
        bdate = ssn.substr(0,6);
        ssncontrol = ssn.substr(6,ssn.length);
    }
    by = parseInt(bdate.substr(0,2),10);
    bm = parseInt(bdate.substr(2,2),10);
    bd = bdate.substr(4,2);

    if (gender == 'f') {
        bm -= 50;
    }

    if (by < 54 && ssncontrol.length == 3) {
        by += 1900;
    }
    else if (by < 54 && ssncontrol.length == 4) {
        by += 2000;
    } else {
        by += 1900;
    }

    // fix bigger year than the actual year
    var y = (new Date()).getFullYear();
    if (y < by) {
        by -= 100;
    }

    return bd + '.' + bm.toString().padStart(2,'0') + '.' + by.toString();
}

$('#c-ssn').on('blur',function calcBirthDay(){
   var gend = $('#c-gend').val();
   var ssn = $(this).val();
   var country = $('#addr-country').val();
   var bDate = '';

   if (country == 1) {
       // slovakia code
       bDate = slovakSSN(ssn, gend);
       $('#c-birth').val(bDate);
   }
});

function calcAvg(x, a)
{
    return Math.round( x * 100 / a  ) / 100;
}

$('.calc-avg-wage').on('blur', function CalculateAvgWage(){
    var orderid = $(this).data('order');
    var wages = $('.calc-avg-wage'), sum = 0;
    for(var i=0; i < wages.length; i++) {
        if ($(wages[i]).data('order') != orderid) continue;
        sum += parseFloat($(wages[i]).val());
        if( i == 3 ) {
            $('#avg-4m-wage').val( calcAvg( sum, 4) );
        }
        if ( i == 5) {
            $('#avg-6m-wage').val(calcAvg( sum, 6) );
        }
    }
    $('#avg-12m-wage').val(calcAvg( sum, 12));
});

function getDataItemsWithOrder(elm) {
    var dat =  new Array();
    $.each($(elm), function(k,v){
        var ke=$(v).data('item');
        var va=$(v).val();
        var or=$(v).data('order');
        dat.push({item:ke,val:va,order:or});
    });
    return dat;
}

function getDataItems(elm) {
    var dat = new Array();
    $.each($(elm), function(k,v){
        var ke=$(v).data('item');
        var va=$(v).val();
        dat.push({item:ke,val:va});
    });
    return dat;
}

function getDataItemsWithOrderAndTypeCheck(elm) {
    var dat =  new Array();
    $.each($(elm), function(k,v){
        if ($(v).is(':radio')) {
            if ($(v).is(':checked')) {
                var va = $(v).data('default-value');
            } else {
                return true;
            }
        } else {
            var va=$(v).val();
        }
        var ke=$(v).data('item');
        var or=$(v).data('order');

        dat.push({item:ke,val:va,order:or});
    });
    return dat;
}

$('#perm-work').on('change',function(){
    $(this).is(':checked') ? $('#perm-work-cnt').css('visibility','visible') : $('#perm-work-cnt').css('visibility','hidden');
});

$('#bus-owner').on('change',function(){
    $(this).is(':checked') ? $('#bus-owner-cnt').css('visibility','visible') : $('#bus-owner-cnt').css('visibility','hidden');
});

