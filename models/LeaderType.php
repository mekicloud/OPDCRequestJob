<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_leader".
 *
 * @property int $leader_id
 * @property int|null $user_id
 * @property int|null $org_id
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $status
 * @property string|null $reserve_car
 * @property string|null $evaluate_salary
 * @property string|null $leader_type
 * @property int|null $created_user_id
 * @property string|null $created_user
 * @property string|null $created_date
 * @property int|null $updated_user_id
 * @property string|null $updated_user
 * @property string|null $updated_date
 */
class LeaderType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_leader';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'org_id', 'created_user_id', 'updated_user_id'], 'integer'],
            [['start_date', 'end_date', 'created_date', 'updated_date'], 'safe'],
            [['status', 'reserve_car', 'evaluate_salary', 'leader_type'], 'string', 'max' => 1],
            [['created_user', 'updated_user'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'leader_id' => 'Leader ID',
            'user_id' => 'User ID',
            'org_id' => 'Org ID',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'status' => 'Status',
            'reserve_car' => 'Reserve Car',
            'evaluate_salary' => 'Evaluate Salary',
            'leader_type' => 'Leader Type',
            'created_user_id' => 'Created User ID',
            'created_user' => 'Created User',
            'created_date' => 'Created Date',
            'updated_user_id' => 'Updated User ID',
            'updated_user' => 'Updated User',
            'updated_date' => 'Updated Date',
        ];
    }
}
