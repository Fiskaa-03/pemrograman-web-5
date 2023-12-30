<?php
  include("../connection.php");

  if(isset($_POST["logout"])) {
    header("Location: ../index.php");;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="icon" href="../public/assets/img/icon-logo.svg" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <link rel="stylesheet" href="../public/assets/style.css">
</head>
<body>
  <div class="columns">
    <div class="column is-2 pt-5 has-background-success ">
      <aside class="menu pl-2" style="height: 100vh">
        <p class="menu-label has-text-white">
          General
        </p>
        <ul class="menu-list">
          <li><a href="index.php?page=news">Dashboard</a></li>
          <?php if ($_SESSION["role"] == "ADMIN") : ?>
            <li><a href="index.php?page=user">User</a></li>
          <?php else : ?>
            <li><a href="index.php?page=user">Profile</a></li>
          <?php endif ?>
        </ul>
        <p class="menu-label has-text-white">
          Main Menu
        </p>
        <ul class="menu-list">
          <li><a href="../index.php">Back To Main</a></li>
        </ul>
        
        <a href="../auth/logout.php" class="button mt-5">Logout</a>
        
      </aside>

    </div>
    <div class="column is-four-fifths container">
      <div class="card">
        <div class="card-content">
          <?php
            $page = isset($_GET["page"]) ? $_GET["page"] : "news";

            switch ($page) {
              case "news":
                include("newsDashboard.php");
                break;
              case "user":
                include("userDashboard.php");
                break;
              case "addNews":
                include("addNews.php");
                break;
              case "editNews":
                include("editNews.php");
                break;
              case "addUser":
                include("addUser.php");
                break;
              case "editUser":
                include("editUser.php");
                break;
              
            }
          ?>
          </div>
        </div>
      </div>
  </div>
  <script src="https://kit.fontawesome.com/5dedc1233e.js" crossorigin="anonymous"></script>
  <script src="../public/assets/script.js"></script>
</body>
</html>