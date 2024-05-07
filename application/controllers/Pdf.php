<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pdf Controller
 *
 * This controller generates a PDF report containing information about units and students.
 * It utilizes the FPDF library for PDF generation.
 */
class Pdf extends CI_Controller
{
  /**
   * Constructor
   *
   * Initializes required constants, loads models, and includes FPDF library.
   */
  public function __construct()
  {
    define('FONT', 'Arial');
    define('FONT_G_SIZE', 14);
    define('FONT_S_SIZE', 12);
    define('CELL_M_SIZE', 90);
  
    parent::__construct();
    $this->load->database();
    $this->load->model('Student_model');
    $this->load->model('Unit_model');
    require_once(APPPATH . 'libraries/fpdf.php');
  }

  /**
   * Index Method
   *
   * Generates the PDF report containing unit information, unassigned students, and empty units.
   */
  public function index()
  {
    $pdf = new FPDF();
    $pdf->AddPage();
    
    $this->setHeader($pdf);

    $this->setUnitInformation($pdf);

    $this->setEmptyUnits($pdf);

    $this->setUnassignedStudents($pdf);

    $this->setFooter($pdf); 
    
    $pdf->Output(); 
  }

  /**
   * Sets the header for the PDF report.
   *
   * @param object $pdf The FPDF object.
   */
  private function setHeader(&$pdf)
  {
    $pdf->SetFont(FONT, 'B', FONT_G_SIZE);
    $pdf->Cell(0, 7, 'Escola primaria ABC', 0, 1);
    $pdf->SetFont(FONT, '', FONT_S_SIZE);
    $pdf->Cell(0, 7, 'Endereco: 123 School Street, City', 0, 1);
    $pdf->Cell(0, 7, 'Telefone: (123) 456-7890 | Email: escola@primaria.com', 0, 1);
    $pdf->Ln(10);
    $pdf->SetFont(FONT, 'B', FONT_G_SIZE);
    $pdf->Cell(0, 10, 'RELATORIO', 0, 1, 'C');
    $pdf->Ln(7);
  }

  /**
   * Sets the unit information section of the PDF report.
   *
   * @param object $pdf The FPDF object.
   */
  private function setUnitInformation(&$pdf)
  {
    $units = $this->Unit_model->get_all_units_with_students();
    foreach ($units as $unit) {
      if (!empty($unit['students'])) {
        $pdf->SetFont(FONT, 'B', FONT_G_SIZE);
        $pdf->Cell(0, 10, 'Turma ' . strtoupper($unit['name']), 0, 1);

        //Table header
        $pdf->SetFont(FONT, '', FONT_S_SIZE);
        $pdf->Cell(CELL_M_SIZE, 10, '  Nome do Aluno(a)', 1);
        $pdf->Cell(CELL_M_SIZE, 10, '  Data de Nascimento', 1);
        $pdf->Ln();

        //Unit's students
        foreach ($unit['students'] as $student) {
          $pdf->Cell(CELL_M_SIZE, 10, '  '. strtoupper($student['name']), 1);
          $pdf->Cell(CELL_M_SIZE, 10, '  '. date('d/m/Y', strtotime($student['birthdate'])), 1);
          $pdf->Ln();
        }

        $pdf->Ln(7);
      }
    }
  }

  /**
   * Sets the section for unassigned students in the PDF report.
   *
   * @param object $pdf The FPDF object.
   */
  private function setUnassignedStudents(&$pdf)
  {
    $unassigned_students = $this->Student_model->get_unassigned_students();
    if (!empty($unassigned_students)) {
      $pdf->SetFont(FONT, 'B', FONT_G_SIZE);
      $pdf->Cell(0, 10, 'Alunos Sem Turma', 0, 1);

      //Table header
      $pdf->SetFont(FONT, '', FONT_S_SIZE);
      $pdf->Cell(CELL_M_SIZE, 10, '  Nome do Aluno(a)', 1);
      $pdf->Cell(CELL_M_SIZE, 10, '  Data de Nascimento', 1);
      $pdf->Ln();

      foreach ($unassigned_students as $student) {
        $pdf->Cell(CELL_M_SIZE, 10, '  '. strtoupper($student->name), 1);
        $pdf->Cell(CELL_M_SIZE, 10, '  '. date('d/m/Y', strtotime($student->birthdate)), 1);
        $pdf->Ln();
      }
    }
  }

  /**
   * Sets the section for empty units in the PDF report.
   *
   * @param object $pdf The FPDF object.
   */
  private function setEmptyUnits(&$pdf)
  {
    $empty_units = $this->Unit_model->get_empty_units();
    if (!empty($empty_units)) {
      $pdf->SetFont(FONT, 'B', FONT_G_SIZE);
      $pdf->Cell(0, 10, 'Turmas vazias', 0, 1);

      //Table header
      $pdf->SetFont(FONT, '', FONT_S_SIZE);
      $pdf->Cell(CELL_M_SIZE, 10, '  Turma', 1);
      $pdf->Cell(CELL_M_SIZE, 10, '  Professor(a)', 1);
      $pdf->Ln();

      //Units
      foreach ($empty_units as $unit) {
        $pdf->Cell(CELL_M_SIZE, 10, '  '. strtoupper($unit['name']), 1);
        $pdf->Cell(CELL_M_SIZE, 10, '  '. strtoupper($unit['teacher']), 1);
        $pdf->Ln();
      }

      $pdf->Ln(7);
    }
  }

  /**
   * Sets the footer for the PDF report.
   *
   * @param object $pdf The FPDF object.
   */
  private function setFooter(&$pdf){
    $pdf->SetY(-15); //position near the bottom
    $logo_path = FCPATH . 'assets/img/logo.png';
    list($width, $height) = getimagesize($logo_path);

    $aspect_ratio = $width / $height;
    $image_width = 30; //logo resizing mantaining aspect ratio
    $image_height = $image_width / $aspect_ratio;

    $page_height = $pdf->GetPageHeight();
    $image_y = $page_height - $image_height - 10;

    $page_width = $pdf->GetPageWidth();
    $image_x = ($page_width - $image_width) / 2;

    $pdf->Image($logo_path, $image_x, $image_y, $image_width, 0);
  }
}
?>