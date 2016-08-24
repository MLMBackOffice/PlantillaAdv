<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use vendor\linslin\curl;
use backend\models\compra;
use backend\models\empresa;
use backend\models\paquetes;
use backend\models\LogErrorCalback;
use backend\models\CompraSearch;
use yii\rest\ActiveController;
use common\models\Users;
use yii\helpers\Json;
use yii\web\Response;

class ShopController extends ActiveController {

    public $modelClass = 'backend\models\compra';
    /*   public function behaviors() {

      return [

      'access' => [

      'class' => AccessControl::className(),

      'only' => ['special'],

      'rules' => [

      [

      //  'actions' => ['special-callback'],

      'allow' => true,



      ],

      ],

      ],

      ];

      } */
    // Match callback called! This page can be accessed only each October 31st

    public function actionSpecial() {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;

        /* $error_model = new LogErrorCalback();

          $error_model->descripcion = 'status: '.$request->post('status');

          $error_model->fecha_registro = date('Y-m-d h:m:s');

          $error_model->save(false);

          throw new NotFoundHttpException('is ajax peticion, dont support.');

          return ['status' => $request->post('status')];

         *    */
        
        if ($request->isAjax) {

            $error_model = new LogErrorCalback();
            $error_model->descripcion = 'is ajax peticion, dont support.';
            $error_model->fecha_registro = date('Y-m-d h:m:s');
            $error_model->save(false);
            return ['error' => 'is ajax peticion, dont support.'];

        } else {

            $model = new Compra();
            $model->pay_reference = $request->post('pay_reference');

            if (empty($model->pay_reference)) {

                $error_model = new LogErrorCalback();
                $error_model->descripcion = 'pay_reference is empty';
                $error_model->fecha_registro = date('Y-m-d h:m:s');
                $error_model->save(false);
                return ['error' => 'pay_reference is empty'];
            }

               $error_model = new LogErrorCalback();
                $error_model->descripcion = 'inicio  de peticion, pay_reference: '. $request->post('pay_reference');
                $error_model->fecha_registro = date('Y-m-d h:m:s');
                $error_model->save(false);

            $pay_reference = split('_', $model->pay_reference);

            if (($user = Users::findOne($pay_reference[0])) == null) {

                $error_model = new LogErrorCalback();
                $error_model->descripcion = 'The user  does not exist. user send: before ' . $request->post('pay_reference');
                $error_model->fecha_registro = date('Y-m-d h:m:s');
                $error_model->save(false);
                return ['error' => 'The user does not exist. user send:' . $pay_reference[0]];

            }

            $status = $request->post('status');
            $model->id_usuario = $user->id;
            $model->num_orden = $pay_reference[1];
            $importe_enviado = $pay_reference[2];

            $model->coin_amount = $request->post('coin_amount');
            $model->fiat_amount = $request->post('fiat_amount');
            $model->fiat_name = $request->post('fiat_name');
            $model->status = $request->post('status');
            $model->usd_amount = $request->post('usd_amount');
            $model->bitcoin_txId = $request->post('bitcoin_txId');
            $model->internal_txId = $request->post('internal_txId');
            $model->cardId = $request->post('cardId');
            $model->coin_name = $request->post('coin_name');
            $model->address = $request->post('address');
            $model->fecha_registro = date('Y-m-d h:m:s');

            if (($empresa = Empresa::findOne('1')) == null) {

                $error_model = new LogErrorCalback();
                $error_model->descripcion = 'The company  does not exist, usuario_id:' . $model->id_usuario . ' ordenID:' . $model->num_orden;
                $error_model->fecha_registro = date('Y-m-d h:m:s');
                $error_model->save(false);
                return ['error' => 'The company  does not exist.'];

            }

            $model->empresa_id = $empresa->Id;

            $model->fecha_registro = date('Y-m-d h:m:s');



          

            if (($compra = Compra::find()->where(['num_orden' => $pay_reference[1]])->one()) != null) {
                $compra->status = $status;

                if ($compra->status == 'confirmed') {

                    $final = date("Y-m-d h:m:s", strtotime("+1 month"));
                  //  $compra->fecha_vencimiento = $final; // date('Y-m-d h:m:s');
                    $user->estado = 2;
                    $user->update();

                } else {

                    $final = date("Y-m-d h:m:s");
                 //   $compra->fecha_vencimiento = $final; // date('Y-m-d h:m:

                }

                $compra->update();

                $error_model = new LogErrorCalback();
                $error_model->descripcion = 'estado actualizado. Num_orden:' . $pay_reference[1];
                $error_model->fecha_registro = date('Y-m-d h:m:s');
                $error_model->save(false);
                //cuando existe la orden creada, es para actualizar el estado.           
                return true;
            }else{
                   $error_model = new LogErrorCalback();
                $error_model->descripcion = 'orden no encontrada, la accion es de crear nueva.  Num_orden:' . $pay_reference[1];
                $error_model->fecha_registro = date('Y-m-d h:m:s');
                $error_model->save(false);
                
            }
              //   $model->empresa_id = $empresa->Id;

            if (empty($model->usd_amount)) {

                $error_model = new LogErrorCalback();
                $error_model->descripcion = 'imposible detectar el pago usd amount empty, usuario_id:' . $model->id_usuario . ' ordenID:' . $model->num_orden;
                $error_model->fecha_registro = date('Y-m-d h:m:s');
                $error_model->save(false);
                return ['error' => 'imposible detectar el pago usd amount empty, usuario_id'];
            }

            if ($model->usd_amount == $importe_enviado) {
                $paquete = paquetes::find()->where(["costo" => $importe_enviado])->one();
            }else{
                $error_model = new LogErrorCalback();
                $error_model->descripcion = 'paquete no encontrado, usuario_id:' . $model->id_usuario . ' ordenID:' . $model->num_orden;
                $error_model->fecha_registro = date('Y-m-d h:m:s');
                $error_model->save(false);
                return ['error' => 'paquete no encontrado'];
            }

            // $paquete = paquetes::findOne(1);
            $model->id_paquete = $paquete->id_paquete;


            if ($model->save(false)) {

                //activamos el usuario  
                $error_model = new LogErrorCalback();
                $error_model->descripcion = 'peticion  guardada con exito. Num_orden:' . $pay_reference[1];
                $error_model->fecha_registro = date('Y-m-d h:m:s');
                $error_model->save(false);

            } else {
                $error_model = new LogErrorCalback();
                $error_model->descripcion = 'no guardo peticion . Num_orden:' . $pay_reference[1];
                $error_model->fecha_registro = date('Y-m-d h:m:s');
                $error_model->save(false);
            }
            $this->layout = 'loginLayout';

        }
        Yii::$app->language = Yii::$app->getRequest()->getCookies()->getValue('language');

        return ['error' => 'proceso exitoso'];
    }


    public function actionAbout() {

        return $this->render('mensaje_exito');

    }

}