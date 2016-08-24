<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
 
<?=
$this->title = Yii::t('app', 'Recover Password');
?>


<?php if ($msg): ?>
            <h3 class="alert alert-info"><?= Yii::t('app', $msg) ?></h3>
            
        <?php endif; ?>
        <?php if (empty($msg)): ?>
            <h3 class="callout callout-success"><?= Yii::t('app', 'Write the email with which the record was made , we will send instructions to reset your password') ?></h3>
    
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

        <div class="text-center"> 
            <?= Html::submitButton(Yii::t('app', 'Recover Password'), ["class" => "btn btn-primary"]) ?>
        </div>    
        <?php $form->end() ?>
    </div>
</div>