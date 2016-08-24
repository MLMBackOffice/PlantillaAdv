<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Paises; 
use backend\models\Idiomas; 
use yii\helpers\ArrayHelper; 

/* @var $this yii\web\View */
/* @var $model backend\models\Clientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-form">

    <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-3 control-label'],
        ],
            
            
            ]); ?>


    <?= $form->field($model, 'nombre_completo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pais')->dropDownList(
            ArrayHelper::map(Paises::find()->all(),'id','descripcion'),
               ['prompt'=>Yii::t('app', 'Select Country')]
            )
   ?>
    <?= $form->field($model, 'idioma')->dropDownList(
            ArrayHelper::map(Idiomas::find()->all(),'codigo','descripcion'),
               ['prompt'=>Yii::t('app', 'Select Language')]
            )
   ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput() ?>
    
    <?= $form->field($model, 'direccion_billetera')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>