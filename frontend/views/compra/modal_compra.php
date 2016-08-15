<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\paquetes;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Compra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compra-form">

    <?php $form = ActiveForm::begin(); ?>

  

    <?= $form->field($model, 'id_paquete')->dropDownList(
         ArrayHelper::map(paquetes::find()->all(), 'id_paquete', 'nombre'),['prompt' => 'Seleccione' ]
          );?>

    <img src="<?= Url::to(['compra/qrcode'])?>" alt="qrcode"/>
    
    <img src="https://chart.googleapis.com/chart?cht=qr&chs=250x250&cht=qr&chl=bitcoin:1AfMEZLAGGimTHunNpvJ1BVTnRWFhMEewr?amount=0.053" alt="qrcode"/>
    
   <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
       <?php ActiveForm::end(); ?>

</div>
