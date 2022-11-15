<?php
 
namespace app\models;
 
use Yii;
use yii\base\Model;
 
/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;
 
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\app\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'Нет пользователя с таким адресом электронной почты.'
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'email' => 'Е-майл',
        ];
    }
 
    /**
     * Отправляет электронное письмо со ссылкой для сброса пароля.
     *
     * @return bool было ли письмо отправлено

     */
    public function sendEmail(): bool
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);
 
        if (!$user) {
            return false;
        }
 
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

 
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
           ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Сброс пароля')
            ->send();


    }
 
}