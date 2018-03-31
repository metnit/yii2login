<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout','apilogin','apiregister','finduser'],
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('login');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $session = Yii::$app->session;
        if ($session['id']){
            return $this->goHome();
        }
        return $this->render('login');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('login');
    }

    public function actionSingout()
    {
        $session = Yii::$app->session;
        $session->destroy();

        return $this->redirect('login');
    }

    public function actionApilogin()
    {

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Access-Control-Allow-Methods: POST');

        $username ="";
        $password ="";

        if(!empty($_POST)){

        $username = $_POST['username'];
        $password = $_POST['password'];


        $data = User::login($username,md5($password));


     
        echo json_encode($data);

        }else{

          echo 'error page 404';
        }

    }

    public function actionRegister(){
        return $this->render('register');
    }

    public function actionApiregister(){

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Access-Control-Allow-Methods: POST');

        $username ="";
        $password ="";
        $email = "";
        $image = "";

        if(!empty($_POST)){

            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            $model = new User();

            if($_FILES){

              if ( 0 < $_FILES['file']['error'] ) {
                    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
              }
              else {
                    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
                    $model->user_image = '/uploads/'.$_FILES['file']['name'];
              }

            }
            

            //echo json_encode($_POST);
            
            $model->username = $username;
            $model->password = md5($password);
            $model->email = isset($email)?$email:'';

                if($model->save()){
                    echo json_encode('pass');
                }else{
                    echo json_encode('error save');
                }

        }else{
             echo json_encode('error');
        }
    }

    public function actionFinduser()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Access-Control-Allow-Methods: POST');
        if(!empty($_POST)){

            $username = $_POST['username'];
            $user = User::findUsername($username);

            echo json_encode($user);

        }
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
