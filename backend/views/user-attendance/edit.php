<?php
$this->title = Yii::t('app','Zmena dochádzky');
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
        <div class="col-md-4 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <a href="<?= \yii\helpers\Url::to(['index','uid'=>Yii::$app->request->get('uid')]) ?>" class="btn btn-danger d-none d-lg-block m-l-15 text-white">
                    <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;<?php echo Yii::t('app','Späť') ?>
                </a>
            </div>
        </div>
    </div>
    
    
</div>
