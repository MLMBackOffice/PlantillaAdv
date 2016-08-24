<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\Cookie;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\ContactForm;
use common\models\User;
use common\models\Users;
use common\models\AfiliadosSearch;
use common\models\DirectosSearch;
use app\models\FormRegister;
use app\models\FormChangePass;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Session;
use app\models\FormRecoverPass;
use app\models\FormResetPass;
use yii\web\NotFoundHttpException;
use backend\models\Idiomas;
use \yii\web\Request;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */



    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','captura','confirm','signup','red','perfil','register','resetpass','captura','directos', 'pagado','timeout','novalue'],
                'rules' => [
                    [
                        'actions' => ['register','confirm','language','recoverpass','resetpass','captura'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','perfil','red','directs','afiliados','set-cookie','show-cookie','pagado','timeout', 'novalue'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionIndex() {
        
        Yii::$app->language = Yii::$app->getRequest()->getCookies()->getValue('language');
        
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["login"]);
        } else {
            return $this->render('index');
        }
    }
    
    public function actionInicio() {
       $user = Yii::$app->user->identity;
       return $this->render('inicio',compact('user'));
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        
        $this->layout = 'loginLayout';
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
        
        Yii::$app->language = Yii::$app->getRequest()->getCookies()->getValue('language');
                
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        //return $this->actionLogin();
        return $this->redirect(["login"]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    
    private function randKey($str='', $long=0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
  
 public function actionConfirm()
 {
    $table = new Users;
    if (Yii::$app->request->get())
    {
   
        //Obtenemos el valor de los parámetros get
        $id = Html::encode($_GET["id"]);
        $authKey = $_GET["authKey"];
    
        if ((int) $id)
        {
            //Realizamos la consulta para obtener el registro
            $model = $table
            ->find()
            ->where("id=:id", [":id" => $id])
            ->andWhere("authKey=:authKey", [":authKey" => $authKey]);
 
            //Si el registro existe
            if ($model->count() == 1)
            {
                $activar = Users::findOne($id);
                $activar->activate = 1;
                if ($activar->update())
                {
                    echo '<h3 class="alert alert-success" style="text-align:center">'.Yii::t('app','Congratulations registration carried out correctly. You are being redirected...').'</h3>';
                    echo "<meta http-equiv='refresh' content='5; ".Url::toRoute("login")."'>";
                }
                else
                {
                    echo '<h3 class="alert alert-success" style="text-align:center">'.Yii::t('app','There was an error when registering. You are being redirected...').'</h3>';
                    echo "<meta http-equiv='refresh' content='5; ".Url::toRoute("login")."'>";
                }
             }
            else //Si no existe redireccionamos a login
            {
                return $this->redirect(["login"]);
            }
        }
        else //Si id no es un número entero redireccionamos a login
        {
            return $this->redirect(["login"]);
        }
    }
 }
 
 public function actionRegister() {

Yii::$app->language = Yii::$app->getRequest()->getCookies()->getValue('language');
if (Yii::$app->user->isGuest) {  

    $this->layout = 'registerLayout'; 
    //Creamos la instancia con el model de validación
    $model = new FormRegister;
    $usuario = new User;
    //Tomar el usuario del patrocinador
    $patr = Yii::$app->getRequest()->getQueryParam('pat');
    $post = Yii::$app->request->post();
  
    if ($patr) {

        $patrocinador = Users::find()->where(["username" => $patr])->one();

        if ($patrocinador){
            $model->patrocinador = urlencode($patrocinador->id);
        }
        else {
            $model->patrocinador = null;
            $patr = null;
        }
    }
  
  
    //Mostrará un mensaje en la vista cuando el usuario se haya registrado
    $msg = null;
    if ($model->load($post)) { 
    //Validación mediante ajax
          if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
                {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }

        //Validación cuando el formulario es enviado vía post
        //Esto sucede cuando la validación ajax se ha llevado a cabo correctamente
        //También previene por si el usuario tiene desactivado javascript y la
        //validación mediante ajax no puede ser llevada a cabo
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                //user-patrocinador
                $patrocinador = Users::find()->where(["username" => $post['FormRegister']['patrocinador']])->one();
                $model->patrocinador = urlencode($patrocinador->id);   
                
                //Idioma
                /*$codigo_idioma = $post['FormRegister']['idioma'];
                $idioma = Idiomas::find()->where(["codigo" => $codigo_idioma])->one();
                $model->idioma = urlencode($idioma->id); */

                //Preparamos la consulta para guardar el usuario
                $table = new Users;
                $table->username = $model->username;
                $table->fecha_nacimiento = $model->fecha_nacimiento;
                $table->email = $model->email;
                //Encriptamos el password
                $table->password = crypt($model->password, Yii::$app->params["salt"]);
               // $table->password = $model->password;
                //Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
                //clave será utilizada para activar el usuario
                $table->authKey = $this->randKey("abcdef0123456789", 200);
                //Creamos un token de acceso único para el usuario
                $table->accessToken = $this->randKey("abcdef0123456789", 200);


                $table->patrocinador = $model->patrocinador;
                $table->pais = $model->pais;
                $table->nombre_completo = $model->nombre_completo;
                $table->direccion_billetera = $model->direccion_billetera;
                $table->idioma = $model->idioma;

                //Si el registro es guardado correctamente
                if ($table->insert())
                {
                    //Nueva consulta para obtener el id del usuario
                    //Para confirmar al usuario se requiere su id y su authKey
                    $user = $table->find()->where(["email" => $model->email])->one();
                    $id = urlencode($user->id);
                    $authKey = urlencode($user->authKey);
                    $baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());
                   $subject = "Confirmar registro";
                   $body = "<h2>Felicitaciones! Eres nuevo miembro de WeiFastPay! </h2>";
                    $body .="Queremos darte la bienvenida a esta gran oportunidad que apenas comienza. ";
                    $body .="Para iniciar en tu oficina virtual y activar tu cuenta con el usuario y la contraseña que elegiste, Haz clic en el siguiente enlace: ";                          
                   $body .= "<a href='http://www.weifastpay.com".$baseUrl."/frontend/web/site/confirm?id=".$id."&authKey=".$authKey."'>Confirmar</a>";

                   //Enviamos el correo
                   Yii::$app->mailer->compose()
                   ->setTo($user->email)
                   ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
                   ->setSubject($subject)
                   ->setHtmlBody($body)
                   ->send();
                   
                   // enviar correo a patrocinador
                   $subject = "Tienes un nuevo Usuario en tu equipo!";
                   $body = "<h3>Estimado usuario de WeiFastPay, el presente comunicado es para informarle que se ha registrado un nuevo usuario y usted es el patrocinador. Felicitaciones!!</h3>";
                   $body .= "<h4>Nombre: ".$model->nombre_completo."<h4>";
                   $body .= "<h4> Usuario: ".$model->username."<h4>";
                   $body .= "<h4> Correo: ".$model->email."<h4>";

                   //Enviamos el correo
                   Yii::$app->mailer->compose()
                   ->setTo($patrocinador->email)
                   ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
                   ->setSubject($subject)
                   ->setHtmlBody($body)
                   ->send();

                   $model->username = null;
                   $model->email = null;
                   $model->password = null;
                   $model->password_repeat = null;
                   $model->patrocinador = null;
                   $model->nombre_completo = null;
                   $model->direccion_billetera = null;

                   $msg = Yii::t('app','Congratulations, you now only need to confirm your registration in your mailbox.');
                   
                   Yii::$app->language = $model->idioma;

                    $languageCookie = new Cookie([
                        'name' => 'language',
                        'value' => $model->idioma,
                        'expire' => time() + 60 * 60 * 24 * 30, // 30 days
                    ]);
                    Yii::$app->response->cookies->add($languageCookie);
                   
                }
                else
                {
                    $msg = Yii::t('app','Failed to perform your registration, please try again');
                }

            }
            else
            {
             $model->getErrors();
            }
        }
    }
    return $this->render("register", ["model" => $model, "msg" => $msg, "patr" =>$patr]);

   
        } else {
            Yii::$app->session->setFlash('error', 'Debes cerrar sesión para iniciar un registro.');
        }

   }

    /**
     * Requests password reset.
     *
     * @return mixed
     */

    
    public function actionSetCookie(){
        $cookie = new Cookie([
            'name' => 'test',
            'value' => 'test cookie'
        ]);
        
        Yii::$app->getResponse()->getCookies()->add($cookie);
    }
    
    public function actionShowCookie(){
        if(Yii::$app->getRequest()->getCookies()->has('test')){
            print_r(Yii::$app->getRequest()->getCookies()->getValue('test'));
        }
    }
    
        public function actionLanguage($language) {
            
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["login"]);
        } else 
            {
            Yii::$app->language = $language;

        $languageCookie = new Cookie([
            'name' => 'language',
            'value' => $language,
            'expire' => time() + 60 * 60 * 24 * 30, // 30 days
        ]);
        Yii::$app->response->cookies->add($languageCookie);
        
        return $this->render('index');
       }
    }
    
    
   
    public function actionRed()
    {
        if (Yii::$app->user->isGuest) {
                return $this->redirect(["site/login"]);
            } else {
                $searchModel = new AfiliadosSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('red', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
    }

        public function actionDirects()
        {
            
            if (Yii::$app->user->isGuest) {
                return $this->redirect(["site/login"]);
            } else {
                $searchModel = new DirectosSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('directs', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
            ]);
            }
            
            
        }
    
    public function actionRecoverpass()
    {
     Yii::$app->language = Yii::$app->getRequest()->getCookies()->getValue('language');
      $baseUrl =  (new Request)->getBaseUrl();   
     $this->layout = 'loginLayout';   
     //Instancia para validar el formulario
     $model = new FormRecoverPass;

     //Mensaje que será mostrado al usuario en la vista
     $msg = null;

     if ($model->load(Yii::$app->request->post()))
     {
      if ($model->validate())
      {
       //Buscar al usuario a través del email
       $table = Users::find()->where("email=:email", [":email" => $model->email]);

       //Si el usuario existe
       if ($table->count() == 1)
       {
        //Crear variables de sesión para limitar el tiempo de restablecido del password
        //hasta que el navegador se cierre
        //$session = new Session;
        //$session->open();


         $recoverale = $this->randKey("abcdef0123456789", 200);
        
        $recoverCookie = new Cookie([
                'name' => 'recover',
                'value' => $recoverale,
                'expire' => time() + 60 * 60 * 1, // 1 hora
            ]);
         Yii::$app->response->cookies->add($recoverCookie);     


        //Esta clave aleatoria se cargará en un campo oculto del formulario de reseteado
        //$session["recover"] = $this->randKey("abcdef0123456789", 200);
        //$recover = $session["recover"];

        $recover =$recoverale;

        //También almacenaremos el id del usuario en una variable de sesión
        //El id del usuario es requerido para generar la consulta a la tabla users y 
        //restablecer el password del usuario
        $table = Users::find()->where("email=:email", [":email" => $model->email])->one();
        //$session["id_recover"] = $table->id;

        $idrecoverCookie = new Cookie([
                'name' => 'id_recover',
                'value' => $table->id,
                'expire' => time() + 60 * 60 * 1, // 1 hora
            ]);
        Yii::$app->response->cookies->add($idrecoverCookie);
        
        
        //Esta variable contiene un número hexadecimal que será enviado en el correo al usuario 
        //para que lo introduzca en un campo del formulario de reseteado
        //Es guardada en el registro correspondiente de la tabla users
        $verification_code = $this->randKey("abcdef0123456789", 8);
        //Columna verification_code
        $table->verification_code = $verification_code;
        //Guardamos los cambios en la tabla users
        $table->save();

        //Creamos el mensaje que será enviado a la cuenta de correo del usuario
        $subject = "Recuperar password";
        $body = "<p>Copie el siguiente código de verificación para restablecer su password ... ";
        $body .= "<strong>".$verification_code."</strong></p>";
        $body .= "<p><a href='https://www.weifastpay.com/bo/frontend/web/site/resetpass'>Recuperar password</a></p>";

        //Enviamos el correo
        Yii::$app->mailer->compose()
        ->setTo($model->email)
        ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
        ->setSubject($subject)
        ->setHtmlBody($body)
        ->send();

        //Vaciar el campo del formulario
        $model->email = null;
      //  echo '<pre>'; print_r($session["id_recover"]); die;
        
        //Mostrar el mensaje al usuario
        $msg = 'We have sent a message to your email in order that you could reset your password';
       }
       else //El usuario no existe
       {
        $msg = "Ha ocurrido un error";
       }
      }
      else
      {
       $model->getErrors();
      }
     }
     return $this->render("recoverpass", ["model" => $model, "msg" => $msg]);
    }

    public function actionResetpass()
    {
       Yii::$app->language = Yii::$app->getRequest()->getCookies()->getValue('language'); 
       $this->layout = 'loginLayout';
     //Instancia para validar el formulario
        $model = new FormResetPass;

        //Mensaje que será mostrado al usuario
        $msg = null;

        //Abrimos la sesión
        //$session = new Session;
        //$session->open();
        //Si no existen las variables de sesión requeridas lo expulsamos a la página de inicio
        //if (empty($session["recover"]) || empty($session["id_recover"]))
        //{
        // return $this->redirect(["site/index"]);
        //}


        $recoverCook = Yii::$app->getRequest()->getCookies()->getValue('recover');
        $idrecoverCook = Yii::$app->getRequest()->getCookies()->getValue('id_recover');
        
        if(empty($recoverCook) || empty($idrecoverCook)){
            return $this->redirect(["site/index"]);
        }
        else
        {

        //     $recover = $session["recover"];
         
         $recover = $recoverCook;
         //El valor de esta variable de sesión la cargamos en el campo recover del formulario
         $model->recover = $recover;

         //Esta variable contiene el id del usuario que solicitó restablecer el password
         //La utilizaremos para realizar la consulta a la tabla users
         //     $id_recover = $session["id_recover"];
         
         $id_recover = $idrecoverCook;

        }

        //Si el formulario es enviado para resetear el password
        if ($model->load(Yii::$app->request->post()))
        {
         if ($model->validate())
         {
          //Si el valor de la variable de sesión recover es correcta
          if ($recover == $model->recover)
          {
           //Preparamos la consulta para resetear el password, requerimos el email, el id 
           //del usuario que fue guardado en una variable de session y el código de verificación
           //que fue enviado en el correo al usuario y que fue guardado en el registro
           $table = Users::findOne(["email" => $model->email, "id" => $id_recover, "verification_code" => $model->verification_code]);

           //Encriptar el password
           $table->password = crypt($model->password, Yii::$app->params["salt"]);

           //Si la actualización se lleva a cabo correctamente
           if ($table->save())
           {

            //Destruir las variables de sesión
            //$session->destroy();

            //Vaciar los campos del formulario
            $model->email = null;
            $model->password = null;
            $model->password_repeat = null;
            $model->recover = null;
            $model->verification_code = null;

            $msg = 'Congratulations , your password has been reset properly, we are being redirected to the login page';
            $msg .= "<meta http-equiv='refresh' content='5; ".Url::toRoute("site/login")."'>";
           }
           else
           {
            $msg = "No se ha encontrado el email registrado";
           }

          }
          else
          {
           $model->getErrors();
          }
         }
        }

        return $this->render("resetpass", ["model" => $model, "msg" => $msg]);

    }
    
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }    

    
     public function actionCaptura() {
        $this->layout = 'capturaLayout'; 
        $patr = Yii::$app->getRequest()->getQueryParam('pat');

       if ($patr) {
             $patrocinador = Users::find()->where(["username" => $patr]);
             
             if ($patrocinador->one())
             $datos=['patr'=> $patrocinador->one()->nombre_completo];
           else {
              $datos=['patr'=>''];
           }
           
       }else {
              $datos=['patr'=>''];
           }
           

       return $this->render('captura',$datos);
   }
   
   public function actionLanding() {
        $this->layout = 'capturaLayout'; 
        $patr = Yii::$app->getRequest()->getQueryParam('pat');

       if ($patr) {
             $patrocinador = Users::find()->where(["username" => $patr]);
             
             if ($patrocinador->one())
             $datos=['patr'=> $patrocinador->one()->nombre_completo];
           else {
              $datos=['patr'=>''];
           }
           
       }else {
              $datos=['patr'=>''];
           }
           

       return $this->render('landing',$datos);
   }

    public function actionPassmod(){
        
        Yii::$app->language = Yii::$app->getRequest()->getCookies()->getValue('language');
        $model = new FormChangePass;
        $loadedpost = $model->load(Yii::$app->request->post());
        
        if($loadedpost && $user->validate()){
            $model->password = $model->newPassword;
            $model->save(false);            
            $var_dump($model->errors);
            Yii::$app->session->setFlash('success', 'Haz cambiado el password');
            return $this->refresh();
        }
        return $this->render('passmod', [
            'model'=>$model,
        ]);
    }


    public function actionPagado(){
        
        $this->layout = 'loginLayout';
        Yii::$app->language = Yii::$app->getRequest()->getCookies()->getValue('language');
        
        $msg = 'Congratulations, payment has been successful. You are being redirected...';
        $redirect = "<meta http-equiv='refresh' content='5; ".Url::toRoute("compra/create")."'>";
        
        return $this->render('pagado', [
            'msg'=>$msg,
            'redirect'=>$redirect,
        ]);
    }
    
        
    public function actionTimeout(){
        
        $this->layout = 'loginLayout';
        Yii::$app->language = Yii::$app->getRequest()->getCookies()->getValue('language');
        
        $msg = 'The waiting time has run out, please try again. You are being redirected...';
        $redirect = "<meta http-equiv='refresh' content='5; ".Url::toRoute("compra/create")."'>";
        
        return $this->render('timeout', [
            'msg'=>$msg,
            'redirect'=>$redirect,
        ]);
    }
    
        public function actionNovalue(){
        
        $this->layout = 'loginLayout';
        Yii::$app->language = Yii::$app->getRequest()->getCookies()->getValue('language');
        
        $msg = 'The amount paid does not correspond to the expected , please try again. You are being redirected...';
        $redirect = "<meta http-equiv='refresh' content='5; ".Url::toRoute("compra/create")."'>";
        
        return $this->render('novalue', [
            'msg'=>$msg,
            'redirect'=>$redirect,
        ]);
    }
}