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
    public $Name;
    public $Location;
    public $Phone_no;
    public $Description;
    public static function tableName()
    {
        return 'zoo'; 
    }

    public function rules()
    {
        return [
            [['Name', 'Location', 'Phone_no', 'Description'], 'required'],
            [['Name', 'Location', 'Phone_no', 'Description'], 'string', 'max' => 255],
        ];
    }

    public function getPhotos()
    {
        $sql = "SELECT * FROM photo WHERE object_type = 'zoo' AND object_id = :zooId";
        $params = [':zooId' => $this->id];
        $photos = Yii::$app->db->createCommand($sql, $params)->queryAll();

        return $photos;
    }
}
