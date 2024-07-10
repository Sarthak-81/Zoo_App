<?php

namespace app\models;
use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            ['email', 'email'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6],
        ];
    }
   public function signup()
    {
            $user = new UserDetail();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->setPassword($this->password);
            Yii::$app->session->set('name', $this->name);
            Yii::$app->session->set('email', $this->email);
            Yii::$app->session->set('password', $this->password);
        return $user->save() ? $user : null;
    }
}