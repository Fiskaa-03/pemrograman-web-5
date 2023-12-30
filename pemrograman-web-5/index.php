<?php
  ob_start();
  session_start();

  include("connection.php");

  $userID = "";
  $result = "";
  $profileImg = "";
  $profilePath = "public/uploads/profile/";
  $imgPath = "public/uploads/";


  if (isset($_SESSION["id"])) {
    $userID = $_SESSION["id"];
    $query = "SELECT * FROM user WHERE id=$userID";
    try {
      $result = mysqli_query($conn, $query);
    } catch (Exception $e) {
      error_log($e->getMessage(), 0);
    }

    $profile = mysqli_fetch_assoc($result)["profile"];
    
    if (mysqli_num_rows($result) > 0) {
      $profileImg = $profilePath . $profile;
    }
  }

  if(isset($_GET["msg"])) {
    $msg = $_GET["msg"];
    echo "
      <script>
        alert('$msg');
      </script>
    ";
  }
  
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>News Portal | Home</title>
    <link rel="icon" href="public/assets/img/icon-logo.svg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="public/assets/style.css">
  </head>
  <body>

    <header>
      <div class="container">
        <nav class="navbar" role="navigation" aria-label="main navigation">
          <div class="navbar-brand">
            <a href="index.php" class="navbar-item logo">
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
              <a class="navbar-item" href="index.php">
                Home
              </a>

              <a class="navbar-item" href="index.php?page=news">
                News
              </a>

            </div>
            <?php if(!isset($_SESSION["status"])) : ?>
              <div class="navbar-end">
                <div class="navbar-item">
                  <p
                    class="js-modal-trigger has-text-white"
                    style="cursor: pointer;"
                    data-target="modal-js-login"
                  >
                    Login
                  </p>
                  <p
                    class="js-modal-trigger has-text-white"
                    style="cursor: pointer; margin-left: 15px;"
                    data-target="modal-js-register"
                  >
                    Register
                  </p>
                </div>
              </div>
            <?php else : ?>
              <div class="navbar-end">
                <div class="navbar-item">
                  <!-- <p
                    class="has-text-white"
                    style="cursor: pointer;"
                  >
                  </p> -->
                  <div class="dropdown is-right is-hoverable">
                    <div class="dropdown-trigger">
                      <div class="profile is-flex is-align-items-center">
                        <p class="has-text-white" style="cursor: pointer;" aria-haspopup="true" aria-controls="dropdown-menu4">
                          <span><?= $_SESSION["name"]; ?></span>
                        </p>
                        <img class="profile-img" src="<?= $profileImg ?>" alt="profile">
                      </div>
                    </div>
                    <div class="dropdown-menu" id="dropdown-menu4" role="menu">
                      <div class="dropdown-content has-text-right">
                        <div class="dropdown-item">
                          <a
                            class="has-text-black"
                            href="admin/index.php"
                          >
                            Dashboard
                          </a>
                        </div>
                        <div class="dropdown-item">
                          <a
                            class="has-text-danger"
                            href="auth/logout.php"
                          >
                            Logout
                          </a> 
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif ?>
          </div>
        </nav>
      </div>
    </header>

    <?php
      $page = isset($_GET["page"]) ? $_GET["page"] : "home";

      switch ($page) {
        case "home":
          include("home.php");
          break;
        case "news":
          include("news.php");
          break;
        case "newsDetail":
          include("newsDetail.php");
          break;
      }
    ?>
    
    <div id="modal-js-login" class="modal">
      <div class="modal-background"></div>
      <header class="modal-card-head" style="width: 30%;">
        <p class="modal-card-title has-text-centered">Login</p>
      </header>
      <div class="modal-content">
        <div class="box">
          <?php include("auth/login.php"); ?>
        </div>
      </div>
    </div>

    <div id="modal-js-register" class="modal">
      <div class="modal-background"></div>
      <header class="modal-card-head" style="width: 30%;">
        <p class="modal-card-title has-text-centered">Register</p>
        <button class="delete" aria-label="close"></button>
      </header>
      <div class="modal-content">
        <div class="box">
          <?php include("auth/register.php"); ?>
        </div>
      </div>
    </div>

  <script src="public/assets/script.js"></script>
  <script src="https://kit.fontawesome.com/5dedc1233e.js" crossorigin="anonymous"></script>

  </body>
</html>