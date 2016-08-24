<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; 
use backend\models\Paises; 
use backend\models\Idiomas; 
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form_actualiza',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-3 control-label'],
        ],
       
]); ?>

    <?= $form->field($model, 'nombre_completo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pais')->dropDownList(
           ArrayHelper::map(Paises::find()->all(),'id','descripcion'),
              ['prompt'=>'Select Country']
           )
  ?> 

        <?= $form->field($model, 'idioma')->dropDownList(
           ArrayHelper::map(Idiomas::find()->all(),'codigo','descripcion'),
              ['prompt'=>Yii::t('app', 'Select Language')]
           )
  ?>

    <?php echo $form->field($model,'fecha_nacimiento')->
   widget(DatePicker::className(),[
       'dateFormat' => 'yyyy-MM-dd',
       'clientOptions' => [
           'yearRange' => '-80:+0',
           'changeYear' => true]
   ]) ?> 

    <?= $form->field($model, 'direccion_billetera')->textInput(['maxlength' => true]) ?>

        <!--<br><h3>Confirma o Cambia tu contraseña</h3>-->

    <?php //$form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?php //$form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>