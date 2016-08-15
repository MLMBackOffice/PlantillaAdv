<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Paquetes;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\Compra */

/* @var $form yii\widgets\ActiveForm */
/*  <img src="<?= Url::to(['compra/qrcode'])?>" alt="qrcode"/> */
/*
 *    <div class="flat-green">
  <button id="btn-tropay" data-publicKey="eyJpdiI6IkdFaFVNaTY3ZUF4UzA1STJwVGNkWEE9PSIsInZhbHVlIjoibFozYmF4QXF3QVpTUVl6TmlQWExxQnBWZ1BMOGdPdVNWcmRFSDRnbGNEMk1hbEtnMlpHOGJJRVpNc2RocGlQSyIsIm1hYyI6IjU1NzRiNGFhNDA4OGY5NGUzMTBmM2ExOGVlYTA3OGY3NDFlZDNlMmI5NTAxZDI5ZDdhZDRhZWRiNmRkY2JiMmEifQ==" data-title=""
  data-importe="" data-ref="https://tropay.com/api/bitcoin-invoice/eyJpdiI6IkdFaFVNaTY3ZUF4UzA1STJwVGNkWEE9PSIsInZhbHVlIjoibFozYmF4QXF3QVpTUVl6TmlQWExxQnBWZ1BMOGdPdVNWcmRFSDRnbGNEMk1hbEtnMlpHOGJJRVpNc2RocGlQSyIsIm1hYyI6IjU1NzRiNGFhNDA4OGY5NGUzMTBmM2ExOGVlYTA3OGY3NDFlZDNlMmI5NTAxZDI5ZDdhZDRhZWRiNmRkY2JiMmEifQ==///" style="width: 220px ; height: 50px; border-radius: 10px;
  font-size: 20px" class="btn btn-success btn-block"><i class="icon fa fa-bitcoin  pull-left"
  style="font-size: 25px"></i>   Pay with Tropay</button></div>
  <div class="flat-green"><button id="btn-tropay" data-publicKey="eyJpdiI6IkdFaFVNaTY3ZUF4UzA1STJwVGNkWEE9PSIsInZhbHVlIjoibFozYmF4QXF3QVpTUVl6TmlQWExxQnBWZ1BMOGdPdVNWcmRFSDRnbGNEMk1hbEtnMlpHOGJJRVpNc2RocGlQSyIsIm1hYyI6IjU1NzRiNGFhNDA4OGY5NGUzMTBmM2ExOGVlYTA3OGY3NDFlZDNlMmI5NTAxZDI5ZDdhZDRhZWRiNmRkY2JiMmEifQ==" data-title="Compra libro" data-importe="150" data-ref="4478" style="width: 220px ; height: 50px; border-radius: 10px; font-size: 20px" class="btn btn-success btn-block"><i class="icon fa fa-bitcoin  pull-left" style="font-size: 25px"></i>   Pay with Tropay</button></div>
  <?= $form->field($model, 'empresa_id')->hiddenInput() ?>
 * 
 * 
 *     <?= $form->field($model, 'id_paquete')->dropDownList(
  ArrayHelper::map(Paquetes::find()->all(), 'id_paquete', 'nombre'),
  ['prompt' => 'Seleccione',
  'onchange'=>'alert("aaa");'
  ]
 * 
 *    <center>   <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Pagar con Tropay') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </center> 
  );?>

 */
$this->title = Yii::t('app', 'Seleccione el paquete deseado ' );
$subtitle = Yii::t('app', '.');
?>


<div class="compra-form">
    <h1> <?= Html::encode($this->title) ?></h1>
    <?php

    $form = ActiveForm::begin([
                'options' => [
                    'id' => $model->formName()
                ]
    ]);
    echo Html::hiddenInput('carId', $empresa->cardId);

    echo 
    '<center>' . $form->field($model, 'id_paquete')->radioList(
            ArrayHelper::map(
            Paquetes::find()->all(), 
            'costo', 'nombre'),
            ['onchange' => 
         '$( "#btn-tropay" ).attr("data-importe",'
                . '$("input:radio[name=\"Compra[id_paquete]\"]:checked").val());'
                 .'$( "#btn-tropay" ).attr("data-ref","'.$model->id_usuario."_".$model->num_orden.'");'
                ])
            . '</center>';
    ?>
    <div class="form-group">
     </div>
    <br/>

    <h2> <?= Html::encode($subtitle) ?></h2>

    <br/>
 
  
    
<?php ActiveForm::end(); ?>
  <center> <div class="flat-green">
        <button  id="btn-tropay" 
                 data-publicKey="eyJpdiI6IkdFaFVNaTY3ZUF4UzA1STJwVGNkWEE9PSIsInZhbHVlIjoibFozYmF4QXF3QVpTUVl6TmlQWExxQnBWZ1BMOGdPdVNWcmRFSDRnbGNEMk1hbEtnMlpHOGJJRVpNc2RocGlQSyIsIm1hYyI6IjU1NzRiNGFhNDA4OGY5NGUzMTBmM2ExOGVlYTA3OGY3NDFlZDNlMmI5NTAxZDI5ZDdhZDRhZWRiNmRkY2JiMmEifQ==" 
                 data-title="Compra Paquete Wesfastpay" 
                 data-importe="1000" 
                 data-ref="test"
                 type="submit"
                 style="width: 220px ; height: 50px; border-radius: 10px; font-size: 20px"
                 class="btn btn-success btn-block">
            <i class="icon fa fa-bitcoin  pull-left" style="font-size: 25px">
            </i>   Pay with Tropay</button>
        </div></center>
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id_compra',
        'fecha_registro',
        'fecha_vencimiento',
        'id_paquete',
        'estado',
        ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'],
    ],
]);
?>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://tropay.com/api/jsresources/tropay.js"></script>
 <script>
     
    /*    $('#btn-tropay').click(function() {  alert('funciona java');});
        $('#<?=$model->formname()?>').on('beforeSubmit',function(e)
     {
     alert('funciona');return;
         var $form = $(this);
         $.post(
                 $form.attr("action"),
                 $form.serialize()
                 
                 )
                 .done(function(result){
                     console.log(result);
                 })
                 .fail(function(){
                     console.log("server error");
                 });
     return false;
     });*/
  /*  
   * 
   * $('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', 'https://tropay.com/api/cssresources/flat-green.css') );
$('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', 'https://tropay.com/api/cssresources/font-awesome.min.css') );
$('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', 'https://tropay.com/api/cssresources/bootstrap.min.css') );



$('#btn-tropay').click(function() {
    var btn = document.getElementById('btn-tropay');
    var titulo = btn.getAttribute('data-title');
    var importe = btn.getAttribute('data-importe');
    var referencia = btn.getAttribute('data-ref');
    var publicKey = btn.getAttribute('data-publicKey');

    window.location="https://tropay.com/api/bitcoin-invoice/"+publicKey+"/"+importe+"/"+referencia+'/'+titulo;
});*/
    </script>



<?php

/*     <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

 * 
 *  onclick="$('create-modal-compra').submit()"
 *   $script= <<< JS
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
  $this->registerJs($script); */
?>

    
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