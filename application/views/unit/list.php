<?php $this->load->view('layouts/header', array('title' => 'Turmas')); ?>

<!-- Form to add a new unit -->
<h4>Adicionar nova turma</h4>
<form action="<?php echo site_url('turma/salvar'); ?>" method="post">
  <div class="row mb-4">

    <!-- Input field for unit name -->
    <div class="col-12 col-sm-6">
      <div class="form-group mb-0">
        <label for="name">Nome:</label>
        <input type="text" class="form-control" id="name" name="name" value="">
      </div>
    </div>
    
    <!-- Input field for teacher's name -->
    <div class="col-10 col-sm-4">
      <div class="form-group mb-0">
        <label for="name">Professor:</label>
        <input type="text" class="form-control" id="teacher" name="teacher" value="">
      </div>
    </div>

    <!-- Submit button -->
    <div class="col-2 align-self-end">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
    </div>

  </div>
</form>

<!-- List of units -->
<h4>Listagem </h4>
<table class="table">
  <thead class="bg-light shadow-sm">
    <tr>
      <th>Turma</th>
      <th>Alunos (Qt.)</th>
      <th>Professor(a)</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
     <!-- Loop through units -->
    <?php foreach ($units as $unit): ?>
      <tr>
        <!-- Unit's name, students count, and teacher's name -->
        <td class="col-3 col-sm-4"><?php echo $unit->name; ?></td>
        <td class="col-1 col-sm-2"><?php echo $unit->students_count; ?></td>
        <td class="col-3"><?php echo $unit->teacher; ?></td>
        <!-- Actions -->
        <td class="col-5 col-sm-3">
          <a href="<?php echo site_url('turma/editar/' . $unit->id); ?>" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit"></i></a>
          <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $unit->id; ?>)"><i class="fas fa-trash-alt"></i></button>
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
  function confirmDelete(id) {
    if (confirm('Tem certeza que deseja excluir essa turma?')) {
      window.location.href = "<?php echo site_url('turma/excluir/'); ?>" + id;
    }
  }
</script>