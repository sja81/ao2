<?php
use yii\helpers\Url;
$this->title= Yii::t('app','Pridať grupu');
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 cols-xs-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5"><?= Yii::t('app','Nová grupa') ?></h4>
                    <form method="post" role="form">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
                        <div class="form-group row">
                            <label class="col-md-2 col-xs-2 col-form-label">
                                <?= Yii::t('app','Názov') ?>
                            </label>
                            <div class="col-md-10 col-xs-10">
                                <input class="form-control" type="text" name="UserGroup[name]" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-2 col-xs-2 col-form-label">
                                <?= Yii::t('app','Popis') ?>
                            </label>
                            <div class="col-md-10 col-xs-10">
                                <textarea name="UserGroup[description]" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mr-1">
                            <i class="mdi mdi-content-save m-r-5"></i><?= Yii::t('app','Uložiť') ?>
                        </button>
                        <a class="btn btn-danger" href="<?= Url::to(['/users']) ?>">
                            <i class="mdi mdi-step-backward m-r-5"></i><?= Yii::t('app','Späť') ?>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>