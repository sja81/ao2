<?php
use backend\assets\RealAsset;


/** @var string $pageTitle */
/** @var int $userId */
/** @var array $attendance */
/** @var string $yearlySummary */
/** @var string $monthlySummary */
/** @var string $dailySummary */

$this->title = $pageTitle;

$this->registerCSSFile('@web/assets/node_modules/toast-master/css/jquery.toast.css', ['depends' => RealAsset::class]);
$this->registerCSSFile('@web/assets/dist/css/pages/other-pages.css', ['depends' => RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js', ['depends' => RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css', ['depends' => RealAsset::class]);
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-5 card-shadow">
                <div class="card-body">
                    <h4 class="card-title mb-3">
                        <?php echo Yii::t('app','Manuálne vloženie operácie do dochádzky') ?>
                    </h4>
                    <form method="post" role="form">
                        <input type="hidden" id="userId" value="<?=  $userId ?>">
                        <div class="form-group mt-4">
                            <label class="form-label" for="txt01"><?= Yii::t('app','Poznámka'); ?></label>
                            <textarea class="form-control" id="txt01" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                                <button type="button" class="btn btn-success text-white" id="prichod"><?php echo Yii::t('app','Začiatok práce') ?></button>
                                <button type="button" class="btn btn-danger text-white" id="odchod"><?php echo Yii::t('app','Koniec práce') ?></button>
                        </div>
                       </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-md-3">
            <div class="card rounded-5 card-shadow">
                <div class="card-body">
                    <h5 class="card-title text-uppercase">
                        <?= Yii::t('app','Za aktuálny deň'); ?>
                    </h5>
                    <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                        <h1><i class="ti-alarm-clock text-info"></i></h1>
                        <div class="ms-auto">
                            <h1 class="text-muted" id="day-total-time"><?= $dailySummary ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="col-md-3">
            <div class="card rounded-5 card-shadow">
                <div class="card-body">
                    <h5 class="card-title text-uppercase">
                        <?= Yii::t('app','Za aktuálny týždeň'); ?>
                    </h5>
                    <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                        <h1><i class="ti-alarm-clock text-info"></i></h1>
                        <div class="ms-auto">
                            <h1 class="text-muted" id="weekday-total-time">0h 0m</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <div class="col-md-3">
            <div class="card rounded-5 card-shadow">
                <div class="card-body">
                    <h5 class="card-title text-uppercase">
                        <?= Yii::t('app','Za aktuálny mesiac'); ?>
                    </h5>
                    <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                        <h1><i class="ti-calendar text-info"></i></h1>
                        <div class="ms-auto">
                            <h1 class="text-muted" id="month-total-time"><?= $monthlySummary ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card rounded-5 card-shadow">
                <div class="card-body">
                    <h5 class="card-title text-uppercase">
                        <?= Yii::t('app','Za celý rok'); ?>
                    </h5>
                    <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                        <h1><i class="ti-calendar text-info"></i></h1>
                        <div class="ms-auto">
                            <h1 class="text-muted" id="year-total-time"><?= $yearlySummary ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card rounded-5 card-shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm dattable" id="att-01">
                                    <thead>
                                    <tr>
                                        <th><?= Yii::t('app', 'Meno a priezvisko'); ?></th>
                                        <th><?= Yii::t('app', 'Dátum'); ?></th>
                                        <th><?= Yii::t('app', 'Príchod'); ?></th>
                                        <th><?= Yii::t('app', 'Odchod'); ?></th>
                                        <th><?= Yii::t('app','Odpracované'); ?></th>
                                        <th><?= Yii::t('app', 'Typ dochádzky'); ?></th>
                                        <th><?= Yii::t('app','Poznámka'); ?></th>
                                        <th><?= Yii::t('app','Akcia'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    echo $this->render('tablebody',[
                                            'rows'  =>  $attendance
                                    ]);
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

<?php
$csrf = "'" . Yii::$app->request->csrfParam . "':'" . Yii::$app->request->getCsrfToken() . "'";
$js = <<<JS
$(function() { $('.dattable').DataTable({ order: [] }); });

$('#prichod').click(function(){
    $.ajax({
                url: "/backoffice/user-attendance/arrival",
                dataType: "json",
                data: { 
                    userId:$('#userId').val(),
                    note: document.getElementById('txt01').value,
                    {$csrf} 
                },
                type: "POST"
        }).done(function(res){
            if (res.status == 'error') {
                    console.log(res.message);
                } else {    
                    $('#att-01 tbody').empty().append(res.rows);
                }
        });
});

$('#odchod').click(function(){
    $.ajax({
                url: "/backoffice/user-attendance/departure",
                dataType: "json",
                data: { 
                    userId:$('#userId').val(),
                    {$csrf} 
                },
                type: "POST"
        }).done(function(res){
            if (res.status == 'error') {
                    console.log(res.message);
                } else {    
                    $('#att-01 tbody').empty().append(res.rows);
                    $('#day-total-time').html(res.day_total_time);
                    $('#month-total-time').html(res.month_total_time);
                    $('#year-total-time').html(res.year_total_time);
                }
        });
});

JS;
$this->registerJS($js);

$css = <<<CSS
.rounded-5 {
    border-radius: .5em!important;
}
.card-shadow {
    box-shadow: lightgrey 3px 3px;
}
CSS;
$this->registerCSS($css);
