<?php if ($this->session->flashdata('error')): ?>
  <div class="alert alert-danger" role="alert">
      <?php echo $this->session->flashdata('error'); ?>
  </div>
<?php endif; ?>