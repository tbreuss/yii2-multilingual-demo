<?php

namespace app\controllers;

use yii\helpers\Url;
use yii\rest\Controller;

class CkeditorController extends Controller
{
    public function actionFile()
    {
        return [
            'uploaded' => 1,
            'fileName' => 'www.pdf',
            'url' => Url::base(true) . '/index.php/download/file?uuid=61f2e425-6505-4b31-be0e-13794a4bccea',
        ];
    }

    public function actionImage()
    {
        return [
            'uploaded' => 1,
            'fileName' => 'xxx.jpg',
            'url' => Url::base(true) . '/index.php/download/image?uuid=27c78894-04ea-4431-b074-e2a6ec2c4c76',
        ];
    }
}
