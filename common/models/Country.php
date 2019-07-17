<?php
namespace common\models;

use yii\db\ActiveRecord;

class Country extends ActiveRecord
{

    /**
    * @return string the name of the table associated with this ActiveRecord class.
    */
    public static function tableName()
    {
    return 'country';
    }
}