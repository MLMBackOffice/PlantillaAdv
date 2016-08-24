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
            <h3 class="login-box-msg"><?= Yii::t('app', 'Enter your virtual office')?></h3>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username',['options'=>[
                    'tag'=>'div',
                    'class'=>'form-group field-loginform-username has-feedback required'
                    ],
                    'template'=>'{input}<span class="glyphicon glyphicon-user form-control-feedback"></span>'
                    . '{error}{hint}'
                    ])->textInput(['autofocus' => true, 'placeholder'=>Yii::t('app', 'Username')]) ?>
                <?= $form->field($model, 'password',['options'=>[
                    'tag'=>'div',
                    'class'=>'form-group field-loginform-password has-feedback required'
                    ],
                    'template'=>'{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>'
                    . '{error}{hint}'
                    ])->passwordInput(['placeholder'=>Yii::t('app', 'Password')]) ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                <div style="color:#999;margin:1em 0">
                    <?= Html::a(Yii::t('app', 'Restore Password'), ['site/recoverpass']) ?>.
                </div>
                <div style="color:#999;margin:1em 0">
                    <?= Html::a(Yii::t('app', 'Register'), ['site/register']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
