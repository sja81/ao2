<?php
use yii\widgets\ActiveForm;
$this->title = Yii::t('app','Komentáre');
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 col-xs-12 col-lg-3 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>
<?php $form = ActiveForm::begin(); ?>

<?php ActiveForm::end(); ?>
?>
</div>
