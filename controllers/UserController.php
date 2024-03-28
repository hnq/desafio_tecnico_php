<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\db\Expression;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\web\Response;

class UserController extends \yii\console\Controller
{
    public function actionCreate($username, $password, $name)
    {
        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->name = $name;

        if ($user->save()) {
            echo "User created successfully.\n";
        } else {
            echo "Error creating user.\n";
            print_r($user->getErrors());
        }
    }
}