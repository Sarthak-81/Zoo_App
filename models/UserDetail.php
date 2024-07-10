<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_details".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 */
class UserDetail extends ActiveRecord
{
    public static function tableName()
    {
        return 'Users';
    }

    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['name', 'email', 'password'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['email'], 'unique'],
        ];
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function validatePassword($password)
    {
        return $this->password = $password;
    }
}
