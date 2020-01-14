<?php

use app\models\TaskJob;

use yii\widgets\ActiveForm;

?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .timeline {
      margin-top: 20px;
      position: relative;

    }

    .timeline:before {
      position: absolute;
      content: '';
      width: 4px;
      height: calc(100% + 50px);
      background: rgb(138, 145, 150);
      background: -moz-linear-gradient(left, rgba(138, 145, 150, 1) 0%, rgba(122, 130, 136, 1) 60%, rgba(98, 105, 109, 1) 100%);
      background: -webkit-linear-gradient(left, rgba(138, 145, 150, 1) 0%, rgba(122, 130, 136, 1) 60%, rgba(98, 105, 109, 1) 100%);
      background: linear-gradient(to right, rgba(138, 145, 150, 1) 0%, rgba(122, 130, 136, 1) 60%, rgba(98, 105, 109, 1) 100%);
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#8a9196', endColorstr='#62696d', GradientType=1);
      left: 14px;
      top: 5px;
      border-radius: 4px;
    }

    .timeline-month {
      position: relative;
      padding: 4px 15px 4px 35px;
      background-color: whitesmoke;
      display: inline-block;
      width: auto;
      border-radius: 40px;
      border: 1px solid #17191B;
      border-right-color: black;
      margin-bottom: 30px;
    }

    .timeline-month span {
      position: absolute;
      top: -1px;
      left: calc(100% - 10px);
      z-index: -1;
      white-space: nowrap;
      display: inline-block;
      background-color: goldenrod;
      padding: 4px 10px 4px 20px;
      border-top-right-radius: 40px;
      border-bottom-right-radius: 40px;
      border: 1px solid black;
      box-sizing: border-box;
    }

    .timeline-month:before {
      position: absolute;
      content: '';
      width: 20px;
      height: 20px;
      background: rgb(138, 145, 150);
      background: -moz-linear-gradient(top, rgba(138, 145, 150, 1) 0%, rgba(122, 130, 136, 1) 60%, rgba(112, 120, 125, 1) 100%);
      background: -webkit-linear-gradient(top, rgba(138, 145, 150, 1) 0%, rgba(122, 130, 136, 1) 60%, rgba(112, 120, 125, 1) 100%);
      background: linear-gradient(to bottom, rgba(138, 145, 150, 1) 0%, rgba(122, 130, 136, 1) 60%, rgba(112, 120, 125, 1) 100%);
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#8a9196', endColorstr='#70787d', GradientType=0);
      border-radius: 100%;
      border: 1px solid #17191B;
      left: 5px;
    }

    .timeline-section {
      padding-left: 35px;
      display: block;
      position: relative;
      margin-bottom: 30px;
    }

    .timeline-date {
      margin-bottom: 15px;
      padding: 2px 15px;
      background: linear-gradient(#74cae3, #5bc0de 60%, #4ab9db);
      position: relative;
      display: inline-block;
      border-radius: 20px;
      border: 1px solid #17191B;
      color: #fff;
      text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
    }

    .timeline-section:before {
      content: '';
      position: absolute;
      width: 30px;
      height: 1px;
      background-color: #444950;
      top: 12px;
      left: 20px;
    }

    .timeline-section:after {
      content: '';
      position: absolute;
      width: 10px;
      height: 10px;
      background: linear-gradient(to bottom, rgba(138, 145, 150, 1) 0%, rgba(122, 130, 136, 1) 60%, rgba(112, 120, 125, 1) 100%);
      top: 7px;
      left: 11px;
      border: 1px solid #17191B;
      border-radius: 100%;
    }

    .timeline-section .col-sm-4 {
      margin-bottom: 15px;
    }

    .timeline-box {
      position: relative;

      background-color: gainsboro;
      border-radius: 15px;
      border-top-left-radius: 0px;
      border-bottom-right-radius: 0px;
      border: 1px solid #17191B;
      transition: all 0.3s ease;
      overflow: hidden;
    }

    .box-icon {
      position: absolute;
      right: 5px;
      top: 0px;
    }

    .box-title {
      padding: 5px 15px;
      border-bottom: 1px solid wheat;
    }

    .box-title i {
      margin-right: 5px;
    }

    .box-content {
      padding: 5px 15px;
      background-color: white;
    }

    .box-content strong {
      color: black;
      font-style: italic;
      margin-right: 5px;
    }

    .box-item {
      margin-bottom: 5px;
    }

    .box-footer {
      padding: 5px 15px;
      border-top: 1px solid #17191B;
      background-color: #gainsboro;
      text-align: right;
      font-style: italic;
    }

    .select-css {
      display: block;
      font-size: 12px;
      font-family: sans-serif;
      font-weight: 700;
      color: #444;
      line-height: 1.3;
      padding: .6em 1.4em .5em .8em;
      width: 100%;
      max-width: 100%;
      box-sizing: border-box;
      margin: 0;
      border: 1px solid #aaa;
      box-shadow: 0 1px 0 1px rgba(0, 0, 0, .04);
      border-radius: .5em;
      -moz-appearance: none;
      -webkit-appearance: none;
      appearance: none;
      background-color: #fff;
      background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
        linear-gradient(to bottom, #ffffff 0%, #e5e5e5 100%);
      background-repeat: no-repeat, repeat;
      background-position: right .7em top 50%, 0 0;
      background-size: .65em auto, 100%;
    }

    .select-css::-ms-expand {
      display: none;
    }

    .select-css:hover {
      border-color: #888;
    }

    .select-css:focus {
      border-color: #aaa;
      box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7);
      box-shadow: 0 0 0 3px -moz-mac-focusring;
      color: #222;
      outline: none;
    }

    .select-css option {
      font-weight: normal;
    }

    body {
      padding: 3rem;
    }
  </style>
</head>

<body>
  <?php if (empty($timeline2)) {
  } else { ?>
    <div class="container">
      <div class="timeline">
        <div class="timeline-month">
          <?= $curMount ?>, <?= $curYear ?>
          <span><?= count($times); ?> รายการ</span>

        </div>
        <div class="pull-right col-md-8">
          <?php $form = ActiveForm::begin(['action' => ['taskjob/timeline'], 'options' => ['method' => 'post', 'class' => 'form-inline', 'autocomplete' => 'off']]) ?>
          <div class="form-group">
            <div class="dropdown form-group ">
              <select class="select-css" name="years">
                <?php
                foreach ($year_list as $years) {
                  if ($years['task_year'] == ($curYear-543)) {
                    $select1 = "selected";
                  } else {
                    $select1 = "";
                  }
                ?>
                  <option value="<?= $years['task_year'] ?>" <?= $select1 ?>><?= $years['task_year'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="dropdown form-group">
              <select class="select-css" name="month">
                <?php
                foreach ($month_list as $month) {
                  if ($month[1] == $curMount) {
                    $select = "selected";
                  } else {
                    $select = "";
                  }
                ?>
                  <option value="<?= $month[0] ?>" <?= $select ?>><?= $month[1] ?></option>
                <?php
                }
                ?>
              </select>
            </div>

          </div>
          <button type="submit" class="btn btn-info btn-sm">ตกลง</button>
          <label class=" btn-sm btn-primary">งานสารสนเทศ</label>
          <label class=" btn-sm btn-danger ">ประชาสัมพันธ์</label>
          <?php ActiveForm::end(); ?>

        </div>
        <!-- End Time Line-->

        <?php

        foreach ($d_timeline as $dtl) {
          //echo "<br>Date TimeLine : " . $dtl['task_date_start'];
          $datestart = $dtl['task_date_start'];
        ?>

          <div class="timeline-section">
            <div class="timeline-date">
              <?= $dtl['date_name'] . " (" . $dtl['task_date_start'] . ")" ?>
            </div>
            <div class="row">
              <?php
              $count_arr2 = count($timeline2[$datestart]);
              //$amount_arr = substr($count_arr2,0,0);
              $row2 = 0;

              //echo "<br><br><br><br> Count Array".$count_arr2."-----";
              for ($row2 = 0; $row2 < $count_arr2; $row2++) {
                // echo " Job : ".$timeline2[$datestart][$row2]['typej_detail'];


              ?>
                
                <div class="row">
                  <?php
                  $count_arr2 = count($timeline2[$datestart]);
                  //$amount_arr = substr($count_arr2,0,0);
                  $row2 = 0;

                  //echo "<br><br><br><br> Count Array".$count_arr2."-----";
                  for ($row2 = 0; $row2 < $count_arr2; $row2++) {
                    // echo " Job : ".$timeline2[$datestart][$row2]['typej_detail'];


                  ?>
                    <div class="col-sm-4">
                      <div class="timeline-box">
                        <div class="box-title">
                          <i class="fa fa-asterisk text-success" aria-hidden="true"></i> <?= $timeline2[$datestart][$row2]['typej_detail'] ?>
                          <a class="btn btn-xs btn-<?= $timeline2[$datestart][$row2]['tj_color'] ?> pull-right"><?= $timeline2[$datestart][$row2]['tj_org'] ?></a>
                        </div>
                        <div class="box-content">

                          <!--  <div class="box-item"><strong>Loss Type</strong>: A/C Leak</div> -->
                          <div class="box-item"><strong>สถานที่</strong>: <?= $timeline2[$datestart][$row2]['task_location'] ?></div>
                          <div class="box-item"><strong>วันเวลา</strong>: <?= $timeline2[$datestart][$row2]['task_date_start'] . ' ' . $timeline2[$datestart][$row2]['time_start'] ?></div>
                        </div>
                        <?php
                        $assign_user = TaskJob::getAssignuser2($timeline2[$datestart][$row2]['task_id']);
                        $username = "";
                        $i = 1;
                        foreach ($assign_user as $assign_rs) {
                          $username = $username . "<br> (" . $i . ")" . $assign_rs['user_name'];
                          $i++;
                        }
                        ?>
                        <div class="box-footer">
                          - ผู้ได้รับมอบหมาย: <?= $username ?></div>
                      </div>
                    </div>

                  <?php
                  }
                  ?>
                </div>
            </div>
          <?php
              }
          ?>

          </div>
        <?php } ?>
      </div>
    </div>

  <?php }  ?>
</body>

</html>