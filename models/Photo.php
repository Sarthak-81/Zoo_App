<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Photo extends ActiveRecord
{
    public static function tableName()
    {
        return 'photo';
    }

    // Method to retrieve photos associated with a specific object (zoo or Animal)
    public function findPhotosByObject($objectType, $objectId)
    {
        $sql = "SELECT * FROM photo WHERE object_type = :objectType AND object_id = :objectId";
        $params = [':objectType' => $objectType, ':objectId' => $objectId];
        $photos = Yii::$app->db->createCommand($sql, $params)->queryAll();

        return $photos;
    }
}
