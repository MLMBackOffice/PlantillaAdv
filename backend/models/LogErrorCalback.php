<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "log_error_calback".
 *
 * @property integer $Id
 * @property string $descripcion
 * @property string $fecha_registro
 */
class LogErrorCalback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_error_calback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'descripcion', 'fecha_registro'], 'required'],
            [['Id'], 'integer'],
            [['fecha_registro'], 'safe'],
            [['descripcion'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
        ];
    }

    /**
     * @inheritdoc
     * @return LogErrorCalbackQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LogErrorCalbackQuery(get_called_class());
    }
}
