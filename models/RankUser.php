<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_rank_user".
 *
 * @property int $rank_id
 * @property string $rank_name
 * @property int $user_id
 * @property string $rank_priority
 *
 * @property MUser $user
 */
class RankUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_rank_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rank_id', 'rank_name'], 'required'],
            [['rank_id', 'user_id'], 'integer'],
            [['rank_name'], 'string', 'max' => 255],
            [['rank_priority'], 'string', 'max' => 2],
            [['rank_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => MUser::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rank_id' => 'Rank ID',
            'rank_name' => 'ชื่อระดับตำแหน่ง',
            'user_id' => 'ชื่อผู้ใช้งาน',
            'rank_priority' => 'ระดับสิทธิ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     * Relation 
     */
    public function getUser()
    {
        return $this->hasOne(MUser::className(), ['user_id' => 'user_id']);
    }

    public function getNameuser(){

    }


}
