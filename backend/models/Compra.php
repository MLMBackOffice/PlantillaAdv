<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "compra".
 *
 * @property integer $id_compra
 * @property string $fecha_registro
 * @property integer $id_usuario
 * @property integer $id_paquete
 *
 * @property Paquetes $idPaquete
 * @property User[] $users
 */
class Compra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'compra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_registro'], 'safe'],
            [['id_usuario', 'id_paquete'], 'required'],
            [['id_usuario', 'id_paquete'], 'integer'],
            [['id_paquete'], 'exist', 'skipOnError' => true, 'targetClass' => Paquetes::className(), 'targetAttribute' => ['id_paquete' => 'id_paquete']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_compra' => Yii::t('app', 'Id Compra'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
            'id_usuario' => Yii::t('app', 'Id Usuario'),
            'id_paquete' => Yii::t('app', 'Paquete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPaquete()
    {
        return $this->hasOne(Paquetes::className(), ['id_paquete' => 'id_paquete']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id_compra' => 'id_compra']);
    }

    /**
     * @inheritdoc
     * @return CompraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompraQuery(get_called_class());
    }
}
