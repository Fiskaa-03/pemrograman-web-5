<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pemrograman Web</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    html, body {
      height: 100%;
    }

    .card {
      border-radius: 0;
      border: 1px solid #343a40; /* Set the border color to dark */
    }

    .card img {
      border-radius: 0; /* Remove border radius from images */
    }

    .card-title,
    .card-text {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      max-width: 100%; /* Adjust this value based on your design */
    }

    .max-width-input {
      max-width: 50px;
    }

    /* Tambahkan properti margin-top pada elemen notifikasi */
    #customNotification {
      margin-top: 10px; /* Sesuaikan dengan besar margin yang diinginkan */
    }
  </style>
</head>
<body class="container d-flex flex-column h-100">

  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
      <div class="container">
        <?php
        session_start();
        if(!isset($_SESSION['status'])) 
        {
          ?>
          <a class="navbar-brand" href="index.php">Pemrograman Web</a>
          <div class="row justify-content-between">
            <div class="col-10"></div>
            <div class="col-2 d-flex justify-content-end align-items-end">
              <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#loginModal">Login</button>
              &nbsp;
              <button class="btn btn-dark" data-toggle="modal" data-target="#registerModal">Register</button>
            </div>
          </div>
          <?php  
        } 
        else if ($_SESSION['status'] == "login") 
        {
          $user = $_SESSION['username'];
          ?>
          <a class="navbar-brand" href="index.php"><?php echo $_SESSION['username'] ?></a>
          <div class="row justify-content-between">
            <div class="col-10"></div>
            <div class="col-2 d-flex justify-content-end align-items-end">
              <a href="index.php?page=pesanan"><button class="btn btn-dark" type="button">Pesanan</button></a>
              &nbsp;
              <a href="index.php?page=logout"><button class="btn btn-dark" type="button">Logout</button></a>
            </div>
          </div>
          <?php 
        } 
        ?>
      </div>
    </nav>
  </header>

  <div class="container flex-grow-1" id="content">
    <?php
    if (isset($_GET['notification'])) {
      $notification = urldecode($_GET['notification']);
      echo '<div id="customNotification" class="alert alert-dark">' . $notification . '</div>';
    }
    ?>
    <div class="p-3 table-responsive">
      <?php
      include "sql.php"; 
      $halaman = isset($_GET['page']) ? $_GET['page'] : 'home';

      switch ($halaman) {
        case 'login':
        include('login.php'); 
        break;
        case 'logout':
        include('logout.php'); 
        break;
        case 'register':
        include('register.php'); 
        break;
        case 'pesanan':
        include('pesanan.php'); 
        break;
        case 'pesanan-add':
        include('pesanan-add.php'); 
        break;
        default:
        include('home.php'); 
        break;
      }
      ?> 
    </div>    
  </div>

  <footer class="bg-dark text-white p-3" >
   <a>&copy; 2023</a>
 </footer>

 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

 <script>
      // Hilangkan notifikasi setelah beberapa detik
      setTimeout(function(){
        document.getElementById('customNotification').style.display = 'none';
      }, 5000); // Ubah nilai 5000 menjadi durasi yang diinginkan dalam milidetik
    </script>

  </body>
  </html>