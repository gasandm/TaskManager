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

    <title>Просмотр задачи</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <style>

    </style>
  </head>

  <body>
      <?php foreach ($tasks as $task): ?>
    <div class="form-wrapper text-center">
      <img src="img/<?php echo $task['filename']; ?>" alt="" width="400">
      <h2><?php echo $task['taskname']; ?></h2>
      <p>
        <?php echo $task['task']; ?>
      </p>
    </div>
<?php endforeach; ?>

<section class="jumbotron text-center">
<a href="edit.php?id=<?php echo $taskid; ?>" class="btn btn-primary my-2">Редактировать запись</a>
</section>

  </body>
</html>
