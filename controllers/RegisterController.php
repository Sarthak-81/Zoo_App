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
                        'editzoo', 'editanimal', 'addinzoo', 'deletezoo', 'archiveanimal', 'archivezoo'
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

            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl('http://localhost:8080/signup')
                ->setFormat(Client::FORMAT_JSON)
                ->setData([
                    'name' => $model->name,
                    'email' => $model->email,
                    'password' => $model->password,
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

    public function actionAddinzoo($id)
    {
        $model = new Animal();

        $zoo = Yii::$app->db->createCommand("SELECT * FROM zoo where id = :id")
            ->bindValue(':id', $id)
            ->queryOne();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $client = new Client();
            $url = "http://localhost:8080/animal/addinzoo/{$id}";
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl($url)
                ->setFormat(Client::FORMAT_JSON)
                ->setData([
                    'name' => $model->name,
                    'gender' => $model->gender,
                    'species' => $model->species,
                ])
                ->send();
            if ($response->isOk) {
                return $this->redirect(['viewzoo']);
            } else {
                echo "Some error" . $response->statusCode;
            }
        }
        return $this->render('event/addanimalinzoo', [
            'model' => $model,
            'zoo' => $zoo
        ]);
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
        return $this->render('event/animalform', [
            'model' => $model,
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
                return $this->redirect(['viewzoo']);
            } else {
                Yii::$app->session->setFlash('Some error occurred');
            }
        }
        return $this->render('event/editzoo', [
            'model' => $model,
        ]);
    }

    public function actionManagehistory($id)
    {
        $animal = Yii::$app->db->createCommand('SELECT name FROM animal where id = :id')
            ->bindValue(':id', $id)
            ->queryOne();

        $zoo = Yii::$app->db->createCommand('SELECT z.name AS zoo_name FROM animal a JOIN zoo z ON a.zoo_id = z.id where a.id = :id')
            ->bindValue(':id', $id)
            ->queryOne();

        $model = new History();
        $model->name = $animal['name'];
        $model->from_zoo_id = $zoo['zoo_name'];

        if ($model->load(Yii::$app->request->post())) {
            $client = new Client();
            $url = "http://localhost:8080/history/add/{$id}";
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl($url)
                ->setFormat(Client::FORMAT_JSON)
                ->setData([
                    'id' => $model->id,
                    'name' => $model->name,
                    'reason' => $model->reason,
                    'fromZooName' => $model->from_zoo_id,
                    'toZooName' => $model->to_zoo_id,
                    'transferDate' => $model->transfer_date,
                    'animalID' => $id,
                ])
                ->send();
            if ($response->isOk) {
                return $this->redirect(['viewhistory']);
            } else {
                echo "Some error" . $response->statusCode;
            }
        }
        return $this->render('event/transferform', [
            'model' => $model,
        ]);
    }

    public function actionArchiveanimal($id)
    {
        $animal = Yii::$app->db->createCommand('SELECT name FROM animal WHERE id = :id')
            ->bindValue(':id', $id)
            ->queryOne();

        $model = new Archive();
        $model->name = $animal['name'];

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $client = new Client();
            $url = "http://localhost:8080/archive/addanimal/{$id}";
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setFormat(Client::FORMAT_JSON)
                ->setUrl($url)
                ->setData(
                    [
                        'id' => $model->id,
                        'entity_type' => $model->entity_type,
                        'name' => $model->name,
                        'reason' => $model->reason,
                        'animalId' => $id,
                        'zooId' => null
                    ]
                )
                ->send();
            if ($response->isOk) {
                return $this->redirect(['user']);
            } else {
                Yii::$app->session->setFlash("Some error occurred") . $response->statusCode;
            }
        }
        return $this->render('event/archiveformanimal', [
            'model' => $model,
        ]);
    }
    
    public function actionArchivezoo($id)
    {
        $zoo = Yii::$app->db->createCommand('SELECT name FROM zoo where id = :id')
            ->bindValue(':id', $id)
            ->queryOne();

        $model = new Archive();
        $model->name = $zoo['name'];
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $client = new Client();
            $url = "http://localhost:8080/archive/addzoo/{$id}";
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setFormat(Client::FORMAT_JSON)
                ->setUrl($url)
                ->setData(
                    [
                        'id' => $model->id,
                        'entity_type' => $model->entity_type,
                        'name' => $model->name,
                        'reason' => $model->reason,
                        'animalId' => null,
                        'zooId' => $id,
                    ]
                )
                ->send();
            if ($response->isOk) {
                return $this->redirect(['user']);
            } else {
                Yii::$app->session->setFlash("Some error occurred") . $response->statusCode;
            }
        }
        return $this->render('event/archiveform', [
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

    public function actionViewanimal()
    {
        $animals = Yii::$app->db->createCommand("SELECT * FROM animal")->queryAll();
        foreach ($animals as &$animal) {
            $photos = Yii::$app->db->createCommand("SELECT * FROM photo WHERE object_type = 'animal' AND object_id = :animal_id")
                ->bindValue(':animal_id', $animal['id'])
                ->queryAll();

            // Assign photos to each animal
            $animal['photos'] = $photos;

            // Fetching zoo information
            $zoo = Yii::$app->db->createCommand("SELECT * FROM zoo WHERE id = :zoo_id")
                ->bindValue(':zoo_id', $animal['zoo_id'])
                ->queryOne();
            // Assigning zoo information to each animal
            $animal['zoo'] = $zoo;
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
            Yii::$app->db->createCommand('UPDATE animal SET Name = :name WHERE id = :id')
                ->bindValue(':name', $animal->name)
                ->bindValue(':id', $id)
                ->execute();
            return $this->redirect(['viewanimal']);
        }
        return $this->render('event/editanimal', ['animal' => $animal]);
    }
}
