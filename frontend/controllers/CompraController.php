<?php

namespace frontend\controllers;

use Yii;
use backend\models\Compra;
use backend\models\CompraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\PaquetesQuery;
use dosamigos\qrcode\formats\MailTo;
use dosamigos\qrcode\QrCode;
use yii\web\JsonParser;
/**
 * CompraController implements the CRUD actions for Compra model.
 */
class CompraController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
    $bit->address ='1AfMEZLAGGimTHunNpvJ1BVTnRWFhMEewr';
    $bit->amount ='0.053';
    return QrCode::png($bit->getText());// return QrCode::png('$mailTo->getText()');
  
    // you could also use the following
    // return return QrCode::png($mailTo);
}   

    /**
     * Lists all Compra models.
     * @return mixed
     */
    public function actionIndex()
    {
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
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Compra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Compra();
        

        if ($model->load(Yii::$app->request->post()) ) {
         
            $model->id_usuario=Yii::$app->user->id;
            $model->fecha_registro=date('Y-m-d h:m:s');
             $model->save();
            return $this->redirect("https://tropay.com/v0/secure-api/get-usd-balance");
            
            /*return $this->render('//compra/_form',  
            [ 'model' => $model,]);*/
        } else {
            return $this->render('//compra/_form', [
                'model' => $model,
       //         'paquetes' => $paquetes,
            ]);
        }
    }
    
      public function actionVercompra()
    {
        $model = new Compra();
        
         
     /*    return $this->renderAjax('//compra/modal_compra',  
            [ 'model' => $model,]);*/
    }
    /**
     * Updates an existing Compra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
    public function actionDelete($id)
    {
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
    protected function findModel($id)
    {
        if (($model = Compra::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
