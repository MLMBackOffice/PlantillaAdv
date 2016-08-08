<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\paquetes */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Paquetes',
]) . $model->id_paquete;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Paquetes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_paquete, 'url' => ['view', 'id' => $model->id_paquete]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="paquetes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
