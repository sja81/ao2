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
    <input type="hidden" id="dodavatel-id" name="Dodavatel[dodavatel_id]" value="<?= $invoice->dodavatel->dodavatel_id ?>">
    <label class="col-3 col-form-label">Spoločnosť:</label>
    <div class="col-9">
        <input
                type="text"
                name="Dodavatel[nazov]"
                class="form-control"
                id="dodavatel-name"
                autocomplete="off"
                value="<?= $invoice->dodavatel->nazov ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Kontaktná osoba:</label>
    <div class="col-9">
        <input
                type="text"
                name="Dodavatel[kontaktna_osoba]"
                class="form-control"
                id="dodavatel-contactperson"
                autocomplete="off"
                value="<?= $invoice->dodavatel->kontaktna_osoba ?>">
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Ulica:</label>
    <div class="col-9">
        <input
                type="text"
                name="Dodavatel[ulica]"
                class="form-control"
                id="dodavatel-address"
                autocomplete="off"
                value="<?= $invoice->dodavatel->ulica ?>">
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
                $selected = $invoice->dodavatel->mesto == $it['nazov_obce'] ? " selected" : '';
                echo "<option value='{$jsonIt}'{$selected}>{$it['nazov_obce']}".($selected != "" ? "" : "({$it['nazov_okresu']})" )."</option>";
            }
            ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">PSČ:</label>
    <div class="col-9">
        <input
                type="text"
                name="Dodavatel[psc]"
                class="form-control"
                id="dodavatel-zip"
                autocomplete="off"
                value="<?= $invoice->dodavatel->psc ?>">
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
                value = "<?= $invoice->dodavatel->stat ?>"
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
                value="<?= $invoice->dodavatel->ico ?>"
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
                value="<?= $invoice->dodavatel->dic ?>"
        >
    </div>
</div>

<div class="form-group row zalFaSkryt"<?= $invoice->dodavatel->platca_dph == 0 ? ' style="display:none"': '' ?>>
    <label class="col-3 col-form-label">IČ DPH:</label>
    <div class="col-9">
        <input
                type="text"
                name="Dodavatel[icdph]"
                id="dodavatel-icdph"
                class="form-control"
                autocomplete="off"
                value="<?= $invoice->dodavatel->icdph ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Platca DPH:</label>
    <div class="col-3">
        <select name="Dodavatel[platca_dph]" class="form-control dropdown" id="dodavatel-vatpayer">
            <option value="0"<?= $invoice->dodavatel->platca_dph == 0 ? ' selected': '' ?>>Nie</option>
            <option value="1"<?= $invoice->dodavatel->platca_dph == 1 ? ' selected': '' ?>>Áno</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Info o dodávateľovi:</label>
    <div class="col-9">
        <textarea name="Dodavatel[info]" class="form-control" id="dodavatel-info"><?= $invoice->dodavatel->info ?></textarea>
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
                value="<?= $invoice->dodavatel->telefon ?>"
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
                value="<?= $invoice->dodavatel->email ?>"
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
                value="<?= $invoice->dodavatel->web ?>"
        >
    </div>
</div>
<br>
<div class="form-group row" id="db">
    <label class="col-3 col-form-label">Banka:</label>
    <div class="col-9">
        <?php
        if (count($office->accounts) > 1) {
            foreach ($office->accounts as $idx => $item) {
        ?>
            <input type="hidden" id="def-iban-<?= $idx ?>" value="<?= $item->iban ?>" />
            <input type="hidden" id="def-swift-<?= $idx ?>" value="<?= $item->swift ?>" />
            <input type="hidden" id="def-curr-"<?= $idx ?>" value="<?= $item->currency ?>" />
        <?php
            }
        }
        ?>
        <select name="Dodavatel[banka]" class="form-control dropdown" id="dodavatel-bank">
            <option value=""><?= Yii::t('app','Zvoľte si banku')?></option>
            <?php
            foreach($office->accounts as $idx => $item) {
                $selected = '';
                if ($invoice->dodavatel->iban == $item->iban) {
                    $selected = ' selected';
                }
                echo "<option value='{$item->details->name}' data-idx='{$idx}'{$selected}>{$item->details->name} ({$item->currency})</option>";
            }
            ?>
        </select>
    </div>
</div>
<br>
<div class="form-group row">
    <label class="col-3 col-form-label">IBAN:</label>
    <div class="col-9">
        <input
                type="text"
                name="Dodavatel[iban]"
                class="form-control"
                id="dodavatel-iban"
                autocomplete="off"
                value="<?= $invoice->dodavatel->iban?>"
        >
    </div>
</div>
<div class="form-group row">
    <label class="col-3 col-form-label">SWIFT:</label>
    <div class="col-9">
        <input
                type="text"
                name="Dodavatel[swift]"
                class="form-control"
                id="dodavatel-swift"
                value="<?= $invoice->dodavatel->swift ?>"
        >
    </div>
</div>
<?php
$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";
$urlGetCompanyDetails = \yii\helpers\Url::to(['/accounting/ajax-company-details']);
$js = <<<JS
    $('#get-dodav').on('change',function(){
        $.ajax({
           url: "{$urlGetCompanyDetails}",
           dataType: "json",
           data: { company_id: $(this).val(), {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             
          } else {
            $('#dodavatel-name').val(res.details.name);
            $('#dodavatel-contactperson').val(res.details.contact_person);
            $('#dodavatel-address').val(res.details.address);
            $('#dodavatel-zip').val(res.details.zip);
            $('#dodavatel-country').val(res.details.country);
            $('#dodavatel-ico').val(res.details.ico);
            $('#dodavatel-dic').val(res.details.dic);
            $('#dodavatel-icdph').val(res.details.icdph);
            $('#dodavatel-phone').val(res.details.phone);
            $('#dodavatel-email').val(res.details.email);
            $('#dodavatel-web').val(res.details.web);
            $('#dodavatel-info').text(res.details.registered);
            $('#dodavatel-vatpayer option').each(function(){
                $(this).removeAttr('selected');
            });
            $('#dodavatel-vatpayer option[value=' + res.details.vat_payer + ']').attr('selected','selected');
            $('#dodavatel-town').find('option').each(function(){
                var op = $(this).val();
                if (op !== '') {
                    var mesto = JSON.parse(op);
                    if (mesto.nazov_obce === res.details.town) {
                        $('#dodavatel-town').val(op).trigger('change');
                    }
                }
            });
            let banks = res.details.banks;
 
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
            $('#d1').val(res.details.lastInvoiceNumber);
            $('#vs0').val(res.details.vs);
            $('#dodavatel-id').val(res.details.id);
            $('#dodavatel-vatpayer').trigger('change');
            spocitaj();
          }
       });
    });
   
JS;
$this->registerJS($js);

