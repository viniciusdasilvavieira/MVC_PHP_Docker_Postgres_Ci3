<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Unit_model
 *
 * This model handles operations related to units.
 */
class Unit_model extends CI_Model {

  /**
   * Get all units.
   *
   * @return array Returns an array containing all units. Returns an empty array if no units exist.
   */
  public function get_units()
  {
    return $this->db->get('units')->result();
  }

  /**
   * Get unit by ID.
   *
   * @param int $id The ID of the unit to retrieve.
   * @return object|null Returns the unit object if found, otherwise returns null.
   */
  public function get_unit($id)
  {
    $query = $this->db->get_where('units', array('id' => $id));
    return $query->row();
  }

  /**
   * Get unit name by ID.
   *
   * @param int $id The ID of the unit to retrieve the name for.
   * @return string|null Returns the name of the unit if found, otherwise returns null.
   */
  public function get_unit_name($id)
  {
    $query = $this->db->get_where('units', array('id' => $id));

    if ($query) {
      if ($query->num_rows() > 0) {
        return $query->row()->name;
      } else {
        return NULL;
      }
    } else {
      return NULL;
    }
  }

  /**
   * Get the number of students assigned to a unit.
   *
   * @param int $unit_id The ID of the unit to count students for.
   * @return int Returns the number of students assigned to the unit.
   */
  public function get_students_count($unit_id)
  {
    $this->db->where('unit_id', $unit_id);
    $query = $this->db->get('students');

    return $query->num_rows();
  }

  /**
   * Get all units with their students.
   *
   * @return array|bool Returns an array containing all units with their associated students. Returns false if no units exist.
   */
  public function get_all_units_with_students()
  {
    $this->db->select('units.*, students.name as student_name, students.birthdate');
    $this->db->from('units');
    $this->db->join('students', 'units.id = students.unit_id', 'left');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $result = array();
      foreach ($query->result_array() as $row) {
        // unit data
        $unit_id = $row['id'];
        if (!isset($result[$unit_id])) {
          $result[$unit_id] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'teacher' => $row['teacher'],
            'students' => array()
          );
        }
        // unit's students data
        if ($row['student_name'] !== null) {
          $result[$unit_id]['students'][] = array(
            'name' => $row['student_name'],
            'birthdate' => $row['birthdate']
          );
        }
      }
      return $result;
    } else {
      return false;
    }
  }

  /**
   * Get empty units (units with no students assigned).
   *
   * @return array|bool Returns an array containing all empty units. Returns false if no empty units exist.
   */
  public function get_empty_units()
  {
    $this->db->select('units.*');
    $this->db->from('units');
    $this->db->join('students', 'units.id = students.unit_id', 'left');
    $this->db->where('students.unit_id IS NULL');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return false;
    }
  }

  /**
   * Check if unit exists.
   *
   * @param int $unit_id The ID of the unit to check.
   * @return bool Returns true if the unit exists, otherwise returns false.
   */
  public function unit_exists($unit_id)
  {
    $query = $this->db->get_where('units', array('id' => $unit_id));
    return $query->num_rows() > 0;
  }

  /**
   * Assign student to unit.
   *
   * @param int $unit_id The ID of the unit to assign the student to.
   * @param int $student_id The ID of the student to assign to the unit.
   */
  public function assign_student_to_unit($unit_id, $student_id)
  {
    $data = array(
      'unit_id' => $unit_id
    );
    $this->db->where('id', $student_id);
    $this->db->update('students', $data);
  }

  /**
   * Insert unit.
   *
   * @param array $data The data of the unit to insert.
   * @return bool Returns true if the insertion is successful, otherwise returns false.
   */
  public function insert_unit($data)
  {
    $this->db->insert('units', $data);
    return $this->db->affected_rows() > 0;
  }

  /**
   * Update unit.
   *
   * @param int $id The ID of the unit to update.
   * @param array $data The data to update the unit with.
   * @return bool Returns true if the update is successful, otherwise returns false.
   */
  public function update_unit($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update('units', $data);

    return $this->db->affected_rows() > 0;
  }

  /**
   * Delete unit.
   *
   * @param int $id The ID of the unit to delete.
   * @return bool Returns true if the deletion is successful, otherwise returns false.
   */
  public function delete_unit($id)
  {
    $this->db->delete('units', array('id' => $id));
    return $this->db->affected_rows() > 0;
  }

  /**
   * Clear unit (remove all students from the unit).
   *
   * @param int $id The ID of the unit to clear.
   */
  public function clear_unit($id)
  {
    $this->db->where('unit_id', $id);
    $this->db->update('students', array('unit_id' => NULL));
  }
}
?>