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
  </style>
</head>

<body>
    <?php if(empty($timeline2)){}else{ ?>
  <div class="container">
    <div class="timeline">
      <div class="timeline-month">
        <?=$curMount?>, <?=$curYear?>
        <span><?=count($times);?> รายการ</span>
      </div>
      <!-- End Time Line-->
      <?php

      foreach ($d_timeline as $dtl) {
        //echo "<br>Date TimeLine : " . $dtl['task_date_start'];
        $datestart = $dtl['task_date_start'];
        ?>

        <div class="timeline-section">
          <div class="timeline-date">
            <?=$dtl['date_name']." (".$dtl['task_date_start'].")"?>
          </div>
          <div class="row">
          <?php
          $count_arr2 = count($timeline2[$datestart]);
          //$amount_arr = substr($count_arr2,0,0);
          $row2 = 0;
          
          //echo "<br><br><br><br> Count Array".$count_arr2."-----";
          for($row2 = 0; $row2 < $count_arr2;$row2++ ){
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
                <div class="box-footer">- ผู้ได้รับมอบหมาย</div>
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
  </div>
    <?php } ?>
</body>

</html>