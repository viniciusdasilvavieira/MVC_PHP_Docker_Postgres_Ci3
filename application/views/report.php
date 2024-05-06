<?php $this->load->view('layouts/header', array('title' => 'Relatório de turmas')); ?>

<div class="container mt-4">
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

  <?php if (!empty($unassigned_students)): ?>
    <div class="mb-4">
      <h3>Alunos Sem Turma</h3>
      <table class="table">
        <thead class="bg-light shadow-sm">
          <tr>
            <th>Nome do Aluno</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($unassigned_students as $student): ?>
            <tr>
              <td><?php echo $student->name; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>

  <?php if (!empty($empty_units)): ?>
    <div class="mb-4">
      <h3>Turmas vazias</h3>
      <table class="table">
        <thead class="bg-light shadow-sm">
          <tr>
            <th>Nome da turma</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($empty_units as $unit): ?>
            <tr>
              <td><?php echo $unit['name']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>

  <div class="mb-4">
    <a href="<?php echo site_url('/'); ?>" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Voltar
    </a>
  </div>
</div>

<?php $this->load->view('layouts/footer'); ?>