<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_user".
 *
 * @property int $user_id
 * @property int $user_title_id
 * @property string $user_title_name
 * @property string $user_name
 * @property string $user_nickname
 * @property string $user_name_en
 * @property string $user_idcard
 * @property string $user_address
 * @property string $user_email
 * @property string $user_mobile
 * @property string $user_phone
 * @property string $user_intercom
 * @property string $user_fax
 * @property int $cont_to_id
 * @property string $cont_to
 * @property int $cont_to_id2
 * @property string $cont_to2
 * @property int $cont_to_id3
 * @property string $cont_to3
 * @property int $user_education_id
 * @property string $user_education_name
 * @property int $user_sex_id
 * @property string $user_sex_name
 * @property int $user_religion_id
 * @property string $user_religion_name
 * @property int $user_status_id
 * @property string $user_status_name
 * @property int $user_domicile_id
 * @property string $user_domicile_name
 * @property string $user_birthday
 * @property string $user_start_date
 * @property string $user_start_opdc_date
 * @property string $user_no_position
 * @property string $user_start_posit
 * @property int $user_category_id
 * @property string $user_category_name
 * @property string $user_position_name
 * @property int $user_level_id
 * @property string $user_level_name
 * @property int $user_employee_id
 * @property int $user_employee_type_id
 * @property string $user_employee_type_name
 * @property int $user_start_work_id
 * @property string $user_start_work_name
 * @property string $user_login
 * @property string $user_password
 * @property string $RFID_code
 * @property int $user_finger_print
 * @property string $user_finger_print_type
 * @property int $user_id_status
 * @property string $date_resign
 * @property string $date_transfer
 * @property string $date_move
 * @property string $date_retire
 * @property string $date_withhold
 * @property string $user_name_status
 * @property string $user_note
 * @property string $remark
 * @property string $show_dialog_search
 * @property int $created_user_id
 * @property string $created_user
 * @property string $created_date
 * @property int $updated_user_id
 * @property string $updated_user
 * @property string $updated_date
 * @property string $user_pic
 * @property string $user_generation
 * @property int $user_new_id
 * @property string $user_new_name
 *
 * @property MRankUser[] $mRankUsers
 */
class MUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_title_id', 'user_no_position', 'user_position_name', 'created_user_id', 'created_user', 'created_date', 'updated_user_id', 'updated_user', 'updated_date'], 'required'],
            [['user_title_id', 'cont_to_id', 'cont_to_id2', 'cont_to_id3', 'user_education_id', 'user_sex_id', 'user_religion_id', 'user_status_id', 'user_domicile_id', 'user_category_id', 'user_level_id', 'user_employee_id', 'user_employee_type_id', 'user_start_work_id', 'user_finger_print', 'user_id_status', 'created_user_id', 'updated_user_id', 'user_new_id'], 'integer'],
            [['user_birthday', 'user_start_date', 'user_start_opdc_date', 'user_start_posit', 'date_resign', 'date_transfer', 'date_move', 'date_retire', 'date_withhold', 'created_date', 'updated_date'], 'safe'],
            [['user_note', 'remark', 'user_pic'], 'string'],
            [['user_title_name', 'user_nickname', 'user_idcard', 'user_email', 'user_mobile', 'user_phone', 'user_intercom', 'user_no_position', 'user_category_name', 'user_position_name', 'user_level_name', 'user_employee_type_name', 'user_start_work_name', 'user_login', 'user_password'], 'string', 'max' => 100],
            [['user_name', 'user_name_en', 'user_address', 'cont_to', 'user_education_name', 'user_domicile_name'], 'string', 'max' => 250],
            [['user_fax', 'user_sex_name', 'user_religion_name', 'user_status_name', 'user_name_status', 'created_user', 'updated_user'], 'string', 'max' => 50],
            [['cont_to2', 'cont_to3', 'user_new_name'], 'string', 'max' => 255],
            [['RFID_code'], 'string', 'max' => 20],
            [['user_finger_print_type', 'show_dialog_search'], 'string', 'max' => 1],
            [['user_generation'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_title_id' => 'User Title ID',
            'user_title_name' => 'User Title Name',
            'user_name' => 'User Name',
            'user_nickname' => 'User Nickname',
            'user_name_en' => 'User Name En',
            'user_idcard' => 'User Idcard',
            'user_address' => 'User Address',
            'user_email' => 'User Email',
            'user_mobile' => 'User Mobile',
            'user_phone' => 'User Phone',
            'user_intercom' => 'User Intercom',
            'user_fax' => 'User Fax',
            'cont_to_id' => 'Cont To ID',
            'cont_to' => 'Cont To',
            'cont_to_id2' => 'Cont To Id2',
            'cont_to2' => 'Cont To2',
            'cont_to_id3' => 'Cont To Id3',
            'cont_to3' => 'Cont To3',
            'user_education_id' => 'User Education ID',
            'user_education_name' => 'User Education Name',
            'user_sex_id' => 'User Sex ID',
            'user_sex_name' => 'User Sex Name',
            'user_religion_id' => 'User Religion ID',
            'user_religion_name' => 'User Religion Name',
            'user_status_id' => 'User Status ID',
            'user_status_name' => 'User Status Name',
            'user_domicile_id' => 'User Domicile ID',
            'user_domicile_name' => 'User Domicile Name',
            'user_birthday' => 'User Birthday',
            'user_start_date' => 'User Start Date',
            'user_start_opdc_date' => 'User Start Opdc Date',
            'user_no_position' => 'User No Position',
            'user_start_posit' => 'User Start Posit',
            'user_category_id' => 'User Category ID',
            'user_category_name' => 'User Category Name',
            'user_position_name' => 'User Position Name',
            'user_level_id' => 'User Level ID',
            'user_level_name' => 'User Level Name',
            'user_employee_id' => 'User Employee ID',
            'user_employee_type_id' => 'User Employee Type ID',
            'user_employee_type_name' => 'User Employee Type Name',
            'user_start_work_id' => 'User Start Work ID',
            'user_start_work_name' => 'User Start Work Name',
            'user_login' => 'User Login',
            'user_password' => 'User Password',
            'RFID_code' => 'Rfid Code',
            'user_finger_print' => 'User Finger Print',
            'user_finger_print_type' => 'User Finger Print Type',
            'user_id_status' => 'User Id Status',
            'date_resign' => 'Date Resign',
            'date_transfer' => 'Date Transfer',
            'date_move' => 'Date Move',
            'date_retire' => 'Date Retire',
            'date_withhold' => 'Date Withhold',
            'user_name_status' => 'User Name Status',
            'user_note' => 'User Note',
            'remark' => 'Remark',
            'show_dialog_search' => 'Show Dialog Search',
            'created_user_id' => 'Created User ID',
            'created_user' => 'Created User',
            'created_date' => 'Created Date',
            'updated_user_id' => 'Updated User ID',
            'updated_user' => 'Updated User',
            'updated_date' => 'Updated Date',
            'user_pic' => 'User Pic',
            'user_generation' => 'User Generation',
            'user_new_id' => 'User New ID',
            'user_new_name' => 'User New Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMRankUsers()
    {
        return $this->hasMany(MRankUser::className(), ['user_id' => 'user_id']);
    }

    public function getNameuser(){
        
    }
}
