<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CarPark $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="car-park-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'available')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'available_now')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
