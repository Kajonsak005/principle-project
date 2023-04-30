<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CarPark $model */

$this->title = Yii::t('app', 'Create Car Park');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Car Parks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-park-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
