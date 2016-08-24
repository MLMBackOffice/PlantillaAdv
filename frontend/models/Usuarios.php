<?php

namespace common\models;

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
 * @property Usuarios $patrocinador0
 * @property Usuarios[] $usuarios
 */
class Usuarios extends \yii\db\ActiveRecord
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
            [['patrocinador'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['patrocinador' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'nombre_completo' => Yii::t('app', 'Nombre Completo'),
            'pais' => Yii::t('app', 'Pais'),
            'idioma' => Yii::t('app', 'Idioma'),
            'email' => Yii::t('app', 'Email'),
            'fecha_nacimiento' => Yii::t('app', 'Fecha Nacimiento'),
            'password' => Yii::t('app', 'Password'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'patrocinador' => Yii::t('app', 'Patrocinador'),
            'direccion_billetera' => Yii::t('app', 'Direccion Billetera'),
            'accessToken' => Yii::t('app', 'Access Token'),
            'activate' => Yii::t('app', '0: usuario sin activar su cuenta a través del correo - 1: usuario con cuenta activada.'),
            'estado' => Yii::t('app', '0: inactivo, 1: activo, 2: activado'),
            'verification_code' => Yii::t('app', 'Verification Code'),
            'fecha_creacion' => Yii::t('app', 'Fecha Creacion'),
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
        return $this->hasOne(Usuarios::className(), ['id' => 'patrocinador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['patrocinador' => 'id']);
    }
}
