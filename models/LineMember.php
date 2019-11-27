<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_line_member".
 *
 * @property int $id
 * @property string $user_id
 * @property string $access_token
 * @property string $expried_token
 * @property string $member_type
 */
class LineMember extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_line_member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['expried_token'], 'safe'],
            [['user_id', 'access_token'], 'string', 'max' => 50],
            [['member_type'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'access_token' => 'Access Token',
            'expried_token' => 'Expried Token',
            'member_type' => 'Member Type',
        ];
    }
}
