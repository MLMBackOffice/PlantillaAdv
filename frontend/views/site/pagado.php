<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
 
<?=
$this->title = Yii::t('app', 'Successful Payment');
?>


<?php if ($msg): ?>
            <h3 class="alert alert-success"><?= Yii::t('app', $msg) ?></h3>
            <?= $redirect ?> 
        <?php endif; ?>