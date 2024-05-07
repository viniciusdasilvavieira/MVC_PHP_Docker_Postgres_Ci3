<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Unit
 * Controller for managing units.
 */
class Unit extends CI_Controller
{
  /**
   * Constructor method.
   * Loads necessary libraries and models.
   */
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('Unit_model');
    $this->load->library('session');
    $this->load->helper('url');
  }

  /**
   * Edit view method.
   * Displays the edit view for a specific unit.
   * @param int $id The ID of the unit to edit.
   */
  public function editView($id)
  {
    $unit = $this->Unit_model->get_unit($id);
    if (empty($unit)) {
      $this->session->set_flashdata('error', 'Turma não encontrada.');
      redirect('turmas');
    }
    $data['unit'] = $unit;
    $this->load->view('unit/edit', $data);
  }

  /**
   * Save method.
   * Saves a new unit. Expects a POST request.
   */
  public function save()
  {
    if (!$this->input->post()) {
      redirect('/');
    }
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'nome', 'required');
    $this->form_validation->set_rules('teacher', 'professor', 'required');
    
    if ($this->form_validation->run() === FALSE) {
      $this->session->set_flashdata('error', validation_errors());
      redirect('turmas');
    }

    $data = array(
      'name' => $this->input->post('name'),
      'teacher' => $this->input->post('teacher')
    );
    $this->Unit_model->insert_unit($data);
    $this->session->set_flashdata('success', 'Turma adicionada!');

    redirect('turmas');
  }

  /**
   * Update method.
   * Updates an existing unit. Expects a POST request.
   * @param int $id The ID of the unit to update.
   */
  public function update($id)
  {
    if (!$this->input->post()) {
      redirect('/');
    }

    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'Nome', 'required');
    $this->form_validation->set_rules('teacher', 'professor', 'required');
    
    if ($this->form_validation->run() === FALSE) {
      $this->session->set_flashdata('error', validation_errors());
      redirect("turma/editar/{$id}");
    }

    $data = array(
      'name' => $this->input->post('name'),
      'teacher' => $this->input->post('teacher')
    );
    $this->Unit_model->update_unit($id, $data);
    $this->session->set_flashdata('success', 'Dados da turma atualizados');
    
    redirect('turmas');
  }

  /**
   * Delete method. Deletes a unit.
   * @param int $id The ID of the unit to delete.
   */
  public function delete($id)
  {
    $unit = $this->Unit_model->get_unit($id);
    if ($unit)
    {
      $this->Unit_model->delete_unit($id);
      $this->session->set_flashdata('success', 'Turma excluída');
    }
    else
    {
      $this->session->set_flashdata('error', 'Turma não encontrada');
    }
    redirect('turmas');
  }
}
?>