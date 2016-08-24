<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\NivelSearch;
use common\models\DosSearch;
use common\models\TresSearch;
use common\models\CuatroSearch;
use common\models\CincoSearch;
use common\models\SeisSearch;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 

    $sm_niveluno = new NivelSearch();
    $dp_niveluno = $sm_niveluno->search(Yii::$app->request->queryParams); 
    
    $sm_niveldos = new DosSearch();
    $dp_niveldos = $sm_niveldos->search(Yii::$app->request->queryParams);
    
    $sm_niveltres = new TresSearch();
    $dp_niveltres = $sm_niveltres->search(Yii::$app->request->queryParams);
    
    $sm_nivelcuatro = new CuatroSearch();
    $dp_nivelcuatro = $sm_nivelcuatro->search(Yii::$app->request->queryParams);
    
    $sm_nivelcinco = new CincoSearch();
    $dp_nivelcinco = $sm_nivelcinco->search(Yii::$app->request->queryParams);
    
    $sm_nivelseis = new SeisSearch();
    $dp_nivelseis = $sm_nivelseis->search(Yii::$app->request->queryParams);
    
    
    ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $xsearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            //'id',
//            'Usuario',
//            'Nombre',
            'N1',
            'N2',
            'N3',
            'N4',
            'N5',
            'N6',
//            'user_directo',
//            'genedos',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<div class="text-center">
<br><h3>A continuación podrás consultar el estado de los usuarios que tienes en cada uno de los niveles.</h3>
<div style="display: inline-block; margin-left: auto; margin-right: auto">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#n1">Nivel 1</button>
            <div id="n1" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Cantidad de Usuarios en Nivel 1</h4>
                    </div>
                    <div class="modal-body">
                      <p><?= GridView::widget([
                            'dataProvider' => $dp_niveluno,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'Estado',
                                'Cantidad',
                            ],
                        ]); ?>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>

            </div>
          </div>
    
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#n2">Nivel 2</button>
            <div id="n2" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Cantidad de Usuarios en Nivel 2</h4>
                    </div>
                    <div class="modal-body">
                      <p><?= GridView::widget([
                            'dataProvider' => $dp_niveldos,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'Estado',
                                'Cantidad',
                            ],
                        ]); ?>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>

            </div>
          </div>
    
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#n3">Nivel 3</button>
            <div id="n3" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Cantidad de Usuarios en Nivel 3</h4>
                    </div>
                    <div class="modal-body">
                      <p><?= GridView::widget([
                            'dataProvider' => $dp_niveltres,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'Estado',
                                'Cantidad',
                            ],
                        ]); ?>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>

            </div>
          </div>
    
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#n4">Nivel 4</button>
            <div id="n4" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Cantidad de Usuarios en Nivel 4</h4>
                    </div>
                    <div class="modal-body">
                      <p><?= GridView::widget([
                            'dataProvider' => $dp_nivelcuatro,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'Estado',
                                'Cantidad',
                            ],
                        ]); ?>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>

            </div>
          </div>
    
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#n5">Nivel 5</button>
            <div id="n5" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Cantidad de Usuarios en Nivel 5</h4>
                    </div>
                    <div class="modal-body">
                      <p><?= GridView::widget([
                            'dataProvider' => $dp_nivelcinco,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'Estado',
                                'Cantidad',
                            ],
                        ]); ?>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>

            </div>
          </div>
    
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#n6">Nivel 6</button>
            <div id="n6" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Cantidad de Usuarios en Nivel 6</h4>
                    </div>
                    <div class="modal-body">
                      <p><?= GridView::widget([
                            'dataProvider' => $dp_nivelseis,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'Estado',
                                'Cantidad',
                            ],
                        ]); ?>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>

            </div>
          </div>
</div>
</div>