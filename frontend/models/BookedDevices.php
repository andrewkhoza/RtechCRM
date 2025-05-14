<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booked_devices".
 *
 * @property int $id
 * @property int $client_id
 * @property int $technician_id
 * @property int $checkin_agent_id
 * @property string $brand
 * @property string $model
 * @property string $colour
 * @property string $type
 * @property string $branch
 * @property string $bookin_date
 * @property string|null $job_completion_date
 * @property string|null $collection_date
 * @property string $assessment_fee
 */
class BookedDevices extends \yii\db\ActiveRecord
{

    const BOOKED_SCENARIO = 'booked';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booked_devices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'technician_id', 'checkin_agent_id', 'brand', 'model', 'colour', 'type', 'branch', 'bookin_date', 'assessment_fee','status'], 'required'],
            [['total_cost'],'required','on'=>self::BOOKED_SCENARIO],
            [['client_id', 'technician_id', 'checkin_agent_id'], 'integer'],
            [['bookin_date', 'job_completion_date', 'collection_date'], 'safe'],
            [['brand', 'model', 'colour', 'type', 'branch', 'assessment_fee'], 'string', 'max' => 255],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::BOOKED_SCENARIO] = ['client_id', 'technician_id', 'checkin_agent_id', 'brand', 'model', 'colour', 'type', 'branch', 'bookin_date', 'assessment_fee','total_cost','status'];    

        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'technician_id' => 'Technician ID',
            'checkin_agent_id' => 'Checkin Agent ID',
            'brand' => 'Brand',
            'model' => 'Model',
            'colour' => 'Colour',
            'type' => 'Type',
            'branch' => 'Branch',
            'bookin_date' => 'Bookin Date',
            'job_completion_date' => 'Job Completion Date',
            'collection_date' => 'Collection Date',
            'assessment_fee' => 'Assessment Fee',
        ];
    }

    public function getClient()
    {
        return $this->hasOne(\app\models\Clients::className(), ['id' => 'client_id']);
    }
    public function getUser()
    {
        return $this->hasOne(\app\models\UserInfo::className(), ['id' => 'technician_id']);
    }
    public function getReported()
    {
        return $this->hasOne(\app\models\ReportedIssues::className(), ['device_id' => 'id']);
    }
}
