<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "email_text".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property string $email_subject
 * @property string|null $email_brief
 * @property string $view
 */
class EmailText extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email_text';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'text', 'email_subject'], 'required'],
            [['text'], 'string'],
            [['type'], 'number'],
            [['name', 'email_subject', 'email_brief'], 'string', 'max' => 255],
            [['email_brief', 'view'], 'safe'],
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
            'text' => 'Text',
            'email_subject' => 'Email Subject',
            'email_brief' => 'Email Brief',
            'view' => 'Email View',
            'type' => 'Type',
        ];
    }
}
