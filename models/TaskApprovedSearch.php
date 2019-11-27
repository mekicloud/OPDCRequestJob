<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TaskApproved;

/**
 * TaskApprovedSearch represents the model behind the search form of `app\models\TaskApproved`.
 */
class TaskApprovedSearch extends TaskApproved
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'approved1', 'approved2', 'approved3'], 'integer'],
            [['approved1_date', 'approved1_time', 'approved2_date', 'approved2_time', 'approved3_date', 'approved3_time'], 'safe'],
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
        $query = TaskApproved::find();

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
            'task_id' => $this->task_id,
            'approved1' => $this->approved1,
            'approved1_date' => $this->approved1_date,
            'approved1_time' => $this->approved1_time,
            'approved2' => $this->approved2,
            'approved2_date' => $this->approved2_date,
            'approved2_time' => $this->approved2_time,
            'approved3' => $this->approved3,
            'approved3_date' => $this->approved3_date,
            'approved3_time' => $this->approved3_time,
        ]);

        return $dataProvider;
    }
}
