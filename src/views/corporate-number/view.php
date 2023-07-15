<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\CorporateNumber $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Corporate Numbers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="corporate-number-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'sequenceNumber',
            'corporateNumber',
            [
                'attribute' => 'process',
                'value' => 'processStr',
            ],
            [
                'attribute' => 'correct',
                'value' => 'correctStr',
            ],
            'updateDate',
            'changeDate',
            'name',
            'nameImageId',
            [
                'attribute' => 'kind',
                'value' => 'kindStr',
            ],
            'prefectureName',
            'cityName',
            'streetNumber:ntext',
            'addressImageId',
            'prefectureCode',
            'cityCode',
            'postCode',
            'addressOutside:ntext',
            'addressOutsideImageId',
            'closeDate',
            'closeCause ',
            'successorCorporateNumber',
            'changeCause:ntext',
            'assignmentDate',
            [
                'attribute' => 'latest',
                'value' => 'latestStr',
            ],
            'enName:ntext',
            'enPrefectureName',
            'enCityName:ntext',
            'enAddressOutside:ntext',
            'furigana:ntext',
            [
                'attribute' => 'hihyoji',
                'value' => 'hihyojiStr',
            ],
        ],
    ]) ?>

</div>
