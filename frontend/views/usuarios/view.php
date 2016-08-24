<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Usuarios */

//$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-view">

    <h1><?= Html::encode(Yii::t('app', 'Profile Data')) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            'nombre_completo',
            //'pais',
            //'idioma',
            'email:email',
            'fecha_nacimiento',
            //'password',
            //'authKey',
            'patrocinador',
            'direccion_billetera',
            //'accessToken',
            //'activate',
            //'estado',
            //'verification_code',
            //'fecha_creacion',
        ],
    ]) ?>

</div>