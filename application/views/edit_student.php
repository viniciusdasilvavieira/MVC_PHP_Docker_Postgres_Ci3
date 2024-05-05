<?php $this->load->view('layouts/header', array('title' => 'Edit Student')); ?>

<div class="container mt-4">
  <h2>Edit Student</h2>
  <form action="<?php echo site_url('student/update/' . $student->id); ?>" method="post">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php echo $student->name; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>

<?php $this->load->view('layouts/footer'); ?>