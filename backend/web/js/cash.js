$(document).on('change','#cash-typ',function(){
    var doc_typ = $(this).val();
    if (doc_typ == 'PPD') {
        $('#cash-typ-title').html('Prijaté od');
    } else {
        $('#cash-typ-title').html('Vyplatené');
    }
});

function roundNum(num,dec){
    if(num<0){
        num=(num-0.01*Math.pow(0.1,dec)).toFixed(dec);
    }else{
        num=(num+0.01*Math.pow(0.1,dec)).toFixed(dec);
    }
    num=parseFloat(num);
    if(isNaN(parseFloat(num))){
        num=0;
    }
    return num;
}

$(document).on('change','#mena',function(){
    $('.money').html($(this).val());
});

$('#get-dodav').select2({
    theme: 'bootstrap',
    placeholder: 'Vyberte dodávateľa a alebo vyplňte políčka',
    tags: false
});
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

$('#get-dodav').on('select2:select',function(){
    var company = JSON.parse($(this).val());
    $('#dodavatel-name').val(company.name);
    $('#dodavatel-contactperson').val(company.contact_person);
    $('#dodavatel-address').val(company.address);
    $('#dodavatel-zip').val(company.zip);
    $('#dodavatel-country').val(company.country);
    $('#dodavatel-ico').val(company.ico);
    $('#dodavatel-dic').val(company.dic);
    $('#dodavatel-icdph').val(company.icdph);

    $('#dodavatel-town option').each(function(){
        var vl_str = $(this).val();
        if (vl_str !== '') {
            var vl = JSON.parse(vl_str);
            var psc1 = company.zip.replace(' ','');
            var psc2 = vl.psc.replace(' ','');
            if (psc1 == psc2 && company.town == vl.nazov_obce) {
                $(this).attr('selected',true).trigger('change');
            }
        }
    });
});

$(document).on('change', '#platcadph', function(){
    pocitajSDPH();
});

$(document).on('keyup blur', '#suma', function(){
    pocitajSDPH();
});

$(document).on('keyup blur', '#dan', function(){
    var newVal = $(this).val();
    $(this).val(newVal.replace(',', '.'));

    pocitajSDPH();
});

$(document).on('keyup blur', '#suma2', function(){
    var k = Math.pow(10,4);
    var sumaDPH = $('#suma2').val();
    sumaDPH = parseFloat(sumaDPH.replace(',', '.'));

    var platca = $('#platcadph').val();
    if (platca === '0'){
        var hodnota = Math.round(sumaDPH*k)/k;
        $('#suma').val(hodnota);
    }
    else {
        var dan = $('#dan').val();
        dan = parseFloat(dan.replace(',', '.'));
        var dph = roundNum( sumaDPH - (sumaDPH / (1+(dan/100))),2);
        var sumaBezDPH = roundNum(sumaDPH - dph,2);
        $('#suma').val(sumaBezDPH);
    }
});

function pocitajSDPH() {
    var e = 2;
    var suma = $('#suma').val();
    if (suma === '') {
        suma = '0';
    }
    suma = parseFloat(suma.replace(',', '.'));

    var platca = $('#platcadph').val();
    if (platca === '0') {
        $('.platcaDph').hide();
    }
    else {
        $('.platcaDph').show();
        var dan = $('#dan').val();
        dan = dan.replace(',', '.');
        dan = (dan/100) + 1;
        var suma = $('#suma').val();
        suma = suma.replace(',', '.');
        var hodnota = roundNum(suma*dan,e);
        $('#suma2').val(hodnota);
    }
}

$('#odberatel-town').select2({
    theme: 'bootstrap',
    placeholder: 'Zvoľte mesto'
});
$('#get-odber').select2({
    theme: 'bootstrap',
    placeholder: 'Zvoľte odberateľa'
});
$('#odberatel-town').on('select2:select',function(){
    var mesto = JSON.parse($(this).val());
    $('#odberatel-zip').val(mesto.psc);
    $('#oberatel-country').val(mesto.nazov_statu);
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
$(document).on('change','#cash-typ',function(){
    var doc_typ = $(this).val();
    if (doc_typ == 'PPD') {
        $('#cash-typ-title').html('Prijaté od');
        $('#ucto-text').html('Dal - účet');
    } else {
        $('#cash-typ-title').html('Vyplatené');
        $('#ucto-text').html('Má dať - účet');
    }
});
