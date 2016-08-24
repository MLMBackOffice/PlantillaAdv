<?php

namespace common\models;
use Yii;
use yii\db\ActiveRecord;

class Users extends ActiveRecord{
    
    public static function getDb()
    {
        return Yii::$app->db;
    }
    
    public static function tableName()
    {
        return 'users';
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
    
}