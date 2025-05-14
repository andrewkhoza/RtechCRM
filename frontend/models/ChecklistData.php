<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checklist_data".
 *
 * @property int $id
 * @property int $device_id
 * @property string $data1
 * @property string $data2
 * @property string $data3
 * @property string $data4
 * @property string $data5
 * @property string $data6
 * @property string $data7
 * @property string $data8
 * @property string $data9
 * @property string $data10
 * @property string $data11
 * @property string $data12
 * @property string $data13
 * @property string $data14
 * @property string $data15
 * @property string $data16
 * @property string $data17
 */
class ChecklistData extends \yii\db\ActiveRecord
{

    const PHONE_SCENARIO = 'phone';
    const LAPTOP_SCENARIO = 'laptop';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'checklist_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_id'], 'required'],
            [['device_id', 'data1', 'data2', 'data3', 'data4', 'data5', 'data6', 'data7', 'data8', 'data9', 'data10', 'data11', 'data12', 'data13', 'data14', 'data15', 'data16'], 'required','on'=>self::LAPTOP_SCENARIO],
            [['device_id', 'data1', 'data2', 'data3', 'data4', 'data5', 'data6', 'data7'], 'required','on'=>self::PHONE_SCENARIO],
            [['device_id'], 'integer'],
            [['data1', 'data2', 'data3', 'data4', 'data5', 'data6', 'data7', 'data8', 'data9', 'data10', 'data11', 'data12', 'data13', 'data14', 'data15', 'data16', 'data17'], 'string', 'max' => 255],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::LAPTOP_SCENARIO] = ['device_id','data1', 'data2', 'data3', 'data4', 'data5', 'data6', 'data7', 'data8', 'data9', 'data10', 'data11', 'data12', 'data13', 'data14', 'data15', 'data16'];    
        $scenarios[self::PHONE_SCENARIO] = ['device_id','data1', 'data2', 'data3', 'data4', 'data5', 'data6', 'data7'];    

        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'device_id' => 'Device ID',
            'data1' => 'Data1',
            'data2' => 'Data2',
            'data3' => 'Data3',
            'data4' => 'Data4',
            'data5' => 'Data5',
            'data6' => 'Data6',
            'data7' => 'Data7',
            'data8' => 'Data8',
            'data9' => 'Data9',
            'data10' => 'Data10',
            'data11' => 'Data11',
            'data12' => 'Data12',
            'data13' => 'Data13',
            'data14' => 'Data14',
            'data15' => 'Data15',
        ];
    }

}
