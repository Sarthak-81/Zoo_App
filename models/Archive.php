<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Archive extends ActiveRecord
{
    public $entity_type;
    public $name;
    public $reason;
    public $zoo_id;
    public $animal_id;

    public static function tableName()
    {
        return 'archive';
    }

    public function attributeLabels()
    {
        return[
           'entity_type' => 'Entity Type',
           'name' => 'Name',
           'reason' => 'Reason',
           'zoo_id' => 'Zoo',
           'animal_id' => 'Animal',
        ];
    }

    public function rules()
    {
        return [
            [['entity_type', 'name', 'reason'], 'required'],
            [['entity_type', 'name', 'reason'], 'string', 'max' => 255],
            [['zoo_id', 'animal_id'], 'integer'],
        ];
    }

    // public static function getAllAnimals()
    // {
    //     $sql = "SELECT id, name from animal";
    //     return Yii::$app->db->createCommand($sql)->queryAll();
    // }
}