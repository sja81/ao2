<?php

use backend\assets\RealAsset;

$this->title = Yii::t('app', 'Vytvorenie udalosti');
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <form method="post" class="form">
        <div class="row m-t-20">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info text-white" style="padding:10px; font-size: 0.98em">Calendar</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <!-- <input type="hidden" id="calendarEvent-id" name="id" value="<?= $calendarInfo->id ?>"> -->
                            <label class="col-3 col-form-label">Názov Udalosti</label>
                            <div class="col-9">
                                <input type="text" name="title" class="form-control" id="calendarEvent-title" autocomplete="off" value="<?= $calendarInfo->title ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Popis Udalosti</label>
                            <div class="col-9">
                                <textarea name="description" class="form-control" id="calendarEvent-description" autocomplete="off" rows="5"><?= $calendarInfo->description ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Typ Udalosti</label>
                            <div class="col-9">
                                <select name="eventTypeId" class="form-control dropdown" id="calendarEventType-volno">
                                    <option value="0">
                                        Vyberte typ udalosti
                                    </option>
                                    <?php foreach ($eventTypes as $eventType) {
                                        echo  "<option value='{$eventType->id}'>{$eventType->description} </option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <input type="submit" class="btn btn-success" value="Uložiť">
                <a href="/backoffice/calendar/settings" class="btn btn-danger"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Späť</a>
            </div>
        </div>
    </form>
</div>