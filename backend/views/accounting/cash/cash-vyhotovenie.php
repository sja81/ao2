<?php
use common\models\CashReceipt;
?>
<div class="form-group row">
    <label class="col-6 col-form-label">Účel:</label>
    <?php
    $val = '';
    if (isset($doklad) && $doklad instanceof CashReceipt) {
        $val = $doklad->ucel;
    }
    if (isset($receiptData)) {
        $val = $receiptData['ucel'];
    }
    ?>
    <div class="col-6">
        <input
                type="text"
                class="form-control"
                name="Doklad[ucel]"
                autocomplete="off"
                value="<?= $val ?>"
        >
    </div>
</div>

<div class="form-group row">
    <label class="col-6 col-form-label">Vyhotovil:</label>
    <?php
    $val = '';
    if (isset($doklad) && $doklad instanceof CashReceipt) {
        $val = $doklad->vyhotovil;
    } else if (isset($receiptData)) {
        $val = $receiptData['vyhotovil'];
    } else if (isset($default_office)) {
        $val = $default_office->contact_person;
    }
    ?>
    <div class="col-6">
        <input type="text" class="form-control" name="Doklad[vyhotovil]" value="<?= $val ?>" autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <label class="col-6 col-form-label">Schválil:</label>
    <?php
    $val = '';
    if (isset($doklad) && $doklad instanceof CashReceipt) {
        $val = $doklad->vyhotovil;
    } else if (isset($receiptData)) {
        $val = $receiptData['vyhotovil'];
    } else if (isset($default_office)) {
        $val = $default_office->contact_person;
    }
    ?>
    <div class="col-6">
        <input type="text" class="form-control" name="Doklad[schvalil]" value="<?= $val ?>" autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <label class="col-6 col-form-label">Zúčtované v denníku pod poradovým číslom:</label>
    <div class="col-6">
        <input type="text" class="form-control" name="Doklad[zuctovane]" autocomplete="off">
    </div>
</div>