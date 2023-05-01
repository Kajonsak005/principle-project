<?php

/** @var yii\web\View $this */
use yii\bootstrap5\Modal;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

$this->title = 'My Yii Application';
$this->registerJs("
    function padZero(num) {
        return (num < 10 ? '0' : '') + num;
    }
    function myFunction() {
        var now = new Date();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var myElement = document.getElementById('time');
        myElement.textContent = 'เวลาจอง '+padZero(hour)+':'+padZero(minute)+' น.';
    }
    setInterval(myFunction, 1000);
", View::POS_READY);
?>
<div class="site-index">
    <div class="body-content">
        <div class="d-flex justify-content-between" style="height: 125px;">
            <div>
                <h1>Zone <?=$model->zone?></h1>
            </div>
            <div class="text-right" style="align-self: end;">
                <h5>พื้นที่ทั้งหมด</h5>
                <h6><?=$model->available_now?>/<?=$model->available?></h6>
            </div>
        </div>
        <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
        ]); ?>

        <div id="time" class="text-center">เวลาจอง 00:00 น.</div>
        <br />
        <div class="text-center">ค่าบริการต่อชั่วโมง 50 บาท</div>
        <br />
        <div class="form-group text-center">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('จอง', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>