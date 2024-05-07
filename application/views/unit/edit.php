<?php $this->load->view('layouts/header', array('title' => 'Atualizar turma')); ?>

<form action="<?php echo site_url('turma/atualizar/' . $unit->id); ?>" method="post">
  <div class="row mb-4">
    
    <div class="col-12 col-sm-6">
      <div class="form-group mb-0">
        <label for="name">Nome da turma:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $unit->name; ?>">
      </div>
    </div>

  </div>
  <div class="row mb-4">

    <div class="col-10 col-sm-4">
      <div class="form-group mb-0">
        <label for="name">Professor:</label>
        <input type="text" class="form-control" id="teacher" name="teacher" value="<?php echo $unit->teacher; ?>">
      </div>
    </div>

    <div class="col-2 align-self-end">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
    </div>
    
  </div>

</form>

<div class="mb-4">
  <a href="<?php echo site_url('turmas'); ?>" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Voltar
  </a>
</div>

<?php $this->load->view('layouts/footer'); ?>