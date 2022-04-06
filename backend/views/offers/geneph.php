<?php
use yii\helpers\Url;
$this->title = Yii::t('app','Vygenerovať Elektronický Podací Hárok - EPH');
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-11 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
        <div class="col-md-1 align-self-center text-right">
            <a class="btn btn-danger text-white" href="<?= Url::to(['/offers']) ?>">
                <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;<?= Yii::t('app','Späť'); ?>
            </a>
        </div>
    </div>

    <?= \common\widgets\AoAlerts::widget() ?>

    <div class="row">
        <div class="card">
            <div class="card-body">
                <form method="post" role="form">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">

                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label"><?php echo Yii::t('app','Názov súboru'); ?></label>
                            <input class="form-control" type="text" name="Data[file_name]" value="eph-<?php echo date('Y-m-d') ?>">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label class="form-label"><?php echo Yii::t('app','Odosielateľ'); ?></label>
                            <select name="Data[sender_id]" class="form-control form-select" id="senacc">
                                <option value=""><?php echo Yii::t('app','Vyberte odosielateľa'); ?></option>
                                <?php
                                foreach ($senders as $item) {
                                ?>
                                    <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-4" id="comp-acc" style="display: none">
                        <div class="col-md-12">
                            <label class="form-label"><?php echo Yii::t('app','Bankový účet'); ?></label>
                            <select name="Data[bank_account]" id="bankacc" class="form-control form-select"></select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label class="form-label"><?= Yii::t('app','Príjemcovia') ?></label>
                            <textarea class="form-control" name="Data[offers]"></textarea>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <label class="form-label"><?= Yii::t('app','Spôsob úhrady'); ?></label>
                            <select class="form-control form-select" name="Data[payment_method]">
                                <option value=""><?= Yii::t('app','Vyberte spôsob úhrady'); ?></option>
                                <?php
                                foreach ($paymentMethods as $id=>$value) {
                                ?>
                                    <option value="<?= $id ?>"><?= $value ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><?= Yii::t('app','Druh zásielky') ?></label>
                            <select class="form-control form-select" name="Data[shipment_method]">
                                <option value=""><?= Yii::t('app','Vyberte druh zásielky'); ?></option>
                                <?php
                                foreach ($shipmentMethods as $id=>$method) {
                                ?>
                                    <option value="<?= $id ?>"><?= $method ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><?= Yii::t('app','Trieda') ?></label>
                            <select class="form-control form-select" name="Data[letter_class]">
                                <option value=""><?= Yii::t('app','Zvoľte triedu listovej zásielky') ?></option>
                                <option value="1"><?= Yii::t('app','1. trieda') ?></option>
                                <option value="2"><?= Yii::t('app','2. trieda') ?></option>
                            </select>
                        </div>
                    </div>

                    <h5 class="card-title mt-4 mb-3"><?= Yii::t('app','Sluzby'); ?></h5>
                    <div class="row">
                        <?php
                        foreach($services as $id => $svc){
                        ?>
                            <div class="col-md-6">
                                <input type="checkbox" id="ship-<?= $id ?>" class="ephdata" name="Data[services][]" value="<?= $id ?>">
                                <label for="ship-<?= $id ?>" class="form-label"><?= $svc ?></label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button class="btn btn-success text-white" type="submit"><?= Yii::t('app','Vytvoriť EPH'); ?></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>


<?php

$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";

$js = <<<JS

    $('#senacc').change(function(){
        if ($(this).val()=='') {
            $('#comp-acc').hide();
            return;
        }
        $.ajax({
           url: "/backoffice/offers/get-bank-accounts",
           dataType: "json",
           data: { company: $(this).val(), {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             
          } else {
              $('#bankacc').empty();
              $.each(res.result,function(k,v){
                 $('#bankacc').append($('<option />').text(v.bankName).val(v.bban));
              });
              $('#comp-acc').show();
          }
       });
    });

JS;

$this->registerJS($js);