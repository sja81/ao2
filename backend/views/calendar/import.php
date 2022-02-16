<?php

use yii\helpers\Url;

$this->title = Yii::t('app', 'Import dát');
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div <div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form class="form" method="post" action="<?= Url::to(['/calendar/import']) ?>" enctype="multipart/form-data">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>">
                    <div class="form-group row">
                        <label class="col-2 col-form-label"><?= Yii::t('app', 'Typ'); ?></label>
                        <div class="col-10">
                            <select class="form-select dropdown" name="Import[type]">
                                <option value="39">Kalendár</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label"><?= Yii::t('app', 'Oddelovač'); ?></label>
                        <div class="col-10">
                            <select class="form-select dropdown" name="Import[delimiter]">
                                <option value=";">;</option>
                                <option value=",">,</option>
                                <option value="|">|</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label"><?= Yii::t('app', 'Súbor'); ?></label>
                        <div class="col-10">
                            <input type="file" name="DataFile" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <button class="btn btn-success text-white"><?= Yii::t('app', 'Nahrať'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>