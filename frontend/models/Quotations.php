<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quotations".
 *
 * @property int $id
 * @property int $device_id
 * @property string $path
 */
class Quotations extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quotations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_id', 'path'], 'required'],
            [['device_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
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
            'path' => 'Path',
        ];
    }

}
