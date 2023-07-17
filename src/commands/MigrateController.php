<?php
namespace umbalaconmeogia\japancorpnumcsv\commands;

class MigrateController extends \yii\console\controllers\MigrateController
{
    public $migrationNamespaces = ['umbalaconmeogia\japancorpnumcsv\migrations'];
    public $migrationTable = '{{%migration_japancorpnum}}';

    // public $migrationPath = __DIR__ . '/../migrations';
}