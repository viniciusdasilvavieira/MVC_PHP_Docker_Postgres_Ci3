<?php $this->load->view('layouts/header', array('title' => 'Menu de enturmação')); ?>

<div class="row gutters-lg mb-4">
  <div class="col-6">
    <div class="card bg-light shadow-sm">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-link"></i> Enturmar</h5>
        <a href="<?php echo site_url('enturmar/criar'); ?>" class="btn btn-primary stretched-link"><i class="fas fa-sign-in-alt"></i></a>
      </div>
    </div>
  </div>

  <div class="col-6">
    <div class="card bg-light shadow-sm">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-unlink"></i> Limpar turmas</h5>
        <a href="<?php echo site_url('enturmar/limpar'); ?>" class="btn btn-primary stretched-link"><i class="fas fa-sign-in-alt"></i></a>
      </div>
    </div>
  </div>
</div>

<div class="mb-4">
  <a href="<?php echo site_url('/'); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
</div>

<?php $this->load->view('layouts/footer'); ?>