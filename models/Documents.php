<?php

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\db\Expression;


/**
 * Это класс модели для таблицы «documents».
 *
 * @property int $id
 * @property string $name
 * @property string $forms
 * @property string $description
 * @property string $filename
 * @property string $created_at
 * @property string $updated_at
 */


class Documents extends ActiveRecord
{

    public $file;

    public static function tableName(): string
    {
        return 'documents';
    }


    public function rules(): array
    {
        return [
            [['name', 'forms' ], 'required'],
            [['filename'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 150],
//            [['file'], 'file',
////              'skipOnEmpty' => false,
//                'maxSize' => 5*(1024*1024),    //5MB
//                'extensions' => 'pdf, doc, docx'],
            [['file'], 'file'],


            ];

    }



    public function attributeLabels(): array
    {
        return [
            'name' => 'Имя документа',
            'description' => 'Описание',
            'created_at' => 'Создано',
            'updated_at' =>'Изменено',
            'file' => 'Загрузите файл',
            'filename' => 'Файл',
            'forms' => 'Форма документа',


        ];
    }



    public function getAuthor (): ActiveQuery
    {
        return $this->hasOne(User::class(),['id'=>'user_id']);
    }


    public function getUser (): ActiveQuery
    {
        return $this->hasOne(User::class(),['id'=>'user_id']);
    }




    public function behaviors(): array
    {
        return [
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false,
            ],

            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],

                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),

            ]

        ];
    }


}