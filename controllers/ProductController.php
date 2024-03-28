<?php

namespace app\controllers;

use yii\rest\ActiveController;
use app\models\Product;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\db\Expression;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\web\Response;


class ProductController extends ActiveController
{
    public $modelClass = 'app\models\Product';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
        ];

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::class,
            'auth' => function ($username, $password) {
                // Replace this with your own authentication logic.
                return User::findOne(['username' => $username, 'password' => $password]);
            },
        ];

        // Set JSON as the default content type.
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        return $behaviors;
    }

    public function actionIndex()
    {
        $query = Product::find();

        $clientId = \Yii::$app->request->get('client_id');
        if ($clientId) {
            $query->andWhere(['client_id' => $clientId]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
                'attributes' => [
                    'client_id',
                    'name',
                    'price',
                    'created_at',
                ],
            ],
        ]);

        return $dataProvider;
    }
}