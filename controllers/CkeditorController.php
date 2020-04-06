<?php

namespace app\controllers;

use app\models\File;
use Yii;
use yii\rest\Controller;
use yii\web\UploadedFile;

class CkeditorController extends Controller
{
    public function actionFile()
    {
        return $this->doUpload('file');
    }

    public function actionImage()
    {
        return $this->doUpload('image');
    }

    private function doUpload(string $type)
    {
        if (!Yii::$app->request->isPost) {
            return [
                'uploaded' => 0,
            ];
        }

        $model = File::createFromUploadFile(
            UploadedFile::getInstanceByName('upload')
        );

        if ($model->save()) {
            // file is uploaded successfully
            return [
                'uploaded' => 1,
                'fileName' => $model->filename,
                'url' => $model->getAbsUrl($type),
            ];
        }

        return [
            'uploaded' => 0,
            'error' => [
               'message' => $model->getFirstError('uploadedFile')
            ]
        ];
    }
}
