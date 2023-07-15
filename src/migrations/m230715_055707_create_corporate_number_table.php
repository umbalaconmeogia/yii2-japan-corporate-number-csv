<?php
namespace umbalaconmeogia\japancorpnum\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%corporate_number}}`.
 */
class m230715_055707_create_corporate_number_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%corporate_number}}', [
            'id' => $this->primaryKey(),
            'sequenceNumber' => $this->integer()->unique(),
            'corporateNumber' => $this->string()->unique(),
            'process' => $this->string(),
            'correct' => $this->tinyInteger(),
            'updateDate' => $this->date(),
            'changeDate' => $this->date(),
            'name' => $this->string(),
            'nameImageId' => $this->string(),
            'kind' => $this->string(),
            'prefectureName' => $this->string(),
            'cityName' => $this->string(),
            'streetNumber' => $this->text(),
            'addressImageId' => $this->string(),
            'prefectureCode' => $this->string(),
            'cityCode' => $this->string(),
            'postCode' => $this->string(),
            'addressOutside' => $this->text(),
            'addressOutsideImageId' => $this->string(),
            'closeDate' => $this->date(),
            'closeCause' => $this->string(),
            'successorCorporateNumber' => $this->string(),
            'changeCause' => $this->text(),
            'assignmentDate' => $this->date(),
            'latest' => $this->tinyInteger(),
            'enName' => $this->text(),
            'enPrefectureName' => $this->string(),
            'enCityName' => $this->text(),
            'enAddressOutside' => $this->text(),
            'furigana' => $this->text(),
            'hihyoji' => $this->tinyInteger(),
        ]);
        $indexColumns = [
            'sequenceNumber',
            'corporateNumber',
            'process',
            'correct',
            'kind',
            'prefectureName',
            'cityName',
            'prefectureCode',
            'cityCode',
            'postCode',
        ];
        foreach ($indexColumns as $column) {
            $this->createIndex("corpnum-{$column}-idx", 'corporate_number', $column);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%corporate_number}}');
    }
}
