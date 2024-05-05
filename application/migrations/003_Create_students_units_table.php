<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_students_units_table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'student_id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
            'unit_id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
        ));

        $this->dbforge->create_table('students_units');

        $this->db->query('ALTER TABLE students_units ADD CONSTRAINT fk_student_id FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE');
        $this->db->query('ALTER TABLE students_units ADD CONSTRAINT fk_unit_id FOREIGN KEY (unit_id) REFERENCES units(id) ON DELETE CASCADE');
    }

    public function down() {
        $this->dbforge->drop_table('students_units');
    }
}