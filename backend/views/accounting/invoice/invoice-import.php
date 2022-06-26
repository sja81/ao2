<?php

$this->title = " Faktúry - Import ";
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Nahranie faktúry</h4>
            <form method="post" class="form">
                <input id="form-token" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>" />
                <label class="col-1 col-form-label">Faktura</label>
                <div class="col-5">
                    <input type="file" name="faktura" class="form-control">
                </div>
                <div class="row m-b-20 pt-3">
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-success" value="Import Faktutry">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>