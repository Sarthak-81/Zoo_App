<?php

namespace app\models;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $name;
    public $password;
    public $email;

    public function rules()
    {
        return 
        [
            [["name", "password"], "required"],
            ["password", "validatePassword"]
        ];
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) 
        {
            $user = $this->getUser();
            if (!$user || $this->password !== $user['password']) 
            {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function getUser()
    {
        $user = Yii::$app->db->createCommand("SELECT * FROM users WHERE name = :name")
        ->bindValue(':name', $this->name)
        ->queryOne(); 
        return $user;
    }

    public function login()
    {
        if ($this->validate()) 
        {
            Yii::$app->session->set('name', $this->name);
            Yii::$app->session->set('email', $this->email);
            return true; 
        }
        return false;
    }
}