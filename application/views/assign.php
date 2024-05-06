<?php $this->load->view('layouts/header', array('title' => 'Enturmar Alunos')); ?>

<h3>Enturmar alunos</h3>

<form class="mb-2" action="<?php echo site_url('enturmar/enviar'); ?>" method="post">

  <div class="row mb-4">

    <div class="col-6">
      <div class="form-group">
        <label for="unit">Turma:</label>
        <select class="form-control" id="unit" name="unit">
          <option value="">Selecione</option>
          <?php foreach ($units as $unit): ?>
            <option value="<?php echo $unit->id; ?>"><?php echo $unit->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="col-6">
      <div class="form-group">
        <label>Alunos disponíveis:</label>
        <div class="checkbox-list">
          <?php foreach ($students as $student): ?>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="student_<?php echo $student->id; ?>" name="students[]" value="<?php echo $student->id; ?>">
              <label class="form-check-label" for="student_<?php echo $student->id; ?>"><?php echo $student->name; ?></label>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

  </div>

  <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Enturmar alunos</button>
</form>

<div class="mb-4">
  <a href="<?php echo site_url('/'); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
</div>

<?php $this->load->view('layouts/footer'); ?>