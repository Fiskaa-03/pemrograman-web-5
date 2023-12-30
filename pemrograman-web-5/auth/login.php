<?php  
  $email = "";
  $password = "";
  $msg="";
  if(isset($_GET["msg"])) {
    $msg = $_GET["msg"];
  }

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("../connection.php");

    $email = htmlentities(mysqli_real_escape_string($conn, $_POST["email"]));
	  $password = htmlentities(mysqli_real_escape_string($conn, $_POST["password"]));

    $getPasswordFromDB = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $getPasswordFromDB);

    if (!$result) {
      $msg = "User Not Found";
      header("Location: ../index.php?msg=$msg");
      die();
    }

    $datas = mysqli_fetch_assoc($result);

    if (!$datas) {
      $msg = "User Not Found";
      header("Location: ../index.php?msg=$msg");
      die();
    }

    $passwordFromDB = $datas["password"];

    if (password_verify($password, $passwordFromDB)) {
      if ($datas["status"] == "ACTIVE") {
        session_start();

        $_SESSION["id"] = $datas["id"];
        $_SESSION["name"] = $datas["name"];
        $_SESSION["status"] = "login";
        $_SESSION["role"] = $datas["role"];

        if ($datas["role"] == "ADMIN") {
            header("Location: ../admin/index.php");
            die();
        } else {
            header("Location: ../index.php");
            die();
        }
      } else {
        $msg = "User is not active yet";
        header("Location: ../index.php?msg=$msg");
        die();
      }
    } else {
      $msg = "Invalid password";
      header("Location: ../index.php?msg=$msg");
      die();
    } 


    $msg = "User Not Found";
    // header("Location: ../index.php?msg=$msg");
    // die();
  }
  
?>

<form action="auth/login.php" method="post">
  <p class="has-text-danger has-text-centered is-size-4"><?= $msg ?></p>

  <div class="field">
    <label class="label">Email</label>
    <div class="control has-icons-left has-icons-right">
      
      <input 
        class="input is-success"
        type="text"
        placeholder="Email"
        name="email" id="email"
        value="<?= $email; ?>"
        required
      />

      <span class="icon is-small is-left">
        <i class="fas fa-user"></i>
      </span>

      <span class="icon is-small is-right">
        <i class="fas fa-check"></i>
      </span>
    </div>
  </div>

  <div class="field">
    <label class="label">Password</label>
    <div class="control has-icons-left has-icons-right">
      <input
        class="input is-success"
        name="password" type="password"
        placeholder="Password"
        value="<?= $password; ?>"
        required
      />

      <span class="icon is-small is-left">
        <i class="fa-solid fa-lock"></i>
      </span>

      <span class="icon is-small is-right">
        <i class="fas fa-check"></i>
      </span>
    </div>
  </div>
  
  <button type="submit" name="login" class="button is-primary">Login</button>
</form>