<?php
namespace umbalaconmeogia\japancorpnum\commands;

class MigrateController extends \yii\console\controllers\MigrateController
{
    public $migrationNamespaces = ['umbalaconmeogia\japancorpnum\migrations'];
    public $migrationTable = '{{%migration_japancorpnum}}';

    // public $migrationPath = __DIR__ . '/../migrations';
}