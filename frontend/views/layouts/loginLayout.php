<?php
use frontend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

LoginAsset::register($this);
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
<body class="login-page">
    <?php $this->beginBody() ?>
    <div class="wrap">
        <div style="text-align: center">
             <?php echo Html::a(Html::img('@web/dist/img/logo-verde.png'), 'https://www.weifastpay.com') ?>
        </div>
        <div class="container">
            <?= $content ?>            
        </div>        
    </div>
    
    <footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; WeiFastPay <?= date('Y') ?></p>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>