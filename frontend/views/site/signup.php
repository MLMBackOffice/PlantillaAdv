<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Paises;
use kartik\select2\Select2;

$this->title = Yii::t('app', 'Register');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    
    <h3><?= $msg ?></h3>
    
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Yii::t('app', 'Please fill out the following fields to signup')?>:</p>
    <div class="row">
        <div class="col-lg-10">
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'id' => 'form-signup',
                 'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
                            'labelOptions' => ['class' => 'col-lg-2 control-label'],
                        ],
                'enableClientValidation' => false,
                'enableAjaxValidation' => true,
                ]);
            ?>
            <?php //$form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'patrocinador') ?>
                <?php /*$form->field($model, 'pais')->widget(Select2::classname(),[
                    'data' => ArrayHelper::map(Paises::find()->all(),'id','descripcion'),
                    'language' => 'es',
                    'options' => ['placeholder'=> 'Selecciona un País'],
                    'pluginOptions' => [
                        'allowClear' => true
                        ],
                    ]);*/?>
                
                <?= $form->field($model, 'pais')->dropDownList(
                        ArrayHelper::map(Paises::find()->all(),'id','descripcion'),
                        ['prompt'=>'Seleccionar País']
                        )
                    ?>    
                <?= $form->field($model, 'nombre_completo') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'direccion_billetera') ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>                
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'password_repeat')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Register'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
