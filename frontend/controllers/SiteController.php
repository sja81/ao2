<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Aoreal;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actionPage()
    {
        $lang_iso = 'sk';
        $view = Yii::$app->request->get('view');

        if ($view == 'ajax')
            return $this->actionAjax();

        $pageAlias = Aoreal::pageAlias();        
        $page = $pageAlias[$lang_iso][$view];

        if (!isset($page) || empty($page))
            return $this->render('index');
 
        if ($page[1] && !is_null($page[1]))
        {
            Yii::$app->view->title = $page[1];
            Yii::$app->view->params['breadcrumbs'][] = $page[1];
            //Yii::$app->view->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
        }

        switch($page[0])
        {
            case 'contact':
                
                $model = new ContactForm();
                if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                    if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                        Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                    } else {
                        Yii::$app->session->setFlash('error', 'There was an error sending your message.');
                    }

                    return $this->refresh();
                } else {
                    return $this->render('contact', [
                        'model' => $model,
                    ]);
                }
                
                break;
            case 'properties':
                $searchForm = Yii::$app->request->get();
                if (isset($searchForm['submitPropertySearch']))
                {
                    
                    print_r(Yii::$app->request->get());
                    $properties = Aoreal::getProperties();
                }
                else
                {
                    $view = Yii::$app->request->get('view');
                    
                    $exclusive = false;
                    $newest = false;
                    
                    if ($view == 'exkluzivne-ponuky')
                        $exclusive = true;
                    if ($view == 'najnovsie-ponuky')
                        $newest = true;
                    
                    $properties = Aoreal::getProperties($exclusive, $newest);
                }
                    
                return $this->render($page[0], ['properties' => $properties]);
                break;
            case 'property':
                $id_property = Yii::$app->request->get('id');
                $property_details = Aoreal::getProperty($id_property);
                    
                return $this->render($page[0], ['property_details' => $property_details]);
                break;
            default:
                return $this->render($page[0]);
        }
    }

    public function translang($string)
    {
        return 'ok';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) 
    {
        $page = Aoreal::pageAlias()['sk'][Yii::$app->request->get('view')][0];
        if (isset($page) && $page == 'properties')
            $this->enableCsrfValidation = false;
        return parent::beforeAction($action); 
    }
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionAjax()
    {
        $ajaxAction = Yii::$app->request->post('ajaxAction');

        $json_error = '';
        
        switch ($ajaxAction)
        {
            case 'getDisctrictsByRegion':
                $region_id = (int)Yii::$app->request->post('filter_id');
                $result_list = Aoreal::getDistricts($region_id, true);
                break;
            case 'getTownsByDistrict':
                $district_id = (int)Yii::$app->request->post('filter_id');
                $result_list = Aoreal::getTowns($district_id, null, true);
                break;
            case 'getTownsByChar':
                $q = Yii::$app->request->post('q');
                $result_list = Aoreal::getTownsByChar($q);
                break;
            case 'getProperties':
                $property_type = Yii::$app->request->post('property_type');
                $result_list = Aoreal::getProperties($property_type);
                break;
            case 'getPropertiesForMap':
                $property_type = Yii::$app->request->post('property_type');
                $result_list = Aoreal::getPropertiesForMap($property_type);
                break;
            default:
                $json_error = 'Wrong action';
        }
    
        $json_return = array(
            'error'         => $json_error,
            'list'          => $result_list
        );

        die(json_encode($json_return));
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $page = Yii::$app->request->get('page');
        switch ($page)
        {
            case 'property':
                return $this->render('property');
            default:
                return $this->render('index');
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionPartnerLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('partner-login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionKontakt()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /* SK */
    public function actionCennik()
    {
        return $this->render('pricelist');
    }

    public function actionObchodnePodmienky()
    {
        return $this->render('terms-general');
    }

    public function actionReklamacnyPoriadok()
    {
        return $this->render('terms-complaint');
    }

    public function actionMakleri()
    {
        return $this->render('agents');
    }

    public function actionNehnutelnosti()
    {
        return $this->render('properties');
    }

    public function actionNehnutelnost()
    {
        return $this->render('property');
    }

    /* HU */
    public function actionKapcsolat()
    {
        return $this->actionKontakt();
    }

    public function actionArlista()
    {
        return $this->actionCennik();
    }

    public function actionSzerzodesiFeltetelek()
    {
        return $this->actionObchodnePodmienky();
    }

    public function actionReklamaciosFeltetelek()
    {
        return $this->actionReklamacnyPoriadok();
    }

    public function actionUgynokok()
    {
        return $this->actionMakleri();
    }

    public function actionIngatlanok()
    {
        return $this->actionNehnutelnosti();
    }

    public function actionIngatlan()
    {
        return $this->actionNehnutelnost();
    }
}
