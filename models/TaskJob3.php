<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_task_job".
 *
 * @property int $task_id
 * @property string $task_detail
 * @property int|null $typej_id
 * @property string|null $task_date_start
 * @property string|null $task_time_start
 * @property string|null $task_date_end
 * @property string|null $task_time_end
 * @property int|null $task_owner
 * @property string|null $task_order_date
 * @property string|null $task_order_time
 * @property string|null $task_location
 * @property int|null $task_personal
 * @property string|null $task_status
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
            [['task_detail'], 'required'],
            [['typej_id', 'task_owner', 'task_personal'], 'integer'],
            [['task_date_start', 'task_time_start', 'task_date_end', 'task_time_end', 'task_order_date', 'task_order_time'], 'safe'],
            [['task_detail'], 'string', 'max' => 500],
            [['task_location'], 'string', 'max' => 255],
            [['task_status'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task ID',
            'task_detail' => 'Task Detail',
            'typej_id' => 'Typej ID',
            'task_date_start' => 'Task Date Start',
            'task_time_start' => 'Task Time Start',
            'task_date_end' => 'Task Date End',
            'task_time_end' => 'Task Time End',
            'task_owner' => 'Task Owner',
            'task_order_date' => 'Task Order Date',
            'task_order_time' => 'Task Order Time',
            'task_location' => 'Task Location',
            'task_personal' => 'Task Personal',
            'task_status' => 'Task Status',
        ];
    }
}
