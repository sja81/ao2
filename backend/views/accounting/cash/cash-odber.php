<?php
use common\models\CashReceipt;
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
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Spoločnosť:</label>
    <?php
    $val = '';
    if (!empty($receiptData)) {
        $val = $receiptData['odberatel']['name'];
    } else if (isset($doklad) && $doklad instanceof CashReceipt) {
        $val = $doklad->odberatel->nazov;
    }
    ?>
    <div class="col-9">
        <input
                type="text"
                name="Doklad[odberatel][name]"
                class="form-control"
                id="odberatel-name"
                autocomplete="off"
                value="<?= $val ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Osoba:</label>
    <?php
    $val = '';
    if (!empty($receiptData)) {
        $val = $receiptData['odberatel']['contact_person'];
    } else if (isset($doklad) && $doklad instanceof CashReceipt) {
        $val = $doklad->odberatel->kontaktna_osoba;
    }
    ?>
    <div class="col-9">
        <input
                type="text"
                name="Doklad[odberatel][contact_person]"
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
        if (!empty($receiptData)) {
            $val = $receiptData['odberatel']['address'];
        } else if (isset($doklad) && $doklad instanceof CashReceipt) {
            $val = $doklad->odberatel->ulica;
        }
        ?>
        <input
                type="text"
                name="Doklad[odberatel][address]"
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
                name="Doklad[odberatel][town]"
                class="form-control"
                id="odberatel-town"
                >
            <option value=""></option>
            <?php
            foreach($mesto as $it) {
                $selected = '';
                if (
                    (isset($receiptData) && $receiptData['odberatel']['town'] == $it['nazov_obce']) ||
                    (isset($doklad) && $doklad instanceof CashReceipt && $doklad->odberatel->mesto == $it['nazov_obce'])
                ){
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
        if (!empty($receiptData)) {
            $val = $receiptData['odberatel']['zip'];
        } else if (isset($doklad) && $doklad instanceof CashReceipt) {
            $val = $doklad->odberatel->psc;
        }
        ?>
        <input
                type="text"
                name="Doklad[odberatel][zip]"
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
        if (!empty($receiptData)) {
            $val = $receiptData['odberatel']['country'];
        } else if (isset($doklad) && $doklad instanceof CashReceipt) {
            $val = $doklad->odberatel->stat;
        }
        ?>
        <input
                type="text"
                name="Doklad[odberatel][country]"
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
        if (!empty($receiptData)) {
            $val = $receiptData['odberatel']['ico'];
        } else if (isset($doklad) && $doklad instanceof CashReceipt) {
            $val = $doklad->odberatel->ico;
        }
        ?>
        <input
                type="text"
                name="Doklad[odberatel][ico]"
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
        if (!empty($receiptData)) {
            $val = $receiptData['odberatel']['dic'];
        } else if (isset($doklad) && $doklad instanceof CashReceipt) {
            $val = $doklad->odberatel->dic;
        }
        ?>
        <input
                type="text"
                name="Doklad[odberatel][dic]"
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
        if (!empty($receiptData)) {
            $val = $receiptData['odberatel']['icdph'];
        } else if (isset($doklad) && $doklad instanceof CashReceipt) {
            $val = $doklad->odberatel->icdph;
        }
        ?>
        <input
                type="text"
                name="Doklad[odberatel][icdph]"
                class="form-control"
                id="odberatel-icdph"
                autocomplete="off"
                value="<?= $val ?>"
        >
    </div>
</div>