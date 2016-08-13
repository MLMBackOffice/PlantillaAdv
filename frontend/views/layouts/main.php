<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\DashboardAsset;
use common\widgets\Alert;

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
<body class="hold-transition skin-green sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?php echo Html::img('@web/dist/img/logo-mini.png') ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo Html::img('@web/dist/img/logo-header.png') ?></span>
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
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= Yii::$app->user->identity->nombre_completo; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?= Yii::$app->user->identity->nombre_completo; ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
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
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
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
          <a href="#">
            <i class="fa fa-dashboard"></i> <span><?= Yii::t('app', 'Dashboard'); ?></span>
            <span class="pull-right-container">
            </span>
          </a>          
        </li>
        <li class="treeview">
          <a href="http://localhost/PlantillaAdv/frontend/web/index.php?r=users%2Fupdate&id=<?= Yii::$app->user->identity->id ?> ">
            <i class="fa fa-user"></i>
            <span><?= Yii::t('app', 'Profile'); ?></span>
            <?php //Html::a(Yii::t('app', 'Profile'),["/site/perfil"]);?>
            <?php //Html::a(Yii::t('app', 'Profile'), ['update', 'id' => Yii::$app->user->identity->id]) ?>
            <span class="pull-right-container">
            </span>
           </a>
        </li>
        <li>
          <a href="#">
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
            <li><a href="#"><i class="fa fa-circle-o"></i><?= Yii::t('app', 'Direct'); ?></a></li>
            <li><a href="http://localhost/PlantillaAdv/frontend/web/index.php?r=site%2Fred"><i class="fa fa-circle-o"></i><?= Yii::t('app', 'By Levels'); ?></a></li>
          </ul>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-trophy"></i> 
            <span><?= Yii::t('app', 'Commissions'); ?></span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-flag-o"></i> 
            <span><?= Yii::t('app', 'Reports'); ?></span>
          </a>
        </li>
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span><?= Yii::t('app', 'Support Center'); ?></span>            
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= Yii::t('app', 'Dashboard') ?>
          </h1>
        <div class='languages'>
            <?php 
                foreach(Yii::$app->params['languages'] as $key => $language){
                    echo '<span class="language" id='.$key.'>'.Html::a(Yii::t('app', $language.' | '), ['language', 'language' => $key]).'</span>';
                    //Html::a(Yii::t('app', $language.' | '), ['language', 'language' => $key]);
                }
            ?>
            
            <?php // Html::beginForm() ?>
            <?php //Html::dropDownList('language', Yii::$app->language, ['pt_BR' => 'Portugues', 'it_IT' => 'Italian']) ?>
            <?php //Html::a(Yii::t('app', 'Ruso'), ['language', 'lang' => 'ru-RU']) ?>
            <?php // Html::endForm() ?>
        </div> 
    </section>

    <!-- Main content -->
    <section class="content">
  
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
