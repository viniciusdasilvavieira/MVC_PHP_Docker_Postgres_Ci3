<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_students_classes_table extends CI_Migration {

    public function up() {
      $fields = array(
        'student_id' => array(
            'type' => 'INT',
            'unsigned' => true,
        ),
        'class_id' => array(
            'type' => 'INT',
            'unsigned' => true,
        )
      );

      $this->dbforge->add_field($fields);
      $this->dbforge->create_table('students_classes', true);

      //looks like dbforge->add_foreign_key doesn't work with postgres
      $this->db->query('ALTER TABLE students_classes ADD CONSTRAINT fk_student_id FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE');
      $this->db->query('ALTER TABLE students_classes ADD CONSTRAINT fk_class_id FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE');
    }

    public function down() {
      $this->dbforge->drop_table('students_classes');
    }
}