<?php $this->load->view('layouts/header', array('title' => 'Listagem de estudantes')); ?>

<h2>Alunos</h2>

<form action="<?php echo site_url('aluno/salvar'); ?>" method="post">
  <div class="row mb-4">
    <div class="col-6">
      <div class="form-group mb-0">
        <label for="name">Nome:</label>
        <input type="text" class="form-control" id="name" name="name" value="">
      </div>
    </div>
    <div class="col-6 align-self-end">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
    </div>
  </div>
</form>


<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>Aluno</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($students as $student): ?>
      <tr>
        <td><?php echo $student->name; ?></td>
        <td>
          <a href="<?php echo site_url('aluno/editar/' . $student->id); ?>" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit"></i> Editar</a>
          <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $student->id; ?>)"><i class="fas fa-trash-alt"></i> Excluir</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<?php $this->load->view('layouts/footer'); ?>

<script>
  function confirmDelete(studentId) {
    if (confirm('Tem certeza que deseja excluir esse estudante?')) {
      window.location.href = "<?php echo site_url('aluno/excluir/'); ?>" + studentId;
    }
  }
</script>