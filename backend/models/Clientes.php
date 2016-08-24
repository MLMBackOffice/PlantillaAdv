<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $nombre_completo
 * @property integer $pais
 * @property string $idioma
 * @property string $email
 * @property string $fecha_nacimiento
 * @property string $password
 * @property string $authKey
 * @property integer $patrocinador
 * @property string $direccion_billetera
 * @property string $accessToken
 * @property integer $activate
 * @property integer $estado
 * @property string $verification_code
 * @property string $fecha_creacion
 *
 * @property Compra[] $compras
 * @property Paises $pais0
 * @property Idiomas $idioma0
 * @property Clientes $patrocinador0
 * @property Clientes[] $clientes
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'nombre_completo', 'pais', 'idioma', 'email', 'password', 'authKey', 'patrocinador', 'direccion_billetera', 'accessToken', 'verification_code'], 'required'],
            [['pais', 'patrocinador', 'activate', 'estado'], 'integer'],
            [['fecha_nacimiento', 'fecha_creacion'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['nombre_completo', 'direccion_billetera'], 'string', 'max' => 100],
            [['idioma'], 'string', 'max' => 10],
            [['email'], 'string', 'max' => 80],
            [['password', 'authKey', 'accessToken', 'verification_code'], 'string', 'max' => 250],
            [['pais'], 'exist', 'skipOnError' => true, 'targetClass' => Paises::className(), 'targetAttribute' => ['pais' => 'id']],
            [['idioma'], 'exist', 'skipOnError' => true, 'targetClass' => Idiomas::className(), 'targetAttribute' => ['idioma' => 'codigo']],
            [['patrocinador'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['patrocinador' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
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
            'estado' => Yii::t('app', 'Status = 0: inactive, 1: active, 2: activated'),            
            'fecha_creacion' => Yii::t('app', 'Registration Date'), 
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compra::className(), ['id_usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPais0()
    {
        return $this->hasOne(Paises::className(), ['id' => 'pais']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdioma0()
    {
        return $this->hasOne(Idiomas::className(), ['codigo' => 'idioma']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatrocinador0()
    {
        return $this->hasOne(Clientes::className(), ['id' => 'patrocinador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Clientes::className(), ['patrocinador' => 'id']);
    }
}