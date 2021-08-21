<?php
$this->title=Yii::t('app',"Nová objednávka");
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <form method="post" role="form">
        <input type="hidden" id="h-suma" name="suma" value="0"/>
        <input type="hidden" id="h-sumadph" name="sumadph" value="0"/>

        <div class="row">
            <div class="col-lg-12">
                <a href="/backoffice/orders" class="btn btn-danger"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Späť</a>
                <input type="submit" class="btn btn-success" value="Vytvoriť objednávku">
            </div>

        </div>

        <div class="row m-t-20">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Údaje dodávateľa</div>
                    <div class="card-body">
                        <?= $this->render('orders-dodav',[
                                'offices'   => $offices,
                                'default_company'   => $default_company,
                                'mesto' => $mesto
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Údaje odberateľa</div>
                    <div class="card-body">
                        <?= $this->render('orders-odber') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-t-20">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Základné údaje</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-1 col-form-label" for="n1">Číslo obj.:</label>
                            <input type="text" name="Order[number]" class="col-3 form-control" id="n1">
                            <label class="col-1 col-form-label" for="n2">Dátum vyst.:</label>
                            <input type="date" name="Order[date]" class="col-3 form-control" id="n2">
                            <label class="col-1 col-form-label" for="n3">Mena:</label>
                            <select class="col-3 form-control dropdown" id="n3" name="Order[currency]">
                                <option value="eur">EUR</option>
                                <option value="eur">USD</option>
                                <option value="eur">CZK</option>
                                <option value="eur">HUF</option>
                            </select>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-t-20">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Doplňujúce údaje</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-1 col-form-label" for="t0">Poznámka:</label>
                            <textarea class="col-5 form-control" name="Invoice[poznamka]" id="t0"></textarea>
                            <label class="col-1 col-form-label" for="vystavil">Vystavil:</label>
                            <input
                                    type="text"
                                    class="col-5 form-control"
                                    name="Invoice[vystavil]"
                                    value=""
                                    id="vystavil"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-t-20">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Položky objednávky</div>
                    <div class="card-body">
                        <?php
                        $vatPayer = 0;
                        ?>
                        <div style="position: relative; overflow: hidden; transition:height .35s ease;padding:0">
                            <div class="row m-b-10" id="popis-poloziek" style="font-size: 0.9em">
                                <div class="col-sm-4">Popis položky</div>
                                <div class="col-sm-1">M.j.</div>
                                <div class="col-sm-1">Množstvo</div>
                                <div class="col-sm-2">Cena za MJ bez DPH (<span class="money">EUR</span>)</div>
                                <div class="col-sm-1"><span class="zalFaSkryt"<?= !$vatPayer ? ' style="display: none"' : '' ?>>DPH (%)</span></div>
                                <div class="col-sm-3"><span class="zalFaSkryt"<?= !$vatPayer ? ' style="display: none"' : '' ?>>Cena za MJ s DPH (<span class="money">EUR</span>)</span></div>
                            </div>
                            <div id="inv-polozky" class="ui-sortable">
                                <div class="row fa-polozka" id="row-0" style="cursor: move; position: relative; left: 10px; top: 10px; width:100%">
                                    <div class="col-sm-4">
                                        <select
                                                name="Polozky[0][polozka_id]"
                                                class="form-control dropdown"
                                                id="popis-0"
                                        >
                                            <option value="">Vyberte položku</option>
                                        </select>
                                        <div class="m-t-10">a/alebo vyberte dátum realizácie</div>
                                        <input type="date" class="form-control m-t-10" id = "datum-realizacie-0" name="Polozky[0][datum_realizacie]">
                                        <div class="m-t-10">alebo vyplňte meno položky</div>
                                        <textarea
                                                class="form-control m-t-10"
                                                name="Polozky[0][popis_polozky]"
                                                id = "popis-text-0"
                                        ></textarea>
                                    </div>
                                    <div class="col-sm-1">
                                        <input
                                                class="form-control"
                                                type="text"
                                                name="Polozky[0][merna_jednotka]"
                                                id="mj-0"
                                                autocomplete="off"
                                        >
                                    </div>
                                    <div class="col-sm-1">
                                        <input
                                                class="form-control"
                                                type="text"
                                                name="Polozky[0][mnozstvo]"
                                                id="mnozstvo-0"
                                                value="1"
                                                autocomplete="off"
                                        >
                                        <br>
                                        <span id="dmnozstvo-0" class="dmnoz">Spolu ≐</span>
                                    </div>
                                    <div class="col-sm-2">
                                        <input
                                                class="form-control"
                                                type="text"
                                                name="Polozky[0][cena]"
                                                id="cena-0"
                                                autocomplete="off"
                                        >
                                        <input type="hidden" value="0" id="totalcena-0" name="Polozky[0][total_cena]">
                                        <br>
                                        <span id="dtotalcena-0">0,00 <span class="money">EUR</span></span>
                                    </div>
                                    <div class="col-sm-1">
                                        <input
                                                class="form-control zalFaSkryt"
                                                type="text"
                                                name="Polozky[0][dph]"
                                                id="dph-0"
                                                value="20"
                                                autocomplete="off"
                                            <?= !$vatPayer ? ' style="display: none"' : '' ?>
                                        >
                                        <input type="hidden" value="0" id="totaldph-0" name="Polozky[0][total_dph]">
                                        <input type="hidden" value="0" id="sdph-0" name="Polozky[0][sdph]">
                                        <br>
                                        <span id="dtotaldph-0" class="zalFaSkryt"<?= !$vatPayer ? ' style="display: none"' : '' ?>>0,00 <span class="money">EUR</span></span>
                                    </div>
                                    <div class="col-sm-2">
                                        <input
                                                class="form-control zalFaSkryt"
                                                type="text"
                                                name="Polozky[0][cena_s_dph]"
                                                id="cena2-0"
                                                autocomplete="off"
                                            <?= !$vatPayer ? ' style="display: none"' : '' ?>
                                        >
                                        <input type="hidden" value="0" id="totalcena2-0" name="Polozky[0][total_cena_s_dph]">
                                        <span id="dtotalcena2-0" class="zalFaSkryt"<?= !$vatPayer ? ' style="display: none"' : '' ?>>0,00 <span class="money">EUR</span></span>
                                    </div>
                                    <div class="col-sm-1">
                                        <a href="#inv-polozky" class="btn btn-danger odstranit-polozku">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Tlacitko vlozit riadok -->
                        <div class="row m-t-10">
                            <div class="col-lg-12">
                                <button class="btn btn-success" id="add-item">Vložiť riadok</button>
                            </div>
                        </div>
                        <!-- Spodny riadok Spolu -->
                        <div class="row m-t-10">
                            <div class="col-lg-12">
                                <table style="width:100%">
                                    <tr>
                                        <td style="width: 80%; text-align: right">Spolu:</td>
                                        <td style="text-align: right"><span id="s-spolu">0</span> <span class="money">EUR</span></td>
                                    </tr>
                                    <tr<?= !$vatPayer ? ' style="display: none"' : '' ?> class="zalFaSkryt">
                                        <td style="width: 80%; text-align: right">DPH:</td>
                                        <td style="text-align: right"><span id="s-dph">0</span> <span class="money">EUR</span></td>
                                    </tr>
                                    <tr<?= !$vatPayer ? ' style="display: none"' : '' ?> class="zalFaSkryt">
                                        <td style="width: 80%; text-align: right">Spolu s DPH:</td>
                                        <td style="text-align: right"><span id="s-spoludph">0</span> <span class="money">EUR</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding: 10px"></td>
                                    </tr>
                                    <tr class="font-weight-bolder">
                                        <td style="width: 80%; text-align: right">K úhrade:</td>
                                        <td style="text-align: right"><span id="s-kuhrade">0</span> <span class="money">EUR</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row m-b-20">
            <div class="col-lg-12">
                <input type="submit" class="btn btn-success" value="Vytvoriť objednávku">
            </div>
        </div>

    </form>

</div>