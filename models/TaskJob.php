<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_task_job".
 *
 * @property int $task_id
 * @property string $task_detail
 * @property int $typej_id
 * @property string $task_date_start
 * @property string $task_time_start
 * @property string $task_date_end
 * @property string $task_time_end
 * @property int $task_owner
 * @property string $task_order_date
 * @property string $task_order_time
 * @property string $task_location
 * @property int $task_personal
 *
 * @property TaskApproved $tTaskApproved
 * @property TaskAssign[] $tTaskAssigns
 * @property MUser[] $users
 * @property MUser $taskOwner
 * @property UnitTypejob $typej
 */
class TaskJob extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_task_job';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'task_detail', 'task_time_start', 'task_time_end', 'task_order_time'], 'required'],
            [['task_id', 'typej_id', 'task_owner', 'task_personal'], 'integer'],
            [['task_date_start', 'task_time_start', 'task_date_end', 'task_time_end', 'task_order_date', 'task_order_time'], 'safe'],
            [['task_detail'], 'string', 'max' => 500],
            [['task_location'], 'string', 'max' => 255],
            [['task_id'], 'unique'],
            [['task_owner'], 'exist', 'skipOnError' => true, 'targetClass' => MUser::className(), 'targetAttribute' => ['task_owner' => 'user_id']],
            [['typej_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnitTypejob::className(), 'targetAttribute' => ['typej_id' => 'typej_id']],
        ];
    }

    public function getUserDropdown()
    {
        $listCategory   = Category::find()->select('user_id,user_name')
            ->where(['cont_to_id' => '43'])
            ->andWhere(['user_name_status' => 'ปกติ' , "user_name_en != '' "])
            ->all();
        $list   = ArrayHelper::map($listCategory, 'user_id', 'user_name');

        return $list;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task ID',
            'task_detail' => 'รายละเอียด',
            'typej_id' => 'ประเภทงาน',
            'task_date_start' => 'วันที่',
            'task_time_start' => 'เวลา',
            'task_date_end' => 'Task Date End',
            'task_time_end' => 'Task Time End',
            'task_owner' => 'Task Owner',
            'task_order_date' => 'Task Order Date',
            'task_order_time' => 'Task Order Time',
            'task_location' => 'สถานที่',
            'task_personal' => 'Task Personal',
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTaskApproved()
    {
        return $this->hasOne(TaskApproved::className(), ['task_id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTaskAssigns()
    {
        return $this->hasMany(TaskAssign::className(), ['task_id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(MUser::className(), ['user_id' => 'user_id'])->viaTable('t_task_assign', ['task_id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskOwner()
    {
        return $this->hasOne(MUser::className(), ['user_id' => 'task_owner']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypej()
    {
        return $this->hasOne(UnitTypejob::className(), ['typej_id' => 'typej_id']);
    }
}
