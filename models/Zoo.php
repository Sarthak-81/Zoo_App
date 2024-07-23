<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

// ActiveRecord is a Model that uses a database engine to store the model(s) data.
// yii\base\Model is a Model that does not specify how the data is being stored.

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
    public static function tableName()
    {
        return 'zoo'; 
    }

    public function rules()
    {
        return [
            [['name', 'location', 'phone_no', 'description'], 'required'],
            [['name', 'location', 'phone_no', 'description'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'location' => 'Location',
            'phone_no' => 'Phone no',
            'description' => 'Description',
        ];
    }   

}
