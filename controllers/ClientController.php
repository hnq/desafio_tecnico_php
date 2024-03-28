<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\web\ServerErrorHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\db\Expression;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;


class ClientController extends ActiveController
{
    public $modelClass = 'app\models\Client';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index'], $actions['view'], $actions['create'], $actions['update'], $actions['delete']);

        $actions['create']['modelClass'] = $this->modelClass;
        $actions['update']['modelClass'] = $this->modelClass;

        return $actions;
    }

    public function actionCreate()
    {
        $client = new $this->modelClass();

        if ($client->load(Yii::$app->request->post(), '') && $client->validate()) {
            try {
                $client->save();

                Yii::$app->response->setStatusCode(Response::HTTP_CREATED);
                return $client;
            } catch (\Exception $e) {throw new ServerErrorHttpException($e->getMessage(), $e->getCode());
            }
        }

        if ($client->hasErrors()) {
            throw new ServerErrorHttpException(json_encode($client->getErrors()), Response::HTTP_BAD_REQUEST);
        }

        return $client;
    }

    public function actionUpdate($id)
    {
        $client = $this->findModel($id);

        if ($client->load(Yii::$app->request->post(), '') && $client->validate()) {
            try {
                $client->save();

                return $client;
            } catch (\Exception $e) {
                throw new ServerErrorHttpException($e->getMessage(), $e->getCode());
            }
        }

        if ($client->hasErrors()) {
            throw new ServerErrorHttpException(json_encode($client->getErrors()), Response::HTTP_BAD_REQUEST);
        }

        return $client;
    }

    public function findModel($id)
    {
        $client = $this->modelClass::findOne($id);
        if ($client !== null) {
            return $client;
        }

        throw new NotFoundHttpException('O registro de cliente não foi encontrado.');
    }

    public function actionList()
    {
        $query = Client::find();

        $totalClients = $query->count();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $totalClients
        ]);

        $clients = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('list', [
            'clients' => $clients,
            'pagination' => $pagination
        ]);
    }
}