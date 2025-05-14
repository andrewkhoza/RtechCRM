<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cancellation_reason".
 *
 * @property int $id
 * @property int $device_id
 * @property string $reason
 */
class CancellationReason extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cancellation_reason';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_id', 'reason'], 'required'],
            [['device_id'], 'integer'],
            [['reason'], 'string', 'max' => 255],
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
            'reason' => 'Reason',
        ];
    }

}
