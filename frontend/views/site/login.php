<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="login-box">
        <div class="login-logo">
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Iniciar Sesión</p>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username',['options'=>[
                    'tag'=>'div',
                    'class'=>'form-group field-loginform-username has-feedback required'
                    ],
                    'template'=>'{input}<span class="glyphicon glyphicon-user form-control-feedback"></span>'
                    . '{error}{hint}'
                    ])->textInput(['autofocus' => true, 'placeholder'=>'Usuario']) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
