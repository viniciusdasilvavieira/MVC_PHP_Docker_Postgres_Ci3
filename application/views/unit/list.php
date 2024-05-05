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
      to be done
    </div>

    <div class="col-2 align-self-end">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
    </div>

  </div>
</form>

<h3>Listagem </h3>

<table class="table">
  <thead>
    <tr>
      <th>Turma</th>
      <th>to be done</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($units as $unit): ?>
      <tr>
        <td><?php echo $unit->name; ?></td>
        <td>to be done</td>
        <td>
          <a href="<?php echo site_url('turma/editar/' . $unit->id); ?>" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit"></i> Editar</a>
          <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $unit->id; ?>)"><i class="fas fa-trash-alt"></i> Excluir</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<?php $this->load->view('layouts/footer'); ?>

<script>
  function confirmDelete(id) {
    if (confirm('Tem certeza que deseja excluir essa turma?')) {
      window.location.href = "<?php echo site_url('turma/excluir/'); ?>" + id;
    }
  }
</script>