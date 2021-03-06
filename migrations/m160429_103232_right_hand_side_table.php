<?php

use yii\db\Migration;

class m160429_103232_right_hand_side_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%right_hand_side}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'ontology_class' => $this->integer()->notNull(),
            'relationship' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey("right_hand_side_ontology_class_fk", "{{%right_hand_side}}",
            "ontology_class", "{{%ontology_class}}", "id", 'CASCADE');
        $this->addForeignKey("right_hand_side_relationship_fk", "{{%right_hand_side}}",
            "relationship", "{{%relationship}}", "id", 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%right_hand_side}}');
    }
}