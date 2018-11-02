<?php
/**
 * Created by PhpStorm.
 * User: Я
 * Date: 17.09.2018
 * Time: 17:13
 */

namespace skarbnica\ckeditor\assets;


use yii\web\AssetBundle;

class CKEditorAsset extends AssetBundle
{
    public $sourcePath = '@vendor/skarbnica/ckeditor';

    public $js = [
        'ckeditor.js'
    ];
}
