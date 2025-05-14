<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact_us".
 *
 * @property int $id
 * @property string $company_name
 * @property string $building
 * @property string $street_name
 * @property string $code
 * @property string $town
 * @property string $province
 * @property string $country
 * @property string $tin
 * @property string $phone
 * @property string $alt_phone
 * @property string $email
 * @property string $website
 */
class ContactUs extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact_us';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_name', 'building', 'street_name', 'code', 'town', 'province', 'country', 'tin', 'phone', 'alt_phone', 'email', 'website'], 'required'],
            [['company_name', 'building', 'street_name', 'code', 'town', 'province', 'country', 'tin', 'phone', 'alt_phone', 'email', 'website'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => 'Company Name',
            'building' => 'Building',
            'street_name' => 'Street Name',
            'code' => 'Code',
            'town' => 'Town',
            'province' => 'Province',
            'country' => 'Country',
            'tin' => 'Tin',
            'phone' => 'Phone',
            'alt_phone' => 'Alt Phone',
            'email' => 'Email',
            'website' => 'Website',
        ];
    }

}
