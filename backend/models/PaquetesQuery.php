<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[paquetes]].
 *
 * @see paquetes
 */
class PaquetesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return paquetes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return paquetes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
