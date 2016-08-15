<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Users;

/**
 * UsersSearch represents the model behind the search form about `common\models\Users`.
 */
class AfiliadosSearch extends Users
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
                ->select(['p.id', 'p.username as Usuario', 'p.nombre_completo as Nombre',
                            'count(DISTINCT u1.username) as N1', 'count(DISTINCT u2.id) as N2', 'count(DISTINCT u3.id) as N3', 
                            'count(DISTINCT u4.id) as N4', 'count(DISTINCT u5.id) as N5', 'count(DISTINCT u6.id) as N6'])
                ->from('users p')
                ->leftJoin('users u1', 'u1.patrocinador=p.id')
                ->leftJoin('users u2', 'u2.patrocinador=u1.id')
                ->leftJoin('users u3', 'u3.patrocinador=u2.id')
                ->leftJoin('users u4', 'u4.patrocinador=u3.id')
                ->leftJoin('users u5', 'u5.patrocinador=u4.id')
                ->leftJoin('users u6', 'u6.patrocinador=u5.id')
                ->where(['<>', 'p.id', 1])
                ->groupBy('p.username, p.nombre_completo');
        
        $query1= (new \yii\db\Query())
                ->select(['p.username as user_pat', 'p.nombre_completo as nombre_pat',
                    'count(u1.username) as user_directo', 'count(u2.username) as n2'])
                ->from('users p')
                ->leftJoin('users u1', 'u1.patrocinador=p.id')
                ->leftJoin('users u2', 'u2.patrocinador=u1.id')
                ->where(['<>', 'p.id', 1])
                ->groupBy('p.username, p.nombre_completo');

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
            'p.id' => Yii::$app->user->identity->id,
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
