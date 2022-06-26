<?php

use backend\assets\RealAsset;
use yii\helpers\Url;
use backend\helpers\HelpersNum;
use PHPUnit\Util\Log\JSON;
use yii\helpers\Html;


$this->title = " Faktúry - Export ";
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Export</h4>
            <form method="post" class="form" id="">
                <input id="form-token" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>" />
                <label class="col-1 col-form-label">Názov Firmy</label>
                <div class="col-5">
                    <input type="text" name="Invoice[znak]" class="form-control">
                </div>

                <label class="col-1 col-form-label">Dátum od:</label>
                <div class="col-5">
                    <input type="date" name="Invoice[datum_vystavenia]" class="form-control">
                </div>

                <label class="col-1 col-form-label">Dátum od:</label>
                <div class="col-5">
                    <input type="date" name="Invoice[datum_dodania]" class="form-control">
                </div>

                <div class="row m-b-20 pt-3">
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-success" value="Export faktury">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>