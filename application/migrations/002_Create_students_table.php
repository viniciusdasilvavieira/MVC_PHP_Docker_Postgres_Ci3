<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_students_table extends CI_Migration
{
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
        'constraint' => 255
      ),
      'birthdate' => array(
        'type' => 'DATE'
      ),
      'unit_id' => array(
        'type' => 'INT',
        'unsigned' => TRUE,
        'null' => TRUE,
      ),
    ));
    $this->dbforge->add_key('id', true);
    $this->dbforge->create_table('students', true);

    $this->db->query('ALTER TABLE students ADD CONSTRAINT fk_unit_id FOREIGN KEY (unit_id) REFERENCES units(id) ON DELETE SET NULL');
  }

  public function down()
  {
    $this->db->query('ALTER TABLE students DROP FOREIGN KEY fk_unit_id');
    $this->dbforge->drop_table('students');
  }
}