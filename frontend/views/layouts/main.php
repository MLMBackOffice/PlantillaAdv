<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\DashboardAsset;
use common\widgets\Alert;
use \yii\web\Request;

//$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());
$baseUrl =  (new Request)->getBaseUrl();

DashboardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-green sidebar-mini sidebar-collapse">

<?php $this->beginBody(); 

    if (Yii::$app->user->isGuest) { 
        
?>
    <div class="text-center">
        <div class="logo">
            <?= Html::a(Html::img('@web/dist/img/logo-header-black.png'), 'https://www.weifastpay.com', ['class' => 'profile-link']) ?>
        </div><br><br>
        <div class="enlaces-menu">
            <?= Html::a( Yii::t('app','Login'), ['site/login'], ['class' => 'btn btn-default btn-lg active']) ?>
        </div>
    <h3 class="alert alert-danger"><? Yii::t('app', 'This page does not exist or do not have permission to be here') ?></h3>
    </div>   
 <?php   
 
    }
    else{    
 ?>  


<div class="wrapper">
    <header class="main-header">
    <!-- Logo -->
    <a href=" <?= $baseUrl ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?php echo Html::img($baseUrl.'/dist/img/logo-mini.png') ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo Html::img($baseUrl.'/dist/img/logo-header.png') ?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?= Html::img('@web/dist/img/user2-160x160.jpg',[
                        'class' => 'user-image',
                        'alt' => 'Foto Usuario',
            ]) ?>
              <span class="hidden-xs"><?= Yii::$app->user->identity->nombre_completo; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?= Html::img('@web/dist/img/user2-160x160.jpg',[
                        'class' => 'img-circle',
                        'alt' => 'Foto Usuario',
            ]) ?>

                <p>
                  <?= Yii::$app->user->identity->nombre_completo; ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=$baseUrl;?>/index.php/clientes/view/<?= Yii::$app->user->identity->id ?> " class="btn btn-default btn-flat">Perfil</a>
                
                </div>
                <div class="pull-right">
               <?=   Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                    'Cerrar Sesión',
                    ['class' => 'btn btn-default btn-flat']
                    )
                    . Html::endForm() ?>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>
    <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?= Html::img('@web/dist/img/user2-160x160.jpg',[
                        'class' => 'img-circle',
                        'alt' => 'Foto Usuario',
            ]) ?>
        </div>
        <div class="pull-left info">
          <p><?= Yii::$app->user->identity->nombre_completo; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"><?= Yii::t('app', 'MAIN NAVIGATION'); ?></li>
        <li class="treeview">
          <a href="<?=$baseUrl;?>/index.php/site/index/">
            <i class="fa fa-dashboard"></i> <span><?= Yii::t('app', 'Dashboard'); ?></span>
            <span class="pull-right-container">
            </span>
          </a>          
        </li>
        <li class="treeview">
          <a href="<?=$baseUrl;?>/index.php/clientes/view/<?= Yii::$app->user->identity->id ?> ">
            <i class="fa fa-user"></i>
            <span><?= Yii::t('app', 'My Profile'); ?></span>
            <span class="pull-right-container">
            </span>
           </a>
        </li>

<!--<li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span><?= Yii::t('app', 'My Profile'); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=$baseUrl;?>/index.php/clientes/view/<?= Yii::$app->user->identity->id ?> "><i class="fa fa-circle-o"></i><?= Yii::t('app', 'Update Data')?></a></li>
            <li><a href="<?=$baseUrl;?>/index.php/site/passmod"><i class="fa fa-circle-o"></i><?= Yii::t('app', 'Change Password') ?></a></li>
          </ul>
        </li>-->


        <li>
          <a href="<?=$baseUrl;?>/index.php/compra/create/">
            <i class="fa fa-shopping-bag"></i> 
            <span><?= Yii::t('app', 'Memberships'); ?></span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span><?= Yii::t('app', 'Affiliate Network'); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=$baseUrl;?>/index.php/site/directs"><i class="fa fa-circle-o"></i><?= Yii::t('app', 'Direct'); ?></a></li>
            <li><a href="<?=$baseUrl;?>/index.php/site/red"><i class="fa fa-circle-o"></i><?= Yii::t('app', 'By Levels'); ?></a></li>
          </ul>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
  
        <?= $content ?>
    </div>
</div>

<footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; Wei Fast Pay <?= date('Y') ?></p>    
                 <p class="pull-right"><?= Html::a(Yii::t('app', 'Terminos y Condiciones'), ['/PDF/TerminosYCondiciones.pdf'],
                           ['target' => '_blank',
                            'alt' => 'Abrir Terminos y Condiciones',
                           ]) ?>
                 </p>
            </div
</footer>

<?php 
    }
$this->endBody() ?> 
</body>
</html>
<?php $this->endPage() ?>