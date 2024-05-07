<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Student
 * Controller for managing students.
 */
class Student extends CI_Controller
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
    $this->load->library('session');
    $this->load->helper('url');
  }

  /**
   * Edit view method.
   * Displays the edit view for a specific student.
   * @param int $id The ID of the student to edit.
   */
  public function editView($id)
  {
    $student = $this->Student_model->get_student($id);
    if (empty($student)) {
      $this->session->set_flashdata('error', 'Estudante não encontrado.');
      redirect('alunos');
    }
    $data['student'] = $student;
    $this->load->view('student/edit', $data);
  }

  /**
   * Save method.
   * Saves a new student. Expects a POST request.
   */
  public function save()
  {
    if (!$this->input->post()) {
      redirect('/');
    }

    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'nome', 'required');
    $this->form_validation->set_rules('birthdate', 'data de nascimento', 'required|date');
    
    if ($this->form_validation->run() === FALSE) {
      $this->session->set_flashdata('error', validation_errors());
      redirect('alunos');
    }

    $data = array(
      'name' => $this->input->post('name'),
      'birthdate' => $this->input->post('birthdate')
    );
    $this->Student_model->insert_student($data);
    $this->session->set_flashdata('success', 'Aluno adicionado!');
  
    redirect('alunos');
  }

  /**
   * Update method.
   * Updates an existing student. Expects a POST request.
   * @param int $id The ID of the student to update.
   */
  public function update($id)
  {
    if (!$this->input->post()) {
      redirect('/');
    }
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'Nome', 'required');
    $this->form_validation->set_rules('birthdate', 'data de nascimento', 'required|date');
    
    if ($this->form_validation->run() === FALSE) {
      $this->session->set_flashdata('error', validation_errors());
      redirect('alunos');
    }

    $data = array(
      'name' => $this->input->post('name'),
      'birthdate' => $this->input->post('birthdate')
    );
    $this->Student_model->update_student($id, $data);
    $this->session->set_flashdata('success', 'Dados do aluno atualizados');

    redirect('alunos');
  }

  /**
   * Delete method. Deletes a student.
   * @param int $id The ID of the student to delete.
   */
  public function delete($id)
  {
    $student = $this->Student_model->get_student($id);
    if ($student) {
      $this->Student_model->delete_student($id);
      $this->session->set_flashdata('success', 'Estudante excluído');
    } else {
      $this->session->set_flashdata('error', 'Estudante não encontrado');
    }
    redirect('alunos');
  }
}
?>