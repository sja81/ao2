<?php
use backend\assets\RealAsset;
use yii\helpers\Url;

$this->title = Yii::t('app', "Študenti");
$this->registerCSSFile('@web/assets/node_modules/toast-master/css/jquery.toast.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/dist/css/pages/other-pages.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css',['depends'=>RealAsset::class]);
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm dattable">
                            <thead>
                                <tr>
                                    <th class="w5p"><?= Yii::t('app','Porovnať?'); ?></th>
                                    <th><?= Yii::t('app','Meno a priezvisko'); ?></th>
                                    <th><?= Yii::t('app','Kontakt'); ?></th>
                                    <th><?= Yii::t('app','Škola a odbor'); ?></th>
                                    <th>Status</th>
                                    <th>Akcia</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($students as $student) {
                            ?>
                                 <tr>
                                     <td><input type="checkbox" name="" id=""></td>
                                     <td><?= $student['firstName'] . " " . $student['lastName'] ?></td>
                                     <td>
                                         <i class="mdi mdi-phone"></i> <?= $student['phoneCountry'] . " ". $student['phoneNumber'] ?>
                                         <br>
                                         <i class="mdi mdi-email"></i> <?= $student['email'] ?>
                                     </td>
                                     <td>
                                         <?= $student['description'] ?>
                                         <br>
                                         <?= $student['code'] . ' ' . $student['name'] ?>
                                     </td>
                                     <td></td>
                                     <td>
                                         <a href="<?= Url::to(['edit','id'=>$student['id']]) ?>"><i class="fas fa-pencil-alt m-l-10" style="color: black"></i></a>
                                     </td>
                                 </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php

$css = <<<CSS
    .w5p{
        width: 5%;
    }

CSS;

$this->registerCSS($css);


$js = <<<JS
    $(function() {
        $('.dattable').DataTable({
            order: []
        });
    });
JS;

$this->registerJS($js);