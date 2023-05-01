<?php

/** @var yii\web\View $this */
use yii\bootstrap5\Modal;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="d-flex justify-content-between" style="height: 125px;">
            <div>
                <h1>ระบบจองที่จอดรถ</h1>
            </div>
            <div class="text-right" style="align-self: end;">
                <h5>พื้นที่ทั้งหมด</h5>
                <h6><?=$parkAll["available_now"]?>/<?=$parkAll["available"]?></h6>
            </div>
        </div>
        <h3>เลือก Zone</h3><br />

        <?php 
            foreach($model as $value){
                echo 
                 '<div class="d-flex align-items-center justify-content-between" style="padding: 0px 50px; margin-bottom: 10px;"><a href="'.\yii\helpers\Url::to(["/app/zone","id" => $value->id]).'"class="btn
        btn-success">Zone '.$value->zone.'</a>
        <div>ว่าง '.$value->available_now.'/'.$value->available.' คัน</div>
    </div>';
    }

    ?>
    </div>
</div>
</div>