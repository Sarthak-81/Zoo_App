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
                    ['logout', 'user', 'profile', 'viewzoo', 'viewanimal', 'addzoo', 'addanimal', 'managehistory', 'viewhistory', 'archive', 'viewarchive',
                     'editzoo', 'editanimal', 'viewinzoo', 'addinzoo'
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

    public function actionAddzoo()
    {
        $model = new Zoo();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $sql = "INSERT INTO zoo (Name, Location, Phone_no, Description)
                    VALUES (:Name, :Location, :Phone_no, :Description)";

            $params = [
                ':Name' => $model->Name,
                ':Location' => $model->Location,
                ':Phone_no' => $model->Phone_no,
                ':Description' => $model->Description,
            ];

            Yii::$app->db->createCommand($sql, $params)->execute();

            $name = $model->Name;
            $location = $model->Location;
            $phone_no = $model->Phone_no;
            $description = $model->Description;

            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl('http://localhost:8080/zoo/add')
                ->setFormat(Client::FORMAT_JSON)
                ->setData([
                    'name' => $name,
                    'location' => $location,
                    'phone no' => $phone_no,
                    'description' => $description
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

    public function actionAddanimal()
    {
        $model = new Animal();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $sql = "INSERT INTO animal (Name, Gender, Species)
            VALUES (:Name, :Gender, :Species)";

            $params = [
                'Name' => $model->Name,
                'Gender' => $model->Gender,
                'Species' => $model->Species,
            ];

            Yii::$app->db->createCommand($sql, $params)->execute();

            $name = $model->Name;
            $gender = $model->Gender;
            $species = $model->Species;

            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl('http://localhost:8080/animal/add')
                ->setFormat(Client::FORMAT_JSON)
                ->setData([
                    'name' => $name,
                    'gender' => $gender,
                    'species' => $species,
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
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $sql = "INSERT INTO transfer_history (name, animal_id, from_zoo_id, to_zoo_id, reason, Transfer_Date)
        VALUES (:name, :animal_id, :from_zoo_id, :to_zoo_id, :reason, :Transfer_Date)";

            $params = [
                'name' => $model->name,
                'animal_id' => $model->animal_id,
                'from_zoo_id' => $model->from_zoo_id,
                'to_zoo_id' => $model->to_zoo_id,
                'reason' => $model->reason,
                'Transfer_Date' => $model->Transfer_Date,
            ];
            Yii::$app->db->createCommand($sql, $params)->execute();
            return $this->redirect(['viewhistory']);
        }
        return $this->render('event/managehistory', [
            'model' => $model,
        ]);
    }

    public function actionArchive()
    {
        $model = new Archive();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $sql = "INSERT INTO archive (Entity_Type, Name, Reason, Archive_Date)
        VALUES (:Entity_Type, :Name, :Reason, :Archive_Date)";

            $params = [
                'Entity_Type' => $model->Entity_Type,
                'Name' => $model->Name,
                'Reason' => $model->Reason,
                'Archive_Date' => $model->Archive_Date,
            ];
            Yii::$app->db->createCommand($sql, $params)->execute();
            return $this->redirect(['viewarchive']);
        }
        return $this->render('event/archive', [
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

    public function actionViewarchive()
    {
        $archive = Yii::$app->db->createCommand("SELECT * FROM archive")->queryAll();
        return $this->render('event/viewarchive', [
            'archive' => $archive,
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

    public function actionEditzoo($id)
    {
        $zooData = Yii::$app->db->createCommand('SELECT * FROM zoo WHERE id = :id')
        // use bindValue to bind a value to a SQL parameter. 
            ->bindValue(':id', $id)
            ->queryOne();
        // This returns an array. 

        // Create a new instance of Zoo model
        $zoo = new Zoo();
        // Assign the fetched data to the model attributes
        $zoo->attributes = $zooData;

        if (Yii::$app->request->isPost && $zoo->load(Yii::$app->request->post())) {
            // Validate and save the model
            if ($zoo->validate()) {
                Yii::$app->db->createCommand('UPDATE zoo SET phone_no = :phone_no, description = :description WHERE id = :id')
                    ->bindValue(':phone_no', $zoo->Phone_no)
                    ->bindValue(':description', $zoo->Description)
                    ->bindValue(':id', $id)
                    ->execute();

                return $this->redirect(['viewzoo']);
            }
        }
        return $this->render('event/editzoo', ['zoo' => $zoo]);
    }

    public function actionEditanimal($id)
    {
        $animalData = Yii::$app->db->createCommand('SELECT * FROM animal WHERE id = :id')
            ->bindValue(':id', $id)
            ->queryOne();
        $animal = new Animal();
        $animal->attributes = $animalData;
        if(Yii::$app->request->isPost && $animal->load(Yii::$app->request->post()))
        {
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
        return $this->render('event/addinzoo');
    }

}

// <plugin>
//             <groupId>org.apache.maven.plugins</groupId>
//             <artifactId>maven-compiler-plugin</artifactId>
//             <configuration>
//                 <source>17</source> <!-- or your Java version -->
//                 <target>17</target> <!-- or your Java version -->
//                 <annotationProcessorPaths>
//                     <path>
//                         <groupId>org.mapstruct</groupId>
//                         <artifactId>mapstruct-processor</artifactId>
//                         <version>1.5.2.Final</version>
//                     </path>
//                 </annotationProcessorPaths>
//             </configuration>
//         </plugin>
