<?php
$this->title = 'Developer Test';
?>
<form method="post" id="dev-test">
    <input type="hidden" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken() ?>">
    <input type="hidden" name="applicant_id" value="">
    <div class="card zero-radius">
        <div class="card-body">

            <h4><?= \Yii::t('app','Developer Test - PHP, MYSQL & general questions') ?></h4>

            <div class="row" style="margin-top: 20px" id="Q1">
                <div class="col-sm-6">
                    <b>1. What will be the output of following php statement?</b>
                    <p style="margin-top:10px; margin-left: 10px;">
                        echo (int) ((0.1 + 0.7) * 10);
                        <br>
                        <ul style="list-style-type: none;">
                            <li><input type="radio" name="Quiz[q1]" value="7"> 7</li>
                            <li><input type="radio" name="Quiz[q1]" value="6"> 6</li>
                            <li><input type="radio" name="Quiz[q1]" value="8"> 8</li>
                            <li><input type="radio" name="Quiz[q1]" value="0"> 0</li>
                        </ul>
                    </p>
                </div>
            </div>

            <div class="row" style="margin-top: 20px" id="Q2">
                <div class="col-sm-12">
                    <b>2.  Please fix the next php code. It should change the content of two variables without using return.</b>
                       <textarea name="Quiz[q2]" class="form-control" rows="10" style="margin-top: 10px;">
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
            </div>

            <div class="row" style="margin-top: 20px" id="Q3">
                <div class="col-sm-12">
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
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q3]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q4">
                <div class="col-sm-12">
                    <b>4. The value of the variable input is a string 1,2,3,4,5,6,7. How would you get the sum of the
                        integers contained inside input?</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <input type="text" name="Quiz[q4]" class="form-control">
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q5">
                <div class="col-sm-12">
                    <b>5. Explain this line of code:</b>
                    <p style="margin-top:10px; margin-left: 10px;">
                        $message = 'Hello ' . ($user->get('first_name') ?: 'Guest');
                    </p>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q5]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q6">
                <div class="col-sm-12">
                    <b>6. When will be this statement false, and when will be true?</b>
                    <p style="margin-top:10px; margin-left: 10px;">
                        <pre>
                        $a = ‘0’;

                        if( $a == 0 ) { … }
                        if( $a === 0 ) { … }
                        </pre>
                    </p>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q6]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q7">
                <div class="col-sm-12">
                    <b>7. Write down the result of the next command:</b>
                    <pre style="margin-top: 10px;">
                        $string='[{"name":"PHP","Description":"Web notes"},{"name":"JSON"}]';
                        $data = json_decode($string);
                        print_r($data);
                    </pre>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q7]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q8">
                <div class="col-sm-12">
                    <b>8. Write down example, how to handle exception.</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q8]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q9">
                <div class="col-sm-12">
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
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q9]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q10">
                <div class="col-sm-12">
                    <b>10. Write simple function which will check if number is Even or Odd</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q10]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q11">
                <div class="col-sm-12">
                    <b>11. Write code which will calculate x! – factorial function.</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q11]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q12">
                <div class="col-sm-12">
                    <b>12. What is the difference between the class and interface?</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q12]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q13">
                <div class="col-sm-12">
                    <b>13. Do you have experience with DDD, BDD, TDD? Describe the approach of DDD…</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q13]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q14">
                <div class="col-sm-12">
                    <b>14. Please explain what is MVC?</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q14]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q15">
                <div class="col-sm-12">
                    <b>15. Does the PHP support multiple inheritance?</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q15]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q16">
                <div class="col-sm-12">
                    <b>16. In a PHP class what are the three visibility keywords of property or method?</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q16]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q17">
                <div class="col-sm-12">
                    <b>17. Please explain shortly what is Lazy Loading.</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q17]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q18">
                <div class="col-sm-12">
                    <b>18. What is the meaning of a final class or final method?</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q18]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q19">
                <div class="col-sm-12">
                    <b>19. What is ORM, why we are using ORM?</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q19]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q20">
                <div class="col-sm-12">
                    <b>20. What is the execution plan? How would you view the execution plan?</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q20]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q21">
                <div class="col-sm-12">
                    <b>21. What types of JOIN do we have in MySQL, describe at least 3</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q21]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q22">
                <div class="col-sm-12">
                    <b>22. Do you use Composer? If yes, what benefits have you found in it?</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q22]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q23">
                <div class="col-sm-12">
                    <b>23. Describe anonymous functions, describe anonymous class.</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q23]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q24">
                <div class="col-sm-12">
                    <b>24. Which PSR standards are familiar to you?</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q24]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q25">
                <div class="col-sm-12">
                    <b>25. Do you know some design patterns? If yes, describe them</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q25]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q26">
                <div class="col-sm-12">
                    <b>26. Docker – are you familiar with docker containers? How you can list containers in docker?</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q26]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;" id="Q27">
                <div class="col-sm-12">
                    <b>27. Do you know jsonrpc 2 format? What parts must be specified there. (jsonrpc, method, params, id)</b>
                    <p style="margin-top: 10px">Answer:</p>
                    <textarea name="Quiz[q27]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 20px">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Finish</button>
                </div>
            </div>

        </div>
    </div>
</form>
<?php

$js = <<<JS

    $('#dev-test').submit(function(){
        $('input[name="applicant_id"]').val(window.sessionStorage.getItem('applicant_id'));
        return true;
    });
JS;
$this->registerJS($js);