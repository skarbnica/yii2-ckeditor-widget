<?php
/**
 * Created by PhpStorm.
 * User: Я
 * Date: 17.09.2018
 * Time: 17:06
 */

namespace skarbnica\ckeditor\assets;


use yii\web\AssetBundle;

class CKEditorWidgetAsset extends AssetBundle
{

    public $sourcePath = '@vendor/skarbnica/ckeditor';

    public $js = [
        'ckeditor_config.js'
    ];

    public $depends = [
        '\skarbnica\ckeditor\assets\CKEditorAsset',
    ];
}