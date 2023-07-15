<?php
namespace umbalaconmeogia\japancorpnum\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "corporate_number".
 *
 * @property int $id
 * @property int|null $sequenceNumber
 * @property string|null $corporateNumber
 * @property int|null $process
 * @property int|null $correct
 * @property string|null $updateDate
 * @property string|null $changeDate
 * @property string|null $name
 * @property string|null $nameImageId
 * @property string|null $kind
 * @property string|null $prefectureName
 * @property string|null $cityName
 * @property string|null $streetNumber
 * @property string|null $addressImageId
 * @property string|null $prefectureCode
 * @property string|null $cityCode
 * @property string|null $postCode
 * @property string|null $addressOutside
 * @property string|null $addressOutsideImageId
 * @property string|null $closeDate
 * @property string|null $closeCause
 * @property string|null $successorCorporateNumber
 * @property string|null $changeCause
 * @property string|null $assignmentDate
 * @property int|null $latest
 * @property string|null $enName
 * @property string|null $enPrefectureName
 * @property string|null $enCityName
 * @property string|null $enAddressOutside
 * @property string|null $furigana
 * @property int|null $hihyoji
 *
 * @property string $processStr
 * @property string $correctStr
 * @property string $closeCauseStr
 * @property string $kindStr
 * @property string $latestStr
 * @property string $hihyojiStr
 */
class CorporateNumber extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'corporate_number';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sequenceNumber', 'correct', 'latest', 'hihyoji'], 'integer'],
            [['updateDate', 'changeDate', 'closeDate', 'assignmentDate'], 'safe'],
            [['streetNumber', 'addressOutside', 'changeCause', 'enName', 'enCityName', 'enAddressOutside', 'furigana'], 'string'],
            [['corporateNumber', 'process', 'name', 'nameImageId', 'kind', 'prefectureName', 'cityName', 'addressImageId', 'prefectureCode', 'cityCode', 'postCode', 'addressOutsideImageId', 'closeCause', 'successorCorporateNumber', 'enPrefectureName'], 'string', 'max' => 255],
            [['corporateNumber'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sequenceNumber' => Yii::t('app', 'Sequence Number'),
            'corporateNumber' => Yii::t('app', 'Corporate Number'),
            'process' => Yii::t('app', 'Process'),
            'correct' => Yii::t('app', 'Correct'),
            'updateDate' => Yii::t('app', 'Update Date'),
            'changeDate' => Yii::t('app', 'Change Date'),
            'name' => Yii::t('app', 'Name'),
            'nameImageId' => Yii::t('app', 'Name Image ID'),
            'kind' => Yii::t('app', 'Kind'),
            'prefectureName' => Yii::t('app', 'Prefecture Name'),
            'cityName' => Yii::t('app', 'City Name'),
            'streetNumber' => Yii::t('app', 'Street Number'),
            'addressImageId' => Yii::t('app', 'Address Image ID'),
            'prefectureCode' => Yii::t('app', 'Prefecture Code'),
            'cityCode' => Yii::t('app', 'City Code'),
            'postCode' => Yii::t('app', 'Post Code'),
            'addressOutside' => Yii::t('app', 'Address Outside'),
            'addressOutsideImageId' => Yii::t('app', 'Address Outside Image ID'),
            'closeDate' => Yii::t('app', 'Close Date'),
            'closeCause' => Yii::t('app', 'Close Cause'),
            'successorCorporateNumber' => Yii::t('app', 'Successor Corporate Number'),
            'changeCause' => Yii::t('app', 'Change Cause'),
            'assignmentDate' => Yii::t('app', 'Assignment Date'),
            'latest' => Yii::t('app', 'Latest'),
            'enName' => Yii::t('app', 'En Name'),
            'enPrefectureName' => Yii::t('app', 'En Prefecture Name'),
            'enCityName' => Yii::t('app', 'En City Name'),
            'enAddressOutside' => Yii::t('app', 'En Address Outside'),
            'furigana' => Yii::t('app', 'Furigana'),
            'hihyoji' => Yii::t('app', 'Hihyoji'),
        ];
    }

    public static function processOptionArr()
    {
        return [
            '01' => Yii::t('app', '新規'),
            '11' => Yii::t('app', '商号又は名称の変更'),
            '12' => Yii::t('app', '国内所在地の変更'),
            '13' => Yii::t('app', '国外所在地の変更'),
            '21' => Yii::t('app', '登記記録の閉鎖等'),
            '22' => Yii::t('app', '登記記録の復活等'),
            '71' => Yii::t('app', '吸収合併'),
            '72' => Yii::t('app', '吸収合併無効'),
            '81' => Yii::t('app', '商号の登記の抹消'),
            '99' => Yii::t('app', '削除'),
        ];
    }

    public function getProcessStr()
    {
        return ArrayHelper::getValue(self::processOptionArr(), $this->process);
    }

    public static function correctOptionArr()
    {
        return [
            0 => '訂正以外',
            1 => '訂正',
        ];
    }

    public function getCorrectStr()
    {
        return ArrayHelper::getValue(self::correctOptionArr(), $this->correct);
    }

    public static function kindOptionArr()
    {
        return [
            '101' => '国の機関',
            '201' => '地方公共団体',
            '301' => '株式会社',
            '302' => '有限会社',
            '303' => '合名会社',
            '304' => '合資会社',
            '305' => '合同会社',
            '399' => 'その他の設立登記法人',
            '401' => '外国会社等',
            '499' => 'その他',
        ];
    }

    public function getKindStr()
    {
        return ArrayHelper::getValue(self::kindOptionArr(), $this->kind);
    }

    public static function latestOptionArr()
    {
        return [
            0 => '過去情報',
            1 => '最新情報',
        ];
    }

    public static function closeCauseOptionArr()
    {
        return [
            '01' => '清算の結了等',
            '11' => '合併による解散等',
            '21' => '登記官による閉鎖',
            '31' => 'その他の清算の結了等',
        ];
    }

    public function getCloseCauseStr()
    {
        return ArrayHelper::getValue(self::closeCauseOptionArr(), $this->closeCause);
    }

    public function getLatestStr()
    {
        return ArrayHelper::getValue(self::latestOptionArr(), $this->latest);
    }

    public static function hihyojiOptionArr()
    {
        return [
            0 => '検索対象',
            1 => '検索対象除外',
        ];
    }

    public function getHihyojiStr()
    {
        return ArrayHelper::getValue(self::hihyojiOptionArr(), $this->hihyoji);
    }
}
