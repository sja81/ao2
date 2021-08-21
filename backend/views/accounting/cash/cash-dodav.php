<?php
use common\models\Office;
use common\models\CashReceipt;
?>
<div class="form-group row">
    <div class="col-12">
        <select class="form-control dropdown" id="get-dodav">
            <option value=""></option>
            <?php
                foreach($office as $item) {
                    $jsonItem = json_encode($item);
                    echo "<option value='{$jsonItem}'>{$item['name']}</option>";
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
        $val = $receiptData['dodavatel']['name'];
    } else if (empty($receiptData) && !isset($doklad) && isset($default_office) && $default_office instanceof Office) {
        $val = $default_office->name;
    } else if (isset($doklad) && $doklad instanceof CashReceipt) {
        $val = $doklad->dodavatel->nazov;
    }
    ?>
    <div class="col-9">
        <input
            type="text"
            name="Doklad[dodavatel][name]"
            class="form-control"
            id="dodavatel-name"
            value="<?= $val ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Ulica:</label>
    <?php
    $val = '';
    if (!empty($receiptData)) {
        $val = $receiptData['dodavatel']['address'];
    } else if (empty($receiptData) && !isset($doklad) && isset($default_office) && $default_office instanceof Office) {
        $val = $default_office->address;
    } else if (isset($doklad) && $doklad instanceof CashReceipt) {
        $val = $doklad->dodavatel->ulica;
    }
    ?>
    <div class="col-9">
        <input
                type="text"
                name="Doklad[dodavatel][address]"
                class="form-control"
                id="dodavatel-address"
                value="<?= $val ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">Mesto:</label>
    <div class="col-9">
        <select
                id="dodavatel-town"
                class="form-control dropdown"
                name="Doklad[dodavatel][town]"
        >
            <option value=""></option>
            <?php
            foreach($mesto as $it) {
                $jsonIt = json_encode($it);
                $selected = "";
                if (
                    (!empty($receiptData) && $receiptData['dodavatel']['town'] == $it['nazov_obce']) ||
                    (empty($receiptData) && !isset($doklad) && isset($default_office) && $default_office->town == $it['nazov_obce']) ||
                    (isset($doklad) && $doklad instanceof CashReceipt && $doklad->dodavatel->mesto == $it['nazov_obce'])
                ) {
                    $selected = " selected";
                }
                echo "<option value='{$jsonIt}'{$selected}>{$it['nazov_obce']}".($selected != "" ? "" : "({$it['nazov_okresu']})" )."</option>";
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
            $val = $receiptData['dodavatel']['zip'];
        } else if (empty($receiptData) && !isset($doklad) && isset($default_office) && $default_office instanceof Office) {
            $val = $default_office->zip;
        } else if (isset($doklad) && $doklad instanceof CashReceipt) {
            $val = $doklad->dodavatel->psc;
        }
        ?>
        <input
                type="text"
                name="Doklad[dodavatel][zip]"
                class="form-control"
                id="dodavatel-zip"
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
            $val = $receiptData['dodavatel']['country'];
        } else if (empty($receiptData) && !isset($doklad) && isset($default_office) && $default_office instanceof Office) {
            $val = $default_office->country;
        } else if (isset($doklad) && $doklad instanceof CashReceipt) {
            $val = $doklad->dodavatel->stat;
        }
        ?>
        <input
                type="text"
                class="form-control dropdown"
                name="Doklad[dodavatel][country]"
                id="dodavatel-country"
                value = "<?= $val ?>"
            >
        </input>
    </div>
</div>
<br>
<div class="form-group row">
    <label class="col-3 col-form-label">IČO:</label>
    <div class="col-9">
        <?php
        $val = '';
        if (!empty($receiptData)) {
            $val = $receiptData['dodavatel']['ico'];
        } else if (empty($receiptData) && !isset($doklad) && isset($default_office) && $default_office instanceof Office) {
            $val = $default_office->ico;
        } else if (isset($doklad) && $doklad instanceof CashReceipt) {
            $val = $doklad->dodavatel->ico;
        }
        ?>
        <input
                type="text"
                name="Doklad[dodavatel][ico]"
                class="form-control"
                id="dodavatel-ico"
                value="<?= $val ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">DIČ:</label>
    <?php
    $val = '';
    if (!empty($receiptData)) {
        $val = $receiptData['dodavatel']['dic'];
    } else if (empty($receiptData) && !isset($doklad) && isset($default_office) && $default_office instanceof Office) {
        $val = $default_office->dic;
    } else if (isset($doklad) && $doklad instanceof CashReceipt) {
        $val = $doklad->dodavatel->dic;
    }
    ?>
    <div class="col-9">
        <input
                type="text"
                name="Doklad[dodavatel][dic]"
                class="form-control"
                id="dodavatel-dic"
                value="<?= $val ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-3 col-form-label">IČ DPH:</label>
    <?php
    $val = '';
    if (!empty($receiptData)) {
        $val = $receiptData['dodavatel']['icdph'];
    } else if (empty($receiptData) && !isset($doklad) && isset($default_office) && $default_office instanceof Office) {
        $val = $default_office->icdph;
    } else if (isset($doklad) && $doklad instanceof CashReceipt) {
        $val = $doklad->dodavatel->icdph;
    }
    ?>
    <div class="col-9">
        <input
                type="text"
                name="Doklad[dodavatel][icdph]"
                id="dodavatel-icdph"
                class="form-control"
                value="<?= $val ?>"
        >
    </div>
</div>
