<?php
use yii\helpers\Url;
$this->title = Yii::t('app','Import dát');
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <?= \common\widgets\AoAlerts::widget() ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="card rounded-5 card-shadow">
                <div class="card-body">
                    <form class="form" method="post" action="<?= Url::to(['/offers/import']) ?>" enctype="multipart/form-data">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>">
                        <div class="form-group row">
                            <label class="col-2 col-form-label"><?= Yii::t('app','Typ nehnutelnosti'); ?></label>
                            <div class="col-10">
                                <select class="form-select dropdown" name="Import[type]">
                                    <option value="39">Garáže</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label"><?= Yii::t('app','Oddelovač'); ?></label>
                            <div class="col-10">
                                <select class="form-select dropdown" name="Import[delimiter]">
                                    <option value=";">;</option>
                                    <option value=",">,</option>
                                    <option value="|">|</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label"><?= Yii::t('app','Súbor'); ?></label>
                            <div class="col-10">
                                <input type="file" name="DataFile" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <button class="btn btn-success text-white"><?= Yii::t('app','Nahrať'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
$css = <<<CSS
.rounded-5 {
    border-radius: .5em!important;
}
.card-shadow {
    box-shadow: lightgrey 3px 3px;
}
CSS;
$this->registerCSS($css);