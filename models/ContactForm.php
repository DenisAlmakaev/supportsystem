<?php

namespace app\models;

use Yii;
use yii\base\Model;


class ContactForm extends Model
{

    public $email;
    public $body;
    public $verifyCode;


    public function rules(): array
    {
        return [
            [['email',  'body'], 'required'],
            ['email', 'email'],
            ['verifyCode', 'captcha'],
        ];
    }


    public function attributeLabels(): array
    {
        return [
            'email' => 'Е-майл',
            'body' => 'Сообщение',
            'verifyCode' => 'Введите код с картинки',
        ];
    }


    public function contact($email): bool
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
                ->setSubject($this->email)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }



}




