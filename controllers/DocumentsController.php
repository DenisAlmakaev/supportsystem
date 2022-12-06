<?php

namespace app\controllers;

use app\models\Documents;
use app\models\DocumentsSearch;
use app\rules\AuthorRule;
use Yii;
use yii\base\DynamicModel;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;


/**
 * @method validate()
 */
class DocumentsController extends Controller
{


    public function behaviors(): array

    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [

                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],


                    ],

                    [

                        'actions' => ['login', 'error'],
                        'allow' => true,

                    ],

                    [
                        'actions' => ['loqout'],
                        'allow' => true,
                        'roles' => ['@'],

                    ],


                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }




    public function actionIndex(): string
    {
        $searchModel = new DocumentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        return $this->render('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,

            ]);
    }


    /**
     * @throws NotFoundHttpException
     */
    public function actionView($id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * @return string|Response
     */

    public function actionCreate()
    {
        $model = new Documents();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save())
            {
                $fileName = uniqid();
                $model->file = UploadedFile::getInstance($model, 'file');
                $text = 'Добавлен документ';
                file_get_contents("https://api.telegram.org/bot5782109046:AAGxHC0RJhvAANL_BbU59dwtk22742IcrgY/sendMessage?chat_id=935718758&text=".$text);
                if(!empty($model->file))
                {
                    $model->file->saveAs('uploads/files/documents/'.$fileName.'.'.$model->file->extension);
                    $model->filename = ' '.$fileName.'.'.$model->file->extension;
                    $model->save();
                }

                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }



    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            $fileName = uniqid();
            $model->file = UploadedFile::getInstance($model, 'file');
            $text = 'Документ отредактирован';
            file_get_contents("https://api.telegram.org/bot5782109046:AAGxHC0RJhvAANL_BbU59dwtk22742IcrgY/sendMessage?chat_id=935718758&text=".$text);
            if(!empty($model->file))
            {
                $model->file->saveAs('uploads/files/documents/'.$fileName.'.'.$model->file->extension);
                $model->filename = ' '.$fileName.'.'.$model->file->extension;
                $model->save();
            }

            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * @throws NotFoundHttpException
     */



    /**
     * @throws StaleObjectException
     * @throws NotFoundHttpException
     */
    public function actionDelete($id): Response
    {
        $text = 'Документ удален';
        file_get_contents("https://api.telegram.org/bot5782109046:AAGxHC0RJhvAANL_BbU59dwtk22742IcrgY/sendMessage?chat_id=935718758&text=".$text);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * @throws NotFoundHttpException
     */
    protected function findModel($id): ?Documents
    {
        if (($model = Documents::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }


    /**
     * @throws NotFoundHttpException
     */

    public function actionSaveRedactorFile($sub='documents'): array
    {

        $this->enableCsrfValidation = false;
        if (Yii::$app->request->isPost) {
            $dir = Yii::getAlias('@files').'/'.$sub.'/';
            if (!file_exists($dir)){
                FileHelper::createDirectory($dir);
            }
            $result_link = 'uploads/files/'.$sub.'/';
            $file = UploadedFile::getInstanceByName('file');
            $model = new DynamicModel(compact('file'));
            $model->addRule('file', 'file')->validate();

            if ($model->hasErrors()) {
                $result = [
                    'error' => $model->getFirstError('file')
                ];
            } else {
                $model->file->name = uniqid() .'.'. $model->file->extension;
                if ($model->file->saveAs($dir . $model->file->name)) {
                    $result = ['filelink' => $result_link . $model->file->name, 'filename'=>$model->file->name];
                } else {
                    $result = [
                        'error' => Yii::t('vova07/imperavi', 'ERROR_CAN_NOT_UPLOAD_FILE')
                    ];
                }
            }

            Yii::$app->response->format = Response::FORMAT_JSON;


            return $result;
        } else {
            throw new BadRequestHttpException('Only POST is allowed');
        }
    }


    /**
     * @throws \Exception
     */
    public function actionRole (): int
    {

//        $admin = Yii::$app->authManager->createRole('admin');
//        $admin->description = 'Администратор';
//        Yii::$app->authManager->add($admin);
//
//        $user = Yii::$app->authManager->createRole('user');
//        $user->description = 'Пользователь';
//        Yii::$app->authManager->add($user);
//          $permit = Yii::$app->authManager->createPermission('canAdmin');
//          $permit->description = 'Право входа в админку';
//          Yii::$app->authManager->add($permit);

//        $role_a = Yii::$app->authManager->getRole('admin');
//        $permit = Yii::$app->authManager->getPermission('canAdmin');
//        Yii::$app->authManager->addChild($role_a, $permit);

//        $userRole = Yii::$app->authManager->getRole('admin');
//        Yii::$app->authManager->assign($userRole, 19);
//          $userRole = Yii::$app->authManager->getRole('user');
//          Yii::$app->authManager->assign($userRole, 20);

        $auth = Yii::$app->authManager;
        $rule = new AuthorRule();
        $auth->add($rule);


//$updateOwnPost = $auth->createPermission('updateOwnPost');
//$updateOwnPost->description = 'Редактировать записи';
//$updateOwnPost->ruleName = $rule->name;
//$auth->add($updateOwnPost);


        return 123456;
    }


}



