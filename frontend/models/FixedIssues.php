<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fixed_issues".
 *
 * @property int $id
 * @property int $device_id
 * @property string $solution
 * @property int $amount
 */
class FixedIssues extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fixed_issues';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_id', 'solution', 'amount'], 'required'],
            [['device_id', 'amount'], 'integer'],
            [['solution'], 'string', 'max' => 255],
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
            'solution' => 'Solution',
            'amount' => 'Amount',
        ];
    }

}
