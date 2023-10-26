<?php
  include("data.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>News Portal | Home</title>
    <link rel="icon" href="assets/img/icon-logo.svg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="assets/style.css">
  </head>
  <body>
    <header>
      <div class="container">
        <nav class="navbar" role="navigation" aria-label="main navigation">
          <div class="navbar-brand">
            <a href="#" class="navbar-item logo">
              News Portal
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
              <span aria-hidden="true" style="background-color: #fff"></span>
              <span aria-hidden="true" style="background-color: #fff"></span>
              <span aria-hidden="true" style="background-color: #fff"></span>
            </a>
          </div>

          <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
              <a class="navbar-item">
                Home
              </a>

              <a class="navbar-item">
                News
              </a>
              
              <?php if(isset($_POST["login"])) : ?>
                <a class="navbar-item">
                  Edit News
                </a>

                <a class="navbar-item">
                  Edit User
                </a>
              <?php endif ?>

            </div>

            <div class="navbar-end">
              <div class="navbar-item">
                <div class="buttons">

                  <?php if(!isset($_POST["login"]) || isset($_POST["logout"])) : ?>
                    <form action="" method="post">
                      <button class="button" type="submit" name="login">Login</button>
                    </form>
                  <?php else : ?>
                    <form action="" method="post">
                      <button class="button" type="submit" name="logout">Logout</button>
                    </form>
                  <?php endif ?>

                </div>
              </div>
            </div>

          </div>
        </nav>
      </div>
    </header>

    <section class="jumbotron">
      <div class="container">
        <div class="jumbotron-content">
          <div class="jumbotron-img">
            <img src="assets/img/jumbotron.png" alt="jumbotron">
          </div>
          <div class="jumbotron-desc">
            <a>Global Unity in the Face of Climate Crisis: A Turning Point for a Sustainable Future</a>
          </div>
        </div>
      </div>
    </section>

    <section class="news-category">
      <div class="container is-flex is-justify-content-space-between">
        <div class="card politics-card">
          <div class="card-content politics-overlay">
            <p class="title">POLITICS</p>
          </div>
        </div>
        <div class="card economy-card">
          <div class="card-content economy-overlay">
            <p class="title">ECONOMY</p>
          </div>
        </div>
        <div class="card sport-card">
          <div class="card-content sport-overlay">
            <p class="title">SPORT</p>
          </div>
        </div>
      </div>
    </section>

    <section class="news-content">
      <div class="container">

      <?php foreach($datas as $data) : ?>
        <div class="card">
          <div class="card-content is-flex is-justify-content-space-between">
            <div class="news-content-img">
              <img src=<?= $data["img"] ?> alt="content">
            </div>
            <div class="news-content-data">
              <a href="#"><?= $data["title"] ?></a>
              <p><?= $data["description"] ?></p>
              <p class="date"><?= $data["date"] ?></p>
            </div>
          </div>
        </div>
      <?php endforeach ?>

      </div>
    </section>
  </body>
</html>