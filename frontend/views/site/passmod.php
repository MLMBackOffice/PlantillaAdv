<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
 
<?=
$this->title = Yii::t('app', 'Change Password');
?>


<h3 class="alert alert-info"><?php //Yii::t('app', $msg) ?></h3>
<div class="login-box">
    <div class="login-box-body">
        <h3 class="login-box-msg"><?= Html::encode($this->title) ?></h3>
        <?php $form = ActiveForm::begin([
            'method' => 'post',
            'enableClientValidation' => true,
        ]);
        ?>

        <?= $form->field($model, 'current_password',['options'=>[
                    'tag'=>'div',
                    'class'=>'form-group field-loginform-password has-feedback required'
                    ],
                    'template'=>'{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>'
                    . '{error}{hint}'
                    ])->passwordInput(['autofocus' => true, 'placeholder'=>Yii::t('app', 'Current Password')]) ?>
        
        <?= $form->field($model, 'new_password',['options'=>[
                            'tag'=>'div',
                            'class'=>'form-group field-loginform-password has-feedback required'
                            ],
                            'template'=>'{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>'
                            . '{error}{hint}'
                            ])->passwordInput(['placeholder'=>Yii::t('app', 'New Password')]) ?>

        
        <?= $form->field($model, 'new_password_repeat',['options'=>[
                            'tag'=>'div',
                            'class'=>'form-group field-loginform-password has-feedback required'
                            ],
                            'template'=>'{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>'
                            . '{error}{hint}'
                            ])->passwordInput(['placeholder'=>Yii::t('app', 'New Password Repeat')]) ?>


        <div class="text-center"> 
            <?= Html::submitButton(Yii::t('app', 'Change Password'), ["class" => "btn btn-primary"]) ?>
        </div>    
        <?php $form->end() ?>
    </div>
</div>