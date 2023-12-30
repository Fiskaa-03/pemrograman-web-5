<?php 
  if (isset($_POST["submit"])) {
    $userID = $_POST["id"];
    $name = htmlentities(mysqli_real_escape_string($conn, $_POST["name"]));
    $email = htmlentities(mysqli_real_escape_string($conn, $_POST["email"]));
    $role = htmlentities(mysqli_real_escape_string($conn, $_POST["role"]));

    if (isset($_POST["status"])) {
      $status = htmlentities(mysqli_real_escape_string($conn, $_POST["status"]));
    } else {
      $status = "ACTIVE";
    }

    $query = "
      UPDATE user SET 
        name = '$name',
        email = '$email',
        role = '$role',
        status = '$status'
      WHERE id = '$userID'";

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
        $query = "
          UPDATE user SET 
            name = '$name',
            email = '$email',
            role = '$role',
            profile = '$fileName',
            status = '$status'
          WHERE id = '$userID'";
      }
    }
    
    try {
      $result = mysqli_query($conn, $query);
      $msg = "Edit User Successfully";
      header("Location: index.php?page=user&msg=$msg");
      die();
    } catch (Exception $e) {
      error_log($e->getMessage(), 0);
      $msg = "Edit User Failed, Try Another";
    }

    header("Location: index.php?page=editUser&msg=$msg");    
    die();
  }
?>

<?php include_once("formUser.php") ?>