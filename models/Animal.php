<?php

namespace app\models;

use Yii;
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
    public $name;
    public $gender;
    public $species;
    public $zoo_id;

    public static function tableName()
    {
        return 'animal';
    }

    public function rules()
    {
        return [
            [['name', 'gender', 'species'], 'required'],
            [['name', 'gender', 'species'], 'string', 'max' => 255],
            [['zoo_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return[
            'id' => 'ID',
            'name' => 'Name',
            'gender' => 'Gender',
            'species' => 'Species',
            'zoo_id' => 'Zoo',
        ];
    }

    public static function getAllZoos()
    {
        $sql = "SELECT id, name FROM zoo";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public function getZoo()
    {
        $sql = "SELECT * FROM zoo WHERE id = :zoo_id";
        $params = [':zoo_id' => $this->zoo_id];
        return Yii::$app->db->createCommand($sql, $params)->queryOne();
    }

}

