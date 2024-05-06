<?php
class Unit_model extends CI_Model {

  //returns all units, always returns an array, empty if no units
  public function get_units()
  {
    return $this->db->get('units')->result();
  }

  //returns units with matching id, null if no unit
  public function get_unit($id)
  {
    $query = $this->db->get_where('units', array('id' => $id));
    return $query->row();
  }

   //returns units'name with matching id, null if not found
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

  //returns number of students with matching unit id
  public function get_students_count($unit_id)
  {
    $this->db->where('unit_id', $unit_id);
    $query = $this->db->get('students');

    return $query->num_rows();
  }

  //returns array of units with its students
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

  //returns units that have no students assigned
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


  //checks if unit with matching id exists, returns true if exists
  public function unit_exists($unit_id)
  {
    $query = $this->db->get_where('units', array('id' => $unit_id));
    return $query->num_rows() > 0;
  }

  //assigns student to unit, returns true if successful
  public function assign_student_to_unit($unit_id, $student_id)
  {
    $data = array(
      'unit_id' => $unit_id
    );
    $this->db->where('id', $student_id);
    $this->db->update('students', $data);
  }

  //inserts new unit into the db, returns true if successful
  public function insert_unit($data)
  {
    $this->db->insert('units', $data);
    return $this->db->affected_rows() > 0;
  }

  //updates unit with matching id, returns true if successful
  public function update_unit($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update('units', $data);

    return $this->db->affected_rows() > 0;
  }

  //deletes unit with matching id, returns true if successful
  public function delete_unit($id)
  {
    $this->db->delete('units', array('id' => $id));
    return $this->db->affected_rows() > 0;
  }

  public function clear_unit($id)
  {
    $this->db->where('unit_id', $id);
    $this->db->update('students', array('unit_id' => NULL));
  }
}
?>