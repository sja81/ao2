<?php

use backend\assets\RealAsset;
use yii\helpers\Url;

$this->title = Yii::t('app', "Nastavenie kalendára");
$this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js', ['depends' => RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css', ['depends' => RealAsset::class]);

?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
        <div class="col-md-4 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <a class="btn btn-info d-none d-lg-block" href="/backoffice/calendar/add">
                    <i class="fas fa-plus-circle"></i>&nbsp;Pridať
                </a>
                <a class="btn btn-info d-none d-lg-block m-l-15 text-white" href="<?= Url::to(['/calendar/import']) ?>">
                    <i class="mdi mdi-cloud-upload m-r-5"></i>&nbsp;<?= Yii::t('app', 'Import dát'); ?>
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Calendar</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm dattable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Číslo kalendára</th>
                                    <th>Typ</th>
                                    <th>Názov</th>
                                    <th>Popis</th>
                                    <th>GPS</th>
                                    <th>Vytvorené</th>
                                    <th>Status</th>
                                    <th>Akcie</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($events as $event) { ?>
                                    <tr>
                                        <td>
                                            <?= $event->id ?>
                                        </td>
                                        <td>
                                            <?= $event->calendarId ?>
                                        </td>
                                        <td>
                                            <?= $event->eventTypeId ?>
                                        </td>
                                        <td>
                                            <?= $event->title ?>
                                        </td>
                                        <td>
                                            <?= $event->description ?>
                                        </td>
                                        <td>
                                            <?php
                                            $gps = [];
                                            if (!empty($event->gpsLong)) {
                                                $gps[] = 'Long ' . $event->gpsLong;
                                            }
                                            if (!empty($event->gpsLat)) {
                                                $gps[] = 'Lat ' . $event->gpsLat;
                                            }
                                            if (empty($gps)) {
                                                echo "No data";
                                            } else {
                                                echo implode("<br>", $gps);
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?= $event->createdAt ?>
                                        </td>
                                        <td>
                                            <?= $event->status ?>
                                        </td>
                                        <td>
                                            <a href="<?= Url::to(['edit', 'on' => $event['id']]) ?>" title="<?= Yii::t('app', 'Upraviť'); ?>" style="color: black"><i class="fas fa-pencil-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$csrf = "'" . Yii::$app->request->csrfParam . "':'" . Yii::$app->request->getCsrfToken() . "'";
$js = <<<JS
    $(function() {
        $('.dattable').DataTable({
            order: []
        });
    });
JS;

$this->registerJS($js);
