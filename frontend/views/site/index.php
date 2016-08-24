<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
/* @var $this yii\web\View */

$this->title = 'Wei Fast Pay | Back Office';
?>
<div class="site-index">

<div class='languages'>
            <?php 
                foreach(Yii::$app->params['languages'] as $key => $language){
                    echo '<span class="language" id='.$key.'>'.Html::a(Yii::t('app', $language.' | '), ['language', 'language' => $key]).'</span>';                    
                }
            ?>
        </div> 


    <div class="jumbotron">
        <?php echo Html::img('@web/dist/img/logo.png') ?>	
        <h1><?= Yii::t('app', 'Congratulations') ?> <?php echo  Yii::$app->user->identity->username ?>!</h1>
        

        <p class="lead"><?= Yii::t('app', 'Already a member of our team!') ?></p>
        <p class="lead"><?= Yii::t('app', 'At this moment already you can modify the information of your profile, acquire a membership '
                . 'and check your organization in order that you have a clear idea of all that you can start receiving from September 17, 2016, date of our official launch.') ?> </p>
        <p class="lead"><?= Html::a(Yii::t('app', 'Meter of Earnings'), ['/PDF/MEDIDOR%20GANANCIAS%20WEIFASTPAY%20V2.2.xlsx']) ?>.</p>
        <p class="lead"><?= Yii::t('app', 'Remember to help all the members of your equipment in order that they acquire his membership and to be able like that to enjoy all the benefits') ?>.</p>  
        <p class="lead" style="text-align:center"><?= Yii::t('app', 'To invite to your prospectuses to which they register copy and send them the following url') ?>:<br> 
            <strong>Invitados en español: <span style="color:#32b496" >https://www.weifastpay.com/bo/frontend/web/site/captura?pat=<?php echo  Yii::$app->user->identity->username ?> </span> </strong><br>
            <strong>Invited in English: <span style="color:#32b496" >https://www.weifastpay.com/bo/frontend/web/site/landing?pat=<?php echo Yii::$app->user->identity->username ?> </span> </strong>
        </p>      
    </div>
    
  
</div>