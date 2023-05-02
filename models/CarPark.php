<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car_park".
 *
 * @property int $id
 * @property string|null $available
 * @property string|null $available_now
 * @property string|null $zone
 * @property string|null $status
 */
class CarPark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_park';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['available', 'available_now', 'zone', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'available' => 'Available',
            'available_now' => 'Available Now',
            'zone' => 'Zone',
            'status' => 'Status',
        ];
    }

    function Decrement(){
        $this->available_now = strval(intval($this->available_now)-1);
        $this->save();
    }

    function Increment(){
         $this->available_now = strval(intval($this->available_now)+1);
    }
}