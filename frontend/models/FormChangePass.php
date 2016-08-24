<?php
 
namespace app\models;
use Yii;
use yii\base\Model;
use common\models\User;
 
class FormChangePass extends model{
 
 public $current_password;
 public $new_password; 
 public $new_password_repeat;
     
    public function rules()
    {
        return [
            [['current_password', 'new_password', 'new_password_repeat'], 'required', 'message' => 'Campo requerido'],
            [['current_password'], 'validateCurrentPassword'],
            ['current_password', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 6 y máximo 16 caracteres'],
            ['new_password', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 6 y máximo 16 caracteres'],
            ['new_password_repeat', 'compare', 'compareAttribute' => 'new_password', 'message' => 'Las contraseñas no coinciden'],
        ];
    }
    
    
    public function validateCurrentPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }
    
        protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findIdentity(Yii::$app->user->id);
        }

        return $this->_user;
    }
}