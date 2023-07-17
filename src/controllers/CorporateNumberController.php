<?php

namespace umbalaconmeogia\japancorpnumcsv\controllers;

use umbalaconmeogia\japancorpnumcsv\models\CorporateNumber;
use umbalaconmeogia\japancorpnumcsv\models\CorporateNumberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CorporateNumberController implements the CRUD actions for CorporateNumber model.
 */
class CorporateNumberController extends Controller
{
    /**
     * Lists all CorporateNumber models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CorporateNumberSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CorporateNumber model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the CorporateNumber model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return CorporateNumber the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CorporateNumber::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
