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
    return $query->num_rows();
  }

  //returns students with no unit assigned, always returns an array, empty if no students
  public function get_unassigned_students()
  {
    $this->db->select('*');
    $this->db->from('students');
    $this->db->where('unit_id', null);

    $query = $this->db->get();
    return $query->result();
  }

  //checks if student with matching id exists, returns true if exists
  public function student_exists($student_id){
    $query = $this->db->get_where('students', array('id' => $student_id));
    if ($query->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
  }

  //inserts new student into the db, returns true if successful
  public function insert_student($data)
  {
    $this->db->insert('students', $data);
    return $this->db->affected_rows() > 0;
  }

  //updates student with matching id, returns true if successful
  public function update_student($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update('students', $data);

    return $this->db->affected_rows() > 0;
  }

  //deletes unit with matching id, returns true if successful
  public function delete_student($id)
  {
    $this->db->delete('students', array('id' => $id));
    return $this->db->affected_rows() > 0;
  }
}
?>