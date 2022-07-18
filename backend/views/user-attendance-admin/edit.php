<?php
use backend\assets\RealAsset;
use yii\helpers\Url;

/**
 * @var $title
 * @var $item
 */
$this->title = $title;

$this->registerCSSFile('@web/assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css', ['depends' => RealAsset::class]);
$this->registerCSSFile('@web/css/user-card.css', ['depends' => RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js', ['depends' => RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js', ['depends' => RealAsset::class]);
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12 m-b-15">
            <a href="<?= Url::to(['index']) ?>" class="btn btn-danger text-white">
                <i class="fas fa-arrow-alt-circle-left"></i> <?= Yii::t('app','Späť') ?>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?= $item['meno'] ?></h4>
                    <h6 class="card-subtitle">(<?= $item['user_group'] ?>)</h6>
                    <form method="post" role="form" class="form p-t-20">
                        <div class="form-group row">
                            <label class="form-label text-end col-sm-3"><?= Yii::t('app','Dátum'); ?></label>
                            <div class="col-sm-9">
                                <input type="date" name="UsrAtt[uaDate]" class="form-control" value="<?= $item['uaDate'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label text-end col-sm-3"><?= Yii::t('app','Príchod'); ?></label>
                            <div class="col-sm-4">
                                <input type="time" name="UsrAtt[inTime]" class="form-control" value="<?= $item['inTime'] ?>" id="t0">
                            </div>
                            <label class="form-label text-end col-sm-1"><?= Yii::t('app','IP'); ?></label>
                            <div class="col-sm-4">
                                <input type="text" name="UsrAtt[inIP]" class="form-control" value="<?= $item['inIP'] ?>" id="t1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label text-end col-sm-3"><?= Yii::t('app','Odchod'); ?></label>
                            <div class="col-sm-4">
                                <input type="time" name="UsrAtt[outTime]" class="form-control" value="<?= $item['outTime'] ?>">
                            </div>
                            <label class="form-label text-end col-sm-1"><?= Yii::t('app','IP'); ?></label>
                            <div class="col-sm-4">
                                <input type="text" name="UsrAtt[outIP]" class="form-control" value="<?= $item['outIP'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label text-end col-sm-3"><?= Yii::t('app','Odpracované'); ?></label>
                            <div class="col-sm-4">
                                <input type="text" name="UsrAtt[diffTime]" class="form-control" value="<?= $item['diffTime'] ?>">
                            </div>
                            <div class="col-sm-5"></div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label text-end col-sm-3"><?= Yii::t('app','Poznámky'); ?></label>
                            <div class="col-sm-9">
                                <textarea name="" cols="30" rows="10" class="form-control"><?= $item['note'] ?></textarea>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?= Yii::t('app','Fotky'); ?></h4>

                    <div class="row el-element-overlay m-t-25">

                        <div class="col-lg-2 col-md-6">
                            <div class="card">
                                <div class="el-card-item">
                                    <div class="el-card-avatar el-overlay-1">
                                        <img src="../assets/images/users/1.jpg" alt="user" style="border-radius: 5px" />
                                        <div class="el-overlay">
                                            <ul class="el-info">
                                                <li>
                                                    <a class="btn default btn-outline image-popup-vertical-fit" href="../assets/images/users/1.jpg">
                                                        <i class="icon-magnifier"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)"
                                                       class="btn default btn-outline"
                                                       onclick="removeImage()"
                                                    >
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php

$js = <<<JS
removeImage = function() {
    console.log(12);
}
JS;
$this->registerJS($js);
