<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property string|null $user_id
 * @property string|null $car_park_id
 * @property string|null $payment_status
 * @property string|null $create_time
 * @property string|null $exit_time
 */
class Booking extends \yii\db\ActiveRecord
{

    public $paid = "paid";
    public $wait = "wait";

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time', 'exit_time'], 'safe'],
            [['user_id', 'car_park_id', 'payment_status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'car_park_id' => 'Car Park ID',
            'payment_status' => 'Payment Status',
            'create_time' => 'Create Time',
            'exit_time' => 'Exit Time',
        ];
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $model = CarPark::findOne($this->car_park_id);
            $model->decrement();
            return true;
        } else {
            return false;
        }
    }

}