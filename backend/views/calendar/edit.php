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
    foreach ($calendar as $cal) { ?>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Id kalendáru') ?></label>
                                <input type="text" class="form-control" name="data[<?= $cal['id']; ?>][calendarId]" value="<?= $cal['calendarId'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Id udalosti') ?></label>
                                <input type="text" class="form-control" name="data[<?= $cal['id']; ?>][eventTypeId]" value=" <?= $cal['eventTypeId'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Názov') ?></label>
                                <input type="text" class="form-control" name="data[<?= $cal['id']; ?>][title]" value=" <?= $cal['title'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                            <div class="col">
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label class="control-label"><?= Yii::t('app', 'Popis') ?></label>
                                    <input type="text" class="form-control" name="data[<?= $cal['id']; ?>][description]" value="<?= $cal['description'] ?>">
                                    <small class="form-control-feedback"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Status') ?></label>
                                <input type="text" class="form-control" name="data[<?= $cal['id']; ?>][status]" value=" <?= $cal['status'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Čas vytvorenia') ?></label>
                                <input type="text" class="form-control" name="data[<?= $cal['id']; ?>][createdAt]" value=" <?= $cal['createdAt'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Typ udalosti') ?></label>
                                <input type="text" class="form-control" name="data[<?= $cal['id']; ?>][calendarEventType]" value="<?= $cal['calendarEventType'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Gps dĺžka') ?></label>
                                <input type="text" class="form-control" name="data[<?= $cal['id']; ?>][gpsLong]" value="<?= $cal['gpsLong'] ?>">
                                <small class="form-control-feedback"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Gps šírka') ?></label>
                                <input type="text" class="form-control" name="data[<?= $cal['id']; ?>][gpsLat]" value="<?= $cal['gpsLat'] ?>">
                                <small class="form-control-feedback"></small>
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
                <a class="btn btn-danger" href="<?= Url::to(['/calendar/settings']) ?>">
                    <i class="mdi mdi-step-backward m-r-5"></i><?= Yii::t('app', 'Späť') ?>
                </a>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        </div>
</div>