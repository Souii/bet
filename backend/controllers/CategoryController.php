<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Category;

/**
 * Site controller
 */
class CategoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            // 'access' => [
            //     'class' => AccessControl::className(),
            //     'rules' => [
            //         [
            //             'actions' => ['login', 'error'],
            //             'allow' => true,
            //         ],
            //         [
            //             'actions' => ['logout', 'index', 'add', 'edit'],
            //             'allow' => true,
            //             'roles' => ['@'],
            //         ],
            //     ],
            // ],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $categories = Category::find()->all();

        return $this->render('index', [
            'categories' => $categories
        ]);
    }

    public function actionAdd()
    {
        $category = new Category();

        if ($category->load(Yii::$app->request->post()) && $category->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('add', [
            'category' => $category,
        ]);
    }

    public function actionEdit($id)
    {
        $category = Category::findOne($id);

        if ($category->load(Yii::$app->request->post()) && $category->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('edit', [
            'category' => $category,
        ]);
    }
}
