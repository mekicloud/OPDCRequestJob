<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MUnit;

/**
 * MUnitSearch represents the model behind the search form of `app\models\MUnit`.
 */
class MUnitSearch extends MUnit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_id', 'rank_id', 'unit_dep'], 'integer'],
            [['unit_name', 'dep_id'], 'safe'],
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
        $query = MUnit::find();

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
            'unit_id' => $this->unit_id,
            'rank_id' => $this->rank_id,
            'unit_dep' => $this->unit_dep,
        ]);

        $query->andFilterWhere(['like', 'unit_name', $this->unit_name])
            ->andFilterWhere(['like', 'dep_id', $this->dep_id]);

        return $dataProvider;
    }
}
