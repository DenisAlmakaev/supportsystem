<?php

namespace app\controllers;


use app\models\Requests;
use app\models\RequestsSearch;
use app\rules\AuthorRule;
use Exception;
use Yii;
use yii\base\DynamicModel;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;





/**
 * RequestsController реализует действия CRUD для модели запросов.
 */
class RequestsController extends Controller
{
    /**
     * @inheritDoc
     */

    public function behaviors(): array

    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'create'],
                'rules' => [

                    [
                        'actions' => ['index', 'create'],
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


    /**
     * Lists all Requests models.
     *
     * @return string|Response
     */




    public function actionIndex()

    {
        $searchModel = new RequestsSearch();
        $user_id = Yii::$app->user->id; // ID пользователя
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index',
            [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Отображает одну модель запросов.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException если модель не найдена
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Создает новую модель запросов.
     *
    * Если создание прошло успешно, браузер будет перенаправлен на страницу просмотра.
     *
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Requests();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save())
            {

                $fileName = uniqid();
                $model->file = UploadedFile::getInstance($model, 'file');
                if(!empty($model->file))
                {
                    $model->file->saveAs('uploads/files/requests/'.$fileName.'.'.$model->file->extension);
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

    /**
     * Обновляет существующую модель запросов.
     * Если обновление прошло успешно, браузер будет перенаправлен на страницу просмотра.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            $fileName = uniqid();
            $model->file = UploadedFile::getInstance($model, 'file');
            if(!empty($model->file))
            {
                $model->file->saveAs('uploads/files/requests/'.$fileName.'.'.$model->file->extension);
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
     * Удаляет существующую модель Requests.
     * Если удаление прошло успешно, браузер будет перенаправлен на «индексную» страницу.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException|StaleObjectException если модель не найдена
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }



    /**
     * Находит модель запросов на основе ее значения первичного ключа.
     * Если модель не найдена, будет выдано исключение 404 HTTP.
     * @param int $id ID
     * @return Requests загруженная модель
     * @throws NotFoundHttpException если модель не найдена
     */
    protected function findModel(int $id): Requests
    {
        if (($model = Requests::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }


    /**
     * @throws \yii\base\Exception
     * @throws BadRequestHttpException
     */
    public function actionSaveRedactorFile($sub='requests'): array
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
                $model->file->name = uniqid() . '.' .
                    $model->file->extension;
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
     * @throws Exception
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
