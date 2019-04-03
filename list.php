<?php
session_start();
require_once( "include/check_user.php" );
require_once( "include/db_conn.php" );

$sessId = $_SESSION['name'];

//Запрос в БД
$sql = "SELECT * from tasks where user_id=:user_id";

$params = [
    ':user_id' => $sessId,
];

$tasks = queryFetchAssoc($pdo, $sql, $params);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Задачи</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
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
          <a href="#" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <strong>Задачи</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Task-Manager</h1>
          <p class="lead text-muted">Здесь вы можете оставлять записи для дальнейшей обработки</p>
          <p>
            <a href="create-form.php" class="btn btn-primary my-2">Добавить запись</a>
          </p>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
            <?php foreach ($tasks as $task): ?>

             <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="img/<?php echo $task['filename']; ?>">
                <div class="card-body">
                  <p class="card-text"><?php echo $task['taskname']; ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="show.php?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-outline-secondary">Просмотр</a>
                      <a href="edit.php?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-outline-secondary">Изменить</a>
                      <a href="delete.php?id=<?php echo $task['id']; ?>&img_name=<?php echo $task['filename']; ?>" class="btn btn-sm btn-outline-secondary" onclick="confirm('are you sure?')">Удалить</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        <?php endforeach; ?>
          </div>
        </div>
      </div>

    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Наверх</a>
        </p>
        <p>Здесь вы можете оставлять записи для дальнейшей обработки</a>.</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>
