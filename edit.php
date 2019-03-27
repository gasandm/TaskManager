<?php
session_start();

if(!isset($_SESSION['name'])) {
    header('Location: /index.html');
}
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
      <header>
        <div class="collapse bg-dark" id="navbarHeader">
          <div class="container">
            <div class="row">
              <div class="col-sm-8 col-md-7 py-4">
                <h4 class="text-white">О проекте</h4>
                <p class="text-muted">Обучающий проект</p>
              </div>
              <div class="col-sm-4 offset-md-1 py-4">
                <h4 class="text-white"> <?php echo $_SESSION['name']; ?></h4>
                <ul class="list-unstyled">
                  <li><a href="logout.php" class="text-white">Выйти</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
          <div class="container d-flex justify-content-between">
            <a href="list.php" class="navbar-brand d-flex align-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
              <strong>Задачи</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          </div>
        </div>
      </header>
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
