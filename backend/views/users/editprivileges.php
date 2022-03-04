<?php
use yii\helpers\Url;
$this->title= Yii::t('app','Zmeniť funkciu');
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 col-xs-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-5 card-shadow">
                <div class="card-body">
                    <form method="post" role="form">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
                        <div class="form-group">
                            <label><?= Yii::t('app','Názov') ?></label>
                            <input type="text" class="form-control" value="<?= $privilege['name'] ?>" name="Privilege[name]">
                        </div>
                        <div class="form-group">
                            <label><?= Yii::t('app','Popis') ?></label>
                            <textarea class="form-control" rows="10" name="Privilege[description]"><?= $privilege['description']?></textarea>
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
