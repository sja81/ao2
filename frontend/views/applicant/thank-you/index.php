<?php
$this->title = \Yii::t('app','Úspešná registrácia');
?>
<div class="card zero-radius">
    <div class="card-body">
        <h2 class="text-center"><?= \Yii::t('app','Ďakujeme za Vašu registráciu!')?></h2>
    </div>
</div>
<?php
$js = <<<JS
    window.sessionStorage.clear();
JS;
$this->registerJS($js);

