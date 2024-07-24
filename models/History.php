<?php

namespace app\models;
use Yii;
use DateTime;
use yii\db\ActiveRecord;

/**
 * Class AnimalS
 *
 * @property int $id
 * @property string $Animal
 * @property int $From_zoo_id
 * @property int $To_zoo_id
 * @property string $Reason
 * @property datetime $Transfer_Date
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
            'from_zoo_id' => 'From',
            'to_zoo_id' => 'To', 
            'transfer_date' => 'Transfer Date'
        ];
    }

    public function rules()
    {
        return [
            [['name', 'animal_id', 'from_zoo_id', 'to_zoo_id', 'reason', 'transfer_date'], 'required'],
            [['name', 'reason'], 'string', 'max' => 255],
            [['transfer_date'], 'datetime', 'format' => 'yyyy-MM-dd'],
        ];
    }

    public static function getAllZoos()
    {
        $sql = "SELECT id, name FROM zoo";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }
}
