<?php $this->load->view('layouts/header', array('title' => 'Relatório de turmas')); ?>

<!-- Link to generate PDF report -->
<div class="mb-4">
  <a href="<?php echo site_url('relatorio/pdf'); ?>" class="btn btn-warning" target="_blank">
    <i class="fas fa-file-pdf"></i> Gerar relatório em PDF
  </a>
</div>

<!-- Loop through units with students -->
<?php foreach ($units as $unit): ?>
  <?php if (!empty($unit['students'])): ?>
    <div class="mb-4">
      <h4>Turma <?php echo $unit['name']; ?></h4>
      <table class="table">
        <thead class="bg-light shadow-sm">
          <tr>
            <th>Aluno(a)</th>
            <th>Data de nascimento</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($unit['students'] as $student): ?>
            <tr>
              <td class="col-6"><?php echo $student['name']; ?></td>
              <td class="col-6"><?php echo date('d/m/Y', strtotime($student['birthdate'])); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
<?php endforeach; ?>

<!-- Check for empty units -->
<?php if (!empty($empty_units)): ?>
  <div class="mb-4">
    <h4>Turmas vazias</h4>
    <table class="table">
      <thead class="bg-light shadow-sm">
        <tr>
          <th>Turma</th>
          <th>Professor(a)</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($empty_units as $unit): ?>
          <tr>
            <td class="col-6"><?php echo $unit['name']; ?></td>
            <td class="col-6"><?php echo $unit['teacher']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>

<!-- Check for unassigned students -->
<?php if (!empty($unassigned_students)): ?>
  <div class="mb-4">
    <h4>Alunos sem turma</h4>
    <table class="table">
      <thead class="bg-light shadow-sm">
        <tr>
          <th>Aluno(a)</th>
          <th>Data de nascimento</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($unassigned_students as $student): ?>
          <tr>
            <td class="col-6"><?php echo $student->name; ?></td>
            <td class="col-6"><?php echo date('d/m/Y', strtotime($student->birthdate)); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>

<!-- Back button -->
<div class="mb-4">
  <a href="<?php echo site_url('/'); ?>" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Voltar
  </a>
</div>


<?php $this->load->view('layouts/footer'); ?>