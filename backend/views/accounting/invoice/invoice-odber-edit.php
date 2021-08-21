<?php
use common\models\Invoice;
?>
<div class="form-group row">
    <label class="col-3 col-form-label">Spoločnosť:</label>
    <div class="col-9">
        <input
                type="text"
                name="Odberatel[nazov]"
                class="form-control"
                id="odberatel-name"
                autocomplete="off"
                value="<?= $invoice->customer->nazov ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Osoba:</label>
    <div class="col-9">
        <input
                type="text"
                name="Odberatel[kontaktna_osoba]"
                class="form-control"
                id="odberatel-contactperson"
                autocomplete="off"
                value="<?= $invoice->customer->kontaktna_osoba ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Ulica:</label>
    <div class="col-9">
        <input
                type="text"
                name="Odberatel[ulica]"
                class="form-control"
                id="odberatel-address"
                autocomplete="off"
                value="<?= $invoice->customer->ulica ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Mesto:</label>
    <div class="col-9">
        <select
                type="text"
                name="Odberatel[mesto]"
                class="form-control"
                id="odberatel-town"
                >
            <option value=""></option>
            <?php
            foreach($mesto as $it) {
                $selected = $invoice->customer->mesto == $it['nazov_obce'] ? ' selected' : '';
                $jsonIt = json_encode($it);
                echo "<option value='{$jsonIt}'{$selected}>{$it['nazov_obce']} ({$it['nazov_okresu']})</option>";
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
                name="Odberatel[psc]"
                class="form-control"
                id="odberatel-zip"
                autocomplete="off"
                value="<?= $invoice->customer->psc ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Štát:</label>
    <div class="col-9">
        <input
                type="text"
                name="Odberatel[stat]"
                class="form-control"
                id="oberatel-country"
                autocomplete="off"
                value="<?= $invoice->customer->stat ?>"
        >
    </div>
</div>

<br>

<div class="form-group row">
    <label class="col-3 col-form-label">IČO:</label>
    <div class="col-9">
        <input
                type="text"
                name="Odberatel[ico]"
                class="form-control"
                id="odberatel-ico"
                autocomplete="off"
                value="<?= $invoice->customer->ico ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">DIČ:</label>
    <div class="col-9">
        <input
                type="text"
                name="Odberatel[dic]"
                class="form-control"
                id="odberatel-dic"
                autocomplete="off"
                value="<?= $invoice->customer->dic ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">IČ DPH:</label>
    <div class="col-9">
        <input
                type="text"
                name="Odberatel[icdph]"
                class="form-control"
                id="odberatel-icdph"
                autocomplete="off"
                value="<?= $invoice->customer->icdph ?>"
        >
    </div>
</div>
<br>
<br>
<br>
<div class="form-group row">
    <label class="col-3 col-form-label">Info o odberateľovi:</label>
    <div class="col-9">
        <textarea class="form-control" name="Odberatel[poznamka]"><?= $invoice->customer->poznamka ?></textarea>
    </div>
</div>
<br>
<h6><span class="font-weight-bold">Adresa dodania</span> (ak je iná ako adresa odberateľa)</h6>
<br>
<div class="form-group row">
    <label class="col-3 col-form-label">Spoločnosť:</label>
    <div class="col-9">
        <input
                type="text"
                name="Odberatel[dodacia_nazov]"
                class="form-control"
                autocomplete="off"
                value="<?= $invoice->customer->dodacia_nazov ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Osoba:</label>
    <div class="col-9">
        <input
                type="text"
                name="Odberatel[dodacia_kontaktna_osoba]"
                class="form-control"
                autocomplete="off"
                value="<?= $invoice->customer->dodacia_kontaktna_osoba ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Ulica:</label>
    <div class="col-9">
        <input
                type="text"
                name="Odberatel[dodacia_ulica]"
                class="form-control"
                autocomplete="off"
                value="<?= $invoice->customer->dodacia_ulica ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Mesto:</label>
    <div class="col-9">
        <select
                name="Odberatel[dodacia_mesto]"
                class="form-control"
                id="dodacia-town"
        >
            <option value=""></option>
            <?php
            foreach($mesto as $it){
                $selected = '';
                if ($invoice->customer->dodacia_mesto == $it['nazov_obce']) {
                    $selected = ' selected';
                }
                $jsonIt = json_encode($it);
                echo "<option value='{$jsonIt}'{$selected}>{$it['nazov_obce']} ({$it['nazov_okresu']})</option>";
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
                name="Odberatel[dodacia_psc]"
                class="form-control"
                id="dodacia-zip"
                autocomplete="off"
                value="<?= $invoice->customer->dodacia_psc ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Štát:</label>
    <div class="col-9">
        <input
                type="text"
                name="Odberatel[dodacia_stat]"
                class="form-control"
                id="dodacia-country"
                autocomplete="off"
                value="<?= $invoice->customer->dodacia_stat ?>"
        >
    </div>
</div>
