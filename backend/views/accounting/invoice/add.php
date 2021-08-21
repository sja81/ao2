<?php
use backend\assets\RealAsset;

$this->title="Nová faktúra";

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::class]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/js/common.js?v=1.1',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/js/faktura.js?v=2.8',['depends'=>RealAsset::class]);
?>

<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <form method="post" class="form">
        <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
        <input type="hidden" id="h-suma" name="Invoice[suma]" value="0">
        <input type="hidden" id="h-sumadph" name="Invoice[suma_s_dph]" value="0">
        <input type="hidden" id="h-kuhrade" name="Invoice[k_uhrade]" value="0">

    <div class="row">
        <div class="col-lg-12">
            <a href="/backoffice/accounting/invoice" class="btn btn-danger"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Späť</a>
            <input type="submit" class="btn btn-success" value="Vytvoriť faktúru">
        </div>
    </div>

        <div class="row m-t-20">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Údaje dodávateľa</div>
                    <div class="card-body">
                    <?= $this->render('invoice-dodav',[
                            'offices'            => $offices,
                            'default_office'    => $default_office,
                            'mesto'             => $mesto,
                            'banks'             => $banks
                    ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Údaje odberateľa</div>
                    <div class="card-body">
                    <?= $this->render('invoice-odber',[
                            'mesto'     => $mesto,
                            'clients'   => $clients,
                    ]); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-t-20">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Základné údaje</div>
                    <div class="card-body">
                        <?= $this->render('invoice-zakladne-udaje',[
                                'konst_symbol'      => $konst_symbol,
                                'lastInvoiceNumber' => $lastInvoiceNumber,
                                'var_symbol'        => $var_symbol
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-t-20">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Peňažné údaje</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="faktura-mena">Mena faktúry:</label>
                            <div class="col-4">
                                <select name="Invoice[mena]" class="form-control dropdown" id="faktura-mena">
                                    <?php
                                    foreach($currencies as $item){
                                        echo "<option value='{$item->mena}'>{$item->mena}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-2 col-form-label zalFaSkryt" for="uhradene">Už uhradené (zálohami):</label>
                            <div class="col-4 zalFaSkryt">
                                <input type="text" name="Invoice[zaloha]" class="form-control" id="uhradene">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="fu0">Forma úhrady:</label>
                            <div class="col-4">
                                <select name="Invoice[forma_uhrady]" class="form-control dropdown" id="fu0">
                                    <option value="prevod" selected="selected">peňažný prevod</option>
                                    <option value="hotovost">hotovosť</option>
                                    <option value="dobierka">dobierka</option>
                                    <option value="poukazka">poštová poukážka</option>
                                    <option value="karta">platobná karta</option>
                                    <option value="eprovider">internetový platobný systém</option>
                                    <option value="registracna_pokladna">registračná pokladňa</option>
                                    <option value="zapocet">zápočet</option>
                                    <option value="ina">iná</option>

                                </select>
                            </div>
                            <label class="col-2 col-form-label" for="zlava">Celková zľava (%):</label>
                            <div class="col-4">
                                <input type="text" name="Invoice[zlava]" class="form-control" id="zlava">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="qr">Zobrazit QR kod:</label>
                            <div class="col-4">
                                <input type="checkbox" id="qr" name="Invoice[qr_kod]" value="1" disabled>
                            </div>
                            <label class="col-2 col-form-label zalFaSkryt" for="prenesenaDan">Prenesená daňová povinnosť:</label>
                            <div class="col-4 zalFaSkryt">
                                <input type="checkbox" id="prenesenaDan" name="Invoice[prenesena_dan]" value="1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label"><?= Yii::t('app','Zobraziť pečiatku:') ?></label>
                            <div class="col-4">
                                <input type="checkbox" id="qr" name="Invoice[peciatka]" value="1">
                            </div>
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
                                    value="<?= $default_office->contact_person ?>"
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
                    <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Položky faktúry</div>
                    <div class="card-body">
                        <?php
                        $vatPayer = $default_office->vat_payer == '1';
                        ?>
                        <div style="position: relative; overflow: hidden; transition:height .35s ease;padding:0">
                            <div class="row m-b-10" id="popis-poloziek" style="font-size: 0.9em">
                                <div class="col-sm-4">Popis položky</div>
                                <div class="col-sm-1">MJ</div>
                                <div class="col-sm-1">Množ.</div>
                                <div class="col-sm-1">JC bez DPH</div>
                                <div class="col-sm-1">Výška zľavy</div>
                                <div class="col-sm-1"><span class="zalFaSkryt"<?= !$vatPayer ? ' style="display: none"' : '' ?>>DPH</span></div>
                                <div class="col-sm-3"><span class="zalFaSkryt"<?= !$vatPayer ? ' style="display: none"' : '' ?>>JC s DPH</span></div>
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
                                            <?php
                                            foreach($sluzby as $it) {
                                                $jsonIt = json_encode($it);
                                                echo "<option value='{$jsonIt}'>{$it['nazov']}</option>";
                                            }
                                            ?>
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
                                    <div class="col-sm-1">
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
                                                type="text"
                                                class="form-control"
                                                autocomplete="off"
                                                name="Polozky[0][pol_zlava_percent]"
                                                id="pol-zlava-percent-0"
                                                placeholder="v %"
                                        >
                                        <input
                                                type="text"
                                                class="form-control m-t-10"
                                                autocomplete="off"
                                                name="Polozky[0][pol_zlava_abshod]"
                                                id="pol-zlava-abshod-0"
                                                placeholder="abs. hodn."
                                        >
                                        <input type="hidden" value="0" id="pol-zlava-hod-0" name="Polozky[0][pol_zlava_hodnota]">
                                        <br>
                                        <span id="dpol-zlava-hod-0">0,00 <span class="money">EUR</span></span>
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
                                        <td style="width: 80%; text-align: right">Zľava spolu:</td>
                                        <td style="text-align: right"><span id="s-zlava">0</span> <span class="money">EUR</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 80%; text-align: right">Uhradené:</td>
                                        <td style="text-align: right"><span id="s-uhradene">0</span> <span class="money">EUR</span></td>
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
                <input type="submit" class="btn btn-success" value="Vytvoriť faktúru">
            </div>
        </div>
    </form>
</div>