<?php
use backend\assets\RealAsset;

$this->title="Zmena dokladu č." . $doklad->cislo;

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',['depends'=>RealAsset::className()]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js',['depends'=>RealAsset::className()]);
$this->registerJSFile('@web/js/cash.js?v=1.1.28',['depends'=>RealAsset::className()]);
?>
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h4 class="text-themecolor"><?= $this->title ?></h4>
            </div>
        </div>

        <form method="post" class="form" id="">
            <input type="hidden" name="Doklad[id]" value="<?= $_GET['id'] ?>">
            <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>

            <div class="row">
                <div class="col-lg-12">
                    <a href="/backoffice/accounting/cash-receipt" class="btn btn-danger"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Späť</a>
                    <input type="submit" class="btn btn-success" value="Uložiť doklad">
                </div>
            </div>

            <div class="row m-t-20">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Typ a číslo dokumentu</div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-1 col-form-label">Typ:</label>
                                <div class="col-2">
                                    <select name="Doklad[typ]" class="form-control dropdown" id="cash-typ">
                                        <option value="PPD"<?= ($doklad->pp_typ == 'PPD') ? ' selected' : '' ?>>Príjmový</option>
                                        <option value="VPD"<?= ($doklad->pp_typ == 'VPD') ? ' selected' : '' ?>>Výdavkový</option>
                                    </select>
                                </div>
                                <label class="col-1 col-form-label">Doklad číslo:</label>
                                <div class="col-2">
                                    <input
                                            type="text"
                                            name="Doklad[cislo]"
                                            class="form-control"
                                            value="<?= $doklad->cislo ?>"
                                    >
                                </div>
                                <label class="col-2 col-form-label">Dátum vystavenia:</label>
                                <div class="col-3">
                                    <input type="date" class="form-control" value="<?= $doklad->vystavene ?>" name="Doklad[vystavene]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-t-20">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Údaje spoločnosti</div>
                        <div class="card-body">
                            <?=
                            $this->render('cash-dodav',[
                                'mesto'             => $mesto,
                                'office'            => $office,
                                'doklad'            => $doklad,
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em" id="cash-typ-title">Prijaté od</div>
                        <div class="card-body">
                            <?=
                            $this->render('cash-odber',[
                                'mesto'              => $mesto,
                                'office'             => $office,
                                'doklad'             => $doklad,
                                'clients'            => $clients,
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-t-20">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Peňažné údaje</div>
                        <div class="card-body">
                            <?=
                            $this->render('cash-dalsie-udaje',[
                                'currencies'        => $currencies,
                                'doklad'            => $doklad,
                            ])
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-t-20">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Vyhotovenie</div>
                        <div class="card-body">
                            <?=
                            $this->render('cash-vyhotovenie',[
                                    'doklad'    => $doklad
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Účtovací predpis</div>
                        <div class="card-body">
                            <?=
                            $this->render('cash-predpis');
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-b-20">
                <div class="col-lg-12">
                    <input type="submit" class="btn btn-success" value="Uložiť doklad">
                </div>
            </div>

        </form>
    </div>
