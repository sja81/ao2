<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

$this->title = 'Developer Test';
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

            <form method="post" id="dev-test">
                <input type="hidden" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken() ?>">
                <input type="hidden" name="studentId" value="<?php echo $_GET['id'] ?>">
                <div class="card zero-radius">
                    <div class="card-body">

                        <h4><?= \Yii::t('app','Developer Test - PHP, MYSQL & general questions') ?></h4>

                        <div class="row" style="margin-top: 20px">
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

                        <div class="row" style="margin-top: 20px">
                            <div class="col-sm-12">
                                <b>2.  Will be output of this code text “Martin”? Please explain why yes or no.</b>
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
                                <textarea name="Quiz[q2]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px">
                            <div class="col-sm-12">
                                <b>3. The value of the variable input is a string 1,2,3,4,5,6,7. How would you get the sum of the
                                    integers contained inside input?</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <input type="text" name="Quiz[q3]" class="form-control">
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px">
                            <div class="col-sm-12">
                                <b>4. Explain this line of code:</b>
                                <p style="margin-top:10px; margin-left: 10px;">
                                    $message = 'Hello ' . ($user->get('first_name') ?: 'Guest');
                                </p>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q4]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px">
                            <div class="col-sm-12">
                                <b>5. When will be this statement false, and when will be true?</b>
                                <p style="margin-top:10px; margin-left: 10px;">
                                <pre>
                        $a = ‘0’;

                        if( $a == 0 ) { … }
                        if( $a === 0 ) { … }
                        </pre>
                                </p>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q5]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px">
                            <div class="col-sm-12">
                                <b>6. Write down the result of the next command:</b>
                                <pre style="margin-top: 10px;">
                        $string='[{"name":"PHP","Description":"Web notes"},{"name":"JSON"}]';
                        $data = json_decode($string);
                        print_r($data);
                    </pre>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q6]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px">
                            <div class="col-sm-12">
                                <b>7. Write down example, how to handle exception.</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q7]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px">
                            <div class="col-sm-12">
                                <b>8. Refactor this code, use Dependency injection</b>
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
                                <textarea name="Quiz[q8]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px">
                            <div class="col-sm-12">
                                <b>9. Write simple function which will check if number is Even or Odd</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q9]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px">
                            <div class="col-sm-12">
                                <b>10. Write code which will calculate x! – factorial function.</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q10]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px">
                            <div class="col-sm-12">
                                <b>11. What is the difference between the class and interface?</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q11]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px">
                            <div class="col-sm-12">
                                <b>12. Do you have experience with DDD, BDD, TDD? Describe the approach of DDD…</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q12]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px">
                            <div class="col-sm-12">
                                <b>13. Please explain what is MVC?</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q13]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-12">
                                <b>14. Does the PHP support multiple inheritance?</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q14]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-12">
                                <b>15. In a PHP class what are the three visibility keywords of property or method?</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q15]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-12">
                                <b>16. Please explain shortly what is Lazy Loading.</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q16]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-12">
                                <b>17. What is the meaning of a final class or final method?</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q17]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-12">
                                <b>18. What is ORM, why we are using ORM?</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q18]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-12">
                                <b>19. What is the execution plan? How would you view the execution plan?</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q19]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-12">
                                <b>20. What types of JOIN do we have in MySQL, describe at least 3</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q20]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-12">
                                <b>21. Do you use Composer? If yes, what benefits have you found in it?</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q21]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-12">
                                <b>22. Describe anonymous functions, describe anonymous class.</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q22]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-12">
                                <b>23. Which PSR standards are familiar to you?</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q23]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-12">
                                <b>24. Do you know some design patterns? If yes, describe them</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q24]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-12">
                                <b>25. Docker – are you familiar with docker containers? How you can list containers in docker?</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q25]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-12">
                                <b>26. Do you know jsonrpc 2 format? What parts must be specified there. (jsonrpc, method, params, id)</b>
                                <p style="margin-top: 10px">Answer:</p>
                                <textarea name="Quiz[q26]" class="form-control" rows="5" style="margin-top: 10px;"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 40px">
                            <div class="col-sm-12" style="text-align: center">
                                <button type="submit" class="btn-sm">Finish</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</main>







