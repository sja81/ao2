<?php
use yii\helpers\Url;

$hideIt = $zobraz ? "" : " style='display:none'";
?>
<input type="hidden" name="Data[customer][<?= $i ?>][poradie]" value=<?= $i ?> >
<div class="card customers"<?=$hideIt?> id="customer-<?= $i?>" data-id="<?= $i ?>">
    <div class="card-header bg-info">
        <h4 class="mb-0 text-white">Majiteľ č. <?= $i ?></h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-12 form-group">
                <button type="button" class="btn btn-success" onclick="pridat_op(<?= $i ?>);">Pridať OP</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label class="control-label">Pôvodný text na OP</label>
                <textarea class="form-control" id="op-note-<?= $i ?>" style="background-color: #f0f0f0; border: 1px dotted grey">
                </textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                <label class="control-label">Pôvodný text z LV</label>
                <textarea class="form-control" style="background-color: #f0f0f0; border: 1px dotted grey">
                    <?= $zobraz ? $majitel['POPIS'] : "" ?>
                </textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                <label class="control-label">Typ majiteľa</label>
                <select
                        class="form-control select-drop to-store"
                        onChange="zmen_zakaznika(<?= $i ?>)"
                        name="Data[customer][<?= $i ?>][customer_type]"
                        id="zmen-zakaznika-<?= $i ?>"
                >
                    <option value="osoba" selected>Fyzická osoba</option>
                    <option value="szco">FO - SZČO</option>
                    <option value="firma">Firma</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                <input type="checkbox" id="rovnake-udaje-<?= $i ?>" value="1" class="to-store">&nbsp;OP klientské údaje sú rovnaké ako LV údaje
            </div>
        </div>

        <div class="row" id="obch-meno-<?=$i?>"<?= $zobraz && $majitel['OSOBA_TYP'] != 'PODN' ? " style='display:none'" : ""?>>
            <div class="col-md-12 form-group">
                <label class="control-label">Obchodné meno</label>
                <input
                        id="obchodne-meno-<?= $i ?>"
                        type="text"
                        class="form-control to-store"
                        name="Data[customer][<?= $i ?>][obchodne_meno]"
                        value="<?= $zobraz && $majitel['OSOBA_TYP'] == 'PODN' ? $majitel['INFO']['NAZOV'] : ''?>"
                >
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">Titul pred menom z LV</label>
                <select 
						class="form-control select-drop to-store"
						name="Data[customer][<?= $i ?>][lv_ac_deg_before]" 
						id="lv-deg-before-<?=$i?>"
				>
                    <option value="">Zvoľte titul</option>
                    <?php
                    foreach($titul_pred as $item) {
                        echo "<option value='{$item['short_name']}'>{$item['short_name']}</option>";
                    }
                    ?>
                </select>
            </div>
			<div class="col-md-6 form-group">
                <label class="control-label">Titul pred menom z OP</label>
                <select
                        class="form-control select-drop to-store"
                        name="Data[customer][<?= $i ?>][ac_deg_before]"
                        id="deg-before-<?=$i?>"
                >
                    <option value="">Zvoľte titul</option>
                    <?php
                    foreach($titul_pred as $item) {
                        echo "<option value='{$item['short_name']}'>{$item['short_name']}</option>";
                    }
                    ?>
                </select>
            </div>
		</div>	

		<div class="row">
			<div class="col-md-6 form-group">
                <label class="control-label">Titul za menom z LV</label>
                <select
                        class="form-control select-drop to-store"
                        name="Data[customer][<?= $i ?>][lv_ac_deg_after]"
                        id="lv-deg-after-<?= $i ?>"
                >
                    <option value="">Zvoľte titul</option>
                    <?php
                    foreach($titul_za as $item) {
                        echo "<option value='{$item['short_name']}'>{$item['short_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Titul za menom z OP</label>
                <select
                        class="form-control select-drop to-store"
                        name="Data[customer][<?= $i ?>][ac_deg_after]"
                        id="deg-after-<?= $i ?>"
                >
                    <option value="">Zvoľte titul</option>
                    <?php
                    foreach($titul_za as $item) {
                        echo "<option value='{$item['short_name']}'>{$item['short_name']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">Priezvisko na LV</label>
                <input type="text"
                        id="lv-priezvisko-<?= $i ?>"
                        class="form-control to-store"
                        name="Data[customer][<?= $i ?>][lv_name_last]"
                        value="<?= $zobraz ? $majitel['INFO']['PRIEZVISKO'] : ''?>"
                />
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Priezvisko na OP</label>
                <select
                        id="priezvisko-<?= $i ?>"
                        class="form-control select-drop to-store"
                        name="Data[customer][<?= $i ?>][name_last]"
                >
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">Meno na LV</label>
                <input
                        type="text"
                        class="form-control to-store"
                        name="Data[customer][<?= $i ?>][lv_name_first]"
                        id="lv-meno-zakaznika-<?=$i?>"
                        value="<?= $zobraz ? $majitel['INFO']['MENO'] : '' ?>"
                >
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Meno na OP</label>
                <input
                        type="text"
                        class="form-control to-store"
                        name="Data[customer][<?= $i ?>][name_first]"
                        id="meno-zakaznika-<?=$i?>"
                        value=""
                >
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">Rodné priezvisko na LV</label>
                <input
                        type="text"
                        class="form-control to-store"
                        name="Data[customer][<?= $i ?>][lv_maiden_name]"
                        id="lv-rodne-priezvisko-<?=$i?>"
                        value="<?= $zobraz ? $majitel['INFO']['ROD_MENO'] : '' ?>"
                >
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Rodné priezvisko na OP</label>
                <input
                        type="text"
                        class="form-control to-store"
                        name="Data[customer][<?= $i ?>][maiden_name]"
                        id="rodne-priezvisko-<?=$i?>"
                >
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">Adresa na LV</label>
                <input
                        type="text"
                        class="form-control to-store"
                        name="Data[customer][<?= $i ?>][lv_address]"
                        value="<?= $zobraz ? $majitel['INFO']['ULICA'] : '' ?>"
                        id="lv-adresa-<?= $i ?>"
                >
            </div>
			<div class="col-md-6 form-group">
                <label class="control-label">Adresa na OP</label>
                <input
                        type="text"
                        class="form-control to-store"
                        id="op-ulica-<?= $i?>"
                        name="Data[customer][<?= $i ?>][address]"
                >
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">Mesto na LV</label>
                <select id="lv-obec-<?=$i?>" name="Data[customer][<?= $i ?>][lv_town]" class="form-control to-store">
                    <?php
                    if ($zobraz && isset($majitel['INFO']['MESTO'])) {
                        ?>
                        <option value="<?= $majitel['INFO']['MESTO'] ?>"><?= $majitel['INFO']['MESTO'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
			<div class="col-md-6 form-group">
                <label class="control-label">Mesto na OP</label>
                <select id="obec-<?=$i?>" name="Data[customer][<?= $i ?>][town]" class="form-control to-store">
                </select>
            </div>
		</div>	
		
		<div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">PSČ na LV</label>
                <select id="lv-zip-<?= $i ?>" class="form-control select-drop to-store" name="Data[customer][<?= $i ?>][lv_zip]">
                    <?php
                    if ($zobraz && isset($majitel['INFO']['PSC'])) {
                    ?>
                        <option value="<?= $majitel['INFO']['PSC'] ?>"><?= $majitel['INFO']['PSC'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
			<div class="col-md-6 form-group">
                <label class="control-label">PSČ na OP</label>
                <select id="zip-<?= $i ?>" class="form-control select-drop to-store" name="Data[customer][<?= $i ?>][zip]">
                </select>
            </div>
        </div>

        <div class="row" id="rc-osoba-gender-<?= $i ?>">
            <div class="col-md-6 form-group">
                <label class="control-label">Pohlavie</label>
                <select id="gender-<?= $i ?>" class="form-control select-drop to-store" name="Data[customer][<?= $i ?>][gender]">
                    <option>Zvoľte pohlavie</option>
                    <option value="1">Muž</option>
                    <option value="2">Žena</option>
                </select>
            </div>
        </div>

        <div class="row" id="rc-osoba-<?= $i ?>">
            <div class="col-md-6 form-group">
                <label class="control-label">Dátum narodenia</label>
                <?php
                $datum = false;
                if ($zobraz && isset($majitel['INFO']['DATUM'])) {
                    $datum = (new DateTime($majitel['INFO']['DATUM']))->format("Y-m-d");
                }
                ?>
                <input
                        type="date"
                        class="form-control to-store"
                        name="Data[customer][<?= $i ?>][birth_date]"
                        id="datum-narodenia-<?= $i?>"
                        value="<?= !$datum ? '' : $datum ?>"
                >
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Rodné číslo (zadajte bez lomitka)</label>
                <input
                        type="text"
                        class="form-control to-store"
                        name="Data[customer][<?= $i ?>][ssn]"
                        id="rodne-cislo-<?= $i ?>"
                        onKeyUp="rodne_cislo(<?= $i ?>)"
                >
            </div>
        </div>

        <div class="row" style="display:none" id="ico-box-<?= $i ?>">
            <div class="col-md-6 form-group">
                <label class="control-label">IČO</label>
                <input type="text" class="form-control to-store" name="Data[customer][<?= $i ?>][ico]" id="ico-<?= $i ?>">
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">DIČ</label>
                <input type="text" class="form-control to-store" name="Data[customer][<?= $i ?>][dic]" id="dic-<?= $i ?>">
            </div>
        </div>
        <div class="row" style="display: none;" id="dph-box-<?= $i ?>">
            <div class="col-md-6 form-group">
                <label class="control-label">IČ DPH</label>
                <input type="text" class="form-control to-store" name="Data[customer][<?= $i ?>][icdph]" id="icdph-<?= $i ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">Email</label>
                <input 
					   type="text" 
					   class="form-control to-store"
					   name="Data[customer][<?= $i ?>][email]"
					   id="customer-email-<?= $i ?>"
				>
            </div>
            <div class="col-md-1 form-group">
				<label class="control-label">Telefón</label>
				<select class="form-control select-drop to-store" name="Data[customer][<?= $i ?>][predvolba]" id="predvolba-<?= $i ?>">
				<?php
				foreach($predvolby as $item) {
					echo "<option value={$item['predvolba']}>+{$item['predvolba']}</option>";
				}
				?>
				</select>
			</div>
			<div class="col-md-5 form-inline">
				<span style="margin-left:-10px; margin-right: 5px;">(</span>
                <select class="form-control select-drop col-lg-2 to-store" name="Data[customer][<?= $i ?>][UTO]" id="uto-<?= $i ?>">
                    <?php
                    foreach ($uto as $item) {
                        echo "<option value={$item['operator_kod']}>{$item['operator_kod']}</option>";
                    }
                    ?>
                </select>
				<span style="margin-left: 5px; margin-right: 10px;">)</span>
                <input type="text" class="form-control col-lg-9 to-store" name="Data[customer][<?= $i ?>][cislo]" id="telefon-<?= $i ?>">
            </div>
        </div>

        <?php
        if ($i == $pocet_majitelov) {
            ?>
            <div class="row">
                <div class="col-md-12 form-group">
                    <button
                        type="button"
                        class="btn btn-danger"
                        onClick = "displayCustomer(<?= $i+1 ?>)"
                    >
                        <i class="fa fa-plus"></i>
                        &nbsp;&nbsp;Pridať majiteľa
                    </button>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
</div>

<?php

$url = Url::to(["/contracts/ajax-get-clients"]);
$urlGetObec = Url::to(['/contracts/ajax-get-obec']);
$urlDetail = Url::to(['/contracts/ajax-get-obec-detail']);
$urlPSC = Url::to(['/contracts/ajax-get-psc']);
$urlGetClient = Url::to(['/contracts/ajax-get-client']);

$js = <<<JS

    split_phone = function(s) {
        var len = s.length;
        var o = "";
        if (len == 6) {
            o = s.substring(0,3) + " " + s.substring(3,len);
        }
        if (len == 7) {
            o = s.substring(0,3) + " " + s.substring(3,6) + " " + s.substring(6,len);
        }
        return o;
    }

    $("#telefon-{$i}").on("blur",function(){
        var val = $(this).val();
        if (val == '') {
            $(this).removeClass("is-invalid");
            return false;
        }
        $(this).val(split_phone(val));
    });

    $("#customer-email-{$i}").on("blur",function(){
        var val = $(this).val();
        if (val != '') {
            $(this).removeClass("is-invalid");
        }
    });

	$("#customer-email-{$i}").on("blur",function(){
		let myEmail = $(this).val();
		
		if (myEmail == "") {
		    return;
		}
		
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myEmail)){
		} else {
			$.confirm({
                    title: "Chyba",
                    content: "Zadaný email je chybný alebo neúplný!",
                    type:"red",
                    typeAnimated: true,
                    buttons: {
                        close: function () {
                        }
                    }
			});
			$(this).addClass("is-invalid");
		}
	});

    $("#lv-obec-{$i}").select2({
        theme: "bootstrap",
        minimumInputLength: 3,
        tags: true,
        ajax : {
            url: '{$urlGetObec}',
            dataType: 'json',
            delay: 250,
            data: function(params){
                return {
                    q: params.term
                }
            },
            processResults: function(data,params) {
                return {
                    results: $.map( data.items, function(val,ind){ return {id: val, text: val};})   
                };
            }
        }
    });
	
	$("#obec-{$i}").select2({
        theme: "bootstrap",
        minimumInputLength: 3,
        tags: true,
        ajax : {
            url: '{$urlGetObec}',
            dataType: 'json',
            delay: 250,
            data: function(params){
                return {
                    q: params.term
                }
            },
            processResults: function(data,params) {
                return {
                    results: $.map( data.items, function(val,ind){ return {id: ind, text: val};})   
                };
            }
        }
    });

    $("#lv-zip-{$i}").select2({
        theme: "bootstrap",
        minimumInputLength: 3,
        tags: true,
        ajax : {
            url: '{$urlPSC}',
            dataType: 'json',
            delay: 250,
            data: function(params){
                return {
                    q: params.term
                }
            },
            processResults: function(data,params) {
                return {
                    results: $.map( data.items, function(val,ind){ return {id: ind, text: val};})   
                };
            }
        }
    });
	
	$("#zip-{$i}").select2({
        theme: "bootstrap",
        minimumInputLength: 3,
        tags: true,
        ajax : {
            url: '{$urlPSC}',
            dataType: 'json',
            delay: 250,
            data: function(params){
                return {
                    q: params.term
                }
            },
            processResults: function(data,params) {
                return {
                    results: $.map( data.items, function(val,ind){ return {id: ind, text: val};})   
                };
            }
        }
    });

    $("#lv-obec-{$i}").on("select2:select",function(){
        var town = $("#lv-obec-{$i}").val();
        $.ajax({
            url: '{$urlDetail}',
            dataType: 'json',
            data: {tid: town},
            success: function(data){
               var details = data.details;
               if(details.hasOwnProperty('id')) {
                   $("#lv-obec-{$i}").empty().append($('<option></option>',{value:details.id, text:details.nazov_obce}));
                   $('#lv-zip-{$i}').empty().append($('<option></option>',{id:details.psc,text:details.psc}));
               }
            }
        });
    });
	
	$("#obec-{$i}").on("select2:select",function(){
        var town = $("#obec-{$i}").val();
        $.ajax({
            url: '{$urlDetail}',
            dataType: 'json',
            data: {tid: town},
            success: function(data){
               var details = data.details;
               if(details.hasOwnProperty('id')) {
                   $("#obec-{$i}").empty().append($('<option></option>',{value:details.id, text:details.nazov_obce}));
                   $('#zip-{$i}').empty().append($('<option></option>',{id:details.psc,text:details.psc}));
               }
            }
        });
    });
    
    $("#lv-zip-{$i}").on("select2:select",function(){
        var town = $("#lv-zip-{$i}").val();
        $.ajax({
            url: '{$urlDetail}',
            dataType: 'json',
            data: {tid: town},
            success: function(data){
               var details = data.details;
               if(details.hasOwnProperty('id')) {
                   $("#obec-{$i}").empty().append($('<option></option>',{value:details.id, text:details.nazov_obce}));
                   $('#zip-{$i}').empty().append($('<option></option>',{id:details.psc,text:details.psc}));
               }
            }
        });
    });
	
	$("#zip-{$i}").on("select2:select",function(){
        var town = $("#zip-{$i}").val();
        $.ajax({
            url: '{$urlDetail}',
            dataType: 'json',
            data: {tid: town},
            success: function(data){
               var details = data.details;
               if(details.hasOwnProperty('id')) {
                   $("#obec-{$i}").empty().append($('<option></option>',{value:details.id, text:details.nazov_obce}));
                   $('#zip-{$i}').empty().append($('<option></option>',{id:details.psc,text:details.psc}));
               }
            }
        });
    });

    $('#priezvisko-{$i}').select2({
        theme: "bootstrap",
        minimumInputLength: 3,
        tags: true,
        ajax : {
            url: '{$url}',
            dataType: 'json',
            delay: 250,
            data: function(params){
                return {
                    q: params.term
                }
            },
            processResults: function(data,params) {
                return {
                    results: $.map( data.items, function(val,ind){ return {id: ind, text: val};})   
                };
            }
        }
    });
    
    $('#priezvisko-{$i}').on('select2:select',function(){
       
        var id = $('#priezvisko-{$i}').val();
        $.ajax({
            url: '{$urlGetClient}',
            dataType: 'json',
            data: {uid: id},
            success: function(data){
               var details = data.details;
               
               if (details == false) {
                   return;
               }
               
               var phone = details.phone.split(",");
               console.log(phone);
               if (phone.length == 1) {
                   $("input[name='Data[customer][{$i}][cislo]']").val(phone[0]);
               } else if (phone.length == 3) {
                   $("input[name='Data[customer][{$i}][predvolba]']").val(phone[0]);
                   $("input[name='Data[customer][{$i}][UTO]']").val(phone[1]);
                   $("input[name='Data[customer][{$i}][cislo]']").val(phone[2]);
               } else {
                   $("input[name='Data[customer][{$i}][cislo]']").val(details.phone);
               }
               
               $("#priezvisko-{$i}").empty().append($('<option></option>',{value:details.name_last, text:details.name_last}));
               $("#zmen-zakaznika-{$i}").find('option[value="' + details.typ_zakaznika + '"]').prop("selected", true);
               $("#deg-before-{$i}").find('option[value="' + details.ac_deg_before + '"]').prop("selected", true);
               $("input[name='Data[customer][{$i}][name_first]']").val(details.name_first);
               
               $("input[name='Data[customer][{$i}][email]']").val(details.email);
               $("input[name='Data[customer][{$i}][adresa]']").val(details.adresa);
               $("input[name='Data[customer][{$i}][rodne_cislo]']").val(details.rodne_cislo);
               $("#datum-narodenia-{$i}").val(details.birth_date);
               $("select[name='Data[customer][{$i}][town_id]']").empty().append($('<option></option>',{value:details.town_id, text:details.nazov_obce}));
			   $("select[name='Data[customer][{$i}][zip]']").empty().append($('<option></option>',{value:details.zip, text:details.zip}));
			   $("input[name='Data[customer][{$i}][rodne_priezvisko]").val(details.rodne_priezvisko);
               
               if(details.typ_zakaznika == 'osoba') {
                   $('#obch-meno-{$i}').hide();
                   $('#ico-box-{$i}').hide();
                   $('#dph-box-{$i}').hide();

               } else if(details.typ_zakaznika == 'szco' || details.typ_zakaznika == 'firma') {
                   $('#obch-meno-{$i}').show();
                   $('#ico-box-{$i}').show();
                   $('#dph-box-{$i}').show();
                   $("input[name='Data[customer][{$i}][obchodne_meno]']").val(details.obchodne_meno);
                   $("input[name='Data[customer][{$i}][ico]']").val(details.ico);
                   $("input[name='Data[customer][{$i}][dic]']").val(details.dic);
                   $("input[name='Data[customer][{$i}][icdph]']").val(details.icdph);
               }
            }
        });
    });
    
    $('#rovnake-udaje-{$i}').on('change',function(){
       if( $(this).prop('checked') == true ) {
           $('#deg-before-{$i}').val($('#lv-deg-before-{$i}').val());
           $('#deg-after-{$i}').val($('#lv-deg-after-{$i}').val());
           $('#priezvisko-{$i}').empty().append($('<option></option>',{value:$('#lv-priezvisko-{$i}').val(), text:$('#lv-priezvisko-{$i}').val()}));
           $('#meno-zakaznika-{$i}').val($('#lv-meno-zakaznika-{$i}').val());
           $('#rodne-priezvisko-{$i}').val($('#lv-rodne-priezvisko-{$i}').val());
           $('#op-ulica-{$i}').val($('#lv-adresa-{$i}').val());
           $('#obec-{$i}').empty().append($('<option></option>',{value:$('#lv-obec-{$i}').val(), text:$('#lv-obec-{$i}').text()}));
           $('#zip-{$i}').empty().append($('<option></option>',{value:$('#lv-zip-{$i}').val(), text:$('#lv-zip-{$i}').val()}));
       } else {
           $('#deg-before-{$i}').val('');
           $('#deg-after-{$i}').val('');
           $('#priezvisko-{$i}').empty();
           $('#meno-zakaznika-{$i}').val('');
           $('#rodne-prievisko-{$i}').val('');
           $('#op-ulica-{$i}').val('');
           $('#obec-{$i}').empty();
           $('#zip-{$i}').empty();
       }
    });
JS;

$this->registerJS($js);
?>


