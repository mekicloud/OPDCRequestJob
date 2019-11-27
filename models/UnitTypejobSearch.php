<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UnitTypejob;

/**
 * UnitTypejobSearch represents the model behind the search form of `app\models\UnitTypejob`.
 */
class UnitTypejobSearch extends UnitTypejob
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['typej_id', 'unit_id'], 'integer'],
            [['typej_detail'], 'safe'],
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
        $query = UnitTypejob::find();

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
            'typej_id' => $this->typej_id,
            'unit_id' => $this->unit_id,
        ]);

        $query->andFilterWhere(['like', 'typej_detail', $this->typej_detail]);

        return $dataProvider;
    }
}
