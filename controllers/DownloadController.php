<?php

namespace app\controllers;

use app\models\File;
use Yii;
use yii\web\Controller;

class DownloadController extends Controller
{
    public function actionFile(string $uuid)
    {
        $file = File::find()->where(['uuid' => $uuid, 'deleted_at' => null])->one();
        if (isset($file)) {
            return Yii::$app->response->sendContentAsFile(base64_decode($file->content), $file->filename);
        }
        Yii::$app->response->statusCode = 404;
        Yii::$app->response->send();
        exit;
    }

    public function actionImage(string $uuid)
    {
        $file = File::find()->where(['uuid' => $uuid, 'deleted_at' => null])->one();
        if (isset($file)) {
            return Yii::$app->response->sendContentAsFile(base64_decode($file->content), $file->filename);
        }
        Yii::$app->response->statusCode = 404;
        Yii::$app->response->send();
        exit;
    }
}
