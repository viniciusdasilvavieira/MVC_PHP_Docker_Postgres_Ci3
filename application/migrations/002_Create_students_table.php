<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Migration_Create_students_table Class
 *
 * Creates the 'students' table in the database.
 * Defines a foreign key constraint with the 'units' table.
 * Inserts example data into the 'students' table.
 */
class Migration_Create_students_table extends CI_Migration
{
  /**
   * Up Method
   *
   * Creates the 'students' table, defines a foreign key constraint,
   * and inserts example data into the 'students' table.
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
  
    // Inserting example data
    $students = array(
      [
        'name' => 'Joao Carlos',
        'birthdate' => '2013-05-15',
        'unit_id' => 2,
      ],
      [
        'name' => 'Juliana Alves',
        'birthdate' => '2013-02-23',
        'unit_id' => 3,
      ],
      [
        'name' => 'Andressa Rios',
        'birthdate' => '2012-07-11',
        'unit_id' => 3,
      ],
      [
        'name' => 'Marcos Paulo',
        'birthdate' => '2014-02-13',
        'unit_id' => NULL,
      ],
      [
        'name' => 'Joaquim Silva',
        'birthdate' => '2010-01-01',
        'unit_id' => NULL,
      ],
      [
        'name' => 'Marta Passos',
        'birthdate' => '2013-09-09',
        'unit_id' => NULL,
      ]
    );

    $this->db->insert_batch('students', $students);
  }

  /**
   * Down Method
   *
   * Drops the 'students' table and its foreign key constraint.
   */
  public function down()
  {
    $this->db->query('ALTER TABLE students DROP CONSTRAINT fk_unit_id');
    $this->dbforge->drop_table('students');
  }
}