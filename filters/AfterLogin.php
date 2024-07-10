<?php
namespace app\filters;

use Yii;
use yii\base\ActionFilter;

class AfterLogin extends ActionFilter
{
    public function beforeAction($action) 
    {
        Yii::$app->controller->layout = 'successlayout';
        if(!Yii::$app->session->get('isLoggedIn'))
        {
            Yii::$app->getResponse()->redirect(['register/login'])->send();
            return false;
        }
        return parent::beforeAction($action);
    }
}