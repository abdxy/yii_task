<?php
namespace backend\controllers;

use common\models\City;
use common\models\Country;
use common\models\Member;
use common\models\Neighborhood;
use common\models\RegForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Site controller
 */
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
                'rules' => [
                    [
                        'actions' => ['login', 'error','register','load-cities','load-neighborhood'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','users'],
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

    public function actionHello()
    {
        return 'hello';
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

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {

            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        } else {
            $model->password = '';
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLoadCities()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $cityList = City::find()->where(['country_id'=>Yii::$app->request->get('id')])->all();
        return  \yii\helpers\ArrayHelper::map($cityList,'id','name');
    }

    public function actionLoadNeighborhood()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $neighborhoodList = Neighborhood::find()->where(['city_id'=>Yii::$app->request->get('id')])->all();
        return \yii\helpers\ArrayHelper::map($neighborhoodList,'id','name');
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {

            return $this->goHome();
        }
        $model = new RegForm();

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if ($user = $model->signUp()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        $countryList = Country::find()->all();

        $countryList = \yii\helpers\ArrayHelper::map($countryList,'id','name');

        return $this->render('register', [
            'model' => $model,
            'country_list' =>$countryList
        ]);
    }

    public function actionUsers(){


        $query = Member::find()
            ->joinWith('country')
            ->joinWith('phones')
            ->joinWith('city');
//        var_dump($query->all());die;

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('users', [
            'dataProvider' =>$provider
        ]);
    }
}
