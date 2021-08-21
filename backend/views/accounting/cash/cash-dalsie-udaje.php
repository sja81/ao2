<?php
use common\models\CashReceipt;
?>
<div class="form-group row">
    <label class="col-1 col-form-label">Mena:</label>
    <div class="col-5">
        <select class="form-control dropdown" name="Doklad[mena]" id="mena">
            <?php
            foreach ($currencies as $it) {
                $selected = '';
                if (
                    (isset($receiptData) && $receiptData['mena'] == $it->mena) ||
                    (isset($doklad) && $doklad instanceof CashReceipt && $doklad->mena == $it->mena)
                ) {
                    $selected = ' selected';
                }
                echo "<option value='{$it->mena}'{$selected}>{$it->mena}</option>";
            }
            ?>
        </select>
    </div>
    <label class="col-1 col-form-label">Suma bez DPH:</label>
    <div class="col-5">
        <?php
        $val = '';
        if (isset($receiptData)) {
            $val = $receiptData['suma'];
        }
        if (isset($doklad) && $doklad instanceof CashReceipt) {
            $val = $doklad->suma;
        }
        ?>
        <input
                type="text"
                class="form-control"
                name="Doklad[suma]"
                autocomplete="off"
                id="suma"
                style="width:80%;margin-right: 5px;"
                value="<?= $val ?>"
        >
        <span class="money">
            <?php
                $val = 'EUR';
                if (isset($receiptData)) {
                    $val = $receiptData['mena'];
                }
                if (isset($doklad) && $doklad instanceof CashReceipt) {
                    $val = $doklad->mena;
                }
                echo $val;
            ?>
        </span>
    </div>
</div>

<div class="form-group row">
    <label class="col-1 col-form-label">Platca DPH:</label>
    <div class="col-5">
        <?php
        $val = 0;
        $platcaDph = 0;
        if (isset($receiptData)) {
            $platcaDph = $val = $receiptData['platca_dph'];
        }
        if (isset($doklad) && $doklad instanceof CashReceipt) {
            $platcaDph = $val = $doklad->dodavatel->platca_dph;
        }
        ?>
        <select class="form-control dropdown" id="platcadph" name="Doklad[platca_dph]">
            <option value="0"<?= $val == 0 ? ' selected': '' ?>>Nie</option>
            <option value="1"<?= $val == 1 ? ' selected': '' ?>>Áno</option>
        </select>
    </div>
    <label class="col-1 col-form-label platcaDph"<?= $platcaDph == 0 ? ' style="display:none"' : ''?>>Suma s DPH:</label>
    <div class="col-5 platcaDph"<?= $platcaDph == 0 ? ' style="display:none"' : ''?>>
        <?php
        $val = 0;
        if (isset($receiptData)) {
            $val = $receiptData['suma2'];
        }
        if (isset($doklad) && $doklad instanceof CashReceipt) {
            $val = $doklad->suma_s_dph;
        }
        ?>
        <input
                type="text"
                class="form-control"
                name="Doklad[suma2]"
                autocomplete="off"
                id="suma2"
                style="width: 80%;margin-right: 5px;"
                value="<?= $val ?>"
        >
        <span class="money">
            <?php
            $val = 'EUR';
            if (isset($receiptData)) {
                $val = $receiptData['mena'];
            }
            if (isset($doklad) && $doklad instanceof CashReceipt) {
                $val = $doklad->mena;
            }
            echo $val;
            ?>
        </span>
    </div>
</div>

<div class="form-group row platcaDph"<?= $platcaDph == 0 ? ' style="display:none"' : ''?>>
    <label class="col-1 col-form-label">Daň v %:</label>
    <div class="col-5">
        <?php
        $val = 20;
        if (isset($receiptData)) {
            $val =$receiptData['dph'];
        }
        if (isset($doklad) && $doklad instanceof CashReceipt) {
            $val = $doklad->dph;
        }
        ?>
        <input type="text" value="<?= $val ?>" name="Doklad[dph]" autocomplete="off" id="dan" class="form-control">
    </div>
    <label class="col-1 col-form-label">
        Nepodlieha DPH:
    </label>
    <div class="col-5">
        <?php
        $val = 0;
        if (isset($receiptData)) {
            $val = $receiptData['suma_nepodlieha_dph'];
        }
        if (isset($doklad) && $doklad instanceof CashReceipt) {
            $val = $doklad->suma_nepodlieha_dph;
        }
        ?>
        <input
                type="text"
                class="form-control"
                name="Doklad[suma_nepodlieha_dph]"
                id="suma_nepodlieha_dph"
                autocomplete="off"
                style="width:80%;margin-right: 5px;"
                value="<?= $val ?>"
        >
        <span class="money">
            <?php
            $val = 'EUR';
            if (isset($receiptData)) {
                $val = $receiptData['mena'];
            }
            if (isset($doklad) && $doklad instanceof CashReceipt) {
                $val = $doklad->mena;
            }
            echo $val;
            ?>
        </span>
    </div>
</div>
