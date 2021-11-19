<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
$this->title = \Yii::t('app','Test - Videonahrávka');

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
            <p>
                <?= Yii::t('app','Teraz hovorte súvislo o Vami zvolenej téme. <strong>Váš hovor budeme zaznamenávať obrazovo aj zvukom!</strong> Na dokončenie úlohy máte 3 minút. Ak ste pripravený/á, stlačte tlačítko Štart.') ?>
            </p>
            <div class="row" style="margin-top: 20px;">
                <div class="col-xs-1">
                    <span id="time" style="font-size: 1.5em">03:00</span>
                </div>
                <div class="col-xs-11">
                    <button type="button" id="btn-start" class="btn-sm"> <?= \Yii::t('app','Štart') ?></button>
                    <?php
                    $student = \common\models\schools\Students::findOne(['id'=>$_GET['id']]);
                    if ($student->schoolId == 3) {
                    ?>
                    <a class="btn-sm" href="/students/dev-test/<?= $_GET['id'] ?>"><?= Yii::t('app','Skočiť na test pre programátorov'); ?></a>
                    <?php
                    } else {
                    ?>
                    <a class="btn-sm" href="/students/test-thank-you/<?= $_GET['id'] ?>"><?= Yii::t('app','Preskočiť'); ?></a>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-xs-9">
                    <video id="student-video" width="640" height="480" autoplay></video>
                </div>
                <div class="col-xs-3">
                    <div id="video-logs" style="min-height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
$csrfName = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->getCsrfToken();
?>

<script>
    var shouldStop = false;
    var stopped = false;
    var player = document.getElementById('student-video');
    var mediaRecorder = null;

    var startTimer = function(duration, display, callb) {
        var timer = duration, minutes, seconds;
        var tim = setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.innerHTML = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(tim);
                callb.call();
                return false;
            }
        }, 1000);
    }

    document.getElementById('btn-start').addEventListener('click',function(){
        let totalTime = 60*3;
        let display = document.getElementById('time');
        startTimer(totalTime,display,stop_counter);
        mediaRecorder.start();
        let c= document.getElementById('video-logs').innerHTML;
        if (c.length != 0) {
            c += "<br>";
        }
        c += "Recording...";
        document.getElementById('video-logs').innerHTML = c;
    });

    var stop_counter = function() {
        document.getElementById('btn-start').style.display = 'none';
        shouldStop = true;
        stopped = true;
        mediaRecorder.stop();
        let c= document.getElementById('video-logs').innerHTML;
        c += "<br>Done...";
        c += "<br>Uploading...";
        document.getElementById('video-logs').innerHTML = c;
    }

    var handleSuccess = function(stream) {
        const options = {mimeType: 'video/webm'};
        const recordedChunks = [];

        player.srcObject = stream;
        player.play();

        mediaRecorder = new MediaRecorder(stream, options);
        mediaRecorder.addEventListener('dataavailable', function(e) {
            if (e.data.size > 0) {
                recordedChunks.push(e.data);
            }
            if(shouldStop === true && stopped === false) {
                stopped = true;
                mediaRecorder.stop();
            }
        });

        mediaRecorder.addEventListener('stop', function() {
            const bigVideoBlob = new Blob(recordedChunks,{'type':'video/webm; codecs=webm'});
            let fd = new FormData();
            fd.append('studentid',<?= $_GET['id'] ?>);
            fd.append('data', bigVideoBlob);
            fd.append("<?= $csrfName ?>","<?= $csrfToken ?>");
            $.ajax({
                type: 'POST',
                url: '/students/upload-video',
                data: fd,
                processData: false,
                contentType: false
            }).done(function(r){
                if (r.status == 'ok') {
                    //redirect to thank you page
                    let c= document.getElementById('video-logs').innerHTML;
                    c += "<br>Done...";
                    document.getElementById('video-logs').innerHTML = c;
                    window.location.href='https://www.aoreal.sk/students/test-thank-you/<?= $_GET['id']?>';
                } else {
                    console.log(r.message);
                }
            });
        });
    }

    // Get access to the camera!
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true, audio: true }).then(handleSuccess);
    }
</script>


<?php

$css = <<<CSS
    #student-video{
        border: 1px solid black;
    }
CSS;
$this->registerCSS($css);