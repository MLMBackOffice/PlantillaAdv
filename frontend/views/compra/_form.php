<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\paquetes;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Paquetes Disponibles ' );
$subtitle = Yii::t('app', 'Compras Realizadas');
?>

<div class="compra-form">
    <h3> <?= Html::encode($this->title) ?></h3>
    <?php

    $form = ActiveForm::begin([
       
                'options' => [
                     'layout' => 'horizontal',
                    'id' => $model->formName()
                ]
    ]);
    echo Html::hiddenInput('carId', $empresa->cardId);

    
    echo 
    ' <center>' . $form->field($model, 'id_paquete')->radioList(
            ArrayHelper::map( Paquetes::find()->all(),'costo', 'nombre'),
            [
            //     'labelOptions'=>array('style'=>'display:inline'), // add this code
                'separator'=>'&nbsp;&nbsp;&nbsp;',
                'onchange' => 
         '$( "#btn-tropay" ).attr("data-importe",'
                . '$("input:radio[name=\"Compra[id_paquete]\"]:checked").val());'
              ])
            . '</center>';
        
    ?>
  
    
<?php ActiveForm::end(); ?>
    
     <center> <div>
        <button   id="btn-tropay" 
                 data-publicKey="eyJpdiI6IitQSjFRSm80MlwvZDN0VjFsR1Q4RjRRPT0iLCJ2YWx1ZSI6Im5UUXN4c1ZCc0lpUElZTVwvcXdYc1lucW9ZU25nWGRjb3hVZERBMWM5TEVtS2wxNlJBOWJ1M2JCb042NWErVGs2IiwibWFjIjoiMDUxZDY3MGYwN2E2M2EyMWE5ZGYxOTUwYTA1MDVjOGJiNWZiYzU2N2YzM2M3ODI1OTY1YTVlYjhlMjY1ZDIzNyJ9" 
                 data-title="Compra Paquete WeiFastPay"            
                 data-importe="7.0" 
                  data-fiat-name="usd"
                 data-ref="test"
                 data-custom="weifastpay"
             
                 style="width: 220px ; height: 50px; border-radius: 10px; font-size: 20px"
                 class="btn btn-success btn-block">
            <i class="icon fa fa-bitcoin  pull-left" style="font-size: 25px">
            </i>   Pay with Bitcoins</button>
        </div></center>
      <h3> <?= Html::encode($subtitle) ?></h3>

    <br/>
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
     //   ['class' => 'yii\grid\SerialColumn'],
        'id_compra',
        'fecha_registro',
        'fecha_vencimiento',
        'idPaquete.nombre',
        'status'//,
      //  ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'],
    ],
]);
?>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://tropay.com/api/jsresources/tropay.js"></script>
 <script>
     
     $('#compra-id_paquete').change(function() {
         
         
         $( "#btn-tropay" ).attr("data-ref","<?=$model->id_usuario?>_<?=$model->num_orden?>_"+$("input:radio[name=\"Compra[id_paquete]\"]:checked").val());
      
     });
     
    </script>




    
<?php 
/*$script = <<< JS
        
      $('#btn-tropay').click(function() {  alert('funciona java');});
        $('form#{$model->formname()}').on('beforeSubmit',function(e)
     {
     alert('funciona');return;
         var \$form = $(this);
         $.post(
                 \$form.attr("action"),
                 \$form.serialize()
                 
                 )
                 .done(function(result){
                     console.log(result);
                 })
                 .fail(function(){
                     console.log("server error");
                 });
     return false;
     });
JS;
     
     $this->registerJS($script);*/
         ?>