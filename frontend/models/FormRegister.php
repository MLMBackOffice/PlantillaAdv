<?php

namespace app\models;
use Yii;
use yii\base\model;
use common\models\Users;

class FormRegister extends model{
 
    public $patrocinador;
    public $pais;
    public $nombre_completo;
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $direccion_billetera;
    
    public function rules()
    {
        return [
            ['patrocinador', 'required'],
            
            ['pais', 'required'],
            
            ['direccion_billetera', 'required'],
            
            ['nombre_completo','trim'],
            ['nombre_completo', 'required'],
            ['nombre_completo', 'string', 'min' => 4, 'max' => 100],
            
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'username_existe'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'email_existe'],
            
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Las contrasseñas no coinciden'],            
        ];
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
    
    public function validatePatrocinador() {
        
         $user = static::findOne(["username" => $this->patrocinador]);

        if (!$user ) {
            $this->addError('patrocinador', 'Patrocinador no existe.');
        }
    }
    
    public function email_existe($attribute, $params)
    {
  
  //Buscar el email en la tabla
  $table = Users::find()->where("email=:email", [":email" => $this->email]);
  
  //Si el email existe mostrar el error
  if ($table->count() == 1)
  {
                $this->addError($attribute, "El email seleccionado existe");
  }
    }
 
    public function username_existe($attribute, $params)
    {
  //Buscar el username en la tabla
  $table = Users::find()->where("username=:username", [":username" => $this->username]);
  
  //Si el username existe mostrar el error
  if ($table->count() == 1)
  {
                $this->addError($attribute, "El usuario seleccionado existe");
  }
    }
 
}