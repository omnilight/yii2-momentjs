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
    public $sourcePath = '@bower/moment/locale';
    /**
     * @var string|null When null, language will be equal for current locale of the application
     */
    public $language = null;

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

