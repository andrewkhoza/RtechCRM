<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reported_issues".
 *
 * @property int $id
 * @property int $device_id
 * @property string $problem
 * @property string|null $password
 * @property string|null $notes
 */
class ReportedIssues extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reported_issues';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password', 'notes'], 'default', 'value' => null],
            [['device_id', 'problem'], 'required'],
            [['device_id'], 'integer'],
            [['problem', 'password', 'notes'], 'string', 'max' => 255],
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
            'problem' => 'Problem',
            'password' => 'Password',
            'notes' => 'Notes',
        ];
    }

}
