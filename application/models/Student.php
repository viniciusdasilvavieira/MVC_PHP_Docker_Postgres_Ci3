<?php
class Student extends CI_Model {

    //inserts new student into database, returns true if successful
    public function insert_student($name) {
      $data = array(
        'name' => $name
      );

      $this->db->insert('students', $data);
      
      if ($this->db->affected_rows() > 0) {
        return true;
      } else {
        return false;
      }
    }

    //returns all students, always returns an array, empty if no students
    public function get_students() {
      return $this->db->get('students')->result();
    }

    //returns student with matching id, null if no student
    public function get_student($id) {
      $query = $this->db->get_where('students', array('id' => $id));
      if ($query->num_rows() > 0) {
          return $query->row();
      } else {
          return null; 
      }
    }
}
?>