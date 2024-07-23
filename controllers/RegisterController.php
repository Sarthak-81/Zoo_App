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
use app\models\Archive;
use app\filters\BeforeLogin;
use app\filters\AfterLogin;
use yii\httpclient\Client;
use yii\helpers\Url;

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
                    'only' =>
                    [
                        'logout', 'user', 'profile', 'viewzoo', 'viewanimal', 'addzoo', 'addanimal', 'managehistory', 'viewhistory', 'archive', 'viewarchive',
                        'editzoo', 'editanimal', 'viewinzoo', 'addinzoo', 'deletezoo'
                    ],
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

            $name = $model->name;
            $email = $model->email;
            $password = $model->password;

            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl('http://localhost:8080/signup')
                ->setFormat(Client::FORMAT_JSON)
                ->setData([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                ])
                ->send();
            if ($response->isOk) {
                return $this->redirect(['register/login']);
            } else {
                echo "Some error" . $response->statusCode;
            }
        }
        return $this->render('signup', ['model' => $model]);
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->set('isLoggedIn', true);

            $name = $model->name;
            $password = $model->password;

            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl('http://localhost:8080/login')
                ->setFormat(Client::FORMAT_JSON)
                ->setData([
                    'name' => $name,
                    'password' => $password,
                ])
                ->send();
            if ($response->isOk) {
                return $this->redirect(['register/user']);
            } else {
                echo "Some error" . $response->statusCode;
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    // curl -X POST http://localhost:8080/login -H "Content-Type: application/json" -d '{"username":"Sarthak","password":"123456"}'

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
        return $this->redirect(['register/index']);
    }

    public function actionCategory()
    {
        return $this->render('category');
    }

    // Events..............................

    // Zoo
    public function actionAddzoo()
    {
        $model = new Zoo();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl('http://localhost:8080/zoo/add')
                ->setFormat(Client::FORMAT_JSON)
                ->setData([
                    'name' => $model->name,
                    'location' => $model->location,
                    'phone_no' => $model->phone_no,
                    'description' => $model->description
                ])
                ->send();
            if ($response->isOk) {
                return $this->redirect(['viewzoo']);
            } else {
                echo "Some error" . $response->statusCode;
            }
        }
        return $this->render('event/addzoo', [
            'model' => $model,
        ]);
    }

    public function actionViewzoo()
    {
        $zoos = Yii::$app->db->createCommand("SELECT * FROM zoo")->queryAll();
        return $this->render('event/viewzoo', [
            'zoos' => $zoos,
        ]);
    }

    public function actionEditzoo($id)
    {
        $zoo = Yii::$app->db->createCommand('SELECT * FROM zoo WHERE id = :id')
            ->bindValue(':id', $id)
            ->queryOne();

        $model = new Zoo();
        $model->setAttributes($zoo);

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {

            $client = new Client();
            $url = "http://localhost:8080/zoo/update/{$id}";
            $response = $client->createRequest()
                ->setMethod('PUT')
                ->setFormat(Client::FORMAT_JSON)
                ->setUrl($url)
                ->setData([
                    'id' => $model->id,
                    'name' => $model->name,
                    'location' => $model->location,
                    'phone_no' => $model->phone_no,
                    'description' => $model->description
                ])
                ->send();
            if ($response->isOk) {
                Yii::$app->session->setFlash('success', 'Zoo updated');
                return $this->redirect(['viewzoo']);
            }else{
                Yii::$app->session->setFlash('Some error occurred');    
            }
        }
        return $this->render('event/editzoo', [
            'model' => $model,
        ]);
    }

    public function actionDeletezoo($id)
    {
        $client = new Client();
        $url = "http://localhost:8080/zoo/delete/{$id}";
        $response = $client->createRequest()
            ->setMethod('DELETE')
            ->setUrl($url)
            ->send();
        if ($response->isOk) {
            return $this->redirect(['viewzoo']);
        } else {
            echo "Some error" . $response->statusCode;
        }
    }

    public function actionAddanimal()
    {
        $model = new Animal();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl('http://localhost:8080/animal/add')
                ->setFormat(Client::FORMAT_JSON)
                ->setData([
                    'name' => $model->name,
                    'gender' => $model->gender,
                    'species' => $model->species,
                    'zooId' => $model->zoo_id,
                ])
                ->send();

            if ($response->isOk) {
                return $this->redirect(['viewanimal']);
            } else {
                echo "Some error" . $response->statusCode;
            }
        }
        return $this->render('event/addanimal', [
            'model' => $model,
        ]);
    }


    public function actionManagehistory()
    {
        $model = new History();
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl('http://localhost:8080/history/add')
                ->setFormat(Client::FORMAT_JSON)
                ->setData([
                    'name' => $model->name,
                    'reason' => $model->reason,
                    
                ])
                ->send();
            if($response->isOk){
                return $this->redirect(['viewhistory']);
            }else{
                echo "Some error" . $response->statusCode;
            }
        }
        return $this->render('event/managehistory', [
            'model' => $model,
        ]);
    }

    public function actionViewarchive()
    {
        $archive = Yii::$app->db->createCommand("SELECT * FROM archive")->queryAll();
        return $this->render('event/viewarchive', [
            'archive' => $archive,
        ]);
    }

    public function actionArchive()
    {
        $model = new Archive();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            $name = $model->Name;
            $reason = $model->Reason;
            $entity_type = $model->Entity_Type;

            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl('http://localhost:8080/archive/add')
                ->setFormat(Client::FORMAT_JSON)
                ->setData([
                    'name' => $name,
                    'reason' => $reason,
                    'entity_type' => $entity_type,
                ])
                ->send();
                if($response->isOk)
                {
                    return $this->redirect(['viewarchive']);
                }
        }
        return $this->render('event/archive', [
            'model' => $model,
        ]);
    }


    public function actionViewanimal()
    {
        $animals = Yii::$app->db->createCommand("SELECT * FROM animal")->queryAll();
        foreach ($animals as &$animal) {
            $photos = Yii::$app->db->createCommand("SELECT * FROM photo WHERE object_type = 'animal' AND object_id = :animal_id")
                ->bindValue(':animal_id', $animal['id'])
                ->queryAll();

            // Assign photos to each animal
            $animal['photos'] = $photos;
        }
        return $this->render('event/viewanimal', [
            'animals' => $animals,
        ]);
    }

    public function actionViewhistory()
    {
        $transferHistories = Yii::$app->db->createCommand("SELECT * FROM transfer_history")->queryAll();
        $query = new Query();
        $transferHistories = $query->select('*')
            ->from('transfer_history')
            ->all();
        return $this->render('event/viewhistory', [
            'transferHistories' => $transferHistories
        ]);
    }

    // EDIT.........................................

    public function actionEditanimal($id)
    {
        $animalData = Yii::$app->db->createCommand('SELECT * FROM animal WHERE id = :id')
            ->bindValue(':id', $id)
            ->queryOne();
        $animal = new Animal();
        $animal->attributes = $animalData;
        if (Yii::$app->request->isPost && $animal->load(Yii::$app->request->post())) {
            Yii::$app->db->createCommand('UPDATE animal SET Name = :Name WHERE id = :id')
                ->bindValue(':Name', $animal->Name)
                ->bindValue(':id', $id)
                ->execute();
            return $this->redirect(['viewanimal']);
        }
        return $this->render('event/editanimal', ['animal' => $animal]);
    }

    public function actionViewinzoo($id)
    {
        return $this->render('event/viewinzoo');
    }

    public function actionAddinzoo($id)
    {
        return $this->redirect(['addanimal']);
    }
}
