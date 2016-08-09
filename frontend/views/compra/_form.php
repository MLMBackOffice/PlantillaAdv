<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\paquetes;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Compra */

/* @var $form yii\widgets\ActiveForm */
  /*  <img src="<?= Url::to(['compra/qrcode'])?>" alt="qrcode"/>*/
/*
 *    <div class="flat-green">
        <button id="btn-tropay" data-publicKey="eyJpdiI6IkdFaFVNaTY3ZUF4UzA1STJwVGNkWEE9PSIsInZhbHVlIjoibFozYmF4QXF3QVpTUVl6TmlQWExxQnBWZ1BMOGdPdVNWcmRFSDRnbGNEMk1hbEtnMlpHOGJJRVpNc2RocGlQSyIsIm1hYyI6IjU1NzRiNGFhNDA4OGY5NGUzMTBmM2ExOGVlYTA3OGY3NDFlZDNlMmI5NTAxZDI5ZDdhZDRhZWRiNmRkY2JiMmEifQ==" data-title="" 
                data-importe="" data-ref="https://tropay.com/api/bitcoin-invoice/eyJpdiI6IkdFaFVNaTY3ZUF4UzA1STJwVGNkWEE9PSIsInZhbHVlIjoibFozYmF4QXF3QVpTUVl6TmlQWExxQnBWZ1BMOGdPdVNWcmRFSDRnbGNEMk1hbEtnMlpHOGJJRVpNc2RocGlQSyIsIm1hYyI6IjU1NzRiNGFhNDA4OGY5NGUzMTBmM2ExOGVlYTA3OGY3NDFlZDNlMmI5NTAxZDI5ZDdhZDRhZWRiNmRkY2JiMmEifQ==///" style="width: 220px ; height: 50px; border-radius: 10px; 
                font-size: 20px" class="btn btn-success btn-block"><i class="icon fa fa-bitcoin  pull-left" 
                                               style="font-size: 25px"></i>   Pay with Tropay</button></div>
    <div class="flat-green"><button id="btn-tropay" data-publicKey="eyJpdiI6IkdFaFVNaTY3ZUF4UzA1STJwVGNkWEE9PSIsInZhbHVlIjoibFozYmF4QXF3QVpTUVl6TmlQWExxQnBWZ1BMOGdPdVNWcmRFSDRnbGNEMk1hbEtnMlpHOGJJRVpNc2RocGlQSyIsIm1hYyI6IjU1NzRiNGFhNDA4OGY5NGUzMTBmM2ExOGVlYTA3OGY3NDFlZDNlMmI5NTAxZDI5ZDdhZDRhZWRiNmRkY2JiMmEifQ==" data-title="Compra libro" data-importe="150" data-ref="4478" style="width: 220px ; height: 50px; border-radius: 10px; font-size: 20px" class="btn btn-success btn-block"><i class="icon fa fa-bitcoin  pull-left" style="font-size: 25px"></i>   Pay with Tropay</button></div>
     <?= $form->field($model, 'empresa_id')->hiddenInput() ?>

 */
  ?>
     
<div class="compra-form">

    <?php $form = ActiveForm::begin([
                'options' => [
                    'id' => 'create-modal-compra'
                ]
    ]); 
    echo Html::hiddenInput('carId', $empresa->cardId);
    ?>

 
    <?= $form->field($model, 'id_paquete')->dropDownList(
         ArrayHelper::map(paquetes::find()->all(), 'id_paquete', 'nombre'),
            ['prompt' => 'Seleccione',
              'onchange'=>'alert("aaa");'   
                ]
          );?>


    
<!--<img src="https://chart.googleapis.com/chart?cht=qr&chs=250x250&cht=qr&chl=bitcoin:1AfMEZLAGGimTHunNpvJ1BVTnRWFhMEewr?amount=0.053" alt="qrcode"/>
    -->
  <?= Html::button('Create New Company', ['value' => Url::to(['compra/vercompra']), 'title' => 'Creating New Company', 'class' => 'showModalButton btn btn-success']); ?>
  <?= Html::button('Compra', [ 'id' => 'verCodigo', 'class' => 'showModalButton btn btn-success']); ?>
   <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
  <?php ActiveForm::end(); ?>

</div>

        <?php
    /*    $script= <<< JS
$.ajax({
       url: '<?php echo Yii::$app->request->baseUrl. '/compra/vercompra' ?>',
       type: 'post',
       data: {
                 searchname: $("#searchname").val() , 
                 searchby:$("#searchby").val() , 
                 _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
             },
       success: function (data) {
          console.log(data.search);
       }
  });
        JS;
        $this->registerJs($script);*/
  ?>