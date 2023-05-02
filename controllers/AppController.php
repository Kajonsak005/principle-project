<?php

namespace app\controllers;

use Yii;
use DateTime;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Users;
use app\models\CarPark;
use app\models\Booking;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class AppController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout','login','register','index','car-park','zone','success'],
                'rules' => [
                    [
                        'actions' => ['logout','index','car-park','zone','success'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login','register'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    if(($action->id == "login")||($action->id == "register")){
                        return Yii::$app->response->redirect(['app/index']);
                    }
                    return Yii::$app->response->redirect(['app/login']);
                },
            ],
            'verbs' => [
                'class' => VerbFilter::class,
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
        $this->layout = 'app';
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

        $model = new Users();
        if($this->request->isPost) {
            if($model->load($this->request->post())){
                $update = Users::findOne(Yii::$app->user->id);
                $update->money = strval((floatval($update->money)+(floatval($model->money))));
                if($update->save()) return $this->redirect(['index']);
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionLogin() {
        $this->layout = 'register';
        $model = new Users();
        
        if($this->request->isPost) {
            if($model->load($this->request->post())){
                if($model->checkPassword()) {
                    if($model->login())
                    return $this->redirect(['app/index']);
                } 
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        $this->layout = 'register';
        $model = new Users();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if (!$model->ConfirmPass()){
                    $model->addError('password', 'Passwords do not match');
                    return $this->render('register', [
                        'model' => $model,
                    ]);
                }
                $model->hashPassword();
                $model->money = "0";
                if($model->save())
                return $this->redirect(['login']);
                $model->password = '';
                $model->confirm_password = '';
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionCarPark()
    {

        $booking = Booking::find()->where(['user_id' => Yii::$app->user->id, 'payment_status' => 'wait'])->one();

        if($booking) {
            return $this->redirect(['success','id' => strval($booking->id)]);
        }

        $model = CarPark::find()->orderBy(['zone' => SORT_ASC])->all();

        $parkAll= [
            "available" => 0,
            "available_now" => 0,
        ];

        foreach($model as $value){
            $parkAll["available"] += intval($value->available);
            $parkAll["available_now"] += intval($value->available_now);
        }
        
        return $this->render('car-park',[
            'model' => $model,
            'parkAll' => $parkAll,
        ]);
    }

    public function actionZone($id) {
        $model = CarPark::findOne($id);

        if ($this->request->isPost) {
            $current_time = date('Y-m-d  H:i:s'); // get the current time
            $increment = '+1 hour'; // the increment value

            $new_time = date('Y-m-d H:i:s', strtotime($current_time . ' ' . $increment));

            $booking = new Booking();
            $booking->user_id = strval(Yii::$app->user->id);
            $booking->car_park_id = $id;
            $booking->create_time = date('Y-m-d H:i:s');
            $booking->payment_status = "wait";
            $booking->exit_time = $new_time;
            $model->available_now = strval(intval($model->available_now) + 1);
            
            if($booking->save() &&  $model->save()){
                return $this->redirect(['success',"id" => $booking->id]); 
            }
        }

        return $this->render('zone',[
            'model' => $model,
        ]);
    }

    public function actionSuccess($id) {
        $model = Booking::findOne($id);

        if ($this->request->isPost) {
            $user = Users::findOne(Yii::$app->user->id);

            $now = new DateTime();
            $end = new DateTime($model->create_time);
            $interval = $end->diff($now);
            $price = 0;
            $hour = intval($interval->format('%H'));
            $minute = intval($interval->format('%I'));

            $price = $hour*50;
            if($minute >= 30)
                $price += 50;

            $user->money = strval(intval($user->money) - $price);

            $model->payment_status = "paid";
            if($model->delete() && $user->save()) {
                return $this->redirect(['index']);
            }
        }

        $text = Yii::$app->request->hostInfo.Yii::$app->request->url;

        // Create options for the QR code
        $options = new QROptions([
            'version' => 5,
            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'eccLevel' => QRCode::ECC_L,
        ]);

        $qrCode = new QRCode($options);

        return $this->render('success',[
            'model' => $model,
            'qrCode' => $qrCode->render($text)]
        );
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}