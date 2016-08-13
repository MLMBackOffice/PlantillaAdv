<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    
    public $patrocinador;
    public $pais;
    public $nombre_completo;
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $direccion_billetera;
    


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['patrocinador', 'required'],
            
            ['pais', 'required'],
            
            ['direccion_billetera', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This direccion has already been taken.'],
            
            ['nombre_completo','trim'],
            ['nombre_completo', 'required'],
            ['nombre_completo', 'string', 'min' => 4, 'max' => 100],
            
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'username_existe'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['email', 'email_existe'],
            
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Las contrasseñas no coinciden'],            
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->patrocinador = $this->patrocinador;
        $user->pais = $this->pais;
        $user->nombre_completo = $this->nombre_completo;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->direccion_billetera = $this->direccion_billetera;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
    
    public function validatePatrocinador() {
        
         $user = static::findOne(["username" => $this->patrocinador]);

        if (!$user ) {
            $this->addError('patrocinador', 'Patrocinador no existe.');
        }
    }
    
    public function attributeLabels() {
        return [
            'username' => Yii::t('app', 'Username'),
            'patrocinador' => Yii::t('app', 'Sponsor'),
            'pais' => Yii::t('app', 'Country'),
            'direccion_billetera' => Yii::t('app', 'Wallet Address'),
            'nombre_completo' => Yii::t('app', 'Full Name'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),            
            'password_repeat'=> Yii::t('app', 'Password Repeat'),
        ];
    }
    
    public function email_existe($attribute, $params)
    {
  
        //Buscar el email en la tabla
        $table = User::find()->where("email=:email", [":email" => $this->email]);

        //Si el email existe mostrar el error
        if ($table->count() == 1)
        {
             $this->addError($attribute, "El correo seleccionado ya existe");
        }
    }
    
    public function username_existe($attribute, $params)
    {
            //Buscar el username en la tabla
              $table = User::find()->where("username=:username", [":username" => $this->username]);
  
            //Si el username existe mostrar el error
            if ($table->count() == 1)
            {
                          $this->addError($attribute, "El usuario seleccionado ya existe");
            }
    }
}
