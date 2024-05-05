<?php
class Student_model extends CI_Model {

  //returns all students, always returns an array, empty if no students
    public function get_students()
    {
      return $this->db->get('students')->result();
    }

    //returns student with matching id, null if no student
    public function get_student($id)
    {
      $query = $this->db->get_where('students', array('id' => $id));
      if ($query->num_rows() > 0) {
          return $query->row();
      } else {
          return null; 
      }
    }

    //inserts new student into the db, returns true if successful
    public function insert_student($data)
    {
      $this->db->insert('students', $data);
      
      if ($this->db->affected_rows() > 0) {
        return true;
      } else {
        return false;
      }
    }

    //updates student with matching id, returns true if successful
    public function update_student($id, $data)
    {
      $this->db->where('id', $id);
      $this->db->update('students', $data);

      if ($this->db->affected_rows() > 0) {
        return true;
      } else {
        return false;
      }
    }

    //deletes unit with matching id, returns true if successful
    public function delete_student($id)
    {
      $this->db->delete('students', array('id' => $id));
      
      if ($this->db->affected_rows() > 0) {
        return true;
      } else {
        return false;
      }
    }
}
?>