<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string $name
 * @property string $lastname
 * @property string $email
 * @property string $cell
 * @property string|null $alt_cell
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'lastname', 'email', 'cell'], 'required'],
            [[ 'email'], 'email'],
            [[ 'cell','alt_cell'], 'number'],
            [['name', 'lastname', 'email', 'cell', 'alt_cell'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'cell' => 'Phone',
            'alt_cell' => 'Alt Phone',
        ];
    }
}
