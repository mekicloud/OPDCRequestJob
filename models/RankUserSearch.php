<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RankUser;

/**
 * RankUserSearch represents the model behind the search form of `app\models\RankUser`.
 */
class RankUserSearch extends RankUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rank_id', 'user_id'], 'integer'],
            [['rank_name', 'rank_priority'], 'safe'],
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
        $query = RankUser::find();

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
            'rank_id' => $this->rank_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'rank_name', $this->rank_name])
            ->andFilterWhere(['like', 'rank_priority', $this->rank_priority]);

        return $dataProvider;
    }
}
