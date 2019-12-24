<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use  yii\web\Session;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Notify;
use app\models\AccessToken;
use app\models\ChkMember;
use yii\helpers\VarDumper;
use yii\helpers\Json;
use app\models\TaskJob;
use app\models\TaskAdmin;
use yii\db\Query;
use yii\helpers\Url;
use yii\web\JsExpression;
Yii::setAlias('@smart', 'https://smart.opdc.go.th/opdc_dev/test/');
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $session->open(); // open a session
        // $id = isset($_GET['id']) ? $_GET['id'] : $session->get('UID');
        //session_unset();
       // unset($_SESSION['username']);

        //$simple_string = "901";
        //echo "Original String: " . $simple_string;
        //----------Config-------------------------
        // Store the cipher method 
        //$ciphering = "AES-256-CTR";
        // Use OpenSSl Encryption method 
        //$iv_length = openssl_cipher_iv_length($ciphering);
        //$options = 0;
        // Non-NULL Initialization Vector for encryption 
        //$encryption_iv = 'gwh28dgcmpp6rc46';
        // Store the encryption key 
        //$encryption_key = "@min0pdc";
        //-----------End Config-----------------------

        //-----------Encrypt Process------------------
        // Use openssl_encrypt() function to encrypt the data 
        /*
        $encryption = openssl_encrypt(
            $simple_string,
            $ciphering,
            $encryption_key,
            $options,
            $encryption_iv
        );
        
        // Display the encrypted string 
        //echo "Encrypted String: " . $encryption . "\n";
        //-----------End Encrypt Process-----------------------

        //-----------Decrypt Process--------------------
        // Non-NULL Initialization Vector for decryption 
        $decryption_iv = 'gwh28dgcmpp6rc46';
        // Store the decryption key 
        $decryption_key = "@min0pdc";
        // Use openssl_decrypt() function to decrypt the data 
        $decryption = openssl_decrypt(
            $encryption,
            $ciphering,
            $decryption_key,
            $options,
            $decryption_iv
        );
        */
        // Display the decrypted string 
       // echo "Decrypted String: " . $decryption;
        //-----------End Decrypt Process--------------------
        //$mess_alert = "Original String: " . $simple_string . "<br>Encrypted String: " . $encryption . "<br>Decrypted String: " . $decryption;
        $mess_alert = "";
        Yii::$app->getSession()->setFlash('alert', [
            'body' => $mess_alert,
            'options' => ['class' => 'alert-danger']
        ]);
        
        if(!empty($_GET['id'])){
            session_unset('UID');
            $id = $this->actionDecryption($_GET['id']);
            $session->set('UID',$id);
        }else{
            $id = $session->get('UID');
        }
 
       //
       
        if(!empty($id)){
            
           // echo "<br><br><br>id : ".$id ;
            
            $userid = $session->get('UID');
            $model = new ChkMember();

           //echo $this->actionAdmintype($id);
            
           // echo "<br><br><br>";
           // var_dump($admin);
            //echo $admin['user_id'];
        
        if($model->getMember($userid) == false){
            if($model->getGroup($userid) == false){
               // echo "Line Member not found..!";
                if($model->getUser($userid) == false){
                    //echo "getUser Return False..!";
                }else{
                    $return_data = $model->getUser($userid);
                }
            }else{
                $return_data = $model->getGroup($userid);
            }
        }else {
            $return_data = $model->getMember($userid);
        }
        $session->set('username', $return_data['user_name']) ;

        $client_id = '50psyjPcWvod79kLAO98z0';
        $api_url = 'https://notify-bot.line.me/oauth/authorize?';
        $callback_url = 'https://smart.opdc.go.th/opdc_job/web/site/callback';

        $query = [
            'response_type' => 'code',
            'client_id' => $client_id,
            'redirect_uri' => $callback_url,
            'scope' => 'notify',
            'state' => 'mylinenotify'
        ];
        
        $result = $api_url . http_build_query($query);


        return $this->render('index',[
            'result' => $result,
            'userdata' => $return_data
        ]);

    }else{
        if(empty($session->get('username'))){
            $return_data['user_name'] = '';
            $return_data['access_token'] = '';

        }
         return $this->render('error');
       // $session->set('username', '') ;
    }

        
        //echo "<br>ลงทะเบียนรับข่าวสารผ่านช่องทาง Line Notify<br><br>";
        //echo "สวัสดีคุณ : ".$return_data['user_id']."<br> UID : ".$session->get('UID');
        //echo "session_client_id : ".session_id();
        //$_SESSION["uId"] = "901";
        session_write_close();
       // echo "<br>ขั้นตอนการลงทะเบียนรับข่าวสาร<br>";
       // var_dump($return_data);

       
    }
    public function actionDecryption($id)
    {
        $encryption = $id;
        $ciphering = "AES-256-CTR";
        $options = 0;
        $decryption_iv = 'gwh28dgcmpp6rc46';
        // Store the decryption key 
        $decryption_key = "@min0pdc";
        // Use openssl_decrypt() function to decrypt the data 
        $uid = openssl_decrypt(
            $encryption,
            $ciphering,
            $decryption_key,
            $options,
            $decryption_iv
        );
        return $uid;
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionAdmintype($id){
        $user_id = $this->actionDecryption($id);
        $data = Yii::$app->db->createCommand("SELECT admin_type FROM m_task_admin WHERE user_id ='$user_id'")->queryScalar();
        if($data){
            return $data;
        }else{
            return $data;
        }
        
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionCallback()
    {
        $client_id = '50psyjPcWvod79kLAO98z0';
        $client_secret = 'GkB0lLEnRPuOOqKsbafz7ytMe5PyVIhMtyVEJugu2ER';

        $api_url = 'https://notify-bot.line.me/oauth/token';
        $callback_url = 'https://smart.opdc.go.th/opdc_job/web/site/callback';

        parse_str($_SERVER['QUERY_STRING'], $queries);
        
        //var_dump($queries);
        if(!empty($queries['code'])){
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
        } catch(Exception $e) {
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
        if(!empty($json->access_token) && !empty($uid)){
            Yii::$app->db->createCommand($sql)->execute();
        }
        //return $this->redirect(array('site/index', 'userId' => $uid));

        
        return $this->render('callback', [
            'json' => $json,
            'data' => $return_data
        ]);
    }else{
        return $this->redirect('index');
    }

        
    }

    public function actionNotify()//หากต้องการให้รับ Token ใหม่ให้ใส่ตัวแปร $token ในวงเล็บ
    {
        //กรณีใช้ token เดิมให้ระบุตรงนี้
        $token = "c5PYwqT8uSuu2PxLuNINJzCLpVQWQysLcXD8Rm6zMqU";//Line ตัวเองใช้ทดสอบ
        $api_url = 'https://notify-api.line.me/api/notify';

        $model = new Notify();
        $json = null;
        if($model->load(Yii::$app->request->post())){
            $headers = [
                'Authorization: Bearer ' . $token
            ];
            $fields = [
                'message' => 'มีบันทึกข้อความต้องอนุมัติ ' . $model->name
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
        }
        return $this->render('notify', [
            'model' => $model,
            'json' => $json
        ]);
    }

    public function actionForm($start,$end)
		{
			return $this->renderAjax('form',[
				'start'=>$start,
				'end'=>$end
			]);
		}
		
	public function actionDropchild($id,$start,$end){
			//echo "ID=".$id." START=".$start." EBD=".$end;
			//$model = Pilotproject::findOne(['ID'=>$id]);

			//$model->PLAN_DATE1 = $start;
			//$model->PLAN_DATE2 = $end;

		   // $model->save();
	}
		
	public function actionJsoncalendar($start=NULL,$end=NULL,$_=NULL){

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $jobTime = "SELECT
        tj.task_id
        ,utj.typej_detail
        ,tj.task_date_start
        ,SUBSTRING(CONVERT(VARCHAR, tj.task_time_start),1,8) AS time_start
        ,tj.task_date_end
        ,SUBSTRING(CONVERT(VARCHAR, tj.task_time_end),1,8) AS time_end
        ,CASE WHEN utj.unit_id = 43 THEN 'MediumSlateBlue' 
WHEN utj.unit_id = 41 THEN 'Salmon'
ELSE '' END tj_color
        ,m_user.user_name
        ,tj.task_location 
        FROM
        t_task_job tj
        LEFT JOIN t_task_approved ta ON tj.task_id = ta.task_id
        LEFT JOIN m_unit_typejob utj ON tj.typej_id = utj.typej_id
        LEFT JOIN m_user ON tj.task_owner = m_user.user_id
        WHERE (tj.task_status > 0 and tj.task_status <> 13)
        ";

        $times = Yii::$app->db->createCommand($jobTime)->queryAll();

        //$times = TaskJob::find();
        //var_dump($times->task_id);
        $events = array();
        date_default_timezone_set("Asia/Bangkok");

        foreach ($times AS $time){      
          //Config Calendar
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $time['task_id'];
            $Event->title = $time['typej_detail'];
            $Event->start = date('Y-m-d\TH:i:s\Z',strtotime(substr($time['task_date_start'],0).' '.substr($time['time_start'],0)));
            $Event->end = date('Y-m-d\TH:i:s\Z',strtotime(substr($time['task_date_end'],0).' '.substr($time['time_end'],0)));
            $Event->color = $time['tj_color']; //label color
            $Event->nonstandard = $time['user_name'];
            $Event->textColor = "วันที่ ".$time['task_date_start']." เวลา ".substr($time['time_start'],0,5)
            ." น. <br> ถึง : วันที่ ".$time['task_date_end']." เวลา ".substr($time['time_end'],0,5)." น.";
            $Event->borderColor = $time['task_location'];
            
           
            $events[] = $Event;
            
        }
    
        return $events;
      }

    public function actionSignout()
    {
        $session = Yii::$app->session;
        $session->open(); // open a session
        session_unset('UID');
        session_unset('username');
        return $this->redirect(Url::to('@smart'));
        //return $this->redirect('index');
    }

    public function actionProfile(){
        return $this->render('profile');
    }
}
