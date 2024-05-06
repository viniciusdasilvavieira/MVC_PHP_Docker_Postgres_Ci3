<?php $this->load->view('layouts/header', array('title' => 'Relatório de turmas')); ?>

<div class="mb-4">
  <a href="<?php echo site_url('relatorio/pdf'); ?>" class="btn btn-primary">
    <i class="fas fa-file-pdf"></i> Gerar PDF
  </a>
</div>

<!-- UNITS WITH STUDENTS -->
<?php foreach ($units as $unit): ?>
  <?php if (!empty($unit['students'])): ?>
    <div class="mb-4">
      <h2>Turma <?php echo $unit['name']; ?></h2>
      <table class="table">
        <thead class="bg-light shadow-sm">
          <tr>
            <th>Nome do Aluno</th>
            <th>Data de Nascimento</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($unit['students'] as $student): ?>
            <tr>
              <td><?php echo $student['name']; ?></td>
              <td><?php echo $student['birthdate']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
<?php endforeach; ?>

<!-- EMPTY UNITS -->
<?php if (!empty($empty_units)): ?>
  <div class="mb-4">
    <h3>Turmas vazias</h3>
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
            <td><?php echo $unit['name']; ?></td>
            <td><?php echo $unit['teacher']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>

<!-- UNASSIGNED STUDENTS -->
<?php if (!empty($unassigned_students)): ?>
  <div class="mb-4">
    <h3>Alunos Sem Turma</h3>
    <table class="table">
      <thead class="bg-light shadow-sm">
        <tr>
          <th>Nome do Aluno</th>
          <th>Data de Nascimento</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($unassigned_students as $student): ?>
          <tr>
            <td><?php echo $student->name; ?></td>
            <td><?php echo $student->birthdate; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>

<!-- GO BACK BUTTON -->
<div class="mb-4">
  <a href="<?php echo site_url('/'); ?>" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Voltar
  </a>
</div>


<?php $this->load->view('layouts/footer'); ?>