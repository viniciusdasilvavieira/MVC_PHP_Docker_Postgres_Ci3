<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('Student_model');
    $this->load->library('session');
    $this->load->helper('url');
  }

  //EDIT VIEW
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

  //SAVE
  public function save()
  {
    if (!$this->input->post()) {
      redirect('/');
    }

    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'nome', 'required');
    $this->form_validation->set_rules('birthdate', 'data de nascimento', 'required|date');
    
    if ($this->form_validation->run()) {
      $data = array(
        'name' => $this->input->post('name'),
        'birthdate' => $this->input->post('birthdate')
      );
      $this->Student_model->insert_student($data);
      $this->session->set_flashdata('success', 'Aluno adicionado!');
    } else {
      $this->session->set_flashdata('error', validation_errors());
    }   

    redirect('alunos');
  }

  //UPDATE
  public function update($id)
  {
    if (!$this->input->post()) {
      redirect('/');
    }
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'Nome', 'required');
    $this->form_validation->set_rules('birthdate', 'data de nascimento', 'required|date');
    
    if ($this->form_validation->run()) {
      $data = array(
        'name' => $this->input->post('name'),
        'birthdate' => $this->input->post('birthdate')
      );
      $this->Student_model->update_student($id, $data);
      $this->session->set_flashdata('success', 'Dados do aluno atualizados');
    }
    else {
      $this->session->set_flashdata('error', validation_errors());
      redirect("aluno/editar/{$id}");
    }  

    redirect('alunos');
  }

  //DELETE
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