<?php
namespace umbalaconmeogia\japancorpnum;

use Yii;

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
            $this->controllerNamespace = 'umbalaconmeogia\japancorpnum\commands';
        }
    }

    /**
     * Registeration translation files.
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['japancorpnum'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'forceTranslation' => true,
            'basePath' => '@umbalaconmeogia/japancorpnum/messages',
            'fileMap' => [
                'japancorpnum' => 'japancorpnum.php',
            ],
        ];
    }
}