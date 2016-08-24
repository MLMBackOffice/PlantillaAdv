<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Users;

/**
 * UsersSearch represents the model behind the search form about `common\models\Users`.
 */
class NivelSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'patrocinador'], 'integer'],
            [['username', 'nombre_completo'], 'safe'],
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
        $query= (new \yii\db\Query())
                ->select(['(case when estado=1 then "Registrados" else case when estado=2 then "Activos" else "Inactivos" end end) as Estado',
                        'count(DISTINCT id) as Cantidad'])
                   // 'u.estado as Estado'])
                ->from('users') 
                //->Join ('users p', 'u.patrocinador=p.id');
                ->where('patrocinador=:patrocinador', [':patrocinador' => Yii::$app->user->identity->id])
                ->andWhere(['<>', 'estado', 0])
                ->groupBy('patrocinador, estado');

        
        
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
            //'p.id' => Yii::$app->user->identity->id,
//            'pais' => $this->pais,
//            'patrocinador' => $this->patrocinador,
//            'activate' => $this->activate,
        ]);
//
//        $query->andFilterWhere(['like', 'username', $this->username])
//            ->andFilterWhere(['like', 'nombre_completo', $this->nombre_completo])
//            ->andFilterWhere(['like', 'email', $this->email])
//            ->andFilterWhere(['like', 'password', $this->password])
//            ->andFilterWhere(['like', 'authKey', $this->authKey])
//            ->andFilterWhere(['like', 'direccion_billetera', $this->direccion_billetera])
//            ->andFilterWhere(['like', 'accessToken', $this->accessToken]);

        return $dataProvider;
    }
}
