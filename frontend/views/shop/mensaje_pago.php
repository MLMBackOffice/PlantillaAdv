<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Felicidades';
$this->params['breadcrumbs'][] = $this->title;
?>
  <div class="login-box-body">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Su pago se encuentra en estado: <code><?= $model->status ?></code> 
    </p>
    <a href="/PlantillaAdv/frontend/web/index.php/site/login/">Volver</a>

  
</div>
