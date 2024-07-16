<?php

namespace app\models;

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
    public $Transfer_Date;

    public static function tableName()
    {
        return 'transfer_history';
    }

    public function rules()
    {
        return [
            [['name', 'animal_id', 'from_zoo_id', 'to_zoo_id', 'reason', 'Transfer_Date'], 'required'],
            [['name', 'reason'], 'string', 'max' => 255],
            [['Transfer_Date'], 'datetime', 'format' => 'yyyy-MM-dd'],
        ];
    }
}
