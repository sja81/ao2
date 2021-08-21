<?php
use backend\assets\RealAsset;
use backend\helpers\HelpersNum;

$this->title = Yii::t('app','Faktúra k predfaktúre č.') . ' ' . $invoice->getInvoiceNumber();

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::class]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/js/common.js?v=1.1',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/js/faktura.js?v=2.8',['depends'=>RealAsset::class]);

$vatPayer = $invoice->dodavatel->platca_dph == 1;
?>
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <form method="post" class="form" id="">
        <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
        <input type="hidden" id="h-suma" name="Invoice[suma]" value="<?= $invoice->suma ?>"/>
        <input type="hidden" id="h-sumadph" name="Invoice[suma_s_dph]" value="<?= $invoice->suma_s_dph ?>>"/>
        <input type="hidden" id="h-kuhrade" name="Invoice[k_uhrade]" value="<?= $invoice->k_uhrade ?>"/>
        <input type="hidden" name="Invoice[faktura_id]" value="<?= $invoice->id ?>">
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
                        <div class="form-group row">
                            <input type="hidden" id="dodavatel-id" name="Dodavatel[dodavatel_id]" value="<?= $invoice->dodavatel->dodavatel_id ?>">
                            <label class="col-3 col-form-label">Spoločnosť:</label>
                            <div class="col-9">
                                <input type="text" name="Dodavatel[nazov]" class="form-control" id="dodavatel-name" autocomplete="off" value="<?= $invoice->dodavatel->nazov ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Kontaktná osoba:</label>
                            <div class="col-9">
                                <input type="text" name="Dodavatel[kontaktna_osoba]" class="form-control" id="dodavatel-contactperson" autocomplete="off" value="<?= $invoice->dodavatel->kontaktna_osoba ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Ulica:</label>
                            <div class="col-9">
                                <input type="text" name="Dodavatel[ulica]" class="form-control" id="dodavatel-address" autocomplete="off" value="<?= $invoice->dodavatel->ulica ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Mesto:</label>
                            <div class="col-9">
                                <select id="dodavatel-town" class="form-control dropdown" name="Dodavatel[mesto]">
                                    <option value=""></option>
                                    <?php
                                    foreach($mesto as $it) {
                                        $jsonIt = json_encode($it);
                                        $selected = $invoice->dodavatel->mesto == $it['nazov_obce'] ? " selected" : '';
                                        echo "<option value='{$jsonIt}'{$selected}>{$it['nazov_obce']}".($selected != "" ? "" : "({$it['nazov_okresu']})" )."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">PSČ:</label>
                            <div class="col-9">
                                <input type="text" name="Dodavatel[psc]" class="form-control" id="dodavatel-zip" autocomplete="off" value="<?= $invoice->dodavatel->psc ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Štát:</label>
                            <div class="col-9">
                                <input
                                        type="text"
                                        class="form-control dropdown"
                                        name="Dodavatel[stat]"
                                        id="dodavatel-country"
                                        autocomplete="off"
                                        value = "<?= $invoice->dodavatel->stat ?>"
                                >
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">IČO:</label>
                            <div class="col-9">
                                <input
                                        type="text"
                                        name="Dodavatel[ico]"
                                        class="form-control"
                                        id="dodavatel-ico"
                                        autocomplete="off"
                                        value="<?= $invoice->dodavatel->ico ?>"
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">DIČ:</label>
                            <div class="col-9">
                                <input
                                        type="text"
                                        name="Dodavatel[dic]"
                                        class="form-control"
                                        id="dodavatel-dic"
                                        autocomplete="off"
                                        value="<?= $invoice->dodavatel->dic ?>"
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">IČ DPH:</label>
                            <div class="col-9">
                                <input
                                        type="text"
                                        name="Dodavatel[icdph]"
                                        id="dodavatel-icdph"
                                        class="form-control"
                                        autocomplete="off"
                                        value="<?= $invoice->dodavatel->icdph ?>"
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Platca DPH:</label>
                            <div class="col-3">
                                <select name="Dodavatel[platca_dph]" class="form-control dropdown" id="dodavatel-vatpayer">
                                    <option value="0"<?= $invoice->dodavatel->platca_dph == 0 ? ' selected': '' ?>>Nie</option>
                                    <option value="1"<?= $invoice->dodavatel->platca_dph == 1 ? ' selected': '' ?>>Áno</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Info o dodávateľovi:</label>
                            <div class="col-9">
                                <textarea name="Dodavatel[info]" class="form-control" id="dodavatel-info"><?= $invoice->dodavatel->info ?></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Telefón:</label>
                            <div class="col-9">
                                <input
                                        type="text"
                                        name="Dodavatel[telefon]"
                                        id="dodavatel-phone"
                                        class="form-control"
                                        autocomplete="off"
                                        value="<?= $invoice->dodavatel->telefon ?>"
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Email:</label>
                            <div class="col-9">
                                <input
                                        type="text"
                                        name="Dodavatel[email]"
                                        class="form-control"
                                        id="dodavatel-email"
                                        autocomplete="off"
                                        value="<?= $invoice->dodavatel->email ?>"
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Web:</label>
                            <div class="col-9">
                                <input
                                        type="text"
                                        name="Dodavatel[web]"
                                        class="form-control"
                                        id="dodavatel-web"
                                        autocomplete="off"
                                        value="<?= $invoice->dodavatel->web ?>"
                                >
                            </div>
                        </div>
                        <br>
                        <div class="form-group row" id="db">
                            <label class="col-3 col-form-label">Banka:</label>
                            <div class="col-9">
                                <?php
                                if (count($office->accounts) > 1) {
                                    foreach ($office->accounts as $idx => $item) {
                                        ?>
                                        <input type="hidden" id="def-iban-<?= $idx ?>" value="<?= $item->iban ?>" />
                                        <input type="hidden" id="def-swift-<?= $idx ?>" value="<?= $item->swift ?>" />
                                        <input type="hidden" id="def-curr-"<?= $idx ?>" value="<?= $item->currency ?>" />
                                        <?php
                                    }
                                }
                                ?>
                                <select name="Dodavatel[banka]" class="form-control dropdown" id="dodavatel-bank">
                                    <option value=""><?= Yii::t('app','Zvoľte si banku')     ?></option>
                                    <?php

                                    foreach($office->accounts as $idx => $item) {
                                        $selected = ($item->details->swift == $invoice->dodavatel->swift) ? ' selected' : '';
                                        echo "<option value='{$item->details->name}' data-idx='{$idx}'{$selected}>{$item->details->name} ({$item->currency})</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">IBAN:</label>
                            <div class="col-9">
                                <input
                                        type="text"
                                        name="Dodavatel[iban]"
                                        class="form-control"
                                        id="dodavatel-iban"
                                        autocomplete="off"
                                        value="<?= $invoice->dodavatel->iban ?>"
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">SWIFT:</label>
                            <div class="col-9">
                                <input
                                        type="text"
                                        name="Dodavatel[swift]"
                                        class="form-control"
                                        id="dodavatel-swift"
                                        value="<?= $invoice->dodavatel->swift ?>"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Údaje odberateľa</div>
                    <div class="card-body">


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

                                        $selected = '';
                                        if ($invoice->customer->mesto == $it['nazov_obce']) {
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
                            <label class="col-1 col-form-label" for="d1">Číslo faktúry:</label>
                            <div class="col-5">
                                <input type="text" name="Invoice[cislo_faktury]" class="form-control" value="<?= $lastInvoiceNumber ?>" id="d1">
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
                                <?php
                                $vs = preg_replace('/[A-Z]{1,}/','',$lastInvoiceNumber);
                                ?>
                                <input type="text" name="Invoice[var_symbol]" class="form-control" id="vs0" value="<?= $vs ?>">
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
                                        $selected = '';
                                        if ($item->mena == $invoice->mena) {
                                            $selected = ' selected';
                                        }
                                        echo "<option value='{$item->mena}'{$selected}>{$item->mena}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-2 col-form-label zalFaSkryt" for="uhradene">Už uhradené (zálohami):</label>
                            <div class="col-4 zalFaSkryt">
                                <input type="text" name="Invoice[zaloha]" class="form-control" id="uhradene" value="<?= $invoice->k_uhrade ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="fu0">Forma úhrady:</label>
                            <div class="col-4">
                                <?php
                                $formaUhrady = '';
                                if (isset($invoice) && $invoice instanceof Invoice) {
                                    $formaUhrady = $invoice->forma_uhrady;
                                }
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
                            <label class="col-2 col-form-label" for="zlava">Celková zľava (%):</label>
                            <div class="col-4">
                                <?php
                                $zlava = '';
                                if (isset($invoice) && $invoice instanceof Invoice) {
                                    $zlava = $invoice->zlava;
                                }
                                ?>
                                <input type="text" name="Invoice[zlava]" class="form-control" id="zlava" value="<?= $zlava ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="qr">Zobrazit QR kod:</label>
                            <div class="col-4">
                                <input type="checkbox" id="qr" name="Invoice[qr_kod]" value="1" disabled>
                            </div>
                            <label class="col-2 col-form-label zalFaSkryt" for="prenesenaDan">Prenesená daňová povinnosť:</label>
                            <div class="col-4 zalFaSkryt">
                                <?php
                                $prenesena = '';
                                if (isset($invoice) && $invoice instanceof Invoice && $invoice->prenesena_dan == 1) {
                                    $prenesena = ' checked';
                                }
                                ?>
                                <input type="checkbox" id="prenesenaDan" name="Invoice[prenesena_dan]" value="1"<?= $prenesena?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label"><?= Yii::t('app','Zobraziť pečiatku:') ?></label>
                            <div class="col-4">
                                <?php
                                $peciatka = '';
                                if (isset($invoice) && $invoice instanceof Invoice && $invoice->peciatka == 1) {
                                    $peciatka = ' checked';
                                }
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
                            <label class="col-1 col-form-label" for="t0">Poznámka:</label>
                            <textarea class="col-5 form-control" name="Invoice[poznamka]"><?= trim($invoice->poznamka) . "k dokladu č. " . $invoice->getInvoiceNumber() ?></textarea>
                            <label class="col-1 col-form-label" for="vystavil">Vystavil:</label>
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

                            <div id="inv-polozky" class="ui-sortable">
                                <?php
                                $spolu = $dph = $spoluSDph = 0;
                                $totalZlava = 0 ;
                                foreach ($invoice->polozky as $id => $item):
                                    $totalZlava += $item['pol_zlava_hodnota'];
                                ?>
                                <div class="row fa-polozka" id="row-<?= $id ?>" style="cursor: move; position: relative; left: 10px; top: 10px; width:100%">
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
                                                if ($it['id'] == $item['polozka_id']) {
                                                    $selected = " selected";
                                                }
                                                $jsonIt = json_encode($it);
                                                echo "<option value='{$jsonIt}'{$selected}>{$it['nazov']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="m-t-10">a/alebo vyberte dátum realizácie</div>
                                        <input type="date" class="form-control m-t-10" id = "datum-realizacie-<?= $id ?>" name="Polozky[<?= $id ?>][datum_realizacie]">
                                        <div class="m-t-10">alebo vyplňte meno položky</div>
                                        <textarea
                                            class="form-control m-t-10"
                                            name="Polozky[<?= $id ?>][popis_polozky]"
                                            id = "popis-text-<?= $id ?>"
                                        ><?= $item['popis_polozky']?></textarea>
                                    </div>
                                    <div class="col-sm-1">
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="Polozky[<?= $id ?>][merna_jednotka]"
                                            id="mj-<?= $id ?>"
                                            autocomplete="off"
                                            value="<?= $item['merna_jednotka'] ?>"
                                        >
                                    </div>
                                    <div class="col-sm-1">
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="Polozky[<?= $id ?>][mnozstvo]"
                                            id="mnozstvo-<?= $id ?>"
                                            value="<?= $item['mnozstvo'] ?>"
                                            autocomplete="off"
                                        >
                                        <br>
                                        <span id="dmnozstvo-<?= $id ?>" class="dmnoz">Spolu ≐</span>
                                    </div>
                                    <div class="col-sm-1">
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="Polozky[<?= $id ?>][cena]"
                                            id="cena-<?= $id ?>"
                                            autocomplete="off"
                                            value="<?= $item['cena'] ?>"
                                        >
                                        <input type="hidden" value="<?= $item['total_cena'] ?>" id="totalcena-0" name="Polozky[<?= $id ?>][total_cena]">
                                        <?php $spolu += $item['total_cena']; ?>
                                        <br>
                                        <span id="dtotalcena-<?= $id ?>"><?= $item['total_cena'] ?> <span class="money">EUR</span></span>
                                    </div>
                                    <div class="col-sm-1">
                                        <input
                                                type="text"
                                                class="form-control"
                                                autocomplete="off"
                                                name="Polozky[<?= $id ?>][pol_zlava_percent]"
                                                id="pol-zlava-percent-<?= $id ?>"
                                                placeholder="v %"
                                                value="<?= $item['pol_zlava_percent'] ?>"
                                        >
                                        <input
                                                type="text"
                                                class="form-control m-t-10"
                                                autocomplete="off"
                                                name="Polozky[<?= $id ?>][pol_zlava_abshod]"
                                                id="pol-zlava-abshod-<?= $id ?>"
                                                placeholder="abs. hodn."
                                                value="<?= $item['pol_zlava_abshod'] ?>"
                                        >
                                        <input type="hidden" value="<?= $item['pol_zlava_hodnota'] ?>" id="pol-zlava-hod-<?= $id ?>" name="Polozky[<?= $id ?>][pol_zlava_hodnota]">
                                        <br>
                                        <span id="dpol-zlava-hod-<?= $id ?>"><?= HelpersNum::moneyFormat($item['pol_zlava_hodnota']) ?> <span class="money"><?= $invoice->mena ?></span></span>
                                    </div>
                                    <div class="col-sm-1">
                                        <input
                                            class="form-control zalFaSkryt"
                                            type="text"
                                            name="Polozky[<?= $id ?>][dph]"
                                            id="dph-<?= $id ?>"
                                            value="<?= $item['dph'] ?>"
                                            autocomplete="off"
                                        >
                                        <?php $dph += $item['total_dph'] ?>
                                        <input type="hidden" value="<?= $item['total_dph'] ?>" id="totaldph-<?= $id ?>" name="Polozky[<?= $id ?>][total_dph]">
                                        <input type="hidden" value="<?= $item['cena_s_dph'] ?>" id="sdph-<?= $id ?>" name="Polozky[<?= $id ?>][sdph]">
                                        <br>
                                        <span id="dtotaldph-<?= $id ?>" class="zalFaSkryt"><?= $item['total_dph'] ?> <span class="money">EUR</span></span>
                                    </div>
                                    <div class="col-sm-2">
                                        <input
                                            class="form-control zalFaSkryt"
                                            type="text"
                                            name="Polozky[<?= $id ?>][cena_s_dph]"
                                            id="cena2-<?= $id ?>"
                                            autocomplete="off"
                                            value="<?= $item['cena_s_dph'] ?>"
                                        >
                                        <input type="hidden" value="<?= $item['total_cena_s_dph'] ?>" id="totalcena2-<?= $id ?>" name="Polozky[<?= $id ?>][total_cena_s_dph]">
                                        <span id="dtotalcena2-<?= $id ?>" class="zalFaSkryt"><?= $item['total_cena_s_dph'] ?> <span class="money">EUR</span></span>
                                    </div>
                                    <div class="col-sm-1">
                                        <a href="#inv-polozky" class="btn btn-danger odstranit-polozku">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php
                                endforeach;
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
                                        <td style="text-align: right"><span id="s-spolu"><?= \common\helpers\MoneyHelper::displayMoney($invoice->suma) ?></span> <span class="money">EUR</span></td>
                                    </tr>
                                    <tr<?= !$vatPayer ? ' style="display: none"' : '' ?> class="zalFaSkryt">
                                        <td style="width: 80%; text-align: right">DPH:</td>
                                        <td style="text-align: right"><span id="s-dph"><?= \common\helpers\MoneyHelper::displayMoney($invoice->suma_s_dph-$invoice->suma) ?></span> <span class="money">EUR</span></td>
                                    </tr>
                                    <tr<?= !$vatPayer ? ' style="display: none"' : '' ?> class="zalFaSkryt">
                                        <td style="width: 80%; text-align: right">Spolu s DPH:</td>
                                        <td style="text-align: right"><span id="s-spoludph"><?= \common\helpers\MoneyHelper::displayMoney($invoice->suma_s_dph) ?></span> <span class="money">EUR</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 80%; text-align: right">Zľava spolu:</td>
                                        <td style="text-align: right">
                                            <span id="s-zlava"><?= HelpersNum::moneyFormat($totalZlava * (-1)) ?></span> <span class="money"><?= $invoice->mena ?></span>
                                        </td>
                                    </tr>
                                    <tr class="zalFaSkryt">
                                        <td style="width: 80%; text-align: right">Uhradené zálohami:</td>
                                        <td style="text-align: right">- <span id="s-zalohy"><?= \common\helpers\MoneyHelper::displayMoney($invoice->k_uhrade) ?></span> <span class="money">EUR</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding: 10px"></td>
                                    </tr>
                                    <tr class="font-weight-bolder">
                                        <td style="width: 80%; text-align: right">K úhrade:</td>
                                        <td style="text-align: right"><span id="s-kuhrade"><?= \common\helpers\MoneyHelper::displayMoney($invoice->k_uhrade - $invoice->k_uhrade) ?></span> <span class="money">EUR</span></td>
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