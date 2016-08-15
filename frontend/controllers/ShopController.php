<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use vendor\linslin\curl;
use backend\models\Compra;
use backend\models\Empresa;
use backend\models\paquetes;
use backend\models\CompraSearch;
use yii\rest\ActiveController;

class ShopController extends ActiveController
{
    public $modelClass = 'backend\models\Compra';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['special'],
                'rules' => [
                    [
                      //  'actions' => ['special-callback'],
                        'allow' => true,
                        /*'matchCallback' => function ($rule, $action) {
                            return date('d-m') === '31-10';
                        }*/
                    ],
                ],
            ],
        ];
    }

    // Match callback called! This page can be accessed only each October 31st
    public function actionSpecial()
    {
    
        
       /* $handler = curl_init("http://www.google.com.co");  
$response = curl_exec ($handler);  
curl_close($handler);  
echo $response; */
     /*   $curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://localhost:8081/index.php');
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_exec($curl);
$status = curl_getinfo($curl);
curl_close($curl);*/
         $model = new Compra();
         $request = Yii::$app->request;
         header('Content-type: text/plain');
print_r( $request->post());
exit;
        return true;
         //  throw new NotFoundHttpException('The paquete  does not exist.');
       //    return $this->render(["/shop/about"]);
      //     $curl = new curl\Curl();

        //get http://example.com/
       // $response = $curl->get('http://google.com/');
    }
}
