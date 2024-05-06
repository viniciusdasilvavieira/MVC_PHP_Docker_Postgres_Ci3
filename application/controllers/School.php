<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends CI_Controller
{
  public function __construct()
  {
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

  //STUDENTS LIST (& INSERT) VIEW
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

  //UNITS LIST (& INSERT) VIEW
  public function unitsView()
  {
    $data['units'] = $this->Unit_model->get_units();
    foreach ($data['units'] as $unit) {
      $unit->students_count = $this->Unit_model->get_students_count($unit->id);
    }
    $this->load->view('unit/list', $data);
  }

  //ASSIGNMENTS VIEW
  public function assignView()
  {
    $data['units'] = $this->Unit_model->get_units();
    $data['students'] = $this->Student_model->get_unassigned_students();

    $this->load->view('assign', $data);
  }

  //REPORT VIEW
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

  //ASSIGN STUDENTS TO A UNIT
  public function assign()
  {
    if ($this->input->post()) {
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

    }
    else
    {
      $this->session->set_flashdata('error', 'Método inválido');
    }
    redirect('turmas');
  }

  public function clear($unit_id)
  {
    //checks if the unit exists in the db
    if (!$this->Unit_model->unit_exists($unit_id)) {
      $this->session->set_flashdata('error', 'Turma não encontrada');
      redirect('enturmar');
    }

    $this->Unit_model->clear_unit($unit_id);
    $this->session->set_flashdata('success', 'Turma limpa com sucesso');
    redirect('turmas');
  }
}
?>