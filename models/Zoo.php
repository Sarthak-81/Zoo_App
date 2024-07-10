<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class Zoo
 *
 * @property int $id
 * @property string $Name
 * @property string $Location
 * @property string $Phone_no
 * @property string $Description
 */
class Zoo extends ActiveRecord
{
    public $Name;
    public $Location;
    public $Phone_no;
    public $Description;
    public static function tableName()
    {
        return 'Zoo'; 
    }

    public function rules()
    {
        return [
            [['Name', 'Location', 'Phone_no', 'Description'], 'required'],
            [['Name', 'Location', 'Phone_no', 'Description'], 'string', 'max' => 255],
        ];
    }

}
