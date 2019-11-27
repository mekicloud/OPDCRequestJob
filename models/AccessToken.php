<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "access_token".
 *
 * @property int $id
 * @property string $access_token
 * @property string $token_expire
 */
class AccessToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'access_token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['token_expire'], 'safe'],
            [['access_token'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'access_token' => 'Access Token',
            'token_expire' => 'Token Expire',
        ];
    }
}
