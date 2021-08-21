<?php

use backend\assets\RealAsset;
use common\models\Agent;

$this->title="Obhliadky";
$this->registerJSFile('@web/assets/node_modules/moment/moment.js',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css',['depends'=>RealAsset::class]);
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
        <div class="col-md-7 align-self-center">
            <div class="d-flex justify-content-end align-items-center">
                <a
                    href="/backoffice/contracts/add-visit?id=<?= $_GET['id'] ?>"
                    class="btn btn-info" title="<?= Yii::t('app','Pridať novú obhliadku') ?>">
                    <i class="fa fa-plus"></i> <?= Yii::t('app','Pridať') ?>
                </a>
                <button id="ob-cancel" class="btn btn-secondary m-l-5" title="<?= Yii::t('app','Zrušiť obhliadku/y') ?>"><i class="fa fa-ban"></i> <?= Yii::t('app','Zrušiť') ?></button>
                <button id="ob-print" class="btn btn-success m-l-5" title="<?= Yii::t('app','Vytlačiť obhliadku') ?>"><i class="fa fa-print"></i> <?= Yii::t('app','Vytlačiť') ?></button>
                <a href="/backoffice/contracts" class="btn btn-danger m-l-5"><i class="mdi mdi-rewind"></i> <?= Yii::t('app','Späť') ?></a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm dattable">
                    <thead>
                    <tr>
                        <th style="color: white">X</th>
                        <th>ID</th>
                        <th>Termín</th>
                        <th>Firma/Maklér</th>
                        <th>Záujemca</th>
                        <th>Stav</th>
                        <th>Akcie</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php
$js = <<<JS

    $(function(){
        $('.dattable').DataTable({
            order: []
        });
    });
JS;
$this->registerJS($js);