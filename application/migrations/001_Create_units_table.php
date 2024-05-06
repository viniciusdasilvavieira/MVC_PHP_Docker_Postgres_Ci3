<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_units_table extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'SERIAL',
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
      ),
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('units', true);
  }

  public function down() {
    $this->dbforge->drop_table('units');
  }
}