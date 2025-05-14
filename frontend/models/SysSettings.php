<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys_settings".
 *
 * @property int $id
 * @property int $inactive_time
 */
class SysSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inactive_time'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'inactive_time' => 'Inactive Time',
        ];
    }
}
