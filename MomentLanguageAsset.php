<?php

namespace omnilight\assets;
use Yii;
use yii\web\AssetBundle;
use yii\web\View;


/**
 * Class MomentLanguageAsset
 */
class MomentLanguageAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $depends = [
        'omnilight\assets\MomentAsset'
    ];

    /**
     * @inheritdoc
     */
    public $sourcePath = '@bower/moment/locale';
    /**
     * @var string|null When null, language will be equal for current locale of the application
     */
    public $language = null;

    /**
     * @inheritdoc
     */
    public function init()
    {
        /**
         * Set sourcePath back to what it was, because bundled assets array sets it to `null`
         */
        $this->sourcePath = '@bower/moment/locale';
    }

    public function registerAssetFiles($view)
    {
        parent::registerAssetFiles($view);
        $language = strtolower($this->language ? $this->language : Yii::$app->language);
        $this->registerLanguage($language, $view);
    }

    /**
     * @param string $language
     * @param View $view
     */
    public function registerLanguage($language, $view)
    {
        $sourcePath = Yii::getAlias($this->sourcePath);
        $fallbackLanguage = substr($language, 0, 2);

        $desiredFile = $sourcePath . DIRECTORY_SEPARATOR . "{$language}.js";
        if (!is_file($desiredFile)) {
            if ($fallbackLanguage === 'en') { // en is default, there is not separate locale file for it
                return;
            }

            $desiredFile = $sourcePath . DIRECTORY_SEPARATOR . "{$fallbackLanguage}.js";
            if (file_exists($desiredFile)) {
                $language = $fallbackLanguage;
            }
        }

        $view->registerJsFile($this->baseUrl."/{$language}.js");
        $js = "moment.locale('{$language}')";
        $view->registerJs($js, View::POS_READY, 'moment-locale-'.$language);
    }
}

