<?php
$this->title = \Yii::t('app','Test písania');
?>

<form method="post" id="writting-test-form">
    <input type="hidden" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken() ?>">
    <input type="hidden" name="applicant_id" value="">
    <input type="hidden" name="writting_test" value="">
    <div class="card zero-radius">
        <div class="card-body">
            <h4><?= \Yii::t('app','Písomný test') ?></h4>
            <div class="row" style="margin-top: 20px;">
                <div class="col">
                    <?= \Yii::t('app','Napíšte e-mail klientovi, ktorý nás poveril s vybavením hypotekárneho úveru. Klient nedodal požadované dokumenty. Na dokončenie úlohy máte 5 minút. Ak ste pripravený/á, stlačte tlačítko Štart.') ?>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="col-lg-1">
                    <span id="time" style="font-size: 1.5em">05:00</span>
                </div>
                <div class="col-lg-10">
                    <button id="btn-start" class="btn btn-info btn-sm"><i class="fas fa-stopwatch-20"></i> <?= \Yii::t('app','Štart') ?></button>
                    <button id="btn-submit" type="submit" class="btn btn-danger btn-sm" style="display: none"> <i class="fas fa-save"></i> <?= \Yii::t('app','Poslať') ?></button>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col">
                    <textarea id="test-area" class="form-control" rows="10"></textarea>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
$js = <<<JS
    $('#writting-test-form').submit(function(){
       $('input[name="applicant_id"]').val(window.sessionStorage.getItem('applicant_id'));
        return true; 
    });

    function startTimer(duration, display, callfn) {
        var start = Date.now(),
            diff,
            minutes,
            seconds;
        function timer() {
            // get the number of seconds that have elapsed since 
            // startTimer() was called
            diff = duration - (((Date.now() - start) / 1000) | 0);
            // does the same job as parseInt truncates the float
            minutes = (diff / 60) | 0;
            seconds = (diff % 60) | 0;
    
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
            
            display.text(minutes + ":" + seconds); 
    
            if (diff <= 0) {
                // add one second so that the count down starts at the full duration
                // example 05:00 not 04:59
                //start = Date.now() + 1000;
                return false;
            }
            return true;
        };
        // we don't want to wait a full second before the timer starts
        if (!timer()) {
            clearInterval(timer);
            callfn.call();
        } else {
            setInterval(timer, 1000);
        }
    }
    
    $('#btn-start').on('click',function(){
        var totalTime = 60*5;
        var display = $('#time');
        startTimer(totalTime,display,stop_counter);
        $(this).attr('disabled',1);
        $('#test-area').focus();
    });
    
    stop_counter = function(){
        $('#btn-start').hide();
        $('input[name="writting_test"]').val($('#test-area').val()).attr('disabled',1);
        window.sessionStorage.setItem('writting_test_done',1);
        $('#btn-submit').show();
    }

JS;
$this->registerJS($js);
