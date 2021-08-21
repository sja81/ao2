<?php
use common\models\Invoice;
?>
<div class="form-group row">
    <div class="col-12">
        <select class="form-control dropdown" id="get-odber">
            <option value=""></option>
            <?php
            foreach($clients as $it) {
                $jsonOdberatel = json_encode($it);
                $nazov = "{$it['name_first']} {$it['name_last']} - r.č.: {$it['ssn']}";
                if ( in_array($it['customer_type'],['szco','firma']) ) {
                    $nazov = "{$it['obchodne_meno']} - IČO: {$it['ico']}";
                }
                echo "<option value='{$jsonOdberatel}'>{$nazov}</option>";
            }
            ?>
        </select>
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Spoločnosť:</label>
    <div class="col-9">
        <?php
        $val = '';
        if (!empty($odberatelData)) {
            $val = $odberatelData['nazov'];
        }
        if (isset($invoice) && $invoice instanceof Invoice) {
            $val = $invoice->customer->nazov;
        }
        ?>
        <input
                type="text"
                name="Odberatel[nazov]"
                class="form-control"
                id="odberatel-name"
                autocomplete="off"
                value="<?= $val ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Osoba:</label>
    <div class="col-9">
        <?php
        $val = '';
        if (!empty($odberatelData)) {
            $val = $odberatelData['kontaktna_osoba'];
        }
        if (isset($invoice) && $invoice instanceof Invoice) {
            $val = $invoice->customer->kontaktna_osoba;
        }
        ?>
        <input
                type="text"
                name="Odberatel[kontaktna_osoba]"
                class="form-control"
                id="odberatel-contactperson"
                autocomplete="off"
                value="<?= $val ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Ulica:</label>
    <div class="col-9">
        <?php
        $val = '';
        if (!empty($odberatelData)) {
            $val = $odberatelData['ulica'];
        }
        if (isset($invoice) && $invoice instanceof Invoice) {
            $val = $invoice->customer->ulica;
        }
        ?>
        <input
                type="text"
                name="Odberatel[ulica]"
                class="form-control"
                id="odberatel-address"
                autocomplete="off"
                value="<?= $val ?>"
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

                $selected = '';
                if (!empty($odberatelData) && $odberatelData['mesto'] == $it['nazov_obce']) {
                    $selected = ' selected';
                }
                if (isset($invoice) && $invoice instanceof Invoice && $invoice->customer->mesto == $it['nazov_obce']) {
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
        <?php
        $val = '';
        if (!empty($odberatelData)) {
            $val = $odberatelData['psc'];
        }
        if (isset($invoice) && $invoice instanceof Invoice) {
            $val = $invoice->customer->psc;
        }
        ?>
        <input
                type="text"
                name="Odberatel[psc]"
                class="form-control"
                id="odberatel-zip"
                autocomplete="off"
                value="<?= $val ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Štát:</label>
    <div class="col-9">
        <?php
        $val = '';
        if (!empty($odberatelData)) {
            $val = $odberatelData['stat'];
        }
        if (isset($invoice) && $invoice instanceof Invoice) {
            $val = $invoice->customer->stat;
        }
        ?>
        <input
                type="text"
                name="Odberatel[stat]"
                class="form-control"
                id="oberatel-country"
                autocomplete="off"
                value="<?= $val ?>"
        >
    </div>
</div>

<br>

<div class="form-group row">
    <label class="col-3 col-form-label">IČO:</label>
    <div class="col-9">
        <?php
        $val = '';
        if (!empty($odberatelData)) {
            $val = $odberatelData['ico'];
        }
        if (isset($invoice) && $invoice instanceof Invoice) {
            $val = $invoice->customer->ico;
        }
        ?>
        <input
                type="text"
                name="Odberatel[ico]"
                class="form-control"
                id="odberatel-ico"
                autocomplete="off"
                value="<?= $val ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">DIČ:</label>
    <div class="col-9">
        <?php
        $val = '';
        if (!empty($odberatelData)) {
            $val = $odberatelData['dic'];
        }
        if (isset($invoice) && $invoice instanceof Invoice) {
            $val = $invoice->customer->dic;
        }
        ?>
        <input
                type="text"
                name="Odberatel[dic]"
                class="form-control"
                id="odberatel-dic"
                autocomplete="off"
                value="<?= $val ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">IČ DPH:</label>
    <div class="col-9">
        <?php
        $val = '';
        if (!empty($odberatelData)) {
            $val = $odberatelData['icdph'];
        }
        if (isset($invoice) && $invoice instanceof Invoice) {
            $val = $invoice->customer->icdph;
        }
        ?>
        <input
                type="text"
                name="Odberatel[icdph]"
                class="form-control"
                id="odberatel-icdph"
                autocomplete="off"
                value="<?= $val ?>"
        >
    </div>
</div>
<br>
<br>
<br>
<div class="form-group row">
    <label class="col-3 col-form-label">Info o odberateľovi:</label>
    <div class="col-9">
        <?php
        $val = '';
        if (!empty($odberatelData)) {
            $val = $odberatelData['poznamka'];
        }
        if (isset($invoice) && $invoice instanceof Invoice) {
            $val = $invoice->customer->poznamka;
        }
        ?>
        <textarea class="form-control" name="Odberatel[poznamka]">
            <?= $val ?>
        </textarea>
    </div>
</div>
<br>
<h6><span class="font-weight-bold">Adresa dodania</span> (ak je iná ako adresa odberateľa)</h6>
<br>
<div class="form-group row">
    <label class="col-3 col-form-label">Spoločnosť:</label>
    <div class="col-9">
        <?php
        $val = '';
        if (!empty($odberatelData)) {
            $val = $odberatelData['dodacia_nazov'];
        }
        if (isset($invoice) && $invoice instanceof Invoice) {
            $val = $invoice->customer->dodacia_nazov;
        }
        ?>
        <input
                type="text"
                name="Odberatel[dodacia_nazov]"
                class="form-control"
                autocomplete="off"
                value="<?= $val ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Osoba:</label>
    <div class="col-9">
        <?php
        $val = '';
        if (!empty($odberatelData)) {
            $val = $odberatelData['dodacia_kontaktna_osoba'];
        }
        if (isset($invoice) && $invoice instanceof Invoice) {
            $val = $invoice->customer->dodacia_kontaktna_osoba;
        }
        ?>
        <input
                type="text"
                name="Odberatel[dodacia_kontaktna_osoba]"
                class="form-control"
                autocomplete="off"
                value="<?= $val ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Ulica:</label>
    <div class="col-9">
        <?php
        $val = '';
        if (!empty($odberatelData)) {
            $val = $odberatelData['dodacia_ulica'];
        }
        if (isset($invoice) && $invoice instanceof Invoice) {
            $val = $invoice->customer->dodacia_ulica;
        }
        ?>
        <input
                type="text"
                name="Odberatel[dodacia_ulica]"
                class="form-control"
                autocomplete="off"
                value="<?= $val ?>"
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
                if (!empty($odberatelData) && $odberatelData['dodacia_mesto'] == $it['nazov_obce']) {
                    $selected = ' selected';
                }
                if (isset($invoice) && $invoice instanceof Invoice && $invoice->customer->dodacia_mesto == $it['nazov_obce']) {
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
        <?php
        $val = '';
        if (!empty($odberatelData)) {
            $val = $odberatelData['dodacia_psc'];
        }
        if (isset($invoice) && $invoice instanceof Invoice) {
            $val = $invoice->customer->dodacia_psc;
        }
        ?>
        <input
                type="text"
                name="Odberatel[dodacia_psc]"
                class="form-control"
                id="dodacia-zip"
                autocomplete="off"
                value="<?= $val ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Štát:</label>
    <div class="col-9">
        <?php
        $val = '';
        if (!empty($odberatelData)) {
            $val = $odberatelData['dodacia_stat'];
        }
        if (isset($invoice) && $invoice instanceof Invoice) {
            $val = $invoice->customer->dodacia_stat;
        }
        ?>
        <input
                type="text"
                name="Odberatel[dodacia_stat]"
                class="form-control"
                id="dodacia-country"
                autocomplete="off"
                value="<?= $val ?>"
        >
    </div>
</div>
