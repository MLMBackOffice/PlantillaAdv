<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
 
<?=
$this->title = Yii::t('app', 'Time Out');
?>


<?php if ($msg): ?>
            <h3 class="alert alert-danger"><?= Yii::t('app', $msg) ?></h3>
            <?= $redirect ?> 
        <?php endif; ?>