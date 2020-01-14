<?php

namespace app\models;

use Yii;

class FunctionConfig
{
    public function getThaiMonth($m)
    {
        switch ($m) {
            case "1":
                $month = "มกราคม";
                break;
            case "2":
                $month = "กุมภาพันธ์";
                break;
            case "3":
                $month = "มีนาคม";
                break;
            case "4":
                $month = "เมษายน";
                break;
            case "5":
                $month = "พฤษภาคม";
                break;
            case "6":
                $month = "มิถุนายน";
                break;
            case "7":
                $month = "กรกฎาคม";
                break;
            case "8":
                $month = "สิงหาคม";
                break;
            case "9":
                $month = "กันยายน";
                break;
            case "10":
                $month = "ตุลาคม";
                break;
            case "11":
                $month = "พฤศจิกายน";
                break;
            case "12":
                $month = "ธันวาคม";
                break;
            default:
                $month = "";
        }

        return $month;
    }

    public function getThaiYear($y){
        if(!empty($y)){
            $thYear = $y+543;
        }else{
            $thYear = date('Y')+543;
        }
        
        return $thYear;
    }
}
