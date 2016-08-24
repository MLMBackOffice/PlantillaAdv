<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%empresa}}".
 *
 * @property integer $Id
 * @property string $cardId
 * @property string $nombre
 *
 * @property Compra[] $compras
 */
class empresa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%empresa}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id'], 'required'],
            [['Id', 'nombre'],  'string', 'max' => 100],
            [['cardId'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'cardId' => 'Card ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compra::className(), ['empresa_id' => 'Id']);
    }

    /**
     * @inheritdoc
     * @return EmpresaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmpresaQuery(get_called_class());
    }
}
