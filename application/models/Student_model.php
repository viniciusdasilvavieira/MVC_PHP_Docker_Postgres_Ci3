<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Student_model
 *
 * This model handles operations related to students.
 */
class Student_model extends CI_Model {

  /**
   * Get all students.
   *
   * @return array Returns an array containing all students. Returns an empty array if no students exist.
   */
  public function get_students()
  {
    return $this->db->get('students')->result();
  }

 /**
   * Get student by ID.
   *
   * @param int $id The ID of the student to retrieve.
   * @return object|null Returns the student object if found, otherwise returns null.
   */
  public function get_student($id)
  {
    $query = $this->db->get_where('students', array('id' => $id));
    return $query->row();
  }

  /**
   * Get assigned students.
   *
   * @return array Returns an array containing all students with a unit assigned. Returns an empty array if no students are assigned.
   */
  public function get_assigned_students()
  {
    $this->db->select('*');
    $this->db->from('students');
    $this->db->where('unit_id !=', null);

    $query = $this->db->get();
    return $query->result();
  }

  /**
   * Get unassigned students.
   *
   * @return array Returns an array containing all students with no unit assigned. Returns an empty array if all students are assigned.
   */
  public function get_unassigned_students()
  {
    $this->db->select('*');
    $this->db->from('students');
    $this->db->where('unit_id', null);

    $query = $this->db->get();
    return $query->result();
  }

  /**
   * Check if student exists.
   *
   * @param int $student_id The ID of the student to check.
   * @return bool Returns true if the student exists, otherwise returns false.
   */
  public function student_exists($student_id){
    $query = $this->db->get_where('students', array('id' => $student_id));
    if ($query->num_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Insert student.
   *
   * @param array $data The data of the student to insert.
   * @return bool Returns true if the insertion is successful, otherwise returns false.
   */
  public function insert_student($data)
  {
    $this->db->insert('students', $data);
    return $this->db->affected_rows() > 0;
  }

  /**
   * Update student.
   *
   * @param int $id The ID of the student to update.
   * @param array $data The data to update the student with.
   * @return bool Returns true if the update is successful, otherwise returns false.
   */
  public function update_student($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update('students', $data);

    return $this->db->affected_rows() > 0;
  }

  /**
   * Delete student.
   *
   * @param int $id The ID of the student to delete.
   * @return bool Returns true if the deletion is successful, otherwise returns false.
   */
  public function delete_student($id)
  {
    $this->db->delete('students', array('id' => $id));
    return $this->db->affected_rows() > 0;
  }
}
?>