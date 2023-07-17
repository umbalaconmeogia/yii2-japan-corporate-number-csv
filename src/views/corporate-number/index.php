<?php

use umbalaconmeogia\japancorpnumcsv\models\CorporateNumber;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var umbalaconmeogia\japancorpnumcsv\models\CorporateNumberSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Corporate Numbers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corporate-number-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'sequenceNumber',
            'corporateNumber',
            [
                'attribute' => 'process',
                'filter' => CorporateNumber::processOptionArr(),
                'value' => 'processStr',
            ],
            [
                'attribute' => 'correct',
                'filter' => CorporateNumber::correctOptionArr(),
                'value' => 'correctStr',
            ],
            // 'updateDate',
            // 'changeDate',
            'name',
            // 'nameImageId',
            [
                'attribute' => 'kind',
                'filter' => CorporateNumber::kindOptionArr(),
                'value' => 'kindStr',
            ],
            'prefectureName',
            'cityName',
            'streetNumber:ntext',
            //'addressImageId',
            'prefectureCode',
            'cityCode',
            'postCode',
            // 'addressOutside:ntext',
            // 'addressOutsideImageId',
            //'closeDate',
            [
                'attribute' => 'closeCause',
                'filter' => CorporateNumber::closeCauseOptionArr(),
                'value' => 'closeCauseStr',
            ],
            //'successorCorporateNumber',
            //'changeCause:ntext',
            //'assignmentDate',
            [
                'attribute' => 'latest',
                'filter' => CorporateNumber::latestOptionArr(),
                'value' => 'latestStr',
            ],
            //'enName:ntext',
            //'enPrefectureName',
            //'enCityName:ntext',
            //'enAddressOutside:ntext',
            //'furigana:ntext',
            [
                'attribute' => 'hihyoji',
                'filter' => CorporateNumber::hihyojiOptionArr(),
                'value' => 'hihyoji',
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'urlCreator' => function ($action, CorporateNumber $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
