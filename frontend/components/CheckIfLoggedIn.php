<?php
namespace app\modules\user\components;

class CheckIfLoggedIn extends \yii\base\Behavior{
    
    public function events(){
        return[
       // \yii\web\Application::EVENT_BEFORE_REQUEST => 'changeLanguage',
            \yii\web\Application::EVENT_BEFORE_REQUEST => 'checkIfLoggedIn',
        ];
    }
    
    public function changeLanguage(){
        if(\Yii::$app->getRequest()->getCookies()->has('lang')){
            \Yii::$app->language = \Yii::$app->getRequest()->getCookies()->getValue('lang');
        }
    }
    
    public function checkIfLoggedIn() {
        
        if (\Yii::$app->user->isGuest) {
            echo 'No has iniciado sesión';
        }                
    }
}

?>