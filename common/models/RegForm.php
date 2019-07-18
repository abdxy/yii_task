<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class RegForm extends Model
{
    private $_user;

    public $email;
    public $password;
    public $country;
    public $city;
    public $neighborhood;
    public $birthDate;
    public $gender;
    public $phoneNo;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password','country'], 'required'],
            ['email','validateEmail'],
            ['email','email'],
            [['birthDate','gender'],'safe'],
            [['country','city','neighborhood'],'integer'],
            ['phoneNo','each', 'rule' => ['udokmeci\yii2PhoneValidator\PhoneValidator'] ],

//            ['countryId','validateCountry'],
//            ['cityId','validateCity'],
//            ['$neighborhoodId','validateNeighborhood'],
        ];
    }

    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {

            if (Member::emailExists($this->email)) {
                $this->addError($attribute, 'invalid email');
            }
        }
    }

    public function signUp()
    {

        if (!$this->validate()) {

            return false;
        }

        $user = new Member();
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->country_id = $this->country;
        $user->city_id = $this->city;
        $user->neighborhood_id = $this->neighborhood;
        $user->gender = $this->gender;
        $user->created_at = date("Y-m-d");
        $user->birth_date = date("Y-m-d", strtotime($this->birthDate));
        if($user->save())
        {
        foreach ($this->phoneNo as $phoneNO){
            $phone = new PhoneNumber();
            $phone->user_id = $user->id;
            $phone->number = str_replace('+','00',$phoneNO);
            $phone->save();
        }
            return $user;

        }
        else return null;
    }

}
