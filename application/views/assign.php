<?php $this->load->view('layouts/header', array('title' => 'Enturmação')); ?>

<!-- Form to assign students to a unit -->
<h4>Enturmar alunos</h4>
<form class="mb-4" action="<?php echo site_url('enturmar/criar/enviar'); ?>" method="post">

  <div class="row mb-4">

    <!-- Column with all units -->
    <div class="col-6">
      <div class="form-group">
        <label for="unit">Turma:</label>
        <select class="form-control" id="unit" name="unit">
          <option value="" disabled selected>Selecione</option>
          <?php foreach ($units as $unit): ?>
            <option value="<?php echo $unit->id; ?>"><?php echo $unit->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <!-- Column displaying available students -->
    <div class="col-6 border rounded py-3">
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

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Enturmar</button>
    </div>

  </div>  
</form>

<!-- Button for clearing a unit -->
<button id="clearUnitButton" type="submit" class="btn btn-danger mb-4"><i class="fas fa-minus"></i> Limpar turma</button>

<!-- Back button -->
<div class="mb-4">
  <a href="<?php echo site_url('/'); ?>" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Voltar
  </a>
</div>

<!-- JavaScript inclusion -->
<script src="<?php echo base_url('assets/js/assign.js'); ?>"></script>

<?php $this->load->view('layouts/footer'); ?>