<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Users;

/**
 * UsersSearch represents the model behind the search form about `common\models\Users`.
 */
class DirectosSearch extends Users
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
                
                ->select(['u.username as Usuario', 'u.nombre_completo as Nombre', 'u.email as Correo', 
                    '(case when u.estado=0 then "Inactivo" else 
                    case when u.estado=1 then "Registrado" else "Activo" end end) as Estado'])
                   // 'u.estado as Estado'])
                ->from('users u') 
                //->Join ('users p', 'u.patrocinador=p.id');
                ->where('patrocinador=:patrocinador', [':patrocinador' => Yii::$app->user->identity->id])
                 ->andWhere(['<>', 'u.estado', 0]);
                
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
        return $dataProvider;
    }
}