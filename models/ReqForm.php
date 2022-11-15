<?php

namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

class ReqForm extends ActiveRecord{

    public static function tableName(): string
    {
        return 'requests';

    }


    public function attributeLabels(): array
    {
        return [

            'theme' => 'Тема обращения',
            'email' => 'Е-майл',
            'text' => 'Содержание',
            'category' => 'Категория',
            'service' => 'Сервис',
            'priority' => 'Приоритет'

        ];

    }

    public function rules(): array
    {
        return [
            [[ 'theme', 'email'], 'required'],
            ['email', 'email'],
            ['theme', 'string', 'min' => 10],
            [['text', 'service', 'category', 'priority'], 'safe'],
            [['created_at', 'updated_at'], 'safe'],

        ];
    }


    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],

        ];
    }

}




