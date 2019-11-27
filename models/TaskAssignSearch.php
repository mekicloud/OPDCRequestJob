<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TaskAssign;

/**
 * TaskAssignSearch represents the model behind the search form of `app\models\TaskAssign`.
 */
class TaskAssignSearch extends TaskAssign
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id'], 'integer'],
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
        
        $session = Yii::$app->session;
        $session->open(); // open a session
        $uid = $session->get('UID');
        $urank = Yii::$app->db->createCommand('SELECT org_id , leader_type FROM t_leader WHERE user_id=:id')
            ->bindValue(':id', $session->get('UID'))
            ->queryOne();
        if ($urank['leader_type'] == 6 and $urank['org_id'] == 43) { //ผอ สลธ
            $sql_data = "
    SELECT tj.task_id
            ,task_detail
            ,typej_id
            ,task_date_start
            ,task_time_start
            ,task_date_end
            ,task_time_end
            ,task_owner
            ,task_order_date
            ,task_order_time
            ,task_location
            ,task_personal
        FROM OPDC_EOF.dbo.t_task_job tj inner join m_user mu on tj.task_owner = mu.user_id
            inner join t_task_approved ta on tj.task_id  = ta.task_id 
		where approved1 != '' and approved2 IS NUll 
	union select tj.task_id
            ,task_detail
            ,typej_id
            ,task_date_start
            ,task_time_start
            ,task_date_end
            ,task_time_end
            ,task_owner
            ,task_order_date
            ,task_order_time
            ,task_location
            ,task_personal 
            from t_task_job tj left join m_user on tj.task_owner = m_user.user_id  
                left join m_org_inner on m_user.cont_to_id = m_org_inner.org_id
                left join t_leader on m_user.user_id = t_leader.user_id 
            where parent_id = 37 or (t_leader.org_id = 37 and leader_type = 4)
            ";
        } else {
            $sql_data = "
    select task_id,task_detail
            ,typej_id
            ,task_date_start
            ,task_time_start
            ,task_date_end
            ,task_time_end
            ,task_owner
            ,task_order_date
            ,task_order_time
            ,task_location
            ,task_personal
        from t_task_job 
            left join m_user on t_task_job.task_owner = m_user.user_id
            left join m_org_inner on m_user.cont_to_id = m_org_inner.org_id
        where org_id = (select cont_to_id from m_user where user_id = $uid)
            or parent_id = (select cont_to_id from m_user where user_id = $uid)
            ";
        }

        $query  =  TaskJob::findBySql($sql_data);
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
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
