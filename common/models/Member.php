<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Member extends ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
        return 'member';
    }

    public static function emailExists($email)
    {
        return static::find()
            ->where(['email' => $email])
            ->exists();

    }

    public function setPassword($password)
    {
        $this->password = \Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

    public static function findByEmail($email)
    {
        return static::find()->where(['email'=>$email])->one();
    }


    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        return md5('123456');
    }


    public function getId()
    {
        return $this->id;

    }

    public function getAuthKey()
    {
        return md5('123456');

    }

    public function validateAuthKey($authKey)
    {
       return $this->authKey == $authKey;
    }

    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    public function getNeighborhood()
    {
        return $this->hasOne(Neighborhood::className(), ['id' => 'neighborhood_id']);
    }

    public function getPhones()
    {
        return $this->hasMany(PhoneNumber::className(), ['user_id' => 'id']);
    }
}