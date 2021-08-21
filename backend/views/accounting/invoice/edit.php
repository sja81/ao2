<?php
use backend\assets\RealAsset;
use backend\helpers\HelpersNum;

$this->title="Zmena faktúry";

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',['depends'=>RealAsset::className()]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js',['depends'=>RealAsset::className()]);
$this->registerJSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.js',['depends'=>RealAsset::className()]);
$this->registerCSSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('@web/js/common.js?v=1.1',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/js/faktura.js?v=2.0',['depends'=>RealAsset::class]);

$vatPayer = $invoice->dodavatel->platca_dph == 1;

?>

    <div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <form method="post" class="form">
        <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
        <input type="hidden" id="h-suma" name="Invoice[suma]" value="<?= $invoice->suma ?>"/>
        <input type="hidden" id="h-sumadph" name="Invoice[suma_s_dph]" value="<?= $invoice->suma_s_dph ?>"/>
        <input type="hidden" id="h-kuhrade" name="Invoice[k_uhrade]" value="<?= $invoice->k_uhrade ?>"/>
        <input type="hidden" name="Invoice[faktura_id]" value="<?= $_GET['id']?>">

        <div class="row">
            <div class="col-lg-12">
                <a href="/backoffice/accounting/invoice" class="btn btn-danger"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Späť</a>
                <input type="submit" class="btn btn-success" value="Uložiť faktúru">
            </div>
        </div>

        <div class="row m-t-20">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Údaje dodávateľa</div>
                    <div class="card-body">
                        <?= $this->render('invoice-dodav-edit',[
                            'offices'            => $offices,
                            'invoice'           => $invoice,
                            'swifts'            => $swifts,
                            'banks'             => $banks,
                            'mesto'             => $mesto,
                            'office'            => $office
                        ]); ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Údaje odberateľa</div>
                    <div class="card-body">

                        <?= $this->render('invoice-odber-edit',[
                            'mesto'     => $mesto,
                            'invoice'   => $invoice,
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

                        <?= $this->render('invoice-zakladne-udaje-edit',[
                            'konst_symbol'      => $konst_symbol,
                            'invoice'           => $invoice,
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
                            <label class="col-2 col-form-label">Mena faktúry:</label>
                            <div class="col-4">
                                <select name="Invoice[mena]" class="form-control dropdown" id="faktura-mena">
                                    <?php
                                    foreach($currencies as $item){
                                        $selected = '';
                                        if ($item->mena == $invoice->mena) {
                                            $selected = ' selected';
                                        }
                                        echo "<option value='{$item->mena}'{$selected}>{$item->mena}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-2 col-form-label zalFaSkryt">Už uhradené (zálohami):</label>
                            <div class="col-4 zalFaSkryt">
                                <input
                                        type="text"
                                        name="Invoice[zaloha]"
                                        class="form-control"
                                        id="uhradene"
                                        value="<?= $invoice->zaloha ?>"
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">Forma úhrady:</label>
                            <div class="col-4">
                                <?php
                                    $formaUhrady = $invoice->forma_uhrady;
                                ?>
                                <select name="Invoice[forma_uhrady]" class="form-control dropdown">
                                    <option value="prevod"<?= $formaUhrady == '' || $formaUhrady == 'prevod' ? ' selected':'' ?>>peňažný prevod</option>
                                    <option value="hotovost"<?= $formaUhrady == 'hotovost' ? ' selected':'' ?>>hotovosť</option>
                                    <option value="dobierka"<?= $formaUhrady == 'dobierka' ? ' selected':'' ?>>dobierka</option>
                                    <option value="poukazka"<?= $formaUhrady == 'poukazka' ? ' selected':'' ?>>poštová poukážka</option>
                                    <option value="karta"<?= $formaUhrady == 'karta' ? ' selected':'' ?>>platobná karta</option>
                                    <option value="eprovider"<?= $formaUhrady == 'eprovider' ? ' selected':'' ?>>internetový platobný systém</option>
                                    <option value="registracna_pokladna"<?= $formaUhrady == 'registracna_pokladna' ? ' selected':'' ?>>registračná pokladňa</option>
                                    <option value="zapocet"<?= $formaUhrady == 'zapocet' ? ' selected':'' ?>>zápočet</option>
                                    <option value="ina"<?= $formaUhrady == 'ina' ? ' selected':'' ?>>iná</option>
                                </select>
                            </div>
                            <label class="col-2 col-form-label">Celková zľava (%):</label>
                            <div class="col-4">
                                <input
                                        type="text"
                                        name="Invoice[zlava]"
                                        class="form-control"
                                        id="zlava"
                                        value="<?= $invoice->zlava ?>"
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">Zobrazit QR kod:</label>
                            <div class="col-4">
                                <input type="checkbox" id="qr" name="Invoice[qr_kod]" value="1" disabled>
                            </div>
                            <label class="col-2 col-form-label zalFaSkryt">Prenesená daňová povinnosť:</label>
                            <div class="col-4 zalFaSkryt">
                                <?php
                                $prenesena = ($invoice->prenesena_dan == 1) ? ' checked' : '';
                                ?>
                                <input type="checkbox" id="prenesenaDan" name="Invoice[prenesena_dan]" value="1"<?= $prenesena?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label"><?= Yii::t('app','Zobraziť pečiatku:') ?></label>
                            <div class="col-4">
                                <?php
                                $peciatka = ($invoice->peciatka == 1) ? ' checked' : '';
                                ?>
                                <input type="checkbox" id="qr" name="Invoice[peciatka]" value="1"<?= $peciatka?>>
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
                            <label class="col-1 col-form-label">Poznámka:</label>
                            <textarea class="col-5 form-control" name="Invoice[poznamka]"><?= $invoice->poznamka ?></textarea>
                            <label class="col-1 col-form-label">Vystavil:</label>
                            <input
                                type="text"
                                class="col-5 form-control"
                                name="Invoice[vystavil]"
                                value="<?= $invoice->vystavil ?>"
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
                            <?php
                            $polozky = $invoice->polozky;
                            $totalZlava = 0 ;
                            ?>
                            <div id="inv-polozky" class="ui-sortable">

                                <?php
                                foreach ($polozky as $id=>$item) {
                                    $totalZlava += $item->pol_zlava_hodnota;
                                ?>
                                <div class="row fa-polozka" id="row-<?= $id ?>" style="cursor: move; position: relative; left: 10px; top: 10px; width:100%">
                                    <input type="hidden" name="Polozky[<?= $id ?>][id]" value="<?= $item->id ?>">
                                    <div class="col-sm-4">
                                        <select
                                            name="Polozky[<?= $id ?>][polozka_id]"
                                            class="form-control dropdown"
                                            id="popis-<?= $id ?>"
                                        >
                                            <option value="">Vyberte položku</option>
                                            <?php
                                            foreach($sluzby as $it) {
                                                $selected = '';
                                                if ($it['id'] == $item->polozka_id) {
                                                    $selected = ' selected';
                                                }
                                                $jsonIt = json_encode($it);
                                                echo "<option value='{$jsonIt}'{$selected}>{$it['nazov']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="m-t-10">a/alebo vyberte dátum realizácie</div>
                                        <input type="date" class="form-control m-t-10" id = "datum-realizacie-<?= $id ?>" name="Polozky[<?= $id ?>][datum_realizacie]">
                                        <div class="m-t-10">alebo vyplňte meno položky</div>
                                        <?php
                                        ?>
                                        <textarea
                                            class="form-control m-t-10"
                                            name="Polozky[<?= $id ?>][popis_polozky]"
                                            id = "popis-text-<?= $id ?>"
                                        ><?= $item->popis_polozky ?></textarea>
                                    </div>
                                    <div class="col-sm-1">
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="Polozky[<?= $id ?>][merna_jednotka]"
                                            id="mj-<?= $id ?>"
                                            autocomplete="off"
                                            value = "<?= $item->merna_jednotka ?>"
                                        >
                                    </div>
                                    <div class="col-sm-1">
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="Polozky[<?= $id ?>][mnozstvo]"
                                            id="mnozstvo-<?= $id ?>"
                                            value="<?= $item->mnozstvo ?>"
                                            autocomplete="off"
                                        >
                                        <br>
                                        <span id="dmnozstvo-<?= $id ?>" class="dmnoz">Spolu =</span>
                                    </div>
                                    <div class="col-sm-1">
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="Polozky[<?= $id ?>][cena]"
                                            id="cena-<?= $id ?>"
                                            autocomplete="off"
                                            value="<?= $item->cena?>"
                                        >
                                        <input type="hidden" value="<?= $item->total_cena ?>" id="totalcena-<?= $id ?>" name="Polozky[<?= $id ?>][total_cena]">
                                        <br>
                                        <span id="dtotalcena-<?= $id ?>"><?= HelpersNum::moneyFormat($item->total_cena) ?><span class="money"><?= $invoice->mena ?></span></span>
                                    </div>
                                    <div class="col-sm-1">
                                        <input
                                                type="text"
                                                class="form-control"
                                                autocomplete="off"
                                                name="Polozky[<?= $id ?>][pol_zlava_percent]"
                                                id="pol-zlava-percent-<?= $id ?>"
                                                placeholder="v %"
                                                value="<?= $item->pol_zlava_percent ?>"
                                        >
                                        <input
                                                type="text"
                                                class="form-control m-t-10"
                                                autocomplete="off"
                                                name="Polozky[<?= $id ?>][pol_zlava_abshod]"
                                                id="pol-zlava-abshod-<?= $id ?>"
                                                placeholder="abs. hodn."
                                                value="<?= $item->pol_zlava_abshod ?>"
                                        >
                                        <input type="hidden" value="<?= $item->pol_zlava_hodnota ?>" id="pol-zlava-hod-<?= $id ?>" name="Polozky[<?= $id ?>][pol_zlava_hodnota]">
                                        <br>
                                        <span id="dpol-zlava-hod-<?= $id ?>"><?= HelpersNum::moneyFormat($item->pol_zlava_hodnota) ?> <span class="money"><?= $invoice->mena ?></span></span>
                                    </div>
                                    <div class="col-sm-1">
                                        <input
                                            class="form-control zalFaSkryt"
                                            type="text"
                                            name="Polozky[<?= $id ?>][dph]"
                                            id="dph-<?= $id ?>"
                                            value="<?= $item->dph ?>"
                                            autocomplete="off"
                                            <?= !$vatPayer ? ' style="display: none"' : '' ?>
                                        >
                                        <input type="hidden" value="<?= $item->total_dph ?>" id="totaldph-<?= $id ?>" name="Polozky[<?= $id ?>][total_dph]">
                                        <input type="hidden" value="0" id="sdph-<?= $id ?>" name="Polozky[<?= $id ?>][sdph]">
                                        <br>
                                        <span id="dtotaldph-<?= $id ?>" class="zalFaSkryt"<?= !$vatPayer ? ' style="display: none"' : '' ?>>
                                            <?= HelpersNum::moneyFormat($item->total_dph) ?>
                                            <span class="money"><?= $invoice->mena ?></span>
                                        </span>
                                    </div>

                                    <div class="col-sm-1">
                                        <input
                                            class="form-control zalFaSkryt"
                                            type="text"
                                            name="Polozky[<?= $id ?>][cena_s_dph]"
                                            id="cena2-<?= $id ?>"
                                            autocomplete="off"
                                            value="<?= $item->cena_s_dph ?>"
                                            <?= !$vatPayer ? ' style="display: none"' : '' ?>
                                        >
                                        <input type="hidden" value="<?= $item->total_cena_s_dph ?>" id="totalcena2-<?= $id ?>" name="Polozky[<?= $id ?>][total_cena_s_dph]">
                                        <span id="dtotalcena2-<?= $id ?>" class="zalFaSkryt"<?= !$vatPayer ? ' style="display: none"' : '' ?>><?= HelpersNum::moneyFormat($item->total_cena_s_dph) ?>
                                            <span class="money"><?= $invoice->mena ?></span></span>
                                    </div>
                                    <div class="col-sm-2">
                                        <a
                                           id="pol-<?= $id ?>"
                                           href="#inv-polozky"
                                           class="btn btn-danger odstranit-polozku"
                                           data-action="edit"
                                           data-id="<?= $item->id ?>"
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
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
                                        <td style="text-align: right">
                                            <span id="s-spolu"><?= HelpersNum::moneyFormat($invoice->suma) ?></span> <span class="money"><?= $invoice->mena ?></span>
                                        </td>
                                    </tr>
                                    <tr<?= !$vatPayer ? ' style="display: none"' : '' ?> class="zalFaSkryt">
                                        <td style="width: 80%; text-align: right">DPH:</td>
                                        <td style="text-align: right">
                                            <span id="s-dph"><?= HelpersNum::moneyFormat($invoice->suma_s_dph-$invoice->suma) ?></span> <span class="money"><?= $invoice->mena ?></span>
                                        </td>
                                    </tr>
                                    <tr<?= !$vatPayer ? ' style="display: none"' : '' ?> class="zalFaSkryt">
                                        <td style="width: 80%; text-align: right">Spolu s DPH:</td>
                                        <td style="text-align: right">
                                            <span id="s-spoludph"><?= HelpersNum::moneyFormat($invoice->suma_s_dph) ?></span> <span class="money"><?= $invoice->mena ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 80%; text-align: right">Zľava spolu:</td>
                                        <td style="text-align: right">
                                            <span id="s-zlava"><?= HelpersNum::moneyFormat($totalZlava * (-1)) ?></span> <span class="money"><?= $invoice->mena ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 80%; text-align: right">Uhradené:</td>
                                        <td style="text-align: right"><span id="s-uhradene"><?= HelpersNum::moneyFormat($invoice->zaloha * (-1)) ?></span> <span class="money"><?= $invoice->mena ?></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding: 10px"></td>
                                    </tr>
                                    <tr class="font-weight-bolder">
                                        <td style="width: 80%; text-align: right">K úhrade:</td>
                                        <td style="text-align: right">
                                            <span id="s-kuhrade"><?= HelpersNum::moneyFormat($invoice->k_uhrade) ?></span> <span class="money"><?= $invoice->mena ?></span>
                                        </td>
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
                <input type="submit" class="btn btn-success" value="Uložiť faktúru">
            </div>
        </div>
    </form>
    </div>
