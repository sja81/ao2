<div class="form-group row">
    <label class="col-1 col-form-label" for="d1">Číslo faktúry:</label>
    <div class="col-5">
        <input type="text" name="Invoice[cislo_faktury]" class="form-control" value="<?= $invoice->getInvoiceNumber() ?>" id="d1">
    </div>
    <label class="col-1 col-form-label" for="d0">Dátum vystavenia:</label>
    <div class="col-5">
        <input type="date" name="Invoice[datum_vystavenia]" class="form-control" value="<?= $invoice->datum_vystavenia ?>" id="d0">
    </div>
</div>

<div class="form-group row">
    <label class="col-1 col-form-label" for="zalohovafa">Typ faktúry:</label>
    <div class="col-5">
        <select name="Invoice[typ_faktury]" class="form-control dropdown" id="zalohovafa">
            <option value="0">Faktúra</option>
            <option value="1">Zálohová faktúra</option>
            <option value="2">Dobropis</option>
        </select>
    </div>
    <label class="col-1 col-form-label no-zaloha" for="d3">Dátum dodania:</label>
    <div class="col-5 no-zaloha">
        <input type="date" name="Invoice[datum_dodania]" class="form-control" value="<?= $invoice->datum_dodania ?>" id="d3">
    </div>
</div>

<div class="form-group row">
    <label class="col-1 col-form-label" for="vs0">Variabilný symbol:</label>
    <div class="col-5">
        <input type="text" name="Invoice[var_symbol]" class="form-control" id="vs0" value="<?= $invoice->var_symbol ?>">
    </div>
    <label class="col-1 col-form-label">Dátum splatnosti:</label>
    <div class="col-5">
        <input type="date" name="Invoice[splatnost]" class="form-control" value="<?= $invoice->splatnost ?>">
    </div>
</div>

<div class="form-group row">
    <label class="col-1 col-form-label">Konštantný symbol:</label>
    <div class="col-5">
        <select id="konst-symbol" name="Invoice[konst_symbol]" class="form-control dropdown">
            <?php
            foreach($konst_symbol as $item) {
                $selected = $item->kod == $invoice->konst_symbol ? ' selected' : '';
                echo "<option value='{$item->kod}'{$selected}>{$item->kod} - {$item->popis}</option>";
            }
            ?>
        </select>
    </div>
    <label class="col-1 col-form-label">Číslo objednávky:</label>
    <div class="col-5">
        <input type="text" name="Invoice[zmluva_id]" class="form-control">
    </div>
</div>


