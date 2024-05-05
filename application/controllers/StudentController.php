<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Student');
    }

    public function index() {
      $data['students'] = $this->Student->get_students();
      $this->load->helper('url');
      $this->load->view('students_list', $data);
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

    public function edit($id)
    {
      $data['student'] = $this->Student->get_student($id);
      $this->load->helper('url');
      $this->load->view('edit_student', $data);
    }

    public function delete($id)
    {
      $this->Student->delete_student($id);
      redirect('alunos');
    }
}
?>