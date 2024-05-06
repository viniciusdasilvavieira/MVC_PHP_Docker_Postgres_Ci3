<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->database();
      $this->load->model('Student_model');
      $this->load->model('Unit_model');
      $this->load->library('session');
      $this->load->helper('url');
    }

    //DASHBOARD VIEW
    public function index()
    {
      $this->load->view('dashboard');
    }

    public function assignView()
    {
      $data['units'] = $this->Unit_model->get_units();
      $data['students'] = $this->Student_model->get_unassigned_students();
      $this->load->view('assign', $data);
    }

    public function assign()
    {
      
    }

}
?>