<?php

namespace app\controllers;

use Yii;
use app\models\TaskJob;
use app\models\TaskJobSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use  yii\web\Session;
use app\models\FunctionConfig;
use app\models\Notify;
use app\models\TaskApproved;
use app\models\RankUser;
use yii\data\SqlDataProvider;
use yii\db\Query;


use app\models\LineMember;
use app\models\TaskAssignSearch;
use phpDocumentor\Reflection\Types\Null_;


/**
 * TaskjobController implements the CRUD actions for TaskJob model.
 */
class TaskjobController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TaskJob models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskJobSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $approveStatus = Yii::$app->db->createCommand("SELECT case when approved1 = 1
            then 1 when approved2 = 1
            then 2 when approved3 = 1 
            then 3 else 0 end AS appr 
            FROM t_task_approved apr")
            ->queryOne();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'aprStatus' => $approveStatus,
            //'count' => $count
        ]);
    }

    public function getTaskstatus()
    {
        $status = TaskApproved::find()->where(['task_id']);
    }

    /**
     * Displays a single TaskJob model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


        public function actionTimeline()
    {
        $timeline[][]=[    [
            [1, 4],
            [2, 3],
            [5, 1],
        ]];
        //$model = new TaskJob();
        $jobTime = "SELECT
            tj.task_id
            ,utj.typej_detail
            ,DATENAME(day, tj.task_date_start) AS date_num
		    ,CASE WHEN DATENAME(weekday, tj.task_date_start) = 'Monday' THEN 'จันทร์' 
									WHEN DATENAME(weekday, tj.task_date_start) = 'Thursday' THEN 'อังคาร' 
									WHEN DATENAME(weekday, tj.task_date_start) = 'Wednesday' THEN 'พุธ' 
									WHEN DATENAME(weekday, tj.task_date_start) = 'Tuesday' THEN 'พฤหัสบดี' 
									WHEN DATENAME(weekday, tj.task_date_start) = 'Friday' THEN 'ศุกร์' 
                                    WHEN DATENAME(weekday, tj.task_date_start) = 'Saterday' THEN 'เสาร์' 
                                    WHEN DATENAME(weekday, tj.task_date_start) = 'Sunday' THEN 'อาทิตย์' 
						ELSE '' END AS date_name
                        ,CASE WHEN DATENAME(weekday, tj.task_date_start) = 'Monday' THEN 2
									WHEN DATENAME(weekday, tj.task_date_start) = 'Thursday' THEN 3
									WHEN DATENAME(weekday, tj.task_date_start) = 'Wednesday' THEN 4
									WHEN DATENAME(weekday, tj.task_date_start) = 'Tuesday' THEN 5 
									WHEN DATENAME(weekday, tj.task_date_start) = 'Friday' THEN 6
                                    WHEN DATENAME(weekday, tj.task_date_start) = 'Saterday' THEN 7 
                                    WHEN DATENAME(weekday, tj.task_date_start) = 'Sunday' THEN 1 
						ELSE '' END AS date_no
            ,tj.task_date_start
            ,SUBSTRING(CONVERT(VARCHAR, tj.task_time_start),1,8) AS time_start
            ,tj.task_date_end
            ,SUBSTRING(CONVERT(VARCHAR, tj.task_time_end),1,8) AS time_end
            ,CASE WHEN utj.unit_id = 1 THEN 'primary' 
				WHEN utj.unit_id = 2 THEN 'danger'
				ELSE '' END tj_color
            ,CASE WHEN utj.unit_id = 1 THEN 'กลุ่มงานเทคโนโลยีสารสนเทศ' 
				WHEN utj.unit_id = 2 THEN 'กลุ่มงานเลาขานุการ ก.พ.ร. และการประชาสัมพันธ์'
				ELSE '' END tj_org
            ,tj.task_location
            FROM
            t_task_job tj
            LEFT JOIN t_task_approved ta ON tj.task_id = ta.task_id
            LEFT JOIN m_unit_typejob utj ON tj.typej_id = utj.typej_id
            WHERE tj.task_date_start >= {fn curdate()} 
		    ORDER BY tj.task_date_start ASC
            ";

            $times = Yii::$app->db->createCommand($jobTime)->queryAll();

            $date_timeline = "SELECT DISTINCT
            task_date_start
            ,CASE WHEN DATENAME(weekday, tj.task_date_start) = 'Monday' THEN 'จันทร์' 
                                                WHEN DATENAME(weekday, tj.task_date_start) = 'Tuesday' THEN 'อังคาร' 
                                                WHEN DATENAME(weekday, tj.task_date_start) = 'Wednesday' THEN 'พุธ' 
                                                WHEN DATENAME(weekday, tj.task_date_start) = 'Thursday' THEN 'พฤหัสบดี' 
                                                WHEN DATENAME(weekday, tj.task_date_start) = 'Friday' THEN 'ศุกร์' 
                                                WHEN DATENAME(weekday, tj.task_date_start) = 'Saterday' THEN 'เสาร์' 
                                                WHEN DATENAME(weekday, tj.task_date_start) = 'Sunday' THEN 'อาทิตย์' 
                                    ELSE '' END AS date_name
            FROM
            t_task_job tj
            WHERE tj.task_date_start >= {fn curdate()}  ";
            $date_tl = Yii::$app->db->createCommand($date_timeline)->queryAll();
            $i=0;
            $r=0;
            $tmpdate = "";
            $getFunction = new FunctionConfig();
            $getCurMount = $getFunction->getThaiMonth(date('m'));
            $getCurYear = $getFunction->getThaiYear();
        foreach ($date_tl as $rs_tl) {
            //echo "<br><br><br>" . $rs_tl['task_date_start'];
            foreach ($times as $time2d) {
                if ($tmpdate != $rs_tl['task_date_start']) {
                    $r = 0;
                    $tmpdate = $rs_tl['task_date_start'];
                } else {
                    $tmpdate = $rs_tl['task_date_start'];
                }
                if ($time2d['task_date_start'] == $rs_tl['task_date_start']) {
                    $d_start = $rs_tl['task_date_start'];
                    $timeline[$d_start][$r] = $time2d;
                    $r++;
                }
                    
                
            }
        }

            //$zQuery = "";
           // print_r($timeline);
           
       
      // echo "<br><br><br>";
      // print_r($row);
      
        return $this->render('timeline', [
            'times' => $times,
             'curMount' => $getCurMount,
             'curYear' => $getCurYear,
            'timeline2' => $timeline,
            'd_timeline' => $date_tl
        ]);
        
    }
    

    public function actionCapt($id)
    {
        $model = new TaskAssignSearch();
        // echo "<br><br><br><br><br>" . $model->task_detail;

        return $this->render('capt', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new TaskJob model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaskJob();
        //   echo "<br><br><br><br><br>" . $model->task_detail;
        if ($model->load(Yii::$app->request->post())) {
            date_default_timezone_set("Asia/Bangkok");
            // $app->request->
            $session = Yii::$app->session;
            $session->open(); // open a session
            $taskjob = Yii::$app->db->createCommand()
                ->insert('t_task_job', [
                    'task_detail' => $model['task_detail'],
                    'typej_id' => $model['typej_id'],
                    'task_date_start' => $model['task_date_start'],
                    'task_time_start' => $model['task_time_start'],
                    'task_date_end' => $model['task_date_end'],
                    'task_time_end' => $model['task_time_end'],
                    'task_owner' => $session->get('UID'),
                    'task_order_date' => date('Y-m-d'),
                    'task_order_time' => date("H:i"),
                    'task_location' => $model['task_location'],
                    'task_personal' => $model['task_personal'],
                ])->execute();
            //Create task_approved for rank capt
            $leader_type = $this->checkrank();

            $this->createCapt($leader_type);


            $uuid = $session->get('UID');
            $token_user = $this->getAccessToken($uuid);
            $capt_id = $this->getCapt($uuid);
            $token_capt = $this->getAccessToken($capt_id);
            $messages_user = "บันทึกใบคำร้องสำเร็จ";
            $messages_capt = "";
            //Line Notify User
            $this->actionNotify($token_user, $messages_user);
            //Line Notify Capt
            $this->actionNotify($token_user, $messages_user);

            if (!empty($leader_type and $leader_type != Null)) {
                $this->createCapt($leader_type);
            }
            //if($taskjob){

            $uuid = $session->get('UID');
            $token_user = $this->getAccessToken($uuid);
            $capt_id = $this->getCapt($uuid);
            $token_capt = $this->getAccessToken($capt_id);
            $messages_user = "บันทึกใบคำร้องสำเร็จ";
            $messages_capt = "มีใบคำร้องรอการอนุญาติจาก ผอ กอง"; //ผอ กอง
            $messages_capt2 = "มีใบคำร้องรอการอนุมัติจาก ผอ สลธ"; // ผอ สลธ
            $messages_boss = "มีใบคำร้องรอการมอบหมายงาน"; // หัวหน้างาน
            $messages_worker = "มีใบคำร้องที่ต้องปฏิบัติหน้าที่";
            //Line Notify User
            $this->actionNotify($token_user, $messages_user);
            //Line Notify Capt
            $this->actionNotify($token_capt, $messages_capt);
            //var_dump($Linemember);

            //}


            $session->close();  // close a session
                // echo '<script type="text/javascript">',
                // 'jsfunction();',
                // '</script>'
            ;
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function getAccessToken($id)
    { //user_id
        $Linemember = Yii::$app->db->createCommand("select access_token from m_line_member where user_id = '$id' and expried_token is null")->queryOne();
        $access_token = $Linemember['access_token'];
        return $access_token;
    }

    public function getCapt($id)
    { //user_id


        $sql = "select t_leader.org_id,
        org_name,
        parent_id ,
        leader_id ,
        leader_type ,
        case when (leader_type > 4) then (select top 1 user_id from t_leader where org_id = parent_id and leader_type = 4) else user_id end as user_id 
        from m_org_inner
        inner join t_leader on m_org_inner.org_id  = t_leader.org_id
        where leader_type > 3
        and t_leader.org_id = (select cont_to_id from m_user where user_id = $id)
        order by leader_type";

        $sql = "select * from m_rank_user where 
        rank_name like concat('%',(select cont_to from m_user where user_id = '$id'),'%')";

        $capt_user = Yii::$app->db->createCommand($sql)->queryOne();
        $capt = $capt_user["user_id"];
        return $capt;
    }

    public function getMessage($id)
    {
        $mes = "";
        return $mes;
    }

    public function checkRank()
    {
        $session = Yii::$app->session;
        $session->open(); // open a session
        $rankUser = Yii::$app->db->createCommand('SELECT leader_type FROM t_leader WHERE user_id=:id and leader_type < 5 or leader_id = \
')
            ->bindValue(':id', $session->get('UID'))
            ->queryOne();
        $session->close();
        return $rankUser['leader_type'];
    }

    public function createCapt($leader_type)
    {
        $task = Yii::$app->db->createCommand('SELECT Top 1 task_id FROM t_task_job order by task_id desc')
            ->queryOne();
        $task_id =  $task['task_id'];
        $session = Yii::$app->session;
        $session->open();
        $task_leader = Yii::$app->db->createCommand('SELECT cont_to_id FROM m_user where user_id = :id')
            ->bindValue(':id', $session->get('UID'))
            ->queryOne();
        $session->close();
        $cont_to_id =  $task_leader['cont_to_id'];

        if (($leader_type == 4 and $cont_to_id == 37) or $leader_type == 3 or
            $leader_type == 2 or $leader_type == 1
        ) { //ผอ สลธ & hight rank
            Yii::$app->db->createCommand()
                ->insert('t_task_approved', [
                    'task_id' => $task_id,
                    'approved1' =>  '1',
                    'approved1_date' => date('Y-m-d'),
                    'approved1_time' => date("H:i"),
                    'approved2' =>  '1',
                    'approved2_date' => date('Y-m-d'),
                    'approved2_time' => date("H:i"),
                ])->execute();
        } else if ($leader_type == 4) { // capt
            Yii::$app->db->createCommand()
                ->insert('t_task_approved', [
                    'task_id' => $task_id,
                    'approved1' =>  '1',
                    'approved1_date' => date('Y-m-d'),
                    'approved1_time' => date("H:i"),
                ])->execute();
        } elseif (
            $cont_to_id == 54 or $cont_to_id == 55 or $cont_to_id == 56 or $cont_to_id == 57 or $cont_to_id == 58 or $cont_to_id == 59
            or $cont_to_id == 60 or $cont_to_id == 76 or $cont_to_id == 77 or $cont_to_id == 100 or $cont_to_id == 103
        ) {
            Yii::$app->db->createCommand()
                ->insert('t_task_approved', [
                    'task_id' => $task_id,
                    'approved1' =>  '1',
                    'approved1_date' => date('Y-m-d'),
                    'approved1_time' => date("H:i"),
                ])->execute();
        } else {
            Yii::$app->db->createCommand()
                ->insert('t_task_approved', [
                    'task_id' => $task_id,
                ])->execute();
        }
    }

    /**
     * Updates an existing TaskJob model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->task_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TaskJob model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionApproved($id)
    {
        date_default_timezone_set("Asia/Bangkok");
        $session = Yii::$app->session;
        $session->open(); // open a session
        $uid = $session->get('UID');

        $rankUser = Yii::$app->db->createCommand('SELECT org_id ,leader_type FROM t_leader WHERE user_id=:id')
            ->bindValue(':id', $session->get('UID'))
            ->queryOne();

        $model = $this->findModel($id);
        $rankApproved = TaskApproved::find()->where(['task_id' => $model->task_id])->all();
        if (empty($rankApproved)) {

            //$insert support create error
            if ($rankUser['leader_type'] == 4 and $rankUser['org_id'] == 37) {

                //$insert

                if ($rankUser['rank_priority'] == 5) { //
                    if ($rankUser['leader_type'] == 4 and $rankUser['leader_id'] == 70) {


                        Yii::$app->db->createCommand()
                            ->insert('t_task_approved', [
                                'task_id' => $id,
                                'approved1' =>  '1',
                                'approved1_date' => date('Y-m-d'),
                                'approved1_time' => date("H:i"),
                                'approved2' =>  '1',
                                'approved2_date' => date('Y-m-d'),
                                'approved2_time' => date("H:i"),
                            ])->execute();
                    } else  if ($rankUser['leader_type'] == 4) {
                        Yii::$app->db->createCommand()
                            ->insert('t_task_approved', [
                                'task_id' => $id,
                                'approved1' =>  '1',
                                'approved1_date' => date('Y-m-d'),
                                'approved1_time' => date("H:i"),

                            ])->execute();
                    } else { }
                } else {

                    if ($rankUser['leader_type'] == 4 and $rankUser['org_id'] == 37) { // ผอ สลธ

                        if ($rankUser['rank_priority'] == 5) { //พี่อู๋

                            if ($rankUser['leader_type'] == 4 and $rankUser['leader_id'] == 70) {
                                Yii::$app->db->createCommand()
                                    ->update(
                                        't_task_approved',
                                        [
                                            'approved1' =>  '1',
                                            'approved1_date' => date('Y-m-d'),
                                            'approved1_time' => date("H:i"),
                                        ],
                                        'task_id = ' . $id
                                    )->execute();
                            } else  if ($rankUser['rank_priority'] < 5) { //
                                Yii::$app->db->createCommand()
                                    ->update(
                                        't_task_approved',
                                        [
                                            'approved2' =>  '1',
                                            'approved2_date' => date('Y-m-d'),
                                            'approved2_time' => date("H:i"),
                                        ],
                                        'task_id = ' . $id
                                    )->execute();
                            } else if ($rankUser['leader_type'] == 6) { // หัวหน้ากลุ่มงาน
                                Yii::$app->db->createCommand()
                                    ->update(
                                        't_task_approved',
                                        [
                                            'approved3' =>  '1',
                                            'approved3_date' => date('Y-m-d'),
                                            'approved3_time' => date("H:i"),
                                        ],
                                        'task_id = ' . $id
                                    )->execute();
                            } else if ($rankUser['leader_type'] == 4) { //ผอ กอง
                                Yii::$app->db->createCommand()
                                    ->update(
                                        't_task_approved',
                                        [
                                            'approved1' =>  '1',
                                            'approved1_date' => date('Y-m-d'),
                                            'approved1_time' => date("H:i"),
                                        ],
                                        'task_id = ' . $id
                                    )->execute();
                            }
                        }
                        $model->save();
                        $session->close();  // close a session
                        $token = "";
                        $messages = "";
                        $this->actionNotify($token, $messages);
                        return $this->redirect(['index', 'task_id' => $id]);
                        // echo ($id);
                    }
                }
            }
        }
    }
    /**
     * Finds the TaskJob model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaskJob the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaskJob::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionNotify($token, $messages)
    {
        if (empty($token)) {
            $token = "c5PYwqT8uSuu2PxLuNINJzCLpVQWQysLcXD8Rm6zMqU"; //Line ตัวเองใช้ทดสอบ
        }
        $api_url = 'https://notify-api.line.me/api/notify';

        $model = new Notify();
        $json = null;

        //$session = Yii::$app->session;
        //$session->open(); // open a session
        //$uid = $session->get('UID');
        //$rankUser = Yii::$app->db->createCommand('SELECT rank_priority FROM m_rank_user WHERE user_id=:id')
        //    ->bindValue(':id', $session->get('UID'))
        //    ->queryOne();
        /*
        if ($rankUser['rank_priority'] == 5) { //ผอ กอง
            $messages = "มีรายการใบคำร้องที่รอการเห็นชอบจากท่าน ผอ.กอง...";
        } else if ($rankUser['rank_priority'] == 4) { //ผอ สลธ
            $messages = "มีรายการใบคำร้องที่รอการอนุมัติจากท่าน ผอ.สลธ...";
        } else if ($rankUser['rank_priority'] == 6) {
            $messages = "มีรายการใบคำร้องที่รอการกำหนดผู้ปฏิบัติงานจากหัวหน้ากลุ่มงาน...";
        } else {
            $messages = "ใบคำร้องได้รับการบันทึกเรียบร้อย...";
        }
        */
        // if($model->load(Yii::$app->request->post())){
        $headers = [
            'Authorization: Bearer ' . $token
        ];
        $fields = [
            'message' => $messages
        ];

        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $res = curl_exec($ch);
            curl_close($ch);

            if ($res == false)
                throw new Exception(curl_error($ch), curl_errno($ch));

            $json = json_decode($res);
            //$status = $json->status;

            //var_dump($status);
        } catch (Exception $e) {
            throw new Exception($e->getMessage);
        }
        // }
        /*
        return $this->render('notify', [
            'model' => $model,
            'json' => $json
        ]);
        */
    }


    public function actionCallback()
    {
        $client_id = '50psyjPcWvod79kLAO98z0';
        $client_secret = 'GkB0lLEnRPuOOqKsbafz7ytMe5PyVIhMtyVEJugu2ER';

        $api_url = 'https://notify-bot.line.me/oauth/token';
        $callback_url = 'http://172.16.23.41/yii2basicline/web/site/callback';

        parse_str($_SERVER['QUERY_STRING'], $queries);

        var_dump($queries);
        $fields = [
            'grant_type' => 'authorization_code',
            'code' => $queries['code'],
            'redirect_uri' => $callback_url,
            'client_id' => $client_id,
            'client_secret' => $client_secret
        ];

        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $res = curl_exec($ch);
            curl_close($ch);

            if ($res == false)
                throw new Exception(curl_error($ch), curl_errno($ch));

            $json = json_decode($res);

            //var_dump($json);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            //var_dump($e);
        }

        //ตรวจสอบค่า UID ที่เก็บไว้ในตัวแปร SESSION ว่ามีใน Table m_line_member แล้วหรือไม่
        $session = Yii::$app->session;
        $session->open(); // open a session
        $uid = $session->get('UID');
        //echo "<br><br><br><br>";
        //echo "session_client_id : ".session_id();
        //echo "<br> User ID : ".$session->get('UID');
        //echo "<br> access token :".$json->access_token;
        $model = new ChkMember();
        $return_data = $model->getMember($uid);
        //echo "<br>";
        //var_dump($return_data);
        $currentdate = date("Y-m-d");
        $sql = "INSERT INTO m_line_member(user_id, access_token,member_type,registed_token) VALUES('$uid','$json->access_token','U','$currentdate')";
        if (!empty($json->access_token)) {
            Yii::$app->db->createCommand($sql)->execute();
        }
        //return $this->redirect(array('site/index', 'userId' => $uid));


        return $this->render('callback', [
            'json' => $json,
            'data' => $return_data
        ]);
    }
}
