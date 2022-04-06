<?php
use yii\helpers\Url;
$this->title= Yii::t('app','Zmeniť grupu');
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 cols-xs-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="card rounded-5 card-shadow">
                <div class="card-body">
                    <form method="post" role="form">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
                        <div class="form-group row">
                            <label class="col-md-2 col-xs-2 col-form-label">
                                <?= Yii::t('app','Názov') ?>
                            </label>
                            <div class="col-md-10 col-xs-10">
                                <input class="form-control" type="text" name="UserGroup[name]" value="<?= $group->name ?>" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-2 col-xs-2 col-form-label">
                                <?= Yii::t('app','Popis') ?>
                            </label>
                            <div class="col-md-10 col-xs-10">
                                <textarea
                                        name="UserGroup[description]"
                                        cols="30"
                                        rows="10"
                                        class="form-control"><?= $group->description ?></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mr-1 text-white">
                            <i class="mdi mdi-content-save m-r-5"></i><?= Yii::t('app','Uložiť') ?>
                        </button>
                        <a class="btn btn-danger text-white" href="<?= Url::to(['/users']) ?>">
                            <i class="mdi mdi-step-backward m-r-5"></i><?= Yii::t('app','Späť') ?>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
$css = <<<CSS
    .rounded-5 {
        border-radius: .5em!important;
    }
    .card-shadow {
        box-shadow: lightgrey 3px 3px;
    }
CSS;
$this->registerCSS($css);