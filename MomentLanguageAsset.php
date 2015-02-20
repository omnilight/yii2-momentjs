<?php

namespace omnilight\assets;
use kartik\base\AssetBundle;
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
        $language = $this->language ? $this->language : \Yii::$app->language;
        $this->registerLanguage($language, $view);
    }

    /**
     * @param string $language
     * @param View $view
     */
    public function registerLanguage($language, $view)
    {
        $view->registerJsFile($this->baseUrl."/{$language}.js");
        $js =<<<JS
moment.locale('{$language}');
JS;
        $view->registerJs($js, View::POS_READY, 'moment-locale-'.$language);
    }
}