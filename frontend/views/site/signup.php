<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Paises;
use kartik\select2\Select2;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to signup:</p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'patrocinador') ?>
                <?= $form->field($model, 'pais')->widget(Select2::classname(),[
                    'data' => ArrayHelper::map(Paises::find()->all(),'id','descripcion'),
                    'language' => 'es',
                    'options' => ['placeholder'=> 'Selecciona un País'],
                    'pluginOptions' => [
                        'allowClear' => true
                        ],
                    ]);?>
                <?= $form->field($model, 'nombre_completo') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'direccion_billetera') ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>                
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
