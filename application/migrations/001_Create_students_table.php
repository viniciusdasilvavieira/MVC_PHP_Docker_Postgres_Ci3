<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_students_table extends CI_Migration {

    public function up() {
        // $this->db->query("
        //     CREATE TABLE students (
        //         id SERIAL PRIMARY KEY,
        //         name VARCHAR(255)
        //     )
        // ");
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
      $this->dbforge->create_table('students', true);
    }

    public function down() {
      $this->dbforge->drop_table('students');
      //  $this->db->query("DROP TABLE IF EXISTS students");
    }
}