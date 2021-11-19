<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
$this->title = \Yii::t('app','Test písania');

$this->registerCSSFile('@web/css/schools.css?v=1.09',['depends'=>AppAsset::class]);
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

            <form method="post" id="writting-test-form">
                <input type="hidden" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken() ?>">
                <input type="hidden" name="studentId" value="<?= $_GET['id']?>">

                <section>
                    <p>
                        <?= Yii::t('app','Napíšte voľný text. Tému si vyberte sami. Na dokončenie úlohy máte 5 minút. Ak ste pripravený/á, stlačte tlačítko Štart.') ?>
                    </p>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-lg-1">
                            <span id="time" style="font-size: 1.5em">05:00</span>
                        </div>
                        <div class="col-lg-10">
                            <button type="button" id="btn-start" class="btn-sm"><i class="fas fa-stopwatch-20"></i> <?= \Yii::t('app','Štart') ?></button>
                            <button id="btn-submit" type="submit" class="btn-sm" style="display: none"><?= \Yii::t('app','Poslať') ?></button>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col">
                            <textarea id="test-area" name="writting_test" class="form-control" rows="10" disabled></textarea>
                        </div>
                    </div>
                </section>
            </form>

        </div>
    </div>
</main>

<?php
$js = <<<JS
    // var start = Date.now(),
    //         diff,
    //         minutes,
    //         seconds;

    startTimer = function(duration, display, callb) {
        var timer = duration, minutes, seconds;
        var tim = setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);
    
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
    
            display.text(minutes + ":" + seconds); 
    
            if (--timer < 0) {
                clearInterval(tim);
                callb.call();
                return false;
            }
        }, 1000);
    }
    
    $('#btn-start').on('click',function(){
        var totalTime = 60*5;
        var display = $('#time');
        $('#test-area').attr('disabled',false);
        startTimer(totalTime,display,stop_counter);
        $(this).attr('disabled',1);
        $('#test-area').focus();
    });
    
    stop_counter = function(){
        $('#btn-start').hide();
        $('input[name="writting_test"]').val($('#test-area').val()).attr('disabled',1);
        $('#btn-submit').show();
    }

JS;
$this->registerJS($js);
