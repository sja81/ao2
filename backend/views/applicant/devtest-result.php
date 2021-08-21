<?php
    $testResult = json_decode($applicant->tests->developer_test,true);
?>
<div class="row m-t-40 p-3">
    <div class="col-sm-6">
        <b>1. What will be the output of following php statement?</b>
        <p style="margin-top:10px; margin-left: 10px;">
            echo (int) ((0.1 + 0.7) * 10);
            <?php
                $qres = (int)$testResult['q1'];
            ?>
        <ul style="clear: both; margin-top: 10px">
            <li>7</li>
            <li>6</li>
            <li>8</li>
            <li>0</li>
        </ul>
        </p>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="1"> <?= Yii::t('app','Správne') ?>
    </div>
    <div class="col-sm-6">
    </div>
</div>
<div class="row m-t-20 p-3" style="background-color: #f8f8f8;">
    <div class="col-sm-6">
        <b>2.  Please fix the next php code. It should change the content of two variables without using return.</b>
        <textarea class="form-control" rows="10" style="margin-top: 10px;">
           function swap( $a, $b )
           {
                $c= $a;
                $a=$b;
                $b=$c;
           }
            $x = 10;
            $y = 20;
            echo $x , ‘ – ‘, $y, PHP_EOL; // 10 – 20
            swap($x,$y);
            echo $x , ‘ – ‘, $y, PHP_EOL; // 20 - 10
        </textarea>
    </div>
    <div class="col-sm-6">
        <b>Result:</b>
        <textarea class="form-control" rows="10" style="margin-top: 28px;"><?= $testResult['q2'] ?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="2" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3">
    <div class="col-sm-5">
        <b>3.  Will be output of this code text “Martin”? Please explain why yes or no.</b>
        <p style="margin-top:10px;">
        <pre>
                        abstract class Person
                        {
                            abstract public function getName();
                        }
                        class Customer extends Person
                        {
                            private $first_name = "Martin";
                            private $last_name = "Kod";

                            public function getFirstName() : string
                            {
                                return $this->first_name;
                            }
                        }
                        $customer = new Customer();
                        echo $customer->getFirstName();
                        </pre>
        </p>
    </div>
    <div class="col-sm-7">
        <b>Result: </b>
        <textarea class="form-control" rows="10" style="margin-top: 10px;"><?= $testResult['q3'] ?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="3" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3" style="background-color: #f8f8f8;">
    <div class="col-sm-12">
        <b>4. The value of the variable input is a string 1,2,3,4,5,6,7. How would you get the sum of the
            integers contained inside input?</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q4']) ? $testResult['q4'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="4" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3">
    <div class="col-sm-12">
        <b>5. Explain this line of code:</b>
        <p style="margin-top:10px; margin-left: 10px;">
            $message = 'Hello ' . ($user->get('first_name') ?: 'Guest');
        </p>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q5']) ? $testResult['q5'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="5" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3" style="background-color: #f8f8f8;">
    <div class="col-sm-5">
        <b>6. When will be this statement false, and when will be true?</b>
        <p style="margin-top:10px; margin-left: 10px;">
            <pre>
            $a = ‘0’;

            if( $a == 0 ) { … }
            if( $a === 0 ) { … }
            </pre>
        </p>
    </div>
    <div class="col-sm-7">
        <b>Result: </b>
        <textarea class="form-control" rows="5"><?= isset($testResult['q6']) ? $testResult['q6'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="6" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3">
    <div class="col-sm-5">
        <b>7. Write down the result of the next command:</b>
        <pre style="margin-top: 10px;">
        $string='[{"name":"PHP","Description":"Web notes"},{"name":"JSON"}]';
        $data = json_decode($string);
        print_r($data);
        </pre>
    </div>
    <div class="col-sm-7">
        <b>Result: </b>
        <textarea class="form-control" rows="5"><?= isset($testResult['q7']) ? $testResult['q7'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="7" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3" style="background-color: #f8f8f8;">
    <div class="col-sm-12">
        <b>8. Write down example, how to handle exception.</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q8']) ? $testResult['q8'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="8" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3">
    <div class="col-sm-5">
        <b>9. Refactor this code, use Dependency injection</b>
        <pre style="margin-top: 10px">
            namespace Example;
            class Client
            {
                public function execute()
                {
                    $dependency = new Dependency();
                    $dependency->execute();
                }
            }
        </pre>
    </div>
    <div class="col-sm-7">
        <b>Result: </b>
        <textarea class="form-control" rows="5"><?= isset($testResult['q9']) ? $testResult['q9'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="9" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3" style="background-color: #f8f8f8;">
    <div class="col-sm-12">
        <b>10. Write simple function which will check if number is Even or Odd</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q10']) ? $testResult['q10'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="10" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3">
    <div class="col-sm-12">
        <b>11. Write code which will calculate x! – factorial function.</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q11']) ? $testResult['q11'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="11" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3" style="background-color: #f8f8f8;">
    <div class="col-sm-12">
        <b>12. What is the difference between the class and interface?</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q12']) ? $testResult['q12'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="12" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3">
    <div class="col-sm-12">
        <b>13. Do you have experience with DDD, BDD, TDD? Describe the approach of DDD…</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q13']) ? $testResult['q13'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="13" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3" style="background-color: #f8f8f8;">
    <div class="col-sm-12">
        <b>14. Please explain what is MVC?</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q14']) ? $testResult['q14'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="14" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3">
    <div class="col-sm-12">
        <b>15. Does the PHP support multiple inheritance?</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q15']) ? $testResult['q15'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="15" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3" style="background-color: #f8f8f8;">
    <div class="col-sm-12">
        <b>16. In a PHP class what are the three visibility keywords of property or method?</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q16']) ? $testResult['q16'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="16" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3">
    <div class="col-sm-12">
        <b>17. Please explain shortly what is Lazy Loading.</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q17']) ? $testResult['q17'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="17" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3" style="background-color: #f8f8f8;">
    <div class="col-sm-12">
        <b>18. What is the meaning of a final class or final method?</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q18']) ? $testResult['q18'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="18" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3">
    <div class="col-sm-12">
        <b>19. What is ORM, why we are using ORM?</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q19']) ? $testResult['q19'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="19" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3" style="background-color: #f8f8f8;">
    <div class="col-sm-12">
        <b>20. What is the execution plan? How would you view the execution plan?</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q20']) ? $testResult['q20'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="20" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3">
    <div class="col-sm-12">
        <b>21. What types of JOIN do we have in MySQL, describe at least 3</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q21']) ? $testResult['q21'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="21" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3" style="background-color: #f8f8f8;">
    <div class="col-sm-12">
        <b>22. Do you use Composer? If yes, what benefits have you found in it?</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q22']) ? $testResult['q22'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="22" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3">
    <div class="col-sm-12">
        <b>23. Describe anonymous functions, describe anonymous class.</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q23']) ? $testResult['q23'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="23" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3" style="background-color: #f8f8f8;">
    <div class="col-sm-12">
        <b>24. Which PSR standards are familiar to you?</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q24']) ? $testResult['q24'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="24" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3">
    <div class="col-sm-12">
        <b>25. Do you know some design patterns? If yes, describe them</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q25']) ? $testResult['q25'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="25" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
<div class="row m-t-20 p-3" style="background-color: #f8f8f8;">
    <div class="col-sm-12">
        <b>26. Docker – are you familiar with docker containers? How you can list containers in docker?</b>
        <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
        <textarea class="form-control"><?= isset($testResult['q26']) ? $testResult['q26'] : ''?></textarea>
        <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="26" value="1"> <?= Yii::t('app','Správne') ?>
    </div>
</div>
    <div class="row m-t-20 p-3">
        <div class="col-sm-12">
            <b>27. Do you know jsonrpc 2 format? What parts must be specified there. (jsonrpc, method, params, id)</b>
            <p style="margin-top: 10px;margin-bottom: 5px">Result: </p>
            <textarea class="form-control"><?= isset($testResult['q27']) ? $testResult['q27'] : ''?></textarea>
            <input type="checkbox" style="clear: both;margin-top:10px" class="res" data-q="27" value="1"> <?= Yii::t('app','Správne') ?>
        </div>
    </div>


<?php
$url = \yii\helpers\Url::to(['/applicant/ajax-update-dev-test-total']);
$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";

$js = <<<JS
    $('.res').on('change', function(){
        var act = 'add';
        if (!$(this).is(':checked')) {
            act = 'dec';
        }
        var p = $(this).data('id');
        $.ajax({
           url: "{$url}",
           dataType: "json",
           data: { application_id: {$_GET['id']}, action: act, pos: p, {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             console.log('Error happend!');
          } else {
             // udpate total counter on tab label
             $('#dev-test-score').html(res.total);
          }
       })
       return false;
    });
    
JS;
$this->registerJS($js);