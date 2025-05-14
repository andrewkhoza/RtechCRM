<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BookedDevices;

/**
 * BookedDevicesSearch represents the model behind the search form of `app\models\BookedDevices`.
 */
class BookedDevicesSearch extends BookedDevices
{

    public $client_name;
    public $technician_name;
    public $reported_problem;
    public $status;
    public $checkin_agent;
    public $cell;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'technician_id', 'checkin_agent_id'], 'integer'],
            [['brand', 'model', 'colour', 'type', 'branch', 'bookin_date', 'job_completion_date', 'collection_date', 'assessment_fee','client_name','cell','technician_name','reported_problem','status','checkin_agent'], 'safe'],
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
        $query = BookedDevices::find()
                ->joinWith('client')
                ->joinWith('reported')
                ->joinWith('user');

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
            'client_id' => $this->client_id,
            'technician_id' => $this->technician_id,
            'checkin_agent_id' => $this->checkin_agent_id,
            'bookin_date' => $this->bookin_date,
            'job_completion_date' => $this->job_completion_date,
            'collection_date' => $this->collection_date,
        ]); 

        $query
            ->andFilterWhere(['like', 'client_name', $this->client_name])
            ->andFilterWhere(['like', 'technician_name', $this->technician_name])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'colour', $this->colour])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'branch', $this->branch])
            ->andFilterWhere(['like', 'cell', $this->cell])
            ->andFilterWhere(
                is_array($this->status)
                    ? ['in', 'status', $this->status]
                    : ['like', 'status', $this->status]
            )
            ->andFilterWhere(['like', 'reported_problem', $this->reported_problem])
            ->andFilterWhere(['like', 'checkin_agent', $this->checkin_agent])
            ->andFilterWhere(['like', 'assessment_fee', $this->assessment_fee]);

        return $dataProvider;
    }
}
