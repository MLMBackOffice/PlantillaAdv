<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Compra;

/**
 * CompraSearch represents the model behind the search form about `backend\models\Compra`.
 */
class CompraSearch extends Compra
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_compra', 'id_usuario', 'id_paquete'], 'integer'],
            [['fecha_registro'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Compra::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_compra' => $this->id_compra,
            'fecha_registro' => $this->fecha_registro,
            'id_usuario' => $this->id_usuario,
            'id_paquete' => $this->id_paquete,
        ]);

        return $dataProvider;
    }
}
