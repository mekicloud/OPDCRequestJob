<?php
namespace app\models;
use yii\base\Model;

class Notify extends Model {
    public $name;

    public function rules() {
        return [
            [['name'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'ข้อความ'
        ];
    }
}