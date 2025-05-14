<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "diagnosed_issues".
 *
 * @property int $id
 * @property int $device_id
 * @property string $diagnosed_problem
 * @property int $cost
 */
class DiagnosedIssues extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diagnosed_issues';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_id', 'diagnosed_problem', 'cost'], 'required'],
            [['cost'], 'number'],
            [['device_id', 'cost'], 'integer'],
            [['diagnosed_problem'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'device_id' => 'Device ID',
            'diagnosed_problem' => 'Diagnosed Problem',
            'cost' => 'Cost',
        ];
    }

}
