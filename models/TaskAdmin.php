<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\MUser;

/**
 * This is the model class for table "m_task_admin".
 *
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property int $admin_type
 */
class TaskAdmin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_task_admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status', 'admin_type'], 'required'],
            [['id', 'user_id', 'status', 'admin_type'], 'integer'],
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
            'user_id' => 'User ID',
            'status' => 'Status',
            'admin_type' => 'Admin Type',
            'admin' => Yii::t('app', 'ชื่อ-นามสกุล'),
            'typeName' => Yii::t('app', 'ประเภทผู้ดูแลระบบ'),
        ];
    }

    public function getMuser()
    {
        return $this->hasOne(MUser::className(), ['user_id' => 'user_id']);
    }

    public function getAdmin()
    {

        return $this->muser->user_title_name . "  " . $this->muser->user_name;
    }

    public function getAdminType()
    {
        return self::itemsAlias('admintype');
    }

    public function getTypeName(){
        return ArrayHelper::getValue($this->getAdminType(),$this->admin_type);
    }

    
    public static function itemsAlias($key)
    {

        $items = [
            'admintype' => [
                1 => 'SuperAdmin',
                2 => 'Admin',
            ],
            'marital' => [
                1 => 'โสด',
                2 => 'สมรส',
                3 => 'เป็นหม้าย',
                4 => 'หย่าร้าง'
            ],
        ];
        return ArrayHelper::getValue($items, $key, []);
        //return array_key_exists($key, $items) ? $items[$key] : [];
    }
}
