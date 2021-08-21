$(document).ready(function(){
    if($('.fa-polozka').length < 2) {
        $('.fa-polozka .odstranit-polozku').hide();
    }
});

var counter = parseInt($('.fa-polozka').length,10)-1;
var dphPolozky = [];
var sdphPolozky = [];
var prenesenaDan = '0';

// zmena ci je dodavatel platcom DPH alebo nie je
$('#dodavatel-vatpayer').on('change',function(){
    if ($(this).val() === '1') {
        $('.zalFaSkryt').show();
        $('.prenesenaDan').show();
    } else {
        $('.zalFaSkryt').hide();
        $('.prenesenaDan').hide();
    }
    $('#zalohovafa').trigger('change');
    spocitaj();
});

$('#inv-polozky').sortable();

$('#faktura-mena').on('change',function(){
    $('.money').each(function(){
        $(this).html($('#faktura-mena option:selected').val());
    });
});

$('#add-item').on('click',function(e){
    e.preventDefault();

    if ($('.fa-polozka').length < 2) {
        $('.fa-polozka .odstranit-polozku').show();
    }
    ++counter;
    var el = $('#row-0');
    el.clone().attr('id','row-'+counter).insertAfter(el).appendTo('#inv-polozky');
    $('#row-'+counter).find('select').attr('id','popis-'+counter);
    $('#row-'+counter).find('#mj-0').attr('id','mj-'+counter);
    $('#row-'+counter).find('#mnozstvo-0').attr('id','mnozstvo-'+counter);
    $('#row-'+counter).find('#dmnozstvo-0').attr('id','dmnozstvo-'+counter);
    $('#row-'+counter).find('#dmnozstvo-'+counter).html('');
    $('#row-'+counter).find('#dmnozstvo-'+counter).html('Spolu = ');
    $('#row-'+counter).find('#cena-0').attr('id','cena-'+counter);
    $('#row-'+counter).find('#dph-0').attr('id','dph-'+counter);
    $('#row-'+counter).find('#cena2-0').attr('id','cena2-'+counter);
    $('#row-'+counter).find('#totalcena-0').attr('id','totalcena-'+counter);
    $('#row-'+counter).find('#dtotalcena-0').attr('id','dtotalcena-'+counter);
    $('#row-'+counter).find('#dtotalcena-'+counter ).html('');
    $('#row-'+counter).find('#datum-realizacie-0').attr('id','datum-realizacie-'+counter);
    $('#row-'+counter).find('#popis-text-0').attr('id','popis-text-'+counter);
    $('#row-'+counter).find('#popis-text-'+counter).empty();
    $('#row-'+counter).find('#sdph-0').attr('id','sdph-'+counter);
    $('#row-'+counter).find('#totaldph-0').attr('id','totaldph-'+counter);
    $('#row-'+counter).find('#dtotaldph-0').attr('id','dtotaldph-'+counter);
    $('#row-'+counter).find('#totalcena2-0').attr('id','totalcena2-'+counter);
    $('#row-'+counter).find('#dtotalcena2-0').attr('id','dtotalcena2-'+counter);
    $('#row-'+counter).find('#pol-zlava-percent-0').attr('id','pol-zlava-percent-'+counter);
    $('#row-'+counter).find('#pol-zlava-abshod-0').attr('id','pol-zlava-abshod-'+counter);
    $('#row-'+counter).find('#pol-zlava-hod-0').attr('id','pol-zlava-hod-'+counter);
    $('#row-'+counter).find('#dpol-zlava-hod-0').attr('id','dpol-zlava-hod-'+counter);
    $('#row-'+counter).find('#mnozstvo-'  + counter).val('1');
    $('#row-'+counter).find('#totalcena-'  + counter).val('');
    $('#row-'+counter).find('#sdph-'  + counter).val(0);
    $('#row-'+counter).find('#cena-'  + counter ).val('');
    $('#row-'+counter).find('#totaldph-'  + counter).val('');
    $('#row-'+counter).find('#cena2-'  + counter ).val('');
    $('#row-'+counter).find('#totalcena2-'  + counter).val('');
    $('#row-'+counter).find('#dtotaldph-'+counter ).html('');
    $('#row-'+counter).find('#dtotalcena2-'+counter).html('');
    $('#row-'+counter).find('#popis-'+counter).attr('name','Polozky['+counter+'][polozka_id]');
    $('#row-'+counter).find('#datum-realizacie-'+counter).attr('name','Polozky['+counter+'][datum_realizacie]');
    $('#row-'+counter).find('#popis-text-'+counter).attr('name','Polozky['+counter+'][popis_polozky]');
    $('#row-'+counter).find('#mj-'+counter).attr('name','Polozky['+counter+'][merna_jednotka]');
    $('#row-'+counter).find('#mnozstvo-'+counter).attr('name','Polozky['+counter+'][mnozstvo]');
    $('#row-'+counter).find('#cena-'+counter).attr('name','Polozky['+counter+'][cena]');
    $('#row-'+counter).find('#totalcena-'+counter).attr('name','Polozky['+counter+'][total_cena]');
    $('#row-'+counter).find('#dph-'+counter).attr('name','Polozky['+counter+'][dph]');
    $('#row-'+counter).find('#totaldph-'+counter).attr('name','Polozky['+counter+'][total_dph]');
    $('#row-'+counter).find('#sdph-'+counter).attr('name','Polozky['+counter+'][sdph]');
    $('#row-'+counter).find('#cena2-'+counter).attr('name','Polozky['+counter+'][cena_s_dph]');
    $('#row-'+counter).find('#totalcena2-'+counter).attr('name','Polozky['+counter+'][total_cena_s_dph]');
    $('#row-'+counter).find('#pol-0').attr('id','pol-'+counter);
    $('#row-'+counter).find('#pol-'+counter).attr('data-id','0');
    $('#row-'+counter).find('#pol-zlava-percent-'+counter).attr('name','Polozky[' + counter + '][pol_zlava_percent]');
    $('#row-'+counter).find('#pol-zlava-abshod-'+counter).attr('name','Polozky['+counter+'][pol_zlava_abshod]');
    $('#row-'+counter).find('#pol-zlava-hod-'+counter).attr('name','Polozky['+counter+'][pol_zlava_hodnota]');
    $('#row-'+counter).find('#dpol-zlava-hod-'+counter).html('');
    $('#row-'+counter).find('#pol-zlava-abshod-'+counter).val('');
    $('#row-'+counter).find('#pol-zlava-percent-'+counter).val('');
});

