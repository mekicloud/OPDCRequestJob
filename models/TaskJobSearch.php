<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TaskJob;
use Mpdf\Tag\P;
use Yii;

/**
 * TaskJobSearch represents the model behind the search form of `app\models\TaskJob`.
 */
class TaskJobSearch extends TaskJob
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'typej_id', 'task_owner', 'task_personal'], 'integer'],
            [['task_detail', 'task_date_start', 'task_time_start', 'task_date_end', 'task_time_end', 'task_order_date', 'task_order_time', 'task_location','task_status'], 'safe'],
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
        $urank = Yii::$app->db->createCommand('SELECT org_id , leader_type FROM t_leader  WHERE user_id=:id')
            ->bindValue(':id', $session->get('UID'))
            ->queryOne();
       // $urank2 = Yii::$app->db->createCommand('SELECT org_id FROM t_leader WHERE user_id=:id')
        //    ->bindValue(':id', $session->get('UID'))
        //    ->queryOne();
        if ($urank['leader_type'] == 4 and $urank['org_id'] == 37) { //ผอ สลธ
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
            ,1 as leader_type
        FROM t_task_job tj inner join m_user mu on tj.task_owner = mu.user_id
            inner join t_task_approved ta on tj.task_id  = ta.task_id 
        where approved1 != '' and approved2 IS NUll
        and (task_status > 0 and task_status != 13)
    
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
            ,1 as leader_type
            from t_task_job tj left join m_user on tj.task_owner = m_user.user_id  
                left join m_org_inner on m_user.cont_to_id = m_org_inner.org_id
                left join t_leader on m_user.user_id = t_leader.user_id 
                inner join t_task_approved ta on tj.task_id  = ta.task_id
            where ( parent_id = 37 or (t_leader.org_id = 37 and leader_type = 4))
                and (task_status > 0 and task_status != 13) and approved1 != '' and approved2 IS NUll

            ";
        } else if ($urank['org_id'] == 52 ) { //นางพรทิพย์ แก้วมูลคำ Capt 2 Group
            $sql_data = "
        select tj.task_id
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
            case when leader_type is not null then 1 else 0 end as leader_type
        from t_task_job tj left join m_user on tj.task_owner = m_user.user_id  
            left join m_org_inner on m_user.cont_to_id = m_org_inner.org_id
            left join t_leader on t_leader.user_id = $uid
        where cont_to_id = 51 or cont_to_id = 52 or cont_to_id2 = 52
        and (task_status > 0 and task_status != 13)
        order by tj.task_id desc
            ";
        } elseif($urank['org_id'] == 43 ){ // IT
            $sql_data = "select *,
            2 as leader_type
            from t_task_job 
            left join m_unit_typejob on t_task_job.typej_id = m_unit_typejob.typej_id
            left join t_task_approved on t_task_job.task_id = t_task_approved.task_id
            left join t_leader on t_leader.user_id = $uid
             where unit_id = 43 and approved2 is not null
             and (task_status > 0 and task_status != 13)  and approved3 is null
             order by t_task_job.task_id desc";    ;          
        } elseif($urank['org_id'] == 41){ // ประชาสัมพันธ์
            $sql_data = "select *,
            2 as leader_type
            from t_task_job 
            left join m_unit_typejob on t_task_job.typej_id = m_unit_typejob.typej_id
            left join t_task_approved on t_task_job.task_id = t_task_approved.task_id
            left join t_leader on t_leader.user_id = $uid
             where unit_id = 41 and approved2 is not null
             and (task_status > 0 and task_status != 13)  and approved3 is null
             order by t_task_job.task_id desc";
        } else { // Other User & Capt
            $sql_data = "
    select distinct task_id,task_detail
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
            ,case when leader_type is not null then 1 else 0 end as leader_type
        from t_task_job 
            left join m_user on t_task_job.task_owner = m_user.user_id
            left join m_org_inner on m_user.cont_to_id = m_org_inner.org_id
            left join t_leader on t_leader.user_id = $uid
        where m_org_inner.org_id = (select cont_to_id from m_user where user_id = $uid)
            or parent_id = (select cont_to_id from m_user where user_id = $uid)  
            and (task_status > 0 and task_status != 13)
            order by t_task_job.task_id desc
            ";
        }

        $query  =  TaskJob::findBySql($sql_data);

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
            'typej_id' => $this->typej_id,
            'task_date_start' => $this->task_date_start,
            'task_time_start' => $this->task_time_start,
            'task_date_end' => $this->task_date_end,
            'task_time_end' => $this->task_time_end,
            'task_owner' => $this->task_owner,
            'task_order_date' => $this->task_order_date,
            'task_order_time' => $this->task_order_time,
            'task_personal' => $this->task_personal,
            'task_status' => $this->task_status,
        ]);

        $query->andFilterWhere(['like', 'task_detail', $this->task_detail])
            ->andFilterWhere(['like', 'task_location', $this->task_location]);

        return $dataProvider;
    }
}
