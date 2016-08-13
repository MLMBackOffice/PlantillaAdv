<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Paises;

$this->title = Yii::t('app', 'Join WeiFastPay');
?>

<div class="logo">
    <?php echo Html::a(Html::img('@web/dist/img/logo-header-black.png'), 'https://www.weifastpay.com', ['class' => 'profile-link']) ?>
</div>
<div class="enlaces-menu">
    <?= Html::a( Yii::t('app','Login'), ['site/login']) ?>
</div>
<h1><?= Html::encode($this->title) ?></h1>
<div class="form">
    
     <?php if ($msg): ?>
            <h3 class="alert alert-success"><?= $msg ?></h3>
        <?php endif; ?>
        <?php if (empty($msg)): ?>
            <h3><?= Yii::t('app', 'Thank you for your desire to enter WeiFastPay. Soon you will know, it will be one of the best decisions of your life!') ?></h3>
    
        <?php endif; ?>
   
    <?php $form = ActiveForm::begin([
    'method' => 'post',
    'id' => 'formulario',
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,    
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-3 control-label'],
    ],
        
]);
?>
    <?php // $form->field($model, 'patrocinador') ->textInput(['autofocus' => true])?>
    <?= $form->field($model, 'pais')->dropDownList(
            ArrayHelper::map(Paises::find()->all(),'id','descripcion'),
               ['prompt'=>'Seleccionar País']
            )
   ?>    
    <?php if ($patr): ?>
        <?=  $form->field($model, 'patrocinador')->textInput(array('value'=>$patr, 'readonly'=>true)) ?>
    <?php endif; ?>
    <?php if (empty($patr)): ?>
        <?=  $form->field($model, 'patrocinador') ?>
    <?php endif; ?>

    <?= $form->field($model, "username")->input("text") ?>
   <?= $form->field($model, 'nombre_completo')->input("text") ?>
   <?= $form->field($model, 'direccion_billetera')->input("text") ?>
    <?= $form->field($model, "email")->input("email") ?>   
    <?= $form->field($model, "password")->input("password") ?> 
    <?= $form->field($model, "password_repeat")->input("password") ?>

<div class="boton">
        <?= Html::submitButton(Yii::t('app', 'Register'), ["class" => "btn btn-primary"]) ?>
</div>
<?php $form->end() ?>
</div>