<?php $this->load->view('layouts/header', array('title' => 'Alunos')); ?>

<!-- Form to add a new student -->
<h4>Adicionar novo aluno(a)</h4>
<form action="<?php echo site_url('aluno/salvar'); ?>" method="post">
  <div class="row mb-4">

    <!-- Input field for student's name -->
    <div class="col-12 col-sm-6">
      <div class="form-group mb-0">
        <label for="name">Nome:</label>
        <input type="text" class="form-control" id="name" name="name" value="">
      </div>
    </div>
    
    <!-- Input field for student's birthdate -->
    <div class="col-10 col-sm-4">
      <div class="form-group mb-0">
        <label for="birthdate">Nascimento:</label>
        <input type="date" class="form-control" id="birthdate" name="birthdate" value="">
      </div>
    </div>

    <!-- Submit button -->
    <div class="col-2 align-self-end">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
    </div>

  </div>
</form>

<!-- Student list -->
<h4>Listagem </h4>
<table class="table">
  <thead class="bg-light shadow-sm">
    <tr> 
      <th>Aluno(a)</th>
      <th>Nascimento</th>
      <th>Turma</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($students as $student): ?>
      <tr>
        <!-- Student's name and birthdate -->
        <td class="col-4"><?php echo $student->name; ?></td>
        <td class="col-2"><?php echo date('d/m/Y', strtotime($student->birthdate)); ?></td>
        <!-- Student's unit name -->
        <td class="col-1 col-sm-3">
          <?php if ($student->unit_id): ?>
          <?php echo $student->unit_name; ?>
          <?php else: ?>
            -
          <?php endif; ?>    
        </td>
        <!-- Actions -->
        <td class="col-5 col-sm-3">
          <a href="<?php echo site_url('aluno/editar/' . $student->id); ?>" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit"></i></a>
          <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $student->id; ?>)"><i class="fas fa-trash-alt"></i></button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Back button -->
<div class="mb-4">
  <a href="<?php echo site_url('/'); ?>" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Voltar
  </a>
</div>

<?php $this->load->view('layouts/footer'); ?>

<!-- JavaScript function to confirm deletion -->
<script>
  function confirmDelete(studentId) {
    if (confirm('Tem certeza que deseja excluir esse aluno?')) {
      window.location.href = "<?php echo site_url('aluno/excluir/'); ?>" + studentId;
    }
  }
</script>