<?php
$this->title = "Zmena";

use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 col-xs-12 col-lg-3 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>
    <?php
    $form = ActiveForm::begin();
    foreach ($offers as $offer) { ?>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Meno') ?></label>
                                <input type="text" class="form-control" name="data[<?= $offer['id']; ?>][name]" value="<?= $offer['name'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Datum Narodenia') ?></label>
                                <input type="text" class="form-control" name="data[<?= $offer['id']; ?>][birthDate]" value=" <?= $offer['birthDate'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Ulica') ?></label>
                                <input type="text" class="form-control" name="data[<?= $offer['id']; ?>][ownerAddress]" value=" <?= $offer['ownerAddress'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                            <div class="col">
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label class="control-label"><?= Yii::t('app', 'Mesto') ?></label>
                                    <input type="text" class="form-control" name="data[<?= $offer['id']; ?>][ownerTown]" value="<?= $offer['ownerTown'] ?>">
                                    <small class="form-control-feedback"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Spoluvl. pod.') ?></label>
                                <input type="text" class="form-control" name="data[<?= $offer['id']; ?>][coOwnership]" value=" <?= $offer['coOwnership'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Titul nadobud.') ?></label>
                                <input type="text" class="form-control" name="data[<?= $offer['id']; ?>][acquisitionTitle]" value=" <?= $offer['acquisitionTitle'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Ťarchy') ?></label>
                                <input type="text" class="form-control" name="data[<?= $offer['id']; ?>][encumbrance]" value="<?= $offer['encumbrance'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Súp.č.') ?></label>
                                <input type="text" class="form-control" name="data[<?= $offer['id']; ?>][registerNumber]" value="<?= $offer['registerNumber'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Č.parcely') ?></label>
                                <input type="text" class="form-control" name="data[<?= $offer['id']; ?>][parcelNumber]" value="<?= $offer['parcelNumber'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'LV') ?></label>
                                <input type="text" class="form-control" name="data[<?= $offer['id']; ?>][ownershipDocumentNumber]" value="<?= $offer['ownershipDocumentNumber'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Miesto') ?></label>
                                <input type="text" class="form-control" name="data[<?= $offer['id']; ?>][propertyAddress]" value="<?= $offer['propertyAddress'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <div class="row m-t-20 m-l-10">
        <div class="col">
            <button type="submit" class="btn btn-success mr-1">
                <i class="mdi mdi-content-save m-r-5"></i><?= Yii::t('app', 'Uložiť') ?>
            </button>
            <a class="btn btn-danger" href="<?= Url::to(['/offers']) ?>">
                <i class="mdi mdi-step-backward m-r-5"></i><?= Yii::t('app', 'Späť') ?>
            </a>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>