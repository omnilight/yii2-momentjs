<?php

namespace omnilight\assets;

use yii\web\AssetBundle;


/**
 * Class MomentAsset
 */
class MomentAsset extends AssetBundle
{
    public $sourcePath = '@bower/moment/min';

    public $js = [
        'moment.min.js'
    ];
} 