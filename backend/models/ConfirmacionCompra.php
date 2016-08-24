<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "confirmacion_compra".
 *
 * @property integer $Id_confirmacion
 * @property string $observacion
 * @property string $fecha_confirmacion
 *
 * @property Compra[] $compras
 */
class ConfirmacionCompra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'confirmacion_compra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id_confirmacion', 'observacion'], 'required'],
            [['Id_confirmacion'], 'integer'],
            [['fecha_confirmacion'], 'safe'],
            [['observacion'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id_confirmacion' => Yii::t('app', 'Id Confirmacion'),
            'observacion' => Yii::t('app', 'Observacion'),
            'fecha_confirmacion' => Yii::t('app', 'Fecha Confirmacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compra::className(), ['Id_confirmacion' => 'Id_confirmacion']);
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
