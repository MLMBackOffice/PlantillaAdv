<?php
namespace frontend\models;

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

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
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
}
