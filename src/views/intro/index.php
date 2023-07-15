<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = Yii::t('app', 'Japan corporate number data');
?>
<div class="site-index">

    <h1><?= $this->title ?></h1>

    <p>This is a web page to view the corporate number Japan.</p>
    <p>The data version is TBD</p>
    <p>To see the data list, open <?= Html::a('Corporate number list', ['corporate-number/index']) ?></p>

    <h2>Preferences</h2>
    Data is download from [法人番号公表ウェブサイト](https://www.houjin-bangou.nta.go.jp/download/zenken/)
</div>