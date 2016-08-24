<?php

namespace frontend\controllers;

use Yii;
use backend\models\compra;
use backend\models\empresa;
use backend\models\paquetes;
use backend\models\CompraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use dosamigos\qrcode\formats\MailTo;
use dosamigos\qrcode\QrCode;
use vendor\linslin\Curl;

/**
 * CompraController implements the CRUD actions for Compra model.
 */
class CompraController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        
        
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionQrcode() {
        $mailTo = new MailTo(['email' => 'ivan-salazar@hotmail.com']);
        $bit = new Bitcoin();
        $bit->address = '1AfMEZLAGGimTHunNpvJ1BVTnRWFhMEewr';
        $bit->amount = '0.053';
        return QrCode::png($bit->getText()); // return QrCode::png('$mailTo->getText()');
        // you could also use the following
        // return return QrCode::png($mailTo);
    }

    /**
     * Lists all Compra models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CompraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/compra/index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Compra model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Metodo para confirmar  un pago(llamado por callback tropay)
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionConfirmar() {

        $commission = 0.00001157;
        $createdAt = "2016-08-06T21:16:56.968Z";
        $CardId = "13b2861d-e9ca-4f52-8e84-d0f73b8349d8";

        /*
         * buscar user by carid
         * insert en confirma
         * update compra . estado y fecha fin
         */

        return $this->redirect(['create']);
    }

    /**
     * Creates a new Compra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Compra();
        $user = Yii::$app->user->identity;

        if (empty($user))
            return $this->redirect(["/site/login"]);

        /* se consulta la empresa para obtener la dirbitcoin */
        if (($empresa = Empresa::findOne('1')) == null) {

            throw new NotFoundHttpException('The company  does not exist.');
        }
        /*num orden random para enviar a tropay*/
        $num_orden = Yii::$app->getSecurity()->generateRandomString(5);
      
        $model->id_usuario = Yii::$app->user->id;
        $model->empresa_id = $empresa->Id;
        $model->fecha_registro = date('Y-m-d h:m:s');
        $model->num_orden = $num_orden;
    
        $searchModel = new CompraSearch();
        $searchModel->id_usuario=Yii::$app->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post())) {

            if (( $paquete = paquetes::findOne($model->id_paquete)) == null) {

                throw new NotFoundHttpException('The paquete  does not exist.');
            }
            
            if($model->save())
            {
                return 1;
            }else
                return 0;

        } else {
            return $this->render('//compra/_form', [
                        'model' => $model,
                        'empresa' => $empresa,
                        'user' => $user,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                            //    'mensajes' => $mensajes,
            ]);
        }
    }

    /*  $postData = array('type' => 'int', 'txid' => '54345f6a-3f3a-4376-abb3-8bd8c7f6d3d6');
      $url = "https://tropay.com/v0/secure-api/get-usd-balance";
      /* Convierte el array en el formato adecuado para cURL */

    //   $elements = array();
    /*       foreach ($postData as $name => $value) {
      $elements[] = "{$name}=" . urlencode($value);
      }
      $handler = curl_init();

      curl_setopt_array($handler, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $url,
      CURLOPT_USERAGENT => 'Codular Sample cURL Request',
      CURLOPT_POST => 1,
      CURLOPT_POSTFIELDS => array(
      'type' => 'int',
      'txid' => "54345f6a3f3a4376abb3y8bd8c7f6d3d6"
      )
      ));
     */
    /*   curl_setopt($handler, CURLOPT_URL, $url);
      curl_setopt($handler, CURLOPT_POST, true);
      curl_setopt($handler, CURLOPT_POSTFIELDS, $elements);
      curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($handler, CURLOPT_SSL_VERIFYHOST, false);
      //    curl_setopt ($handler, CURLOPT_CAINFO, "/etc/cacert.pem");
      curl_setopt($handler, CURLOPT_RETURNTRANSFER, true); */


    /*    if (curl_exec($handler) === false) {
      return 'Curl error: ' . curl_error($handler);
      } else {
      return 'Operación completada sin errores';
      } */
    /*   $response = curl_exec($handler);
      curl_close($handler);

      return ($response);
     */




    /*      $curl = new Curl();


      $response = $curl->setOption(
      CURLOPT_POSTFIELDS,
      http_build_query(array(
      'type' => 'int',
      'txid' => '54345f6a-3f3a-4376-abb3-8bd8c7f6d3d6'
      )
      ))
      ->post('https://tropay.com/v0/secure-api/get-usd-balance');
      return $response; */


    public function actionVercompra() {
        $model = new Compra();


        /*    return $this->renderAjax('//compra/modal_compra',  
          [ 'model' => $model,]); */
    }

    /**
     * Updates an existing Compra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_compra]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }
    public function actionMensaje() {
         $user = Yii::$app->user->identity;

        if (empty($user))
            return $this->redirect(["/site/login"]);
        
        return $this->render('mensaje_exito');
    }


    /**
     * Deletes an existing Compra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $compra = $this->findModel($id);
        if ($compra->status == 'pendient')
            $compra->delete();

        return $this->redirect(['create']);
    }

    /**
     * Finds the Compra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Compra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Compra::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
