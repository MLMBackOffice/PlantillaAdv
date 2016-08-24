<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[empresa]].
 *
 * @see empresa
 */
class EmpresaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return empresa[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return empresa|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
