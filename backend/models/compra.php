<?php

namespace backend\models;

use Yii;
use common\models\Users;

/**
 * This is the model class for table "compra".
 *
 * @property integer $id_compra
 * @property string $fecha_registro
 * @property integer $id_usuario
 * @property integer $id_paquete
 * @property string $estado
 * @property integer $empresa_id
 * @property string $fecha_vencimiento
 * @property integer $Id_confirmacion
 *
 * @property Empresa $empresa
 * @property ConfirmacionCompra $idConfirmacion
 * @property Paquetes $idPaquete
 * @property Users $idUsuario
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
            [['fecha_registro', 'fecha_vencimiento'], 'safe'],
            [['id_usuario', 'id_paquete'], 'required'],
            [['id_usuario', 'id_paquete', 'estado', 'empresa_id', 'Id_confirmacion'], 'integer'],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresa_id' => 'Id']],
            [['Id_confirmacion'], 'exist', 'skipOnError' => true, 'targetClass' => ConfirmacionCompra::className(), 'targetAttribute' => ['Id_confirmacion' => 'Id_confirmacion']],
            [['id_paquete'], 'exist', 'skipOnError' => true, 'targetClass' => Paquetes::className(), 'targetAttribute' => ['id_paquete' => 'id_paquete']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_usuario' => 'id']],
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
            'id_paquete' => Yii::t('app', 'Id Paquete'),
            'estado' => Yii::t('app', '0:pendiente 1: confirmada 2: finalizada'),
            'empresa_id' => Yii::t('app', 'Empresa ID'),
            'fecha_vencimiento' => Yii::t('app', 'Fecha Fin'),
            'Id_confirmacion' => Yii::t('app', 'Id Confirmacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['Id' => 'empresa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdConfirmacion()
    {
        return $this->hasOne(ConfirmacionCompra::className(), ['Id_confirmacion' => 'Id_confirmacion']);
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
    public function getIdUsuario()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_usuario']);
    }

    /**
     * @inheritdoc
     * @return ConfirmacionCompraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConfirmacionCompraQuery(get_called_class());
    }
}
