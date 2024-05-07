<?php $this->load->view('layouts/header', array('title' => 'Menu')); ?>

<div class="row mb-4">
  <!-- Column for "Alunos" menu option -->
  <div class="col-6">
    <div class="card bg-light shadow-sm">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-users-cog"></i> Alunos</h5>
        <a href="<?php echo site_url('alunos'); ?>" class="btn btn-primary stretched-link"><i class="fas fa-sign-in-alt"></i></a>
      </div>
    </div>
  </div>

  <!-- Column for "Turmas" menu option -->
  <div class="col-6">
    <div class="card bg-light shadow-sm">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-object-group"></i> Turmas</h5>
        <a href="<?php echo site_url('turmas'); ?>" class="btn btn-primary stretched-link"><i class="fas fa-sign-in-alt"></i></a>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- Column for "Enturmação" menu option -->
  <div class="col-6">
    <div class="card bg-light shadow-sm">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-link"></i> Enturmação</h5>
        <a href="<?php echo site_url('enturmar'); ?>" class="btn btn-primary stretched-link"><i class="fas fa-sign-in-alt"></i></a>
      </div>
    </div>
  </div>

  <!-- Column for "Relatório" menu option -->
  <div class="col-6">
    <div class="card bg-light shadow-sm">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-paste"></i> Relatório</h5>
        <a href="<?php echo site_url('relatorio'); ?>" class="btn btn-primary stretched-link"><i class="fas fa-sign-in-alt"></i></a>
      </div>
    </div>
  </div>

</div> 

<?php $this->load->view('layouts/footer'); ?>