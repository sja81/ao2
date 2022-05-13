<?php
use backend\assets\RealAsset;
use yii\helpers\Url;
use common\models\users\UserAttendance;


/** @var array $offices **/

$this->title=Yii::t('app','Dokumenty k dochádzke');

$this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css',['depends'=>RealAsset::class]);
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
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
                                        <th>#</th>
                                        <th><?= Yii::t('app', 'Názov dokumentu'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="checkbox" name="" id=""></td>
                                        <td></td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="button" id="docGen" class="btn btn-success text-white"><?php echo Yii::t('app', 'Vygenerovať');?></button>
            <a href="<?= Url::to(['index']) ?>" class="btn btn-danger text-white"><?php echo Yii::t('app', 'Späť');?></a>
        </div>
    </div>

</div>