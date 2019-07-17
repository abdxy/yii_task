<?php

use yii\db\Migration;

/**
 * Class m190715_085028_neighborhood
 */
class m190715_085028_neighborhood extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('neighborhood', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer(),
            'name' => $this->string(),
            'created_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->integer(),

        ]);

        $this->addForeignKey(
            'fk-neighborhood-city_id',
            'neighborhood',
            'city_id',
            'city',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('neighborhood');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190715_085028_neighborhood cannot be reverted.\n";

        return false;
    }
    */
}
