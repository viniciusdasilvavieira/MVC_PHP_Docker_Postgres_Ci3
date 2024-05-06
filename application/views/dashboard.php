<?php $this->load->view('layouts/header', array('title' => 'Turmas')); ?>

<div class="row">
  <div class="col-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-users-cog"></i> Alunos</h5>
        <a href="<?php echo site_url('alunos'); ?>" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Gerenciar</a>
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-object-group"></i> Turmas</h5>
        <a href="<?php echo site_url('turmas'); ?>" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Gerenciar</a>
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-link"></i> Enturmação</h5>
        <a href="<?php echo site_url('assignments'); ?>" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Gerenciar</a>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('layouts/footer'); ?>