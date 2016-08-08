<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\paquetes */

$this->title = Yii::t('app', 'Create Paquetes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Paquetes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paquetes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
