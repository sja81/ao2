<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class PartnerLoginForm extends Model
{
    public $partnerId;
    public $password;

    private $_partner;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            ['partnerId', 'required', 'message'=>'Partnern IS nemôže byť prázdne'],
            ['password', 'required', 'message'=>'Heslo nemôže byť prázdne'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Neplatné heslo alebo užívateľ neexistuje');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return Partner|null
     */
    protected function getUser()
    {
        if ($this->_partner === null) {
            $this->_partner = User::findByUsername($this->username);
        }

        return $this->_partner;
    }
}
