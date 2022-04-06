<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';

?>
<div class="login-register" style="background-image:url(../assets/images/background/login-register.jpg);">
    <div class="login-box card">
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'id' => 'loginform',
                'class' => 'form-horizontal form-material'
            ]); ?>
            <h3 class="text-center m-b-20">Vstúpiť do BackOfficu</h3>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true,'style'=>'font-size:1.3rem !important'])->label('Meno') ?>

            <?= $form->field($model, 'password')->passwordInput(['style'=>'font-size:1.3rem !important'])->label('Heslo') ?>

            <?= $form->field($model, 'rememberMe')->checkbox()->label('Zapamätať') ?>

            <div class="form-group">
                <!-- btn btn-block btn-lg btn-info btn-rounded -->
                <?= Html::submitButton('Vstúpiť', ['class' => 'btn w-100 btn-lg btn-info btn-rounded text-white', 'name' => 'login-button', 'style'=>'font-size:1.3rem !important']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>