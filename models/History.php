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
    public $Animal;
    public $animal_id;
    public $From_zoo_id;
    public $To_zoo_id;
    public $Reason;
    public $Transfer_Date;

    public static function tableName()
    {
        return 'Transfer_History';
    }

    public function rules()
    {
        return [
            [['Animal', 'animal_id', 'From_zoo_id', 'To_zoo_id', 'Reason', 'Transfer_Date'], 'required'],
            [['Animal', 'Reason'], 'string', 'max' => 255],
            [['Transfer_Date'], 'datetime', 'format' => 'yyyy-MM-dd'],
        ];
    }
}
