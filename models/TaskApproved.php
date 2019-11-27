<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_task_approved".
 *
 * @property int $task_id
 * @property int $approved1
 * @property string $approved1_date
 * @property string $approved1_time
 * @property int $approved2
 * @property string $approved2_date
 * @property string $approved2_time
 * @property int $approved3
 * @property string $approved3_date
 * @property string $approved3_time
 *
 * @property TaskJob $task
 */
class TaskApproved extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_task_approved';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id'], 'required'],
            [['task_id', 'approved1', 'approved2', 'approved3'], 'integer'],
            [['approved1_date', 'approved1_time', 'approved2_date', 'approved2_time', 'approved3_date', 'approved3_time'], 'safe'],
            [['task_id'], 'unique'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskJob::className(), 'targetAttribute' => ['task_id' => 'task_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'เลขที่ใบงาน',
            'approved1' => 'ผอ กอง',
            'approved1_date' => 'วันที่',
            'approved1_time' => 'เวลา',
            'approved2' => 'ผอ สลธ',
            'approved2_date' => 'วันที่',
            'approved2_time' => 'เวลา',
            'approved3' => 'หัวหน้างาน',
            'approved3_date' => 'วันที่',
            'approved3_time' => 'เวลา',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(TaskJob::className(), ['task_id' => 'task_id']);
    }

    public function getApproveStatus(){
        $status = "";
        return $status;
    }
}
