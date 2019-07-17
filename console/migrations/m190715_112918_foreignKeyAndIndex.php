<?php

use yii\db\Migration;

/**
 * Class m190715_112918_foreignKeyAndIndex
 */
class m190715_112918_foreignKeyAndIndex extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-user-country_id',
            'member',
            'country_id',
            'country',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user-city_id',
            'member',
            'city_id',
            'city',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user-neighborhood_id',
            'member',
            'neighborhood_id',
            'neighborhood',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190715_112918_foreignKeyAndIndex cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190715_112918_foreignKeyAndIndex cannot be reverted.\n";

        return false;
    }
    */
}
