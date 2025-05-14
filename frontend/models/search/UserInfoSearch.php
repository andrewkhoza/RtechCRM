<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserInfo;

/**
 * UserInfoSearch represents the model behind the search form of `app\models\UserInfo`.
 */
class UserInfoSearch extends UserInfo
{

    public $role;
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id','role'], 'integer'],
            [['name', 'lastname', 'cell','email'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = UserInfo::find();

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
            'id' => $this->id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'cell', $this->cell]);

        return $dataProvider;
    }

    public function search2($params)
    {
        $query = UserInfo::find();

        $query->joinWith('user');
        
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
        // if(isset($this->role) && !empty($this->role)){
        //     $this->role = explode(',', $this->role);
        //     foreach ($this->role as $key => $value) {
        //         $this->role[$key] = (int)$this->role[$key];
        //     }
        // }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user.role' => $this->role,

        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'cell', $this->cell])
            ->andFilterWhere(['like', 'user.email', $this->email]);

        return $dataProvider;
    }
}
