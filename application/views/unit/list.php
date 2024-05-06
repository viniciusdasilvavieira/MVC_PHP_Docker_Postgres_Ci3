<?php $this->load->view('layouts/header', array('title' => 'Turmas')); ?>

<h3>Adicionar nova turma</h3>

<form action="<?php echo site_url('turma/salvar'); ?>" method="post">
  <div class="row mb-4">

    <div class="col-6">
      <div class="form-group mb-0">
        <label for="name">Nome:</label>
        <input type="text" class="form-control" id="name" name="name" value="">
      </div>
    </div>
    
    <div class="col-4">
      <div class="form-group mb-0">
        <label for="name">Professor:</label>
        <input type="text" class="form-control" id="teacher" name="teacher" value="">
      </div>
    </div>

    <div class="col-2 align-self-end">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
    </div>

  </div>
</form>

<h3>Listagem </h3>

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
    <?php foreach ($units as $unit): ?>
      <tr>
        <td><?php echo $unit->name; ?></td>
        <td><?php echo $unit->students_count; ?></td>
        <td><?php echo $unit->teacher; ?></td>
        <td>
          <a href="<?php echo site_url('turma/editar/' . $unit->id); ?>" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit"></i> Editar</a>
          <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $unit->id; ?>)"><i class="fas fa-trash-alt"></i> Excluir</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="mb-4">
  <a href="<?php echo site_url('/'); ?>" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Voltar
  </a>
</div>

<?php $this->load->view('layouts/footer'); ?>

<script>
  function confirmDelete(id) {
    if (confirm('Tem certeza que deseja excluir essa turma?')) {
      window.location.href = "<?php echo site_url('turma/excluir/'); ?>" + id;
    }
  }
</script>