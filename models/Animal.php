<?php

namespace app\models;

use DateTime;
use yii\db\ActiveRecord;

/**
 * Class AnimalS
 *
 * @property int $id
 * @property string $Name
 * @property int $zoo_id
 * @property string $Gender
 * @property string $Species
 * @property datetime $Arrival_Date
 * 
 */

class Animal extends ActiveRecord
{
    public $Name;
    public $zoo_id; 
    public $Gender;
    public $Species;
    public $Arrival_Date;

    public static function tableName()
    {
        return 'animal';
    }

    public function rules()
    {
        return [
            [['Name', 'zoo_id', 'Gender', 'Species', 'Arrival_Date'], 'required'],
            [['Name', 'Gender', 'Species'], 'string', 'max' => 255],
            [['Arrival_Date'], 'datetime', 'format' => 'yyyy-MM-dd'],
        ];
    }
}
