<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Paises */

$this->title = Yii::t('app', 'Create Paises');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Paises'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paises-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
