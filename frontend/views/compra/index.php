<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
/* @var $this yii\web\View */

$this->title = 'Wei Fast adddddddddddddddddddddPay | Back Office';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php echo Html::img('@web/dist/img/logo.png') ?>	
        <h1><?= Yii::t('app', 'Congratulations') ?> <?php //echo  $user->username ?>!</h1>
        

        <p class="lead">Ya eres miembro de nuestro equipo</p>
        <p class="lead">Pronto tendremos habilitadas todas las opciones para que administres tu oficina virtual,</br>
        Paquetes de libros digitales, paginas de captura totalmente personalizables, Pagos en Bitcoins y muchas otras utilidades
        que te ayudarán a que tu negocio y tus finanzas ya no sean lo mismo.</p>  
        <p class="lead" style="text-align:center">Para invitar a tus prospectos a que se registren copia y mandales la siguiente url: <strong><span style="color:#32b496" >https://www.weifastpay.com/backoffice/web/site/captura?pat= </span> </strong>      
    </div>
    
  
</div>
