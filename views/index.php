<?php
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
$messageDel= isset($_SESSION['message_del']) ? $_SESSION['message_del'] : null;
@include('includes/header.php');
if(isset($message)) {
  $alert = 'success';
  $messageText = $message;
  unset($_SESSION['message']);
} elseif(isset($messageDel)) {
  $alert = 'danger';
  $messageText = $messageDel;
  unset($_SESSION['message_del']);
}
$x=0;
?>
    <h2 class="text-center my-4">Телефонный справочник </h2>
    <div class="container my-5">
      <?php if(isset($alert)): ?>
        <div class="alert alert-<?=$alert; ?>" role="alert">
          <?= $messageText; ?>
        </div>
        <?php endif; ?> 
      <a href="add" class="btn btn-success float-end mx-5">Добавить </a>
      <table class="table table-hover text-center">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Имя</th>
            <th scope="col">Телефон номер</th>
            <th scope="col">Действия</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($contacts as $contact):?>
          <tr>
            <td scope="row"><?= ++$x; ?></td>
            <td><?= $contact['name']; ?></td>
            <td><?= $contact['phone']; ?></td>
            <td>
              <a href="edit?id=<?=$contact['id']; ?>" class="btn btn-primary">Редактировать </a>
              <a href="delete?id=<?= $contact['id']; ?>" class="btn btn-danger">Удалить </a>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php
    @include('includes/footer.php');
    ?>