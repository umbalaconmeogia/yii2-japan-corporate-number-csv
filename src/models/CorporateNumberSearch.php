<?php
namespace umbalaconmeogia\japancorpnum\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CorporateNumberSearch represents the model behind the search form of `CorporateNumber`.
 */
class CorporateNumberSearch extends CorporateNumber
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sequenceNumber', 'correct', 'latest', 'hihyoji'], 'integer'],
            [['corporateNumber', 'process', 'updateDate', 'changeDate', 'name', 'nameImageId', 'kind', 'prefectureName', 'cityName', 'streetNumber', 'addressImageId', 'prefectureCode', 'cityCode', 'postCode', 'addressOutside', 'addressOutsideImageId', 'closeDate', 'closeCause', 'successorCorporateNumber', 'changeCause', 'assignmentDate', 'enName', 'enPrefectureName', 'enCityName', 'enAddressOutside', 'furigana'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CorporateNumber::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sequenceNumber' => $this->sequenceNumber,
            'process' => $this->process,
            'kind' => $this->kind,
            'correct' => $this->correct,
            'updateDate' => $this->updateDate,
            'changeDate' => $this->changeDate,
            'closeDate' => $this->closeDate,
            'prefectureCode' => $this->prefectureCode,
            'cityCode' => $this->cityCode,
            'postCode' => $this->postCode,
            'assignmentDate' => $this->assignmentDate,
            'latest' => $this->latest,
            'hihyoji' => $this->hihyoji,
        ]);

        $query->andFilterWhere(['like', 'corporateNumber', $this->corporateNumber])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'nameImageId', $this->nameImageId])
            ->andFilterWhere(['like', 'prefectureName', $this->prefectureName])
            ->andFilterWhere(['like', 'cityName', $this->cityName])
            ->andFilterWhere(['like', 'streetNumber', $this->streetNumber])
            ->andFilterWhere(['like', 'addressImageId', $this->addressImageId])
            ->andFilterWhere(['like', 'addressOutside', $this->addressOutside])
            ->andFilterWhere(['like', 'addressOutsideImageId', $this->addressOutsideImageId])
            ->andFilterWhere(['like', 'closeCause', $this->closeCause])
            ->andFilterWhere(['like', 'successorCorporateNumber', $this->successorCorporateNumber])
            ->andFilterWhere(['like', 'changeCause', $this->changeCause])
            ->andFilterWhere(['like', 'enName', $this->enName])
            ->andFilterWhere(['like', 'enPrefectureName', $this->enPrefectureName])
            ->andFilterWhere(['like', 'enCityName', $this->enCityName])
            ->andFilterWhere(['like', 'enAddressOutside', $this->enAddressOutside])
            ->andFilterWhere(['like', 'furigana', $this->furigana]);

        return $dataProvider;
    }
}
