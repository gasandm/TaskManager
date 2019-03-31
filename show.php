<?php
session_start();
require_once( "include/connection.php" );
require_once( "include/check_user.php" );

$taskid = $_GET['id'];

//Запрос в БД
$sql = "SELECT * from tasks where id=$taskid";

$task = queryFetch($pdo, $sql);
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
    <div class="form-wrapper text-center">
      <img src="img/<?php echo $task['filename']; ?>" alt="" width="400">
      <h2><?php echo $task['taskname']; ?></h2>
      <p>
        <?php echo $task['task']; ?>
      </p>
    </div>
<section class="jumbotron text-center">
<a href="edit.php?id=<?php echo $taskid; ?>" class="btn btn-primary my-2">Редактировать запись</a>
</section>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.js"></script>
  </body>
</html>
