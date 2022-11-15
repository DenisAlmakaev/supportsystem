<?php
 
namespace app\models;
 
use yii\base\Exception;
use yii\base\Model;
use yii\base\InvalidArgumentException;
 
/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
 
    public $password;
 
    /**
     * @var User
     */
    private $_user;
 
    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, array $config = [])
    {
 
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Токен сброса пароля не может быть пустым.');
        }
 
        $this->_user = User::findByPasswordResetToken($token);
 
        if (!$this->_user) {
            throw new InvalidArgumentException('Неправильный токен сброса пароля.');
        }
 
        parent::__construct($config);
    }
 
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'password' => 'Пароль',
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     * @throws Exception
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save(false);
    }
 
}