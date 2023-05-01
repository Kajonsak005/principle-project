<?php

/** @var yii\web\View $this */
use yii\bootstrap5\Modal;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="d-flex justify-content-between">
            <div>
                <img src="/icon/profile.svg" alt="">
                <h4>ชื่อ <?= Yii::$app->user->identity->username ?></h4>
            </div>
            <div class="text-right">
                <h4>เงินในระบบ: <?= number_format((Yii::$app->user->identity->money)) ?></h4>
                <?php
                    Modal::begin([
                        'title' => 'เติมเงินเข้าสู่ระบบ',
                        'toggleButton' => ['label' => 'เติมเงิน','class' => "btn btn-success mt-3"],
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

                    echo $form->field($model, 'money', ['options' => ['class' => 'text-left']])->textInput(['autofocus' => true]);

                    echo Html::submitButton('Confirm', ['class' => 'btn btn-primary mt-3', 'name' => 'login-button']);

                    ActiveForm::end();

                    Modal::end();
                ?>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="<?= \yii\helpers\Url::to(['/app/car-park']) ?>" class="btn btn-success">จอง ที่จอดรถ</a>
        </div>
    </div>
</div>