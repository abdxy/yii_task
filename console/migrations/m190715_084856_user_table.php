<?php

use yii\db\Migration;

/**
 * Class m190715_084856_user_table
 */
class m190715_084856_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('member', [
            'id' => $this->primaryKey(),
            'password' => $this->string()->notNull(),
            'email' => $this->string()->unique()->notNull(),
            'country_id' => $this->integer()->notNull(),
            'city_id' => $this->integer(),
            'neighborhood_id' => $this->integer(),
            'birth_date' => $this->date()->notNull(),
            'gender' => $this->char(1)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'created_by' => $this->integer(),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->integer(),

        ]);


        $this->createIndex(
            'idx-user-country_id',
            'member',
            'country_id'
        );
        $this->createIndex(
            'idx-user-city_id',
            'member',
            'city_id'
        );
        $this->createIndex(
            'idx-user-neighborhood_id',
            'member',
            'neighborhood_id'
        );



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('member');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190715_084856_user_table cannot be reverted.\n";

        return false;
    }
    */
}
