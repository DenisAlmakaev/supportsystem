<?php

namespace app\models;


use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\BaseActiveRecord;
use yii\db\Expression;
use yii\db\ActiveRecord;


/**
 * Это класс модели для таблицы «requests».
 *
 * @property int $id
 * @property int $user_id
 * @property string $theme
 * @property string $email
 * @property string $text
 * @property string $filename
 * @property string $category
 * @property string $service
 * @property string $priority
 * @property string $created_at
 * @property string $updated_at

 */

class Requests extends ActiveRecord
{
    /**
     * {}
     */
    public $file;

    public static function tableName(): string
    {
        return 'requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['user_id'], 'integer'],
            [['theme', 'email'], 'required'],
            [['email'], 'email'],
            ['theme', 'string', 'min' => 10],
            [['text', 'service', 'category', 'priority'], 'safe'],
            [['created_at', 'updated_at'], 'safe'],
            [['filename'], 'string', 'max' => 100],
            [['file'], 'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'theme' => 'Тема обращения',
            'email' => 'Е-майл',
            'text' => 'Содержание',
            'filename' => 'Файл',
            'file' => 'Загрузите файл',
            'category' => 'Категория',
            'service' => 'Сервис',
            'priority' => 'Приоритет',
            'created_at' => 'Создано',
            'updated_at' =>'Изменено'
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
