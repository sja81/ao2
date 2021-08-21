<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use common\widgets\Alert;
use frontend\models\Aoreal;

$aoreal = new Aoreal();

$view = Yii::$app->request->get('view');
if ($view == 'hladam' || $view == 'keresek')
    $contact_page_type = 'search';
elseif ($view == 'ponukam' || $view == 'kinalok')
    $contact_page_type = 'offer';
else
    $contact_page_type = 'default';

?>

<main class="site-contact">
    <div class="page-banner d-block position-relative raleway">
        <canvas style="background-image:url(/images/contact-us-banner-1.jpg);" width="1600" height="400"></canvas>
        <div class="page-border container-default d-block position-absolute mx-auto">
            <div class="page_title_line_left d-inline-block position-absolute background-gold-before background-gold-after animated fadeIn visible" data-aios-reveal="true" data-aios-animation="fadeIn" data-aios-animation-delay="0.2s" data-aios-animation-reset="false" data-aios-animation-offset="0" style="animation-delay: 0.2s;"></div>
            <div class="page_title_line_right d-inline-block position-absolute background-gold-before background-gold-after animated fadeIn visible" data-aios-reveal="true" data-aios-animation="fadeIn" data-aios-animation-delay="0.2s" data-aios-animation-reset="false" data-aios-animation-offset="0" style="animation-delay: 0.2s;"></div>			
        </div>
        <div class="page-title container-default d-block position-absolute mx-auto">
            <div class="container-fluid">
                <div class="titlewrapper">
                    <h1 class="entry-title animated fadeInDown visible" data-aios-reveal="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.3s" data-aios-animation-reset="false" data-aios-animation-offset="0" style="animation-delay: 0.3s;">
                    <strong><?= Html::encode($this->title) ?></strong>				</h1>
                </div>
            </div>
        </div>
        <?= Alert::widget(); ?>
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
    <?php
    if ($contact_page_type == 'default')
    {
    ?>
    <section id="contact-section-one">
        <div class="contactus-form">
            <h2 class="raleway"><strong><?php echo Aoreal::trans('NAPÍŠTE'); ?></strong> <?php echo Aoreal::trans('NÁM'); ?></h2>
            <div role="form" class="wpcf7" id="wpcf7-f2130-o1" lang="en-US" dir="ltr">
                <div class="screen-reader-response"></div>
                <?php $form = ActiveForm::begin(['id' => 'contact-form', 'layout' => 'default']); ?>
                    <div class="hide">
                        <?= $form->field($model, 'subject')->textInput(['value' => Aoreal::trans('Správa z kontaktného formulára')]) ?>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'size' => 40])->label(Aoreal::trans('Celé meno')) ?>
                        </div>
                        <div class="form-col">
                            <?= $form->field($model, 'company')->label(Aoreal::trans('Názov spoločnosti')) ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-row">
                        <div class="form-col">
                            <?= $form->field($model, 'phone')->label(Aoreal::trans('Telefónne číslo')) ?>
                        </div>
                        <div class="form-col">
                            <?= $form->field($model, 'email')->label(Aoreal::trans('E-mailová adresa')) ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-row mt-3">
                        <?= $form->field($model, 'body')->textarea(['rows' => 6])->label(Aoreal::trans('Správa')) ?>
                    </div>
                    
                    <?= $form->field($model, 'verifyCode')->label(Aoreal::trans('Overovací kód'))->widget(Captcha::className(), [
                        'template' => '
                        <div class="row">
                            <div class="col-lg-12">{image}</div>
                            <div class="col-lg-12">{input}</div>
                        </div>',
                    ]) ?>
                    <div class="clear"></div>
                    <div class="form-group">
                        <?= Html::submitButton(Aoreal::trans('Odoslať'), ['class' => 'btn btn-primary d-block mx-auto text-uppercase', 'name' => 'contact-button']) ?>
                    </div>
                    <div class="clear"></div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="contact-us-info">

            <div class="info-line--top background-gold-before d-inline-block position-absolute"></div>
            <div class="info-line--bottom background-gold-before  d-inline-block position-absolute"></div>

            <div class="cus-info-wrap">
                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['/']); ?>" class="contact-logo"><img class="img-responsive" src="/images/logo-web-aoreal_white.png" alt="<?= $aoreal->company_name ?>" /></a>
                <h3 class="raleway"><strong>ALL-INCLUSIVE</strong> SERVICE<br>S NEHNUTEĽNOSŤAMI</h3>
                <p class="cs-phone"><i class="ai-font-phone"></i> <a class="mobile-phone" href="tel:<?= $aoreal->phone_link ?>"><?= $aoreal->phone ?></a> </p>
                <p class="cs-email"><i class="ai-font-envelope-f"></i><a class="asis-mailto-obfuscated-email-hidden asis-mailto-obfuscated-email " data-value="<?= $aoreal->email ?>"><?= $aoreal->email ?></a> </p>
                <p class="cs-address"><i class="ai-font-location-c"></i><span><?= $aoreal->address.'<br>'.$aoreal->postcode.' '.$aoreal->city ?></span></p>
                <p class="were-social__boxes--smi"><i></i><span>
                    <?php
                    if ($aoreal->facebook)
                        echo '<a href="'.$aoreal->facebook.'" target="_blank" class="ai-font-facebook d-inline-block mr-2 text-decoration-none align-middle"></a>';
                    if ($aoreal->twitter)
                        echo '<a href="'.$aoreal->twitter.'" target="_blank" class="ai-font-twitter d-inline-block mx-2 text-decoration-none align-middle"></a>';
                    if ($aoreal->instagram)
                        echo '<a href="'.$aoreal->instagram.'" target="_blank" class="ai-font-instagram d-inline-block mx-2 text-decoration-none align-middle"></a>';
                    if ($aoreal->linkedin)
                        echo '<a href="'.$aoreal->linkedin.'" target="_blank" class="ai-font-linkedin d-inline-block mx-2 text-decoration-none align-middle"></a>';
                    ?>
                    </span>
                </p>
            </div>
        </div>
        <div class="clear"></div>
    </section>
    <section id="contac-us-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2664.1986937372153!2d17.10759251583442!3d48.128143559796705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476c8972e2a4e91b%3A0x20b11b9a5f563660!2zxIxlcm55xaFldnNrw6lobyAxMjg3LzEwLCA4NTEgMDEgUGV0csW-YWxrYQ!5e0!3m2!1shu!2ssk!4v1553504827177" width="600" height="473" frameborder="0" style="border:0" allowfullscreen></iframe>
    </section>
    <?php
    } else {
    ?>
    
    

    
    
    <section id="contact-section-one">
        <div class="container">
            <div class="contactus-form">
                <h2 class="raleway"><strong><?php echo Aoreal::trans('NAPÍŠTE'); ?></strong> <?php echo Aoreal::trans('NÁM'); ?></h2>
                <div role="form" class="wpcf7" id="wpcf7-f2130-o1" lang="en-US" dir="ltr">
                    <div class="screen-reader-response"></div>
                    <?php $form = ActiveForm::begin(['id' => 'contact-form', 'layout' => 'default']); ?>
                        <div class="hide">
                            <?= $form->field($model, 'subject')->textInput(['value' => Aoreal::trans('Správa z kontaktného formulára')]) ?>
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'size' => 40])->label(Aoreal::trans('Celé meno')) ?>
                            </div>
                            <div class="form-col">
                                <?= $form->field($model, 'company')->label(Aoreal::trans('Názov spoločnosti')) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-row">
                            <div class="form-col">
                                <?= $form->field($model, 'phone')->label(Aoreal::trans('Telefónne číslo')) ?>
                            </div>
                            <div class="form-col">
                                <?= $form->field($model, 'email')->label(Aoreal::trans('E-mailová adresa')) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-row mt-3">
                            <?= $form->field($model, 'body')->textarea(['rows' => 6])->label(Aoreal::trans('Správa')) ?>
                        </div>

                        <?= $form->field($model, 'verifyCode')->label(Aoreal::trans('Overovací kód'))->widget(Captcha::className(), [
                            'template' => '
                            <div class="row">
                                <div class="col-lg-12">{image}</div>
                                <div class="col-lg-12">{input}</div>
                            </div>',
                        ]) ?>
                        <div class="clear"></div>
                        <div class="form-group">
                            <?= Html::submitButton(Aoreal::trans('Odoslať'), ['class' => 'btn btn-primary d-block mx-auto text-uppercase', 'name' => 'contact-button']) ?>
                        </div>
                        <div class="clear"></div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    }
    ?>
</main>
