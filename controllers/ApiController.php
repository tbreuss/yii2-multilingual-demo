<?php

namespace app\controllers;

use app\models\Category;
use app\models\News;
use Yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class ApiController extends Controller
{
    public $modelClass = 'app\models\News';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'news-list' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'news-detail' => [
                'class' => 'yii\rest\ViewAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            /*'create' => [
                'class' => 'yii\rest\CreateAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'scenario' => $this->createScenario,
            ],
            'update' => [
                'class' => 'yii\rest\UpdateAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'scenario' => $this->updateScenario,
            ],
            'delete' => [
                'class' => 'yii\rest\DeleteAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            #'create' => ['POST'],
            #'update' => ['PUT', 'PATCH'],
            #'delete' => ['DELETE'],
        ];
    }

    public function checkAccess($action, $model = null, $params = [])
    {
    }

    /*
    public function actionError()
    {
        return ['Error'];
    }

    public function actionNewsList(string $language, string $category)
    {
        $category = Category::find()->where(['name' => $category])->one();
        return News::find()
            ->localized($language)
            ->where([
                'category_id' => is_null($category) ? 0 : $category->id,
                'deleted_at' => null
            ])
            ->orderBy('date DESC')
            ->all();
    }

    public function actionNewsDetail(string $language, int $id)
    {
        $one = News::find()->localized($language)->where(['id' => $id])->one();
        if (is_null($one)) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
        return $one;
    }
    */
}
