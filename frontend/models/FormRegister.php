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
    public $idioma;
    public $fecha_nacimiento;
    
    public function rules()
    {
        return [
            ['patrocinador', 'required'],
            //['patrocinador', 'validatePatrocinador'],
            
            ['pais', 'required'],
            
            ['direccion_billetera', 'required'],
            ['direccion_billetera', 'direccion_existe'],
            
            ['idioma', 'required'],
            
            ['nombre_completo','trim'],
            ['nombre_completo', 'required'],
            ['nombre_completo', 'string', 'min' => 15, 'max' => 100],
            
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 6, 'max' => 255],
            ['username', 'username_existe'],
            
            ['fecha_nacimiento','safe'],
            [['fecha_nacimiento'], 'date', 'format'=>'php:Y-m-d'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'email_existe'],
            
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app','Passwords do not match')],
            ['password_repeat', 'safe'],
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
            'idioma' => Yii::t('app', 'Language'),
            'fecha_nacimiento' => Yii::t('app', 'Birthdate'),
        ];
    }
    
    public function validatePatrocinador($attribute) {
        
         //$user = static::findOne(["username" => $this->patrocinador]);
         $table = Users::find()->where("username=:username", [":username" => $this->patrocinador]);

        if ($table->count() != 1) {
            $this->addError($attribute, Yii::t('app','Sponsor wrote not exist in our database.'));
        }
    }
    
    public function email_existe($attribute, $params)
    {
  
        //Buscar el email en la tabla
        $table = Users::find()->where("email=:email", [":email" => $this->email]);

        //Si el email existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, Yii::t('app','This email already exists.'));
        }
    }
 
    public function username_existe($attribute, $params)
    {
        //Buscar el username en la tabla
        $table = Users::find()->where("username=:username", [":username" => $this->username]);
  
        //Si el username existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, Yii::t('app','This user already exists.'));
        }
    }
    
     public function direccion_existe($attribute, $params)
    {
        //Buscar el username en la tabla
        $table = Users::find()->where("direccion_billetera=:direccion_billetera", [":direccion_billetera" => $this->direccion_billetera]);
  
        //Si el username existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, Yii::t('app','This wallet address already exists.'));
        }
    }
 
}