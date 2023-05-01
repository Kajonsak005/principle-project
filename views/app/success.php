<?php

/** @var yii\web\View $this */
use yii\bootstrap5\Modal;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <h1 class="w-100 text-center">จองสำเร็จ</h1>
        <br />
        <div class="d-flex justify-content-between" style="padding:0px 30px; margin-bottom: 10px;">
            <div>
                เวลาที่จอง
            </div>
            <div class="text-right" style="align-self: end;">
                <?= $model->create_time ?>
            </div>
        </div>
        <div class="d-flex justify-content-between" style="padding:0px 30px">
            <div>
                เวลาหมดอายุ
            </div>
            <div class="text-right" style="align-self: end;">
                <?= $model->exit_time ?>
            </div>
        </div>

        <div class="text-center"><img src="<?=$qrCode?>" alt=""></div>

        <h3 class="text-center">โปรดแสดง QR code ณ ที่จอด</h3>
        <div class="justify-content-center d-flex" style="gap: 15px">
            <?php
                Modal::begin([
                    'title' => 'ชำระเงิน',
                    'toggleButton' => ['label' => 'ชำระเงิน','class' => "btn btn-success mt-3"],
                    'class'=> 'btn btn-success mt-3'
                ]);
                
                $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                        'inputOptions' => ['class' => 'col-lg-3 form-control'],
                        'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                    ],
                ]);

                echo Html::submitButton('ยื่นยันการชำระ', ['class' => 'btn btn-primary mt-3', 'name' => 'login-button']);

                ActiveForm::end();

                Modal::end();
            ?>
            <a href="<?= \yii\helpers\Url::to(['index']) ?>" class="btn btn-primary mt-3">กลับหน้าหลัก</a>
        </div>
    </div>
</div>
</div>