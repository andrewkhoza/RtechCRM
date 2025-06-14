<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EmailText;

/**
 * EmailTextSearch represents the model behind the search form of `app\models\EmailText`.
 */
class EmailTextSearch extends EmailText
{
    /**
     * {@inheritdoc}
     */
    public $emails;
    
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'text', 'email_subject', 'email_brief', 'view', 'emails'], 'safe'],
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
        $query = EmailText::find();

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'email_subject', $this->email_subject])
            ->andFilterWhere(['like', 'email_brief', $this->email_brief])
            ->andFilterWhere(['like', 'view', $this->view])
            ->andFilterWhere(['like', 'type', $this->type]);
        
        if(isset($this->emails) && !empty($this->emails) && is_array($this->emails)){
            $query->andFilterWhere(['in', 'view', $this->emails]);
        }

        return $dataProvider;
    }
}
