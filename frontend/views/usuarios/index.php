<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'username',
            //'nombre_completo',
            //'pais',
            //'idioma',
            // 'email:email',
            // 'fecha_nacimiento',
            // 'password',
            // 'authKey',
            // 'patrocinador',
            // 'direccion_billetera',
            // 'accessToken',
            // 'activate',
            // 'estado',
            // 'verification_code',
            // 'fecha_creacion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>