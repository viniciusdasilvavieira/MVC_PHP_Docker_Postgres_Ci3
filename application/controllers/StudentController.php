<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Student');
    }

    public function add() {
        //$name = $this->input->post('name');
        $name = 'John Doe';
        if (!empty($name)) {
            $result = $this->Student->insert_student($name);
            if ($result) {
                echo "Student added successfully!";
            } else {
                echo "Failed to add student.";
            }
        } else {
            echo "Name cannot be empty!";
        }
    }

    public function index() {
      echo 'test wahasdad';exit;
    }
}
?>