<?php
  $name = "";
  $email = "";
  $password = "";
  $msg = "";
  
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("../connection.php");
    
    $name = htmlentities(mysqli_real_escape_string($conn, $_POST["name"]));
    $email = htmlentities(mysqli_real_escape_string($conn, $_POST["email"]));
	  $password = htmlentities(mysqli_real_escape_string($conn, $_POST["password"]));
    $password = password_hash($password, PASSWORD_DEFAULT);
    $role = "USER";
    $status = "WAITING";

    $query = "INSERT INTO `user` VALUES ('', '$name', '$email', '$password', '$role', '', '$status')";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
      $msg = "Register Failed, Try Another Account";
      header("Location: ../index.php?msg=$msg");
      die();
    }

    $msg = "Register Success, Please Wait Admin Accept You";
    header("Location: ../index.php?msg=$msg");
    die();

  }
?>

<form action="auth/register.php" method="post">
  <p class="has-text-danger has-text-centered is-size-4"><?= $msg ?></p>

  <div class="field">
    <label class="label">Name</label>
    <div class="control has-icons-left has-icons-right">
      
      <input 
        class="input is-success"
        type="text"
        placeholder="Type your username"
        name="name" id="name"
        value="<?= $name; ?>"
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
  
  <button type="submit" name="register" class="button is-primary">Register</button>
</form>