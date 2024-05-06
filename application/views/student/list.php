<?php $this->load->view('layouts/header', array('title' => 'Alunos')); ?>

<h3>Adicionar novo aluno</h3>

<form action="<?php echo site_url('aluno/salvar'); ?>" method="post">
  <div class="row mb-4">

    <div class="col-6">
      <div class="form-group mb-0">
        <label for="name">Nome:</label>
        <input type="text" class="form-control" id="name" name="name" value="">
      </div>
    </div>
    
    <div class="col-4">
      <div class="form-group mb-0">
        <label for="birthdate">Nascimento:</label>
        <input type="date" class="form-control" id="birthdate" name="birthdate" value="">
      </div>
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
      <th>Nº</th>  
      <th>Aluno</th>
      <th>Nascimento</th>
      <th>Turma</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($students as $student): ?>
      <tr>
      <td><?php echo $student->id; ?></td>
        <td><?php echo $student->name; ?></td>
        <td><?php echo date('d/m/Y', strtotime($student->birthdate)); ?></td>
        
        <td>
          <?php if ($student->unit_id): ?>
          <?php echo $student->unit->name; ?>
          <?php else: ?>
            -
          <?php endif; ?>    
        </td>

        <td>
          <a href="<?php echo site_url('aluno/editar/' . $student->id); ?>" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit"></i> Editar</a>
          <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $student->id; ?>)"><i class="fas fa-trash-alt"></i> Excluir</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="mb-4">
  <a href="<?php echo site_url('/'); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
</div>

<?php $this->load->view('layouts/footer'); ?>

<script>
  function confirmDelete(studentId) {
    if (confirm('Tem certeza que deseja excluir esse aluno?')) {
      window.location.href = "<?php echo site_url('aluno/excluir/'); ?>" + studentId;
    }
  }
</script>