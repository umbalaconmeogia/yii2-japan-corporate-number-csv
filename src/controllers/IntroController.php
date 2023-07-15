<?php

namespace umbalaconmeogia\japancorpnum\controllers;

use yii\web\Controller;

class IntroController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}