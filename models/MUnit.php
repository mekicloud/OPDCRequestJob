<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_unit".
 *
 * @property int $unit_id
 * @property string $unit_name
 * @property int $rank_id
 * @property string $dep_id
 * @property int $unit_dep
 *
 * @property RankUser $rank
 * @property MUnitTypejob[] $mUnitTypejobs
 */
class MUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_id', 'unit_name'], 'required'],
            [['unit_id', 'rank_id', 'unit_dep'], 'integer'],
            [['unit_name'], 'string', 'max' => 255],
            [['dep_id'], 'string', 'max' => 2],
            [['unit_id'], 'unique'],
            [['rank_id'], 'exist', 'skipOnError' => true, 'targetClass' => RankUser::className(), 'targetAttribute' => ['rank_id' => 'rank_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'unit_id' => 'Unit ID',
            'unit_name' => 'หน่วยงาน',
            'rank_id' => 'เลขที่ตำแหน่ง',
            'dep_id' => 'สังกัด สลธ หรือไม่',
            'unit_dep' => 'กลุ่มที่เทียบเท่ากองหรือสำนัก มีผอ เป็นของตัวเอง',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRank()
    {
        return $this->hasOne(RankUser::className(), ['rank_id' => 'rank_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMUnitTypejobs()
    {
        return $this->hasMany(MUnitTypejob::className(), ['unit_id' => 'unit_id']);
    }
}
