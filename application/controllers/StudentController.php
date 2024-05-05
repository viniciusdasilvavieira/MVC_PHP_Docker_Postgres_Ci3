<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Student');
        $this->load->library('session');
        $this->load->helper('url');
    }

    //LIST (& INSERT) VIEW
    public function index() {
      $data['students'] = $this->Student->get_students();
      $this->load->view('student/list', $data);
    }

    //EDIT VIEW
    public function editView($id)
    {
      $student = $this->Student->get_student($id);
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
      if ($this->input->post()) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Nome', 'required');
        
        if ($this->form_validation->run()) {
            $data = array(
                'name' => $this->input->post('name')
            );
            $this->Student->insert_student($data);
            $this->session->set_flashdata('success', 'Aluno adicionado!');
            redirect('alunos');
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect("aluno/adicionar");
        }   
      } else {
          $this->session->set_flashdata('error', 'método inválido');
          redirect('alunos');
      }
    }

    //UPDATE
    public function update($id)
    {
      if ($this->input->post()) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Nome', 'required');
        
        if ($this->form_validation->run()) {
          $data = array(
            'name' => $this->input->post('name')
          );
          $this->Student->update_student($id, $data);
          $this->session->set_flashdata('success', 'Dados atualizados');
        }
        else {
          $this->session->set_flashdata('error', validation_errors());
          redirect("aluno/editar/{$id}");
        }   
      }
      else {
        $this->session->set_flashdata('error', 'Método inválido');
      }
      redirect('alunos');
    }

    //DELETE
    public function delete($id)
    {
      $student = $this->Student->get_student($id);
      if ($student) {
        $this->Student->delete_student($id);
        $this->session->set_flashdata('success', 'Estudante excluído');
      } else {
        $this->session->set_flashdata('error', 'Estudante não encontrado');
      }
      redirect('alunos');
    }
}
?>