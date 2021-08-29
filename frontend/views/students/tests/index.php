<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

$this->registerCSSFile('@web/css/schools.css?v=1.09',['depends'=>AppAsset::class]);
$this->title = Yii::t('app','Testy');
?>

<main class="site-student">
    <div class="page-banner d-block position-relative raleway">
        <canvas style="background-image:url('/images/header-bg1.jpg');" width="1600" height="400"></canvas>
        <div class="page-border container-default d-block position-absolute mx-auto">
            <div class="page_title_line_left d-inline-block position-absolute background-gold-before background-gold-after animated fadeIn visible" data-aios-reveal="true" data-aios-animation="fadeIn" data-aios-animation-delay="0.2s" data-aios-animation-reset="false" data-aios-animation-offset="0" style="animation-delay: 0.2s;"></div>
            <div class="page_title_line_right d-inline-block position-absolute background-gold-before background-gold-after animated fadeIn visible" data-aios-reveal="true" data-aios-animation="fadeIn" data-aios-animation-delay="0.2s" data-aios-animation-reset="false" data-aios-animation-offset="0" style="animation-delay: 0.2s;"></div>
        </div>
        <div class="page-title container-default d-block position-absolute mx-auto">
            <div class="container-fluid">
                <div class="titlewrapper">
                    <h1 class="entry-title animated fadeInDown visible" data-aios-reveal="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.3s" data-aios-animation-reset="false" data-aios-animation-offset="0" style="animation-delay: 0.3s;">
                        <strong><?= Html::encode($this->title) ?></strong></h1>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?=
                        Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="students" class="container-fluid">
        <div class="students-container">
            <section class="text-justify">
                <h1><?= $student->firstName ?> <?= $student->lastName ?><?= Yii::t('app',' vítajte späť!'); ?></h1>
                <p class="mt30">
                    <?= Yii::t('app','Na ďalšich stránkach nájdete testy, ktoré treba vyplniť pre úspešné dokončenie prijímacieho konania.'); ?>
                    <?= Yii::t('app','Počas testovania budete absolvovať nasledovné testy:'); ?>
                </p>
                <ol class="mylist mt30">
                    <li><?= Yii::t('app','Test personality'); ?></li>
                    <li><?= Yii::t('app','Test písania'); ?></li>
                    <li><?= Yii::t('app','Videonahrávka'); ?></li>
                </ol>
                <a href="/students/peronal-test/<?= $_GET['id'] ?>" class="secondary-button mt30 text-uppercase"><?= Yii::t('app','Spustiť prvý test'); ?></a>
            </section>
        </div>
    </div>
</main>

<?php

$css = <<<CSS
    .mt30 {
        margin-top: 30px;
    }
    .mb30{
        margin-bottom: 30px;
    }
    .mylist {
        list-style: decimal;
    }
    .mylist li {
        margin-left: 15px;
        padding-bottom: 10px;
    }
CSS;
$this->registerCSS($css);