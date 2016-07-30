<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property integer $id
 * @property string $usuario
 * @property integer $nit
 * @property string $nombres
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario', 'nit', 'nombres'], 'required'],
            [['nit'], 'integer'],
            [['usuario'], 'string', 'max' => 50],
            [['nombres'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'usuario' => Yii::t('app', 'Usuario'),
            'nit' => Yii::t('app', 'Nit'),
            'nombres' => Yii::t('app', 'Nombres'),
        ];
    }
}
