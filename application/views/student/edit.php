<?php $this->load->view('layouts/header', array('title' => 'Atualizar aluno')); ?>

<!-- Form to update student information -->
<form action="<?php echo site_url('aluno/atualizar/' . $student->id); ?>" method="post">
  <div class="row mb-4">
    
    <!-- Input field for student's name -->
    <div class="col-12 col-sm-6">
      <div class="form-group mb-0">
        <label for="name">Nome:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $student->name; ?>">
      </div>
    </div>

    <!-- Input field for student's birthdate -->
    <div class="col-10 col-sm-4">
      <div class="form-group mb-0">
        <label for="birthdate">Nascimento:</label>
        <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $student->birthdate; ?>">
      </div>
    </div>

    <!-- Submit button -->
    <div class="col-2 align-self-end">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
    </div>
    
  </div>

</form>

<!-- Back button -->
<div class="mb-4">
  <a href="<?php echo site_url('alunos'); ?>" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Voltar
  </a>
</div>


<?php $this->load->view('layouts/footer'); ?>