<?php $this->load->view('layouts/header', array('title' => 'Edit Student')); ?>

<h2>Editar aluno</h2>
<form action="<?php echo site_url('aluno/atualizar/' . $student->id); ?>" method="post">
  <div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $student->name; ?>">
    <?php echo form_error('name', '<div class="text-danger">', '</div>'); ?>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>


<?php $this->load->view('layouts/footer'); ?>