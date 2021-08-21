<?php
$this->title = "Uchádzači";
?>

<div class="container-fluid">

    <div class="card m-t-20">
        <div class="card-body">

            <div class="row">
                <div class="col"><b><?= \Yii::t('app','Pozícia') ?></b></div>
                <div class="col"><b><?= \Yii::t('app','Zdroj') ?></b></div>
                <div class="col"><b><?= \Yii::t('app','Vytvorené') ?></b></div>
                <div class="col"><b><?= \Yii::t('app','Zmenené') ?></b></div>
                <div class="col"><b><?= \Yii::t('app','Aktuálny stav') ?></b></div>
                <div class="col"></div>
            </div>
            <div class="row">
                <div class="col"><?= $applicant->pozicia->info->title?></div>
                <div class="col"><?= $applicant->pozicia->sourceText?></div>
                <div class="col"><?= $applicant->created_at?></div>
                <div class="col"><?= $applicant->updated_at ?? "--" ?></div>
                <div class="col"><?= $applicant->pozicia->statusText ?></div>
                <div class="col">
                    <button id="change-status" class="btn btn-sm btn-info"><?= \Yii::t('app','Zmeniť status') ?></button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body" style="min-height: 300px">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a
                        class="nav-link active"
                        id="zakladne-info-tab"
                        data-toggle="pill"
                        href="#zakladne-info"
                        role="tab"
                        aria-controls="zakladne-info"
                        aria-selected="true"
                    ><?= \Yii::t('app','Základné informácie') ?></a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="ulohy-tab"
                        data-toggle="pill"
                        href="#ulohy"
                        role="tab"
                        aria-controls="ulohy"
                        aria-selected="false"><?= \Yii::t('app','Úlohy') ?></a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="devtesty-tab"
                        data-toggle="pill"
                        href="#devtesty"
                        role="tab"
                        aria-controls="devtesty"
                        aria-selected="false"><?= \Yii::t('app','Výsledky dev. testu') ?>
                        <span class="badge badge-warning m-l-10" id="dev-test-score"><?= is_null($applicant->tests->developer_test_total) ? 0 :  $applicant->tests->developer_test_total?></span>
                    </a>

                </li>
                <li class="nav-item">
                    <a
                            class="nav-link"
                            id="osobtesty-tab"
                            data-toggle="pill"
                            href="#osobtesty"
                            role="tab"
                            aria-controls="osobtesty"
                            aria-selected="false"><?= \Yii::t('app','Výsledky osob. testu') ?></a>
                </li>
                <li class="nav-item">
                    <a
                            class="nav-link"
                            id="iqtesty-tab"
                            data-toggle="pill"
                            href="#iqtesty"
                            role="tab"
                            aria-controls="iqtesty"
                            aria-selected="false"><?= \Yii::t('app','Výsledky IQ testu') ?></a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="prilohy-tab"
                        data-toggle="pill"
                        href="#prilohy"
                        role="tab"
                        aria-controls="prilohy"
                        aria-selected="false"><?= \Yii::t('app','Prílohy') ?></a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="zakladne-info" role="tabpanel" aria-labelledby="zakladne-info-tab">
                    <div class="row m-t-40">
                        <div class="col-lg-3">
                            <?php
                                $pic = $applicant->getPicture();
                                echo \yii\helpers\Html::img("/media/{$pic}",[
                                    'style' => ['width'=>'60%','margin-bottom'=>'20px']
                            ]) ?>
                        </div>
                        <div class="col-lg-9">
                            <h2><?= $applicant->getFullName() ?></h2>
                            <p><?= $applicant->phone ?>, <?= $applicant->email ?></p>
                        </div>
                    </div>
                    <h4 class="m-t-10 ugly-title"><?= \Yii::t('app','Osobné údaje') ?></h4>
                    <div class="form-group row">
                        <label class="col-lg-3"><?= \Yii::t('app','Adresa') ?>:</label>
                        <div class="col-lg-5">
                            <?= $applicant->getFullAddress() ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3"><?= \Yii::t('app','Dátum narodenia') ?>:</label>
                        <div class="col-lg-9">
                            <?= $applicant->birthDate ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3"><?= \Yii::t('app','Pohlavie')?>:</label>
                        <div class="col-lg-9">
                            <?= $applicant->genderText ?>
                        </div>
                    </div>

                    <h4 class="m-t-10 ugly-title"><?= \Yii::t('app','Vzdelanie') ?></h4>
                    <div class="form-group row">
                        <label class="col-lg-12"><?= \Yii::t('app','Školy')?>:</label>
                    </div>
                    <?php
                    foreach ($schools as $ord => $school) {
                        if ($school->typ_institucie == 'kurz') {
                            continue;
                        }
                    ?>
                    <div class="form-group row">
                        <label class="col-lg-3"><?= $school->od ?> - <?= $school->do ?></label>
                        <div class="col-lg-9">
                            <b><?= $school->institucia ?>, <?= $school->mesto ?></b>
                            <br>
                            <?= $school->odbor ?>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="form-group row">
                        <label class="col-lg-12"><?= \Yii::t('app','Kurzy')?>:</label>
                    </div>
                    <?php
                    foreach ($schools as $ord => $school) {
                        if ($school->typ_institucie != 'kurz') {
                            continue;
                        }
                    ?>
                    <div class="form-group row">
                        <label class="col-lg-3"><?= $school->od ?> - <?= $school->do ?></label>
                        <div class="col-lg-9">
                            <b><?= $school->nazov ?></b>
                            <br>
                            <?= $school->institucia ?>, <?= $school->mesto ?>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="form-group row">
                        <label class="col-lg-3"><?= \Yii::t('app','Doplňujúce informácie')?>:</label>
                        <div class="col-lg-9">
                            <p><?= $vzdelanie->dpln_info ?></p>
                        </div>
                    </div>

                    <h4 class="m-t-10 ugly-title"><?= \Yii::t('app','Priebeh zamestnaní') ?></h4>
                    <?php
                    foreach ($works as $work) {
                    ?>
                        <div class="form-group row">
                            <label class="col-lg-3"><?= $work->od ?> - <?= $work->aktualne == 1 ? \Yii::t('app','aktuálne') : $work->do ?></label>
                            <div class="col-lg-9">
                                <b><?= $work->zamestnavatel ?> - <?= $work->pozicia ?></b>
                                <p class="m-t-20"><?= $work->napln ?></p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="form-group row">
                        <label class="col-lg-3"><?= \Yii::t('app','Doplňujúce informácie')?>:</label>
                        <div class="col-lg-9">
                            <p><?= $zamestnanie->dopln_info?></p>
                        </div>
                    </div>

                    <h4 class="m-t-10 ugly-title"><?= \Yii::t('app','Znalosti') ?></h4>

                    <div class="form-group row">
                        <label class="col-lg-3"><?= \Yii::t('app','Jazyky')?>:</label>
                        <div class="col-lg-9">
                            <?php
                            foreach ($langs as $lang) {
                            ?>
                                <div class="row">
                                    <div class="col"><?= $lang->languageInfo->name ?> - <?= $lang->getLevelText() ?></div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3"><?= \Yii::t('app','Ostatné vedomosti')?>:</label>
                        <div class="col-lg-9">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3"></label>
                        <div class="col-lg-9">
                            <p>

                            </p>
                        </div>
                    </div>

                    <h4 class="m-t-10 ugly-title"><?= \Yii::t('app','Ďalšie informácie') ?></h4>

                    <div class="form-group row">
                        <label class="col-lg-3"><?= \Yii::t('app','Vodičské oprávnenie') ?>:</label>
                        <div class="col-lg-9">

                            <?php
                            $vodicak = ['A','B','C','D','E','T'];
                            for($i=0; $i < count($vodicak);$i++){
                                if (!is_null($ostatne['vod_'.$vodicak[$i]])) {
                            ?>
                                <div class="row">
                                    <div class="col-sm-1">
                                        <?= $vodicak[$i] ?>
                                    </div>
                                    <div class="col-sm-11">
                                        <?= $ostatne['jazdene_'.$vodicak[$i]] ?> km
                                    </div>
                                </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3"><?= \Yii::t('app','Záujmy') ?>:</label>
                        <div class="col-lg-9">
                            <p><?= $ostatne->zaujmy ?></p>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="ulohy" role="tabpanel" aria-labelledby="ulohy-tab">

                </div>
                <div class="tab-pane fade" id="devtesty" role="tabpanel" aria-labelledby="devtesty-tab">
                    <?= $this->render('devtest-result',[
                            'applicant'     => $applicant
                    ]) ?>
                </div>
                <div class="tab-pane fade" id="osobtesty" role="tabpanel" aria-labelledby="osobtesty-tab">

                </div>
                <div class="tab-pane fade" id="iqtesty" role="tabpanel" aria-labelledby="iqtesty-tab">

                </div>
                <div class="tab-pane fade" id="prilohy" role="tabpanel" aria-labelledby="prilohy-tab">
                    <?php

                    foreach ($docs as $doc) {

                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
    $('#change-status').on('click',function(){
        
    });
JS;
$this->registerJS($js);
$css = <<<CSS
    h4.ugly-title {
        padding:5px; 
        border-bottom: 1px solid #a0a0a0; 
        margin-bottom: 20px;
    }
CSS;
$this->registerCSS($css);

