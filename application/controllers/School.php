<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Class School
 * Controller for managing school-related operations.
 */
class School extends CI_Controller
{
  /**
   * Constructor method.
   * Loads necessary libraries and models.
   */
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('Student_model');
    $this->load->model('Unit_model');
    $this->load->library('session');
    $this->load->helper('url');
  }

  /**
   * Dashboard view method. Displays the dashboard view.
   */
  public function index()
  {
    //quick (bad) way to check if it's the first run of the app, runs migrations if it is
    if (!$this->db->table_exists('students')) {
      $this->firstRun();
    } 

    $this->load->view('dashboard');
  }

  /**
   * First run method.
   * Runs migrations for the first run of the app.
   */
  private function firstRun()
  {
    $this->load->library('migration');
    if ($this->migration->latest() === FALSE) {
      show_error($this->migration->error_string());
    }
  }

   /**
   * Students view method.
   * Displays the students list view and handles student insertion.
   */
  public function studentsView()
  {
    $data['students'] = $this->Student_model->get_students();
    $data['units'] = $this->Unit_model->get_units();

    //loops through students adding unit's name to the ones that have the relationship
    foreach ($data['students'] as $student) {
      if ($student->unit_id) {
        $student->unit_name = $this->Unit_model->get_unit_name($student->unit_id);
      }
    }
    $this->load->view('student/list', $data);
  }

  /**
   * Units view method.
   * Displays the units list view and handles unit insertion.
   */
  public function unitsView()
  {
    $data['units'] = $this->Unit_model->get_units();
    foreach ($data['units'] as $unit) {
      $unit->students_count = $this->Unit_model->get_students_count($unit->id);
    }
    $this->load->view('unit/list', $data);
  }

  /**
   * Assign view method.
   * Displays the assign view for assigning students to units.
   */
  public function assignView()
  {
    $data['units'] = $this->Unit_model->get_units();
    $data['students'] = $this->Student_model->get_unassigned_students();

    $this->load->view('assign', $data);
  }

  /**
   * Report view method.
   * Displays the report view for generating school reports.
   */
  public function reportView()
  {
    $units = $this->Unit_model->get_all_units_with_students();
    $unassigned_students = $this->Student_model->get_unassigned_students();
    $empty_units = $this->Unit_model->get_empty_units();

    $data['units'] = $units;
    $data['unassigned_students'] = $unassigned_students;
    $data['empty_units'] = $empty_units;

    $this->load->view('report', $data);
  }

  /**
   * Assign method.
   * Assigns students to a unit. Expects a POST request.
   */
  public function assign()
  {
    if (!$this->input->post()) {
      redirect('/');
    }

    $this->load->library('form_validation');
    $this->form_validation->set_rules('unit', 'Turma', 'required|integer');
    $this->form_validation->set_rules('students[]', 'Alunos', 'required');

    if ($this->form_validation->run() === FALSE) {
      $this->session->set_flashdata('error', validation_errors());
      redirect('enturmar');
    }

    $unit_id = $this->input->post('unit');
    $student_ids = $this->input->post('students');

    //checks if the unit and students exist in the db
    if (!$this->Unit_model->unit_exists($unit_id)) {
      $this->session->set_flashdata('error', 'Turma não encontrada');
      redirect('enturmar');
    }
    foreach ($student_ids as $student_id) {
      if (!$this->Student_model->student_exists($student_id)) {
        $this->session->set_flashdata('error', 'Aluno não encontrado');
        redirect('enturmar');
      }
    }

    //inserts students one by one in the unit
    foreach ($student_ids as $student_id) {
      $this->Unit_model->assign_student_to_unit($unit_id, $student_id);
    }

    $this->session->set_flashdata('success', 'Alunos enturmados com sucesso');

    redirect('enturmar');
  }

  /**
   * Clear method. Clears a unit.
   * @param int $unit_id The ID of the unit to clear.
   */
  public function clear($unit_id)
  {
    if (!$this->Unit_model->unit_exists($unit_id)) {
      $this->session->set_flashdata('error', 'Turma não encontrada');
      redirect('enturmar');
    }

    $this->Unit_model->clear_unit($unit_id);
    $this->session->set_flashdata('success', 'Turma limpa com sucesso');
    redirect('enturmar');
  }
}
?>