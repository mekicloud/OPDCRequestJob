<?php

namespace app\models;

use Yii;

class ChkMember {
 
    //ค้นหา access_token จาก user_id กรณีได้มีการลงทะเบียนรับข่าวสารทาง LINE ไว้แล้ว เพื่อนำไปส่ง LINE Notify
    public function getMemberLine($userId)
    {
        
        $select_member = "select m_user.user_id ,m_user.user_name ,m_line_member.access_token,'U' AS member_type from m_user" 
            ." left join m_line_member on m_user.user_id = m_line_member.user_id" 
            ." and m_line_member.member_type = 'U'" 
            ." and m_line_member.expried_token is null"
            ." where m_line_member.user_id is not null and m_line_member.user_id = '$userId'";

        $member_data = Yii::$app->db->createCommand($select_member)->queryOne();
    
        return $member_data;
    }

    //ค้นหา user จาก user_id กรณีได้มีการลงทะเบียนรับข่าวสารทาง LINE ไว้แล้ว
    public function getMember($userId){
        //$select_group = "select user_id,access_token, 'U' AS member_type from m_line_member where member_type = 'U' and expried_token is null and m_line_member.user_id = '$userId'";
        $select_member = "select m_user.user_id ,m_user.user_name ,m_line_member.access_token,'U' AS member_type from m_user" 
            ." left join m_line_member on m_user.user_id = m_line_member.user_id" 
            ." and m_line_member.member_type = 'U'" 
            ." and m_line_member.expried_token is null"
            ." where m_line_member.user_id is not null and m_line_member.user_id = '$userId'";
        $member_data = Yii::$app->db->createCommand($select_member)->queryOne();
    
        return $member_data;
    }

    //ค้นหา Group LINE ที่ลงทะเบียนรับข่าวสารทาง LINE ไว้
    public function getGroup($userId)
    {
        $select_group = "select user_id,access_token, 'G' AS member_type from m_line_member where member_type = 'G' and expried_token is null and m_line_member.user_id = '$userId'";

        $group_data = Yii::$app->db->createCommand($select_group)->queryOne();
    
        return $group_data;
    }

    //ค้นหา user จาก user_id กรณี user ยังไม่ได้ลงทะเบียนรับข่าวสารทาง LINE
    public function getUser($userId){
        $select_user = "select m_user.user_id ,m_user.user_name from m_user where user_id = '$userId'";

        $group_data = Yii::$app->db->createCommand($select_user)->queryOne();
    
        return $group_data;
    }
}