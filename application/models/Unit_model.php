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
      if ($query->num_rows() > 0) {
          return $query->row();
      } else {
          return null; 
      }
    }

    //returns number of students with matching unit id
    public function get_students_count($unit_id)
    {
      $this->db->where('unit_id', $unit_id);
      $query = $this->db->get('students');
      return $query->num_rows();
    }

    //inserts new unit into the db, returns true if successful
    public function insert_unit($data)
    {
      $this->db->insert('units', $data);
      
      if ($this->db->affected_rows() > 0) {
        return true;
      } else {
        return false;
      }
    }

    //updates unit with matching id, returns true if successful
    public function update_unit($id, $data)
    {
      $this->db->where('id', $id);
      $this->db->update('units', $data);

      if ($this->db->affected_rows() > 0) {
        return true;
      } else {
        return false;
      }
    }

    //deletes unit with matching id, returns true if successful
    public function delete_unit($id)
    {
      $this->db->delete('units', array('id' => $id));

      if ($this->db->affected_rows() > 0) {
        return true;
      } else {
        return false;
      }
    }
}
?>