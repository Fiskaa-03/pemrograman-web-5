<?php 
  $msg = "";
  if (isset($_POST["submit"])) {
    $title = htmlentities(mysqli_real_escape_string($conn, $_POST["title"]));
    $content = htmlentities(mysqli_real_escape_string($conn, $_POST["content"]));
    $pubDate = htmlentities(mysqli_real_escape_string($conn, $_POST["pubDate"]));

    
    $name = htmlentities(mysqli_real_escape_string($conn, $_POST["name"]));
    $email = htmlentities(mysqli_real_escape_string($conn, $_POST["email"]));
    $password = htmlentities(mysqli_real_escape_string($conn, $_POST["password"]));
    $role = htmlentities(mysqli_real_escape_string($conn, $_POST["role"]));
    $status = htmlentities(mysqli_real_escape_string($conn, $_POST["status"]));
    
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user VALUES ('', '$name', '$email', '$password', '$role', '', '$status')";

    if (isset($_FILES)) {
      $folderName = "../public/uploads/profile";
      $fileName = $_FILES["uploadFile"]["name"];
      $tmp = $_FILES["uploadFile"]["tmp_name"];
      $pathFile = "$folderName/$fileName";
      $mimeAcc = array("image/jpeg", "image/gif","image/png");

      if (!in_array($_FILES["uploadFile"]["type"], $mimeAcc)) {
        $msg = "Please use image of these extensions : (.gif, .png, .jpg )"; 
      }
      if (!move_uploaded_file($tmp, "$folderName/$fileName")) {
        $msg = "Upload Failed";
      }
      else {
        $query = "INSERT INTO user VALUES ('', '$name', '$email', '$password', '$role', '$fileName', '$status')";
      }
    }

    try {
      $result = mysqli_query($conn, $query);
      $msg = "Add User Successfully";
      header("Location: index.php?page=user&msg=$msg");
      die();
    } catch (Exception $e) {
      error_log($e->getMessage(), 0);
      $msg = "Add User Failed, Try Another Account";
    }

    header("Location: index.php?page=addUser&msg=$msg");    
    die();

  }
?>

<?php include_once("formUser.php") ?>