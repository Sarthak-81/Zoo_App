<?php

namespace app\models;

use DateTime;
use yii\db\ActiveRecord;

/**
 * Class AnimalS
 *
 * @property int $id
 * @property string $Entity_Type
 * @property int $Name
 * @property int $entity_id
 * @property string $Reason
 * @property datetime $Archive_Date
 * 
 */

class Archive extends ActiveRecord
{
    public $Entity_Type;
    public $Name;
    public $Reason;

    public static function tableName()
    {
        return 'archive';
    }

    public function rules()
    {
        return [
            [['Entity_Type', 'Name', 'Reason', 'Archive_Date'], 'required'],
            [['Entity_Type', 'Name', 'Reason'], 'string', 'max' => 255],
        ];
    }
}
