<?php

namespace app\models;
use Yii;
use DateTime;
use yii\db\ActiveRecord;

/**
 * Class AnimalS
 *
 * @property int $id
 * @property string $name
 * @property int $from_zoo_id
 * @property int $to_zoo_id
 * @property string $reason
 * @property datetime $transfer_date
 * 
 */

class History extends ActiveRecord
{
    public $name;
    public $animal_id;
    public $from_zoo_id;
    public $to_zoo_id;
    public $reason;
    public $transfer_date;

    public static function tableName()
    {
        return 'transfer_history';
    }

    public function attributeLabels()
    {
        return[
            'name' => 'Name',
            'reason' => 'Reason',
            'from_zoo_id' => 'From Zoo',
            'to_zoo_id' => 'To Zoo', 
            'transfer_date' => 'Transfer Date'
        ];
    }

    public function rules()
    {
        return [
            [['name', 'animal_id', 'from_zoo_id', 'to_zoo_id', 'reason', 'transfer_date'], 'required'],
            [['name', 'reason', 'from_zoo_id', 'to_zoo_id'], 'string', 'max' => 255],
            ['transfer_date', 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    public static function getAllZoos()
    {
        return Yii::$app->db->createCommand("SELECT id, name FROM zoo;")->queryAll();
    }
}
