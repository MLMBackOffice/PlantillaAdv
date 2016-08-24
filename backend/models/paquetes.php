<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "paquetes".
 *
 * @property integer $id_paquete
 * @property string $costo
 * @property string $nombre
 *
 * @property Compra[] $compras
 */
class paquetes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paquetes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['costo'], 'number'],
            [['nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_paquete' => Yii::t('app', 'Id Paquete'),
            'costo' => Yii::t('app', 'Costo'),
            'nombre' => Yii::t('app', 'Paquete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compra::className(), ['id_paquete' => 'id_paquete']);
    }

    /**
     * @inheritdoc
     * @return PaquetesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaquetesQuery(get_called_class());
    }
}
