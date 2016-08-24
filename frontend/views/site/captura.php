<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use frontend\assets\CapturaAsset;

CapturaAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);

$this->title = 'WeiFastPay';
?>

<?php if($_GET['pat']){ 
    
    $user_pat=$_GET['pat'];   
    
    ?>
<div class="row header">
	<div class="col-md-2 col-xs-3 logo">
		<?php echo Html::img('@web/dist/img/logo-cap.png', ['class' => 'img-responsive'], ['alt' => 'Logo WeiFastPay']) ?>
	</div>
	<div class="col-md-7 col-xs-9 titulo text-center">
		<h1>¿Ya estás listo para la mejor Oportunidad de Negocio?</h1>
		<h2>¡Creado por Networkers para Networkers!</h2>
	</div>
	<div class="col-md-3 col-xs-12 perfil">
		<div class="imagen-perfil"><?php echo Html::img('@web/dist/img/perfil.png', ['class' => 'img-circle img-responsive'], ['alt' => 'Foto de Perfil']) ?></div>
		<div class="texto-perfil"><p>Has sido invitado por <em><strong><?php echo  $patr ?></strong></em></p></div>
	</div>
</div>
<div class="row videos">
	<div class="col-md-2">
		
            <!-- Codigo para Contador -->
            
                 <iframe src="https://www.weifastpay.com/contador/contador.html" width="177px" height="235px" style="border:0"></iframe>


            <!-- Fin Contador -->
            
	</div>
	<div class="col-md-6 col-xs-12 video-ppal text-center">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<iframe class="embed-responsive-item" width="640" height="360" src="https://www.youtube.com/embed/0kTLl9j3qPw?rel=0&amp;showinfo=0&amp;autoplay=1" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 boton">
				<a href="https://www.weifastpay.com/bo/frontend/web/site/register?pat=<?php echo  $user_pat ?>" target="_blank" class="btn-success btn-lg">Registrarme  <i class="fa fa-user-plus" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-xs-12 videitos">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<iframe class="embed-responsive-item" width="260" height="146" src="https://www.youtube-nocookie.com/embed/IQeW4pEuC3I?rel=0" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<iframe class="embed-responsive-item" width="260" height="146" src="https://www.youtube-nocookie.com/embed/Fp7G16ie3I0?rel=0" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<iframe class="embed-responsive-item" width="260" height="146" src="https://www.youtube-nocookie.com/embed/8G09S3A08Aw?rel=0" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>

<?php }

else{ ?>
     <div class="alert alert-success">
            <p><?= Html::a(Yii::t('app', 'Inicio'), ["index"]) ?></p>
            
        </div>
<?php } ?>