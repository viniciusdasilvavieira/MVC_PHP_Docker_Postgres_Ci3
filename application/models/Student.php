<?php
class Student extends CI_Model {

    public function insert_student($name) {
        $data = array(
            'name' => $name
        );

        $this->db->insert('students', $data);
        
        //checks if the insertion was successful
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>