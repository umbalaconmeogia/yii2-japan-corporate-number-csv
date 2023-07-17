<?php
namespace umbalaconmeogia\japancorpnumcsv;

use Yii;
use yii\helpers\Url;

class Module extends \yii\base\Module
{
    /**
     * Add configuration for command line.
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // Database configuration
        \Yii::$app->setComponents([
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'sqlite:' . __DIR__ . '/data/db.sqlite',
                'charset' => 'utf8',
            ],
        ]);

        $this->registerTranslations();

        // Config for command line.
        if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'umbalaconmeogia\japancorpnumcsv\commands';
        }
    }

    /**
     * Registeration translation files.
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['japancorpnumcsv'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'forceTranslation' => true,
            'basePath' => '@umbalaconmeogia/japancorpnumcsv/messages',
            'fileMap' => [
                'japancorpnumcsv' => 'japancorpnumcsv.php',
            ],
        ];
    }

    /**
     * @return string
     */
    public function getIntroName()
    {
        return Yii::t('japancorpnumcsv', 'introName');
    }

    /**
     * @return string
     */
    public function getIntroDescription()
    {
        return Yii::t('japancorpnumcsv', 'introDescription');
    }

    public function getIntroUrl()
    {
        return Url::to(["{$this->id}/intro/index"]);
    }
}