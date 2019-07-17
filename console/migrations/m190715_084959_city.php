<?php

use yii\db\Migration;

/**
 * Class m190715_084959_city
 */
class m190715_084959_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('city', [
            'id' => $this->primaryKey(),
            'country_id' => $this->integer(),
            'name' => $this->string(),
            'created_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->integer(),

        ]);

        $this->addForeignKey(
            'fk-city-country_id',
            'city',
            'country_id',
            'country',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('city');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190715_084959_city cannot be reverted.\n";

        return false;
    }
    */
}
