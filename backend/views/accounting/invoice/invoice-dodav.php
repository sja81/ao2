<div class="form-group row">
    <div class="col-12">
        <select class="form-control dropdown" id="get-dodav">
            <option value=""></option>
            <?php
                foreach($offices as $item) {
                    echo "<option value='{$item['id']}'>{$item['name']}</option>";
                }
            ?>
        </select>
    </div>
</div>
<div class="form-group row">
    <input type="hidden" id="dodavatel-id" name="Dodavatel[dodavatel_id]">
    <label class="col-3 col-form-label">Spoločnosť:</label>
    <div class="col-9">
        <input type="text" name="Dodavatel[nazov]" class="form-control" id="dodavatel-name" autocomplete="off"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Kontaktná osoba:</label>
    <div class="col-9">
        <input type="text" name="Dodavatel[kontaktna_osoba]" class="form-control" id="dodavatel-contactperson" autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Ulica:</label>
    <div class="col-9">
        <input type="text" name="Dodavatel[ulica]" class="form-control" id="dodavatel-address" autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Mesto:</label>
    <div class="col-9">
        <select
                id="dodavatel-town"
                class="form-control dropdown"
                name="Dodavatel[mesto]"
        >
                <option value=""></option>
            <?php
            foreach($mesto as $it) {
                $jsonIt = json_encode($it);
                echo "<option value='{$jsonIt}'>{$it['nazov_obce']} ({$it['nazov_okresu']})</option>";
            }
            ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">PSČ:</label>
    <div class="col-9">
        <input type="text" name="Dodavatel[psc]" class="form-control" id="dodavatel-zip" autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Štát:</label>
    <div class="col-9">
        <input
                type="text"
                class="form-control dropdown"
                name="Dodavatel[stat]"
                id="dodavatel-country"
                autocomplete="off"
        >
    </div>
</div>
<br>
<div class="form-group row">
    <label class="col-3 col-form-label">IČO:</label>
    <div class="col-9">
        <input
                type="text"
                name="Dodavatel[ico]"
                class="form-control"
                id="dodavatel-ico"
                autocomplete="off"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">DIČ:</label>
    <div class="col-9">
        <input
                type="text"
                name="Dodavatel[dic]"
                class="form-control"
                id="dodavatel-dic"
                autocomplete="off"
        >
    </div>
</div>

<div class="form-group row zalFaSkryt">
    <label class="col-3 col-form-label">IČ DPH:</label>
    <div class="col-9">
        <input
                type="text"
                name="Dodavatel[icdph]"
                id="dodavatel-icdph"
                class="form-control"
                autocomplete="off"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Platca DPH:</label>
    <div class="col-3">
        <select name="Dodavatel[platca_dph]" class="form-control dropdown" id="dodavatel-vatpayer">
            <option value="0" selected>Nie</option>
            <option value="1">Áno</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Info o dodávateľovi:</label>
    <div class="col-9">
        <textarea name="Dodavatel[info]" class="form-control" id="dodavatel-info"></textarea>
    </div>
</div>
<br>
<div class="form-group row">
    <label class="col-3 col-form-label">Telefón:</label>
    <div class="col-9">
        <input
                type="text"
                name="Dodavatel[telefon]"
                id="dodavatel-phone"
                class="form-control"
                autocomplete="off"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Email:</label>
    <div class="col-9">
        <input
                type="text"
                name="Dodavatel[email]"
                class="form-control"
                id="dodavatel-email"
                autocomplete="off"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Web:</label>
    <div class="col-9">
        <input
                type="text"
                name="Dodavatel[web]"
                class="form-control"
                id="dodavatel-web"
                autocomplete="off"
        >
    </div>
</div>
<br>
<div class="form-group row" id="db">
    <label class="col-3 col-form-label">Banka:</label>
    <div class="col-9">
        <select name="Dodavatel[banka]" class="form-control dropdown" id="dodavatel-bank">
            <option value=""><?= Yii::t('app','Zvoľte si banku') ?></option>
        </select>
    </div>
</div>
<br>
<div class="form-group row">
    <label class="col-3 col-form-label">IBAN:</label>
    <div class="col-9">
        <input type="text" name="Dodavatel[iban]" class="form-control" id="dodavatel-iban" autocomplete="off">
    </div>
</div>
<div class="form-group row">
    <label class="col-3 col-form-label">SWIFT:</label>
    <div class="col-9">
        <input type="text" name="Dodavatel[swift]" class="form-control" id="dodavatel-swift">
    </div>
</div>
<?php
$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";
$urlGetCompanyDetails = \yii\helpers\Url::to(['/accounting/ajax-company-details']);
$js = <<<JS

    cleanDodavatel = function() {
        $('#dodavatel-name').val('');
        $('#dodavatel-contactperson').val('');
        $('#dodavatel-address').val('');
        $('#dodavatel-zip').val('');
        $('#dodavatel-country').val('');
        $('#dodavatel-ico').val('');
        $('#dodavatel-dic').val('');
        $('#dodavatel-icdph').val('');
        $('#dodavatel-phone').val('');
        $('#dodavatel-email').val('');
        $('#dodavatel-web').val('');
        $('#dodavatel-info').text('');
        $('#dodavatel-vatpayer option').each(function(){
            $(this).removeAttr('selected');
        });
        
        $('#dodavatel-bank').empty();
        $('#dodavatel-iban').val('');
        $('#dodavatel-swift').val('');
        $('#d1').val('');
        $('#vs0').val('');
        $('#dodavatel-id').val('');
    }
    
    fillDodavatel = function(d) {
        $('#dodavatel-name').val(d.details.name);
        $('#dodavatel-contactperson').val(d.details.contact_person);
        $('#dodavatel-address').val(d.details.address);
        $('#dodavatel-zip').val(d.details.zip);
        $('#dodavatel-country').val(d.details.country);
        $('#dodavatel-ico').val(d.details.ico);
        $('#dodavatel-dic').val(d.details.dic);
        $('#dodavatel-icdph').val(d.details.icdph);
        $('#dodavatel-phone').val(d.details.phone);
        $('#dodavatel-email').val(d.details.email);
        $('#dodavatel-web').val(d.details.web);
        $('#dodavatel-info').text(d.details.registered);
        $('#dodavatel-vatpayer option').each(function(){
            $(this).removeAttr('selected');
        });
        $('#dodavatel-vatpayer option[value=' + d.details.vat_payer + ']').attr('selected','selected');
        $('#dodavatel-town').find('option').each(function(){
            var op = $(this).val();
            if (op !== '') {
                var mesto = JSON.parse(op);
                if (mesto.nazov_obce === d.details.town) {
                    $('#dodavatel-town').val(op).trigger('change');
                }
            }
        });
        let banks = d.details.banks;

        $('#dodavatel-bank').empty().append($('<option>',{value:"",text:"Zvoľte si banku"}));
        $('#dodavatel-iban').val('');
        $('#dodavatel-swift').val('');
        $.each(banks,function(k,v){
            $('#dodavatel-bank').append($('<option>',{value: v.name,text: v.name  + ' (' + v.currency +')'}).attr('data-idx',k));
            if ($('#def-iban-'+k).length) {
                $('#def-iban-'+k).val(v.iban);
            } else {
                $('#db').append($('<input>',{
                    type: 'hidden',
                    id: 'def-iban-'+k,
                    value: v.iban
                }));
            }
            if ($('#def-swift-'+k).length) {
                $('#def-swift-'+k).val(v.swift);
            } else {
                $('#db').append($('<input>',{
                    type: 'hidden',
                    id: 'def-swift-'+k,
                    value: v.swift
                }));
            }
            if ($('#def-curr-'+k).length) {
                $('#def-curr-'+k).val(v.swift);
            } else {
                $('#db').append($('<input>',{
                    type: 'hidden',
                    id: 'def-curr-'+k,
                    value: v.currency
                }));
            }
        });
        $('#d1').val(d.details.lastInvoiceNumber);
        $('#vs0').val(d.details.vs);
        $('#dodavatel-id').val(d.details.id);
            
    }

    $('#get-dodav').on('change',function(){
        
        if ($(this).val() == '') {
            cleanDodavatel();   
        }
        
        $.ajax({
           url: "{$urlGetCompanyDetails}",
           dataType: "json",
           data: { company_id: $(this).val(), {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
            console.log(res.message); 
          } else {
              fillDodavatel(res);
            $('#dodavatel-vatpayer').trigger('change');
            spocitaj();
          }
       });
    });
   
JS;
$this->registerJS($js);

