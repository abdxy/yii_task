<?php

use yii\db\Migration;

/**
 * Class m190715_084921_phone_no
 */
class m190715_084921_phone_no extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('phone_no', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'number' => $this->string(20),
            'created_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->integer(),

        ]);

        $this->createIndex(
            'idx-phone_no-user_id',
            'phone_no',
            'user_id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('phone_no');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190715_084921_phone_no cannot be reverted.\n";

        return false;
    }
    */
}
