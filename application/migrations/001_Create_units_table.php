<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Migration_Create_units_table Class
 *
 * Creates the 'units' table in the database.
 * Inserts example data into the 'units' table.
 */
class Migration_Create_units_table extends CI_Migration {

  /**
   * Up Method
   *
   * Creates the 'units' table and inserts example data.
   */
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
      'teacher' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('units', true);

    // Inserting example data
    $units = array(
      [
        'name' => 'MAT-02',
        'teacher' => 'Julia'
      ],
      [
        'name' => 'FIS-05',
        'teacher' => 'Valeria',
      ],
      [
        'name' => 'QUI-01',
        'teacher' => 'Ricardo'
      ]
    );
    $this->db->insert_batch('units', $units);
  }

  /**
   * Down Method
   *
   * Drops the 'units' table.
   */
  public function down() {
    $this->dbforge->drop_table('units');
  }
}