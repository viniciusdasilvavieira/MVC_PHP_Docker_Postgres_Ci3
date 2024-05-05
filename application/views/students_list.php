<?php $this->load->view('layouts/header', array('title' => 'Listagem de estudantes')); ?>

<div class="container mt-4">
  <h2 class="mb-4">Student List</h2>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>Nome</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($students as $student): ?>
        <tr>
          <td><?php echo $student->name; ?></td>
          <td>
            <a href="<?php echo site_url('aluno/editar/' . $student->id); ?>" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit"></i> Edit</a>
            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $student->id; ?>)"><i class="fas fa-trash-alt"></i> Delete</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php $this->load->view('layouts/footer'); ?>

<script>
  function confirmDelete(studentId) {
    if (confirm('Tem certeza que deseja excluir esse estudante?')) {
        window.location.href = "<?php echo site_url('aluno/excluir/'); ?>" + studentId;
    }
  }
</script>