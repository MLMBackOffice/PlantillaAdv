<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
 

 
<?=
$this->title = Yii::t('app', 'Restore Password');
?>

<?php if ($msg): ?>
            <h3 class="alert alert-info"><?= Yii::t('app', $msg) ?></h3>            
<?php endif; ?>

<div class="login-box">
    <div class="login-box-body">
        <h3 class="login-box-msg"><?= Html::encode($this->title) ?></h3>
        <?php $form = ActiveForm::begin([
            'method' => 'post',
            'enableClientValidation' => true,
        ]);
        ?>

        
        <?= $form->field($model, 'email',['options'=>[
                    'tag'=>'div',
                    'class'=>'form-group field-loginform-mail has-feedback required'
                    ],
                    'template'=>'{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span>'
                    . '{error}{hint}'
                    ])->textInput(['autofocus' => true, 'placeholder'=>Yii::t('app', 'Email')]) ?>
       
        
         <?= $form->field($model, 'password',['options'=>[
                    'tag'=>'div',
                    'class'=>'form-group field-loginform-password has-feedback required'
                    ],
                    'template'=>'{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>'
                    . '{error}{hint}'
                    ])->passwordInput(['placeholder'=>Yii::t('app', 'Password')]) ?>  
        
         <?= $form->field($model, 'password_repeat',['options'=>[
                    'tag'=>'div',
                    'class'=>'form-group field-loginform-password has-feedback required'
                    ],
                    'template'=>'{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>'
                    . '{error}{hint}'
                    ])->passwordInput(['placeholder'=>Yii::t('app', 'Password Repeat')]) ?>  
        
            <?= $form->field($model, 'verification_code',['options'=>[
                    'tag'=>'div',
                    'class'=>'form-group field-loginform-username has-feedback required'
                    ],
                    'template'=>'{input}<span class="form-control-feedback"><i class="fa fa-key"></i></span>'
                    . '{error}{hint}'
                    ])->textInput(['autofocus' => true, 'placeholder'=>Yii::t('app', 'Verification Code')]) ?>
       

        <div class="form-group">
         <?= $form->field($model, "recover")->input("hidden")->label(false) ?>  
        </div>
        <div class="text-center"> 
            <?= Html::submitButton(Yii::t('app','Restore Password'), ["class" => "btn btn-primary"]) ?>
         </div>
        <?php $form->end() ?>
        <div style="color:#999;margin:1em 0">
            <?= Html::a( Yii::t('app','Login'), ['site/login']) ?>
        </div>
    </div>
</div>