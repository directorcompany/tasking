<?php
@include('includes/header.php');
?>
<div class="container my-5">
  <a href="index.php" class="btn btn-info mb-3">Главная</a>
  <h2 class="text-center">Редактирования контакта</h2>
  <form action="update" method="post" class="form">
  <div class="mb-3">
      <label for="inputName" class="form-label">Имя:</label>
      <input type="text" class="form-control" name="name" required>
    </div>
    <div class="mb-3">
      <label for="inputPhone" class="form-label">Телефон:</label>
      <input type="text" class="form-control" name="phone" required>
    </div>
    <input type="hidden" name="id" value=<?= $id;?>>
    <input type="submit" class="btn btn-primary" value="Отправить">
  </form>
</div>
<?php
@include('includes/footer.php');
?>