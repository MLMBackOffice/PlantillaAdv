<?php

namespace frontend\controllers;

use Yii;
use backend\models\Compra;
use backend\models\Empresa;
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
     * Creates a new Compra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Compra();
        //  empresa::findOne($condition)
        if (($empresa = Empresa::findOne('1')) == null) {

            throw new NotFoundHttpException('The company  does not exist.');
        }


        if ($model->load(Yii::$app->request->post())) {
            $model->empresa_id = $empresa->Id;
            $model->id_usuario = Yii::$app->user->id;
            $model->fecha_registro = date('Y-m-d h:m:s');
            $model->estado = '0';
            $model->save();



            $postData = array('type' => 'int', 'txid' => '54345f6a-3f3a-4376-abb3-8bd8c7f6d3d6');
            $url = "https://tropay.com/v0/secure-api/get-usd-balance";
            /* Convierte el array en el formato adecuado para cURL */
            $elements = array();
            foreach ($postData as $name => $value) {
                $elements[] = "{$name}=" . urlencode($value);
            }
            $handler = curl_init();
            curl_setopt($handler, CURLOPT_URL, $url);
            curl_setopt($handler, CURLOPT_POST, true);
            curl_setopt($handler, CURLOPT_POSTFIELDS, $elements);
            curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($handler, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt ($handler, CURLOPT_CAINFO, "/etc/cacert.pem");
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
           $response = curl_exec($handler);

       /*    if (curl_exec($handler) === false) {
                return 'Curl error: ' . curl_error($handler);
            } else {
                return 'Operación completada sin errores';
            }*/
            curl_close($handler);
          //  var_dump(json_decode($response, true));
           return json_decode($response, true);





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
            //    return $this->redirect(array('https://tropay.com/v0/secure-api/get-usd-balance', 'type' => 'int', 'txid' => '54345f6a-3f3a-4376-abb3-8bd8c7f6d3d6'));

            return $this->render('//compra/_form', [ 'model' => $model, 'empresa' => $empresa,]);
        } else {
            return $this->render('//compra/_form', [
                        'model' => $model,
                        'empresa' => $empresa,
            ]);
        }
    }

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

    /**
     * Deletes an existing Compra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
