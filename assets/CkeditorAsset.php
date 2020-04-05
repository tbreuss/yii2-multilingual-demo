<?php

namespace app\assets;

use yii\web\AssetBundle;

class CkeditorAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/ckeditor';
    public $css = [
    ];
    public $js = [
        'ckeditor.js',
    ];
}
