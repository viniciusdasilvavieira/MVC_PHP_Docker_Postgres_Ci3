<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_classes_table extends CI_Migration {

    public function up() {
      $fields = array(
        'id' => array(
            'type' => 'SERIAL',
            'unsigned' => true,
            'auto_increment' => true
        ),
        'name' => array(
            'type' => 'VARCHAR',
            'constraint' => 255
        )
      );
      
      $this->dbforge->add_field($fields);
      $this->dbforge->add_key('id', true);
      $this->dbforge->create_table('classes', true);
    }

    public function down() {
      $this->dbforge->drop_table('classes');
    }
}