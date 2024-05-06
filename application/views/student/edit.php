<?php $this->load->view('layouts/header', array('title' => 'Atualizar aluno')); ?>

<h2>Atualizar aluno</h2>

<form action="<?php echo site_url('aluno/atualizar/' . $student->id); ?>" method="post">
  <div class="row mb-4">
    
    <div class="col-6">
      <div class="form-group mb-0">
        <label for="name">Nome:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $student->name; ?>">
      </div>
    </div>

    <div class="col-4">
      <div class="form-group mb-0">
        <label for="birthdate">Nascimento:</label>
        <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $student->birthdate; ?>">
      </div>
    </div>

    <div class="col-2 align-self-end">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Atualizar</button>
    </div>
    
  </div>

</form>


<?php $this->load->view('layouts/footer'); ?>