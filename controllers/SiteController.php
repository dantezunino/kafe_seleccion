<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Registro;
use app\models\RegisDB;

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
        return $this->render('index');
    }

    public function actionRegisDB(){
        return;
    }


    public function actionRegistro(){
        $model = new Registro();

        $dbhost = 'localhost';
        $dbuser = 'kafe';
        $dbpass = 'password';
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        
            mysqli_select_db($conn, 'kafe_exe');
            $nombreT = $model->nombre;
            $apellidoT = $model->apellido;
            $edadT = intval($model->edad);
            $emailT = $model->email;
            $dniT = intval($model->dni);
            $amigoT = $model->amigo;

            $sqlinfo = "SELECT nombre, apellido FROM kafe_tabla";
            $result = mysqli_query($conn, $sqlinfo);
            $listData = [];
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  $nomlis = $row["nombre"]." ".$row["apellido"];
                  array_push($listData, $nomlis);
                }
              } else {
                array_push($listData, "No");
            }
            $amigoTF = $listData[$amigoT[0]];
            $sql = "INSERT INTO kafe_tabla VALUES(NULL, '$nombreT', '$apellidoT', '$edadT', '$emailT', '$dniT', '$amigoTF')";
            mysqli_query($conn, $sql);
            mysqli_close($conn);

        return $this->refresh();
        }
        else{
            return $this->render('registro', ['model' => $model]);
        }
    }
    /**
     * Login action.
     *
     * @return Response|string
     */

    public function actionShowin(){
        return $this->render('showin');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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
