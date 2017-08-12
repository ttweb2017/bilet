<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SearchForm;
use app\models\ContactForm;
use app\models\SubscribeForm;
use app\models\CulturalPlaceTranslation;
use app\models\CulturalPlace;
use app\models\Like;
use app\models\User;
use app\models\Article;
use app\models\ArticleTranslation;
use app\models\ArticleCategory;
use app\models\ArticleCategoryTranslation;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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
     * @inheritdoc
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
		$this->setLanguage();
		$id = Yii::$app->session->get('langId');

		//here we get db data about articles news etc.
		$news = Article::find()
								->where(['article_category_id' => 1])
								->all();
		
		//here we get id's so we can get right translation
		$news_size = sizeof($news);	
		$news_ids = array();
		for($n = 0; $n < $news_size; $n++){
			array_push($news_ids, $news[$n]->id);
		}
		
		$news_translation = ArticleTranslation::find()
													->where(['language_id' => $id, 'article_id' => $news_ids])
													->all();
		
		$information = Article::find()
								->where(['article_category_id' => 2])
								->all();
		
		//here we get id's so we can get right translation
		$information_size = sizeof($information);	
		$information_ids = array();
		for($i = 0; $i < $information_size; $i++){
			array_push($information_ids, $information[$i]->id);
		}
		
		$information_translation = ArticleTranslation::find()
													->where(['language_id' => $id, 'article_id' => $information_ids])
													->all();
		
		$advantage = Article::find()
								->where(['article_category_id' => 3])
								->all();
		
		
		//here we get id's so we can get right translation
		$advantage_size = sizeof($advantage);	
		$advantage_ids = array();
		for($a = 0; $a < $advantage_size; $a++){
			array_push($advantage_ids, $advantage[$a]->id);
		}
		
		$advantage_translation = ArticleTranslation::find()
													->where(['language_id' => $id, 'article_id' => $advantage_ids])
													->all();
		
		
		/*$article_category = ArticleCategory::find()
												->where([ ])
												->all();
		
		$article_category_translation = ArticleCategoryTranslation::find()
																		->where(['language_id' => $id, ])
																		->all();*/
		
        
		return $this->render('index', [
										'news' => $news,
										'information' => $information,
										'advantage' => $advantage,
										'news_translation' => $news_translation, 
										'information_translation' => $information_translation, 
										'advantage_translation' => $advantage_translation,
										]);
    }
	
	/**
     * Displays movie main page.
     *
     * @return string
     */
    public function actionList()
    {
		$this->setLanguage();
		
		$id = Yii::$app->session->get('langId');
		
		//here we get category id
		$category_id = Yii::$app->request->get('id');
		
		//here we get id's of current category
		$p_id = Yii::$app->request->get('p_id');
		
		if(!is_null($p_id)){
			
			$cultural_place = CulturalPlace::find()
											->where(['id' => $p_id])
											->all();
			
			$category_id = $cultural_place[0]->category_id;
			
			//here we get all categories with proper values
			$cultural_place_translation = CulturalPlaceTranslation::find()
																		->where(['language_id' => $id, 'cultural_place_id' => $p_id])
																		->all();
		}else{
			
			$cultural_place = CulturalPlace::find()
											->where(['category_id' => $category_id])
											->all();
			
			//here we get id's of current category
			$placeSize = sizeof($cultural_place);	
			$ids = array();
			for($x = 0; $x < $placeSize; $x++){
				array_push($ids, $cultural_place[$x]->id);
			}
					
			//here we get all categories with proper values
			$cultural_place_translation = CulturalPlaceTranslation::find()
																		->where(['language_id' => $id, 'cultural_place_id' => $ids])
																		->all();
		}
		
		//$model = new CulturalPlaceTranslation();
        return $this->render('list', [
            'cultural_place' => $cultural_place,
			'cultural_place_translation' => $cultural_place_translation,
			'category_id' => $category_id,
        ]);
    }
	
	 /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
		$this->setLanguage();
		
        return $this->render('about');
    }
	
	/**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
		$this->setLanguage();
		
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
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
		$this->setLanguage();
		
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
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
		$this->setLanguage();
		
        Yii::$app->user->logout();

        return $this->goHome();
    }


	/**
     * Handles subscribe footer.
     *
     * @return Response|string
     */
    public function actionSubscribe()
    {
		$this->setLanguage();
		
        $model = new SubscribeForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('subscribeFormSubmitted');

            return $this->refresh();
        }
        return $this->render('subscribe', [
            'model' => $model,
        ]);
    }
	
	
	/**
     * Handles language toggle button action.
     *
     * @return string
     */
    public function actionTranslate(){
	
		if(Yii::$app->request->get('lang') === 'RU'){
			
			Yii::$app->session->set('lang', 'RU');
			Yii::$app->session->set('langId', '1');
			
			\Yii::$app->language = 'ru-RU';
		}
		if(Yii::$app->request->get('lang') === 'TM'){
			
			Yii::$app->session->set('lang', 'TM');
			Yii::$app->session->set('langId', '2');
			
			\Yii::$app->language = 'tk-TKM';
		}
		
		
        return $this->render('index');
    }
	
	/**
     * Sets display Language.
     *
     */
    public function setLanguage(){
	
		if(Yii::$app->session->has('lang')){
			if(Yii::$app->session->get('lang') === 'RU'){
				Yii::$app->language = 'ru-RU';
			}else{
				Yii::$app->language = 'tk-TKM';
			}
		}else{
			Yii::$app->language = 'ru-RU';
			Yii::$app->session->set('langId', '1');
		}
    }
	
}
