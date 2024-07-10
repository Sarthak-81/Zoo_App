<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\LoginForm;
use app\models\Zoo;
use app\models\Animal;
use app\models\History;
use app\filters\BeforeLogin;
use app\filters\AfterLogin;
use yii\web\NotFoundHttpException;

class RegisterController extends Controller
{
    public $layout = 'custom';
    public function behaviors()
    {
        return
            [
                'BeforeLogin' =>
                [
                    'class' => BeforeLogin::class,
                    'only' => ['login', 'index', 'about', 'contact', 'signup', 'category'],
                ],
                'AfterLogin' =>
                [
                    'class' => AfterLogin::class,
                    'only' => ['logout', 'user', 'profile', 'viewzoo', 'viewanimal', 'addzoo', 'addanimal', 'managehistory', 'viewhistory'],
                ],
            ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->redirect(['register/login']);
        }
        return $this->render('signup', ['model' => $model]);
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->set('isLoggedIn', true);
            return $this->redirect(['register/user']);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionUser()
    {
        return $this->render('user');
    }

    public function actionProfile()
    {
        return $this->render('profile');
    }

    public function actionLogout()
    {
        Yii::$app->session->destroy();
        return $this->redirect(['/']);
    }

    public function actionCategory()
    {
        return $this->render('category');
    }

    // Events..............................

    public function actionAddzoo()
    {
        $model = new Zoo();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $sql = "INSERT INTO Zoo (Name, Location, Phone_no, Description)
                    VALUES (:Name, :Location, :Phone_no, :Description)";

            $params = [
                ':Name' => $model->Name,
                ':Location' => $model->Location,
                ':Phone_no' => $model->Phone_no,
                ':Description' => $model->Description,
            ];

            Yii::$app->db->createCommand($sql, $params)->execute();
            return $this->redirect(['viewzoo']);
        }

        return $this->render('event/addzoo', [
            'model' => $model,
        ]);
    }

    public function actionAddanimal()
    {
        $model = new Animal();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $sql = "INSERT INTO Animal (Name, zoo_id, Gender, Species, Arrival_Date)
            VALUES (:Name, :zoo_id, :Gender, :Species, :Arrival_Date)";

            $params = [
                'Name' => $model->Name,
                'zoo_id' => $model->zoo_id,
                'Gender' => $model->Gender,
                'Species' => $model->Species,
                'Arrival_Date' => $model->Arrival_Date,
            ];

            Yii::$app->db->createCommand($sql, $params)->execute();
            return $this->redirect(['viewanimal']);
        }

        return $this->render('event/addanimal', [
            'model' => $model,
        ]);
    }

    public function actionTest()
    {
        return $this->render('test');
    }

    public function actionManagehistory()
    {
        $model = new History();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $sql = "INSERT INTO Transfer_History (Animal, animal_id, From_zoo_id, To_zoo_id, Reason, Transfer_Date)
        VALUES (:Animal, :animal_id, :From_zoo_id, :To_zoo_id, :Reason, :Transfer_Date)";

            $params = [
                'Animal' => $model->Animal,
                'animal_id' => $model->animal_id,
                'From_zoo_id' => $model->From_zoo_id,
                'To_zoo_id' => $model->To_zoo_id,
                'Reason' => $model->Reason,
                'Transfer_Date' => $model->Transfer_Date,
            ];
            Yii::$app->db->createCommand($sql, $params)->execute();
            return $this->redirect(['viewhistory']);
        }
        return $this->render('event/managehistory', [
            'model' => $model,
        ]);
    }

    public function actionViewzoo()
    {
        $zoos = Yii::$app->db->createCommand("SELECT * FROM Zoo")->queryAll();
        return $this->render('event/viewzoo', [
            'zoos' => $zoos,
        ]);
    }

    public function actionViewanimal()
    {
        $animals = Yii::$app->db->createCommand("SELECT * FROM Animal")->queryAll();
        return $this->render('event/viewanimal', [
            'animals' => $animals,
        ]);
    }

    public function actionViewhistory()
    {
        $transferHistories = Yii::$app->db->createCommand("SELECT * FROM Transfer_History")->queryAll();
        $query = new Query();
        $transferHistories = $query->select('*')
            ->from('Transfer_History')
            ->all();
        return $this->render('event/viewhistory', [
            'transferHistories' => $transferHistories
        ]);
    }


    //Pending.............
    public function actionEditzoo($id)
    {
        $sql = "SELECT * FROM Zoo WHERE id = :id";
        $zoo = Yii::$app->db->createCommand($sql, [':id' => $id])->queryOne();
        if (!$zoo) {
            throw new NotFoundHttpException("The requested Zoo does not exist. Try again");
        }
        return $this->render('event/editzoo', [
            'zoo' => $zoo,
        ]);
    }
}