$(document).on('click', '.odstranit-polozku', function(event) {
    if (window.confirm('Naozaj chcete zmaza položku?')) {
        event.preventDefault();
        var el = $(this).parents('.fa-polozka');
        el.remove();
        spocitaj();
        var toRemove = $(this).data('id');
        if ($('.fa-polozka').length < 2) {
            $('.fa-polozka .odstranit-polozku').hide();
            $('.fa-polozka').attr('id', 'row-0');
            $('.fa-polozka').find('[id^="popis-"]').attr('id', 'popis-0');
            $('.fa-polozka').find('[id^="popis-"]').attr('id', 'popis-text-0');
            $('.fa-polozka').find('[id^="datum-realizacie-"]').attr('id', 'datum-realizacie-0');
            $('.fa-polozka').find('[id^="mj-"]').attr('id', 'mj-0');
            $('.fa-polozka').find('[id^="mnozstvo-"]').attr('id', 'mnozstvo-0');
            $('.fa-polozka').find('[id^="dmnozstvo-"]').attr('id', 'dmnozstvo-0');
            $('.fa-polozka').find('[id^="cena-"]').attr('id', 'cena-0');
            $('.fa-polozka').find('[id^="totalcena-"]').attr('id', 'totalcena-0');
            $('.fa-polozka').find('[id^="dtotalcena-"]').attr('id', 'dtotalcena-0');
            $('.fa-polozka').find('[id^="dph-"]').attr('id', 'dph-0');
            $('.fa-polozka').find('[id^="totaldph-"]').attr('id', 'totaldph-0');
            $('.fa-polozka').find('[id^="sdph-"]').attr('id', 'sdph-0');
            $('.fa-polozka').find('[id^="dtotaldph-"]').attr('id', 'dtotaldph-0');
            $('.fa-polozka').find('[id^="cena2-"]').attr('id', 'cena2-0');
            $('.fa-polozka').find('[id^="totalcena2-"]').attr('id', 'totalcena2-0');
            $('.fa-polozka').find('[id^="dtotalcena2-"]').attr('id', 'dtotalcena2-0');
        }
        if ($(this).data('action') == 'edit' && $(this).data('id') > 0) {
            $.ajax({
                url: '/backoffice/accounting/ajax-delete-invoice-item',
                dataType: 'json',
                method: 'post',
                data: {itemid:toRemove},
                success: function(r){
                }
            });
        }
    }
});

// zmena typu faktury (faktura, zalohova, dobropis)
$('#zalohovafa').on('change', function() {
    if ($(this).val() == '1') {
        $('.no-zaloha').hide();
        $('#uhradene').val('');
        spocitaj();
    } else {
        $('.zalFaSkryt').show();
        $('.no-zaloha').show();
        if ($('#dodavatel-vatpayer').val() === '1') {
            $('.zalFaSkryt').show();
            $('.prenesenaDan').show();
        } else {
            $('.zalFaSkryt').hide();
            $('.prenesenaDan').hide();
        }
    }
    // get new invoice number via ajax
    $.ajax({
        url: '/backoffice/accounting/ajax-get-new-invoice-number',
        dataType: 'json',
        method: 'post',
        data: {
            oldnumber: $('#d1').val(),
            invtype: $('#zalohovafa').val()
        },
        success: function(r){
            $('#d1').val(r.inv_num);
            $('#vs0').val(r.var_symb);
        }
    });
});

$(document).on('keyup blur', '#zlava', function(event){
    spocitaj();
});

$(document).on('change', 'select[id*="popis-"]', function(){
    var elInt = parseInt($(this).attr('id').replace('popis-',''),10);
    var polozka = JSON.parse($(this).val());
    $('#mj-'+elInt).val(polozka.merna_jednotka);
    if ($('#dodavatel-vatpayer').val() === '1') {
        $('#dph-'+elInt).val(polozka.dph);
    }
    $('#cena-'+elInt).val(polozka.cena_za_jednotku).trigger('keyup');
    spocitaj();
});

//zmena mnozstva
$(document).on('keyup blur', 'input[id*="mnozstvo-"]', function(){
    var elInt = parseInt($(this).attr('id').replace('mnozstvo-',''),10);
    $(this).val($(this).val().replace(',','.'));
    $('#cena-'+elInt).trigger('keyup');
});

// zmena dph(%)
$(document).on('keyup blur', 'input[id*="dph-"]', function(){
    var elInt = parseInt($(this).attr('id').replace('dph-',''),10);
    $(this).val($(this).val().replace(',', '.'));
    $('#cena-'+elInt).trigger('keyup');
});

$(document).on('keyup blur', '#uhradene', function(){
    var cena = $(this).val();
    cena = viewNum(cena,2);
    $(this).val(cena);
    spocitaj();
    $('#s-zalohy').html(formatMoney(cena, 2, ',', '.'));
});

$(document).on('change', '#prenesenaDan', function(){
    if($('#prenesenaDan').is(':checked')) {
        $('input[id^="dph-"]').each(function () {
            var id = $(this).attr('id');
            var toRemove = 'dph-';
            var index = id.replace(toRemove,'');
            dphPolozky[index] = $('input[id="dph-' + index + '"]').val();
            sdphPolozky[index] = $('input[id="sdph-' + index + '"]').val();
            $(this).val('0');
            $(this).prop('disabled', true);
            if (sdphPolozky[index] === 1) {
                $('input[id="cena2-' + index + '"]').trigger('keyup');
            } else if (sdphPolozky[index] === 0) {
                $('input[id="cena-' + index + '"]').trigger('keyup');
            }
        });
        prenesenaDan = '1';
    } else {
        $('input[id^="dph-"]').each(function () {
            var id = $(this).attr('id');
            var toRemove = 'dph-';
            var index = id.replace(toRemove,'');
            if($(this).val() > 0) {
                dphPolozky[index] = $(this).val();
            }
            sdphPolozky[index] = $('input[id="sdph-' + index + '"]').val();
            $(this).val(dphPolozky[index]);
            $(this).prop('disabled', false);
            if (sdphPolozky[index] === 1) {
                $('input[id="cena2-' + index + '"]').trigger('keyup');
            } else if (sdphPolozky[index] === 0) {
                $('input[id="cena-' + index + '"]').trigger('keyup');
            }
        });
        prenesenaDan = '0';
    }
    spocitaj();
});

$(document).on('keyup blur', 'input[id*="pol-zlava-percent-"]', function(){
    var elId = parseInt($(this).attr('id').replace('pol-zlava-percent-',''),10);
    $('#cena-'+elId).trigger('keyup');
});

$(document).on('keyup blur', 'input[id*="pol-zlava-abshod-"]', function(){
    var elId = parseInt($(this).attr('id').replace('pol-zlava-abshod-',''),10);
    $('#cena-'+elId).trigger('keyup');
});

/* bez dph */
$(document).on('keyup blur', 'input[id*="cena-"]', function(){
    var exp = 4;
    var elInt = $(this).attr('id').replace('cena-','');

    var mnozstvo = 'mnozstvo-' + elInt;
    var dmnozstvo = 'dmnozstvo-' + elInt;
    var dph = 'dph-' + elInt;
    var totalcena = 'totalcena-' + elInt;
    var dtotalcena = 'dtotalcena-' + elInt;
    var totaldph = 'totaldph-' + elInt;
    var dtotaldph = 'dtotaldph-' + elInt;
    var cena2 = 'cena2-' + elInt;
    var totalcena2 = 'totalcena2-' + elInt;
    var dtotalcena2 = 'dtotalcena2-' + elInt;
    var sdph = 'sdph-' + elInt;
    var polzlavapercent = parseFloat($('#pol-zlava-percent-' + elInt).val().replace(',','.'));
    var polzlavaabshod = parseFloat($('#pol-zlava-abshod-' + elInt).val().replace(',','.'));

    var mnozstvoVal = parseFloat($('#'+mnozstvo).val().replace(',', '.'));

    var cenaBezDPHJednVal = $(this).val();
    var cenaBezDPHJednView = viewNum(cenaBezDPHJednVal,exp);
    $(this).val(cenaBezDPHJednView);
    cenaBezDPHJednVal = parseFloat(cenaBezDPHJednVal.replace(',', '.'));


    var dphJednVal = $('#'+dph).val();
    dphJednVal = parseFloat(dphJednVal.replace(',', '.'));
    var baseDphVal = parseFloat(dphJednVal);
    dphJednVal = roundNum(cenaBezDPHJednVal * (baseDphVal/100),2);

    var CenaSDPHJednVal = roundNum(cenaBezDPHJednVal + dphJednVal,2);
    $('#'+cena2).val(CenaSDPHJednVal);

    var CenaBezDPHTotalVal = cenaBezDPHJednVal * mnozstvoVal;
    var zlava = 0;

    if (polzlavapercent != 0 && !isNaN(polzlavapercent)) {
        var hodnota = roundNum(CenaBezDPHTotalVal * polzlavapercent / 100,2);
        $('#pol-zlava-hod-'+elInt).val(hodnota);
        $('#dpol-zlava-hod-'+elInt).html(hodnota + ' <span class="money">'+$('#faktura-mena').val() + '</span>');
        zlava = hodnota;
    }
    else if (polzlavaabshod != 0 && !isNaN(polzlavaabshod)) {
        $('#pol-zlava-hod-'+elInt).val(polzlavaabshod);
        $('#dpol-zlava-hod-'+elInt).html(polzlavaabshod + ' <span class="money">'+$('#faktura-mena').val() + '</span>');
        zlava = polzlavaabshod;
    } else {
        $('#pol-zlava-hod-'+elInt).val(0);
        $('#dpol-zlava-hod-'+elInt).html('0 <span class="money">'+$('#faktura-mena').val() + '</span>');
    }

    var dphTotalVal = roundNum((CenaBezDPHTotalVal-zlava) * (baseDphVal/100),2);
    var CenaSDPHTotalVal = roundNum((CenaBezDPHTotalVal-zlava) + dphTotalVal,2);
    CenaBezDPHTotalVal = roundNum(CenaBezDPHTotalVal,2);

    $('#'+dmnozstvo).html('Spolu = ');
    $('#'+totalcena).val(CenaBezDPHTotalVal);
    $('#'+dtotalcena).html(CenaBezDPHTotalVal + ' <span class="money">'+$('#faktura-mena').val() + '</span>');
    $('#'+totaldph).val(dphTotalVal);
    $('#'+dtotaldph).html(dphTotalVal + ' <span class="money">'+$('#faktura-mena').val() + '</span>');
    $('#'+totalcena2).val(CenaSDPHTotalVal);
    $('#'+dtotalcena2).html(CenaSDPHTotalVal + ' <span class="money">'+$('#faktura-mena').val() + '</span>');
    $('#'+sdph).val(0);

    spocitaj();
});

/*s dph*/
$(document).on('keyup blur', 'input[id*="cena2-"]', function(){
    var exp = 4;

    var id = $(this).attr('id');
    var toRemove = 'cena2-';
    var elInt = id.replace(toRemove,'');
    var mnozstvo = 'mnozstvo-' + elInt;
    var dmnozstvo = 'dmnozstvo-' + elInt;
    var dph = 'dph-' + elInt;
    var cena = 'cena-' + elInt;
    var totalcena = 'totalcena-' + elInt;
    var dtotalcena = 'dtotalcena-' + elInt;
    var totaldph = 'totaldph-' + elInt;
    var dtotaldph = 'dtotaldph-' + elInt;
    var totalcena2 = 'totalcena2-' + elInt;
    var dtotalcena2 = 'dtotalcena2-' + elInt;
    var sdph = 'sdph-' + elInt;

    var mnozstvoVal = $('#'+mnozstvo).val();
    mnozstvoVal = parseFloat(mnozstvoVal.replace(',', '.'));
    mnozstvoVal = parseFloat(mnozstvoVal);

    var cenaSDPHJednVal = $(this).val();
    var cenaSDPHValJednView = viewNum(cenaSDPHJednVal,exp);
    $(this).val(cenaSDPHValJednView);
    cenaSDPHJednVal = parseFloat(cenaSDPHJednVal.replace(',', '.'));

    var dphJednVal = $('#'+dph).val();
    dphJednVal = parseFloat(dphJednVal.replace(',', '.'));
    var baseDphVal = parseFloat(dphJednVal);
    var dphJednView = roundNum(cenaSDPHJednVal - cenaSDPHJednVal / (1+(baseDphVal/100)),exp);

    var cenaBezDPHJedn = roundNum(cenaSDPHJednVal-dphJednView,exp);
    $('#'+cena).val(cenaBezDPHJedn);

    var cenaSDPHTotal = cenaSDPHJednVal * mnozstvoVal;
    var dphTotalVal = roundNum(cenaSDPHTotal - cenaSDPHTotal / (1+(baseDphVal/100)),2);
    var cenaBezDPHTotalVal = roundNum(cenaSDPHTotal-dphTotalVal,2);
    cenaSDPHTotal = roundNum(cenaSDPHTotal,2);

    $('#'+dmnozstvo).html('Spolu = ');
    $('#'+totaldph).val(dphTotalVal);
    $('#'+dtotaldph).html(dphTotalVal + ' <span class="money">'+$('#faktura-mena').val() + '</span>');
    $('#'+totalcena).val(cenaBezDPHTotalVal);
    $('#'+dtotalcena).html(cenaBezDPHTotalVal + ' <span class="money">'+$('#faktura-mena').val() + '</span>');
    $('#'+totalcena2).val(cenaSDPHTotal);
    $('#'+dtotalcena2).html(cenaSDPHTotal + ' <span class="money">'+$('#faktura-mena').val() + '</span>');
    $('#'+sdph).val(1);

    spocitaj();
});

function spocitaj() {
    var e = 2;

    var totalcena = 0;
    var totalcena2 = 0;
    var totaldph = 0;

    var zlavaVal = $('#zlava').val();
    if (zlavaVal === '' || zlavaVal === '-') {
        zlavaVal = '0';
    }
    var zlava = parseFloat(zlavaVal.replace(',', '.'));
    var totalzlava = 0;


    $('input[id*="totalcena-"]').each(function(){
        var elInt = $(this).attr('id').replace('totalcena-','');
        var dph = $('#dph-'+elInt).val();
        totalzlava += parseFloat($('#pol-zlava-hod-'+elInt).val().replace(',','.'));
        var c = $(this).val();
        if (c === '') {
            c = '0';
        }
        c = parseFloat(c.replace(',', '.'));
        totaldph += c * dph / 100;
        totalcena2 += c * (1 + dph / 100);
        totalcena += c;
    });

    if (zlava != 0) {
        totalzlava = totalcena * zlava / 100 ;
    }

    totalcena = roundNum(totalcena,e);
    totalcena2 = roundNum(totalcena2,e);
    totaldph = roundNum(totaldph,e);
    totalzlava = roundNum(totalzlava,e);

    $('#s-spolu').html(formatMoney(totalcena,2,',','.'));
    $('#s-zlava').html(formatMoney(totalzlava * (-1),2,',','.'));
    $('#s-dph').html(formatMoney(totaldph,2,',','.'));
    $('#s-spoludph').html(formatMoney(totalcena2,2,',','.'));

    var platca = $('#dodavatel-vatpayer').val();
    var uhradene = $('#uhradene').val();
    if (uhradene === '' || uhradene === '-') {
        uhradene = '0';
    }
    var zaklad = (platca === '1') ? totalcena2 : totalcena;
    var kuhrade = zaklad - uhradene - totalzlava;
    kuhrade = roundNum(kuhrade,e);
    $('#s-uhradene').html(formatMoney(uhradene * (-1),2,',','.'));
    $('#s-kuhrade').html(formatMoney(kuhrade,2,',','.'));
    $('#h-suma').val(totalcena);
    $('#h-sumadph').val(totalcena2);
    $('#h-kuhrade').val(kuhrade);
}
$('#dodavatel-town').select2({
    theme: 'bootstrap',
    placeholder: 'Zvoľte mesto',
    tags: false
});
$('#dodavatel-town').on('select2:select',function(){
    var mesto = JSON.parse($(this).val());
    $('#dodavatel-zip').val(mesto.psc);
    $('#dodavatel-country').val(mesto.nazov_statu);
});

$('#get-odber').select2({
    theme: 'bootstrap',
    placeholder: 'Vyberte odberateľa a alebo vyplňte políčka'
});

$(document).on('select2:select','#get-odber',function(){
    var odber = JSON.parse($(this).val());
    $('#odberatel-name').val(odber.obchodne_meno);
    var meno = odber.name_first + ' ' + odber.name_last;
    if (odber.ac_deg_before !== '') {
        meno += ', ' + odber.ac_deg_before;
    }
    if (odber.ac_deg_after !== '') {
        meno += ', ' + odber.ac_deg_after;
    }
    $('#odberatel-contactperson').val(meno);
    var ulica = odber.address;
    if (odber.customer_type !== 'osoba') {
        ulica = odber.ulica;
    }
    var psc = odber.zip;
    if (odber.customer_type !== 'osoba'){
        psc = odber.psc;
    }
    $('#odberatel-zip').val(psc);
    var stat = odber.country;
    if (odber.customer_type !== 'osoba'){
        stat = odber.stat;
    }
    $('#odberatel-country').val(stat);
    var mesto = odber.town;
    if (odber.customer_type !== 'osoba'){
        mesto = odber.mesto;
    }
    $('#odberatel-town option').each(function(){
        var vl_str = $(this).val();
        if (vl_str.length !== 0) {
            var vl = JSON.parse(vl_str);
            var psc1 = vl.psc.replace(' ','');
            if ( psc1 == psc && vl.nazov_obce == mesto) {
                $(this).attr('selected',true).trigger('change');
            }
        }
    });
    $('#odberatel-address').val(ulica);
    $('#odberatel-ico').val(odber.ico);
    $('#odberatel-dic').val(odber.dic);
    $('#odberatel-icdph').val(odber.icdph);
});

$('#odberatel-town').select2({
    theme: 'bootstrap',
    placeholder: 'Zvoľte mesto'
});
$('#dodacia-town').select2({
    theme: 'bootstrap',
    placeholder: 'Zvoľte mesto'
});

$('#odberatel-town').on('select2:select',function(){
    var mesto = JSON.parse($(this).val());
    $('#odberatel-zip').val(mesto.psc);
    $('#oberatel-country').val(mesto.nazov_statu);
});

$('#dodacia-town').on('select2:select',function(){
    var mesto = JSON.parse($(this).val());
    $('#dodacia-zip').val(mesto.psc);
    $('#dodacia-country').val(mesto.nazov_statu);
});

$('#dodavatel-bank').on('change',function(){
    var idx = $(this).find('option:selected').data('idx');
    $('#dodavatel-iban').val($('#def-iban-'+idx).val());
    $('#dodavatel-swift').val($('#def-swift-'+idx).val());
    $('#faktura-mena option:contains("' + $('#def-curr-'+idx).val() + '")').attr('selected', 'selected');
});

$('#konst-symbol').select2({
    theme: "bootstrap",
    placeholder: "Vyberte konštantný symbol"
});