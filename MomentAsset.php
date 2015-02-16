<?php

namespace omnilight\assets;

use yii\web\AssetBundle;


/**
 * Class MomentAsset
 */
class MomentAsset extends AssetBundle
{
    public $sourcePath = '@bower/moment';

    public $js = [
        'moment.js'
    ];
} 