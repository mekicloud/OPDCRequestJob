<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_unit_typejob".
 *
 * @property int $typej_id
 * @property string $typej_detail
 * @property int $unit_id
 *
 * @property MUnit $unit
 * @property TTaskJob[] $tTaskJobs
 */
class UnitTypejob extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_unit_typejob';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['typej_id', 'typej_detail'], 'required'],
            [['typej_id', 'unit_id'], 'integer'],
            [['typej_detail'], 'string', 'max' => 500],
            [['typej_id'], 'unique'],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => MUnit::className(), 'targetAttribute' => ['unit_id' => 'unit_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'typej_id' => 'Typej ID',
            'typej_detail' => 'ประเภทงาน',
            'unit_id' => 'รหัสหน่วยงาน',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(MUnit::className(), ['unit_id' => 'unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskJobs()
    {
        return $this->hasMany(TTaskJob::className(), ['typej_id' => 'typej_id']);
    }


}
