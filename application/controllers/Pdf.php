<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller
{
  public function __construct()
  {
    define('FONT', 'Arial');
    define('FONT_G_SIZE', 14);
    define('FONT_S_SIZE', 12);
  
    parent::__construct();
    $this->load->database();
    $this->load->model('Student_model');
    $this->load->model('Unit_model');
    $this->load->library('session');
    $this->load->helper('url');
    require_once(APPPATH . 'libraries/fpdf.php');
  }

  public function index()
  {
    $pdf = new FPDF();

    $pdf->AddPage();
    $pdf->SetFont(FONT, 'B', FONT_G_SIZE);
        
    // Header
    $pdf->SetFont('Arial', 'B', FONT_G_SIZE);
    $pdf->Cell(0, 7, 'Escola primaria ABC', 0, 1);
    $pdf->SetFont('Arial', '', FONT_S_SIZE);
    $pdf->Cell(0, 7, 'Endereco: 123 School Street, City', 0, 1);
    $pdf->Cell(0, 7, 'Telefone: (123) 456-7890 | Email: escola@primaria.com', 0, 1);
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', FONT_G_SIZE);
    $pdf->Cell(0, 10, 'RELATORIO', 0, 1, 'C');
    
    $units = $this->Unit_model->get_all_units_with_students();
    foreach ($units as $unit) {
      if (!empty($unit['students'])) {
        $pdf->SetFont('Arial', 'B', FONT_G_SIZE);
        $pdf->Cell(0, 10, 'Turma ' . $unit['name'], 0, 1);
        
        //header
        $pdf->SetFont('Arial', '', FONT_S_SIZE);
        $pdf->Cell(70, 10, 'Nome do Aluno', 1);
        $pdf->Cell(70, 10, 'Data de Nascimento', 1);
        $pdf->Ln();
        
        //students
        foreach ($unit['students'] as $student) {
          $pdf->Cell(70, 10, $student['name'], 1);
          $pdf->Cell(70, 10, $student['birthdate'], 1);
          $pdf->Ln();
        }

        $pdf->Ln(7);
      }
    }

    $empty_units = $this->Unit_model->get_empty_units();
    if (!empty($empty_units)) {
      $pdf->SetFont('Arial', 'B', FONT_G_SIZE);
      $pdf->Cell(0, 10, 'Turmas Sem Alunos', 0, 1);

      $pdf->SetFont('Arial', '', FONT_S_SIZE);
      $pdf->Cell(0, 10, 'Nome da Turma', 1);
      $pdf->Ln();

      foreach ($empty_units as $unit) {
        $pdf->Cell(0, 10, $unit['name'], 1);
        $pdf->Ln();
      }

      $pdf->Ln(7);
    }
    
    $unassigned_students = $this->Student_model->get_unassigned_students();
    if (!empty($unassigned_students)) {
      $pdf->SetFont('Arial', 'B', FONT_G_SIZE);
      $pdf->Cell(0, 10, 'Alunos Sem Turma', 0, 1);
      
      $pdf->SetFont('Arial', '', FONT_S_SIZE);
      $pdf->Cell(0, 10, 'Nome do Aluno', 1);
      $pdf->Ln();
      
      foreach ($unassigned_students as $student) {
        $pdf->Cell(0, 10, $student->name, 1);
        $pdf->Ln();
      }
    }

    $this->footer($pdf); 
    $pdf->Output(); 
  }

  //inserts a footer with a logo at the center
  public function footer($pdf){
    $pdf->SetY(-15); //pos near the bottom
    $logo_path = FCPATH . 'assets/img/logo.png';
    list($width, $height) = getimagesize($logo_path);

    $aspect_ratio = $width / $height;
    $image_width = 30; //new size of the logo mantaining aspect ratio
    $image_height = $image_width / $aspect_ratio;

    $page_height = $pdf->GetPageHeight();
    $image_y = $page_height - $image_height - 10;

    $page_width = $pdf->GetPageWidth();
    $image_x = ($page_width - $image_width) / 2;

    $pdf->Image($logo_path, $image_x, $image_y, $image_width, 0);
  }
}
?>