<?php
session_start();
$taskid = $_GET['id'];

$pdo = new PDO('mysql:host=localhost;dbname=myBase', 'admin', '');

//Запрос в БД
$sql = 'SELECT * from tasks where id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([
    ':id' => $taskid
]);
$tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Изменить задачу</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <style>

    </style>
  </head>

  <body>
      <?php foreach ($tasks as $task): ?>
    <div class="form-wrapper text-center">
      <form class="form-signin" enctype="multipart/form-data" action="edit_script.php" method="POST">
        <img class="mb-4" src="assets/img/logo.jpg" alt="" width="122" height="122">
        <h1 class="h3 mb-3 font-weight-normal">Добавить запись</h1>
        <input type="hidden" name="task_id" value="<?php echo $taskid; ?>">
        <input type="hidden" name="old_img" value="<?php echo $task['filename']; ?>">
        <label for="inputEmail" class="sr-only">Название</label>
        <input type="text" id="inputEmail" class="form-control" name="taskname" placeholder="Название" required value="<?php echo $task['taskname']; ?>">
        <label for="inputEmail" class="sr-only">Описание</label>
        <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Описание"><?php echo $task['task']; ?></textarea>
        <input type="hidden" name="MAX_FILE_SIZE" value="500000">
        <input type="file" name="filename">
        <img src="img/<?php echo $task['filename']; ?>" alt="" width="300" class="mb-3">
        <button class="btn btn-lg btn-success btn-block" type="submit">Редактировать</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2018-2019</p>
      </form>
    </div>
      <?php endforeach; ?>
  </body>
</html>
