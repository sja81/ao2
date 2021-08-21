<?php
use yii\helpers\Url;
$this->title= Yii::t('app','Pridať funkciu');
$nazov = Yii::t('app','Názov');
$popis = Yii::t('app','Popis');
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 col-xs-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" role="form">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
                    <div id="privileges_bin"></div>
                    <div class="row">
                        <div class="col-sm-4 nopadding">
                            <div class="form-group">
                                <input type="text" class="form-control" name="Privileges[name][]" placeholder="<?= $nazov ?>">
                            </div>
                        </div>
                        <div class="col-sm-8 nopadding">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="Privileges[description][]" placeholder="<?= $popis ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="button" onclick="addPrivilege();"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-10 m-l-5">
                        <button type="submit" class="btn btn-success mr-1">
                            <i class="mdi mdi-content-save m-r-5"></i><?= Yii::t('app','Uložiť') ?>
                        </button>
                        <a class="btn btn-danger" href="<?= Url::to(['/users']) ?>">
                            <i class="mdi mdi-step-backward m-r-5"></i><?= Yii::t('app','Späť') ?>
                        </a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

$js = <<<JS
    var room = 1;

    addPrivilege = function() {
    
        room++;
        var objTo = document.getElementById('privileges_bin')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass" + room);
        var rdiv = 'removeclass' + room;
        divtest.innerHTML = '<div class="row"><div class="col-sm-4 nopadding"><div class="form-group"> <input type="text" class="form-control" name="Privileges[name][]" value="" placeholder="{$nazov}"></div></div><div class="col-sm-8 nopadding"><div class="form-group"><div class="input-group"><input type="text" class="form-control" name="Privileges[description][]" placeholder="{$popis}"><div class="input-group-append"> <button class="btn btn-danger" type="button" onclick="removePrivilege(' + room + ');"> <i class="fa fa-minus"></i> </button></div></div></div></div><div class="clear"></div></row>';
    
        objTo.appendChild(divtest)
    }
    
    removePrivilege = function(rid) {
        $('.removeclass' + rid).remove();
    }
JS;
$this->registerJS($js);