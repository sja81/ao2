<?php
use backend\assets\RealAsset;

$this->title=Yii::t('app','Nová prijatá faktúra');
?>


<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <form method="post" class="form">
        <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>

        <div class="row m-b-10">
            <div class="col-12">
                <a href="/backoffice/accounting/invoice" class="btn btn-danger text-white"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Späť</a>
            </div>
        </div>

        <div class="row">
            <!-- left column -->
            <div class="col-md-6 col-xs-12">
                <div class="card rounded-5 card-shadow">
                    <div class="card-header bg-info text-white rounded-title-5">
                        <?= Yii::t('app','Partner/Odosielateľ'); ?>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <select name="Invoice[partner][id]" class="form-control form-select">
                                    <option value=""><?= Yii::t('app','Zvoľte partnera alebo vyplňte políčka'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Spoločnosť'); ?></label>
                                <input type="text" class="form-control" name="Invoice[partner][name]">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Kontaktná osoba'); ?></label>
                                <input type="text" class="form-control" name="Invoice[partner][contact_person]">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Ulica'); ?></label>
                                <input type="text" class="form-control" name="Invoice[partner][address]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-12 col-md-3">
                                <label class="form-label"><?= Yii::t('app','PSČ') ?></label>
                                <input type="text" name="Invoice[partner][zip]" class="form-control">
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <label class="form-label"><?= Yii::t('app','Mesto'); ?></label>
                                <select class="form-control form-select" name="Invoice[partner][town]">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Štát'); ?></label>
                                <input type="text" class="form-control form-select" name="Invoice[partner][country]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-12">
                                <label class="form-label"><?= Yii::t('app','IČO') ?></label>
                                <input type="text" name="Invoice[partner][business_id]" class="form-control">
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label class="form-label"><?= Yii::t('app','DIČ') ?></label>
                                <input type="text" name="Invoice[tax_id]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-12">
                                <label class="form-label"><?= Yii::t('app','IČ DPH'); ?></label>
                                <input type="text" name="Invoice[partner][vat_num]" class="form-control">
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Platca DPH') ?></label>
                                <select name="Invoice[partner][vat_payer]" class="form-control form-select">
                                    <option value="0" selected>Nie</option>
                                    <option value="1">Áno</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Info o dodávateľovi/partnerovi') ?></label>
                                <textarea name="Invoice[partner][info]" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Telefón') ?></label>
                                <input type="text" name="Invoice[partner][phone]" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Email') ?></label>
                                <input type="email" name="Invoice[partner][email]" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label">
                                    <?= Yii::t('app','Web') ?>
                                </label>
                                <input type="text" class="form-control" name="Invoice[partner][web]">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label">
                                    <?= Yii::t('app','Banka') ?>
                                </label>
                                <select name="Invoice[partner][bank]" class="form-control form-select">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label">
                                    <?= Yii::t('app','IBAN') ?>
                                </label>
                                <input type="text" name="Invoice[partner][iban]" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','SWIFT') ?></label>
                                <input type="text" name="Invoice[partner][swift]" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of left column -->
            <!-- right column -->
            <div class="col-md-6 col-xs-12">
                <div class="card rounded-5 card-shadow">
                    <div class="card-header bg-info text-white rounded-title-5">
                        <?= Yii::t('app','Príjemca'); ?>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Zvoľte firmu'); ?></label>
                                <select name="Invoice[receiver][id]" class="form-control form-select">
                                    <option value=""></option>
                                    <?php
                                    /**
                                     * @var Office[] $offices
                                     */
                                    foreach($offices as $office) {
                                        echo "<option value='{$office->id}'>{$office->name}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card rounded-5 card-shadow">
                    <div class="card-header bg-info text-white rounded-title-5">
                        <?= Yii::t('app','Číslo faktúry') ?>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <input type="text" class="form-control" name="Invoice[number]">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card rounded-5 card-shadow">
                    <div class="card-header bg-info text-white rounded-title-5">
                        <?= Yii::t('app','Základné informácie') ?>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Typ faktúry'); ?></label>
                                <select name="Invoice[type]" class="form-control form-select">
                                    <option value="0"><?= Yii::t('app','Faktúra') ?></option>
                                    <option value="1"><?= Yii::t('app','Zálohová faktúra') ?></option>
                                    <option value="2"><?= Yii::t('app','Dobropis') ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Mena faktúry') ?></label>
                                <select name="Invoice[currency]" class="form-control form-select">
                                    <option value=""></option>
                                    <?php
                                    /**
                                     * @var Stat[] $currencies
                                     */
                                    foreach ($currencies as $currency) {
                                        echo "<option value='{$currency->mena}'>{$currency->mena}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label">
                                    <?= Yii::t('app','Forma úhrady'); ?>
                                </label>
                                <select name="Invoice[payment_method]" class="form-control form-select">
                                    <option value="prevod" selected="selected"><?= Yii::t('app','peňažný prevod') ?></option>
                                    <option value="hotovost"><?= Yii::t('app','hotovosť') ?></option>
                                    <option value="dobierka"><?= Yii::t('app','dobierka') ?></option>
                                    <option value="poukazka"><?= Yii::t('app','poštová poukážka') ?></option>
                                    <option value="karta"><?= Yii::t('app','platobná karta') ?></option>
                                    <option value="eprovider"><?= Yii::t('app','internetový platobný systém') ?></option>
                                    <option value="registracna_pokladna"><?= Yii::t('app','registračná pokladňa') ?></option>
                                    <option value="zapocet"><?= Yii::t('app','zápočet') ?></option>
                                    <option value="ina"><?= Yii::t('app','iná') ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Variabilný symbol') ?></label>
                                <input type="text" name="Invoce[var_symbol]" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Konštantný symbol') ?></label>
                                <select name="Invoice[const_symbol]" class="form-control form-select">
                                    <option value=""></option>
                                    <?php
                                    foreach($konst_symbol as $item) {
                                        echo "<option value='{$item->kod}'>{$item->kod} - {$item->popis}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Špecifický symbol') ?></label>
                                <input type="text" name="Invoice[spec_symbol]" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card rounded-5 card-shadow">
                    <div class="card-header bg-info text-white rounded-title-5">
                        <?= Yii::t('app','Dátumy') ?>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Dátum vystavenia') ?></label>
                                <input type="date" name="Invoice[issue_date]" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Dátum dodania') ?></label>
                                <input type="date" name="Invoice[shipment_date]" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Dátum splatnosti') ?></label>
                                <input type="date" name="Invoice[due_date]" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="form-label"><?= Yii::t('app','Dátum daňovej povinnosti') ?></label>
                                <input type="date" name="Invoice[tax_date]" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of right column -->
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="card rounded-5 card-shadow">
                    <div class="card-header bg-info text-white rounded-title-5">
                        <?= Yii::t('app','Položky') ?>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>


        <div class="row m-t-5 m-b-10">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-success text-white"><i class="fas fa-save m-r-5"></i> <?= Yii::t('app','Uložiť'); ?></button>
            </div>
        </div>
    </form>
</div>
<?php
$css = <<<CSS
    .rounded-5 {
        border-radius: .5em!important;
    }
    .rounded-title-5 {
        border-top-left-radius: .5em!important;
        border-top-right-radius: .5em!important;
    }
    .card-shadow {
        box-shadow: lightgrey 3px 3px;
    }
CSS;
$this->registerCSS($css);