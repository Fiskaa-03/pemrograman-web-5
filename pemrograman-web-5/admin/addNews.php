<?php
  $msg = "";
  $errorMsg = "";

  if (isset($_POST["submit"])) {
    $folderName = "../public/uploads";
    $fileName = $_FILES["uploadFile"]["name"];
    $tmp = $_FILES["uploadFile"]["tmp_name"];
    $pathFile = "$folderName/$fileName";

    $userID = $_SESSION["id"];
    $title = htmlentities(mysqli_real_escape_string($conn, $_POST["title"]));
    $category = htmlentities(mysqli_real_escape_string($conn, $_POST["category"]));
    $content = htmlentities(mysqli_real_escape_string($conn, $_POST["content"]));
    $pubDate = htmlentities(mysqli_real_escape_string($conn, $_POST["pubDate"]));

    if (isset($_POST["visibility"])) {
      $visibility = htmlentities(mysqli_real_escape_string($conn, $_POST["visibility"]));
    } else {
      $visibility = "UNVISIBLE";
    }

    if (file_exists($pathFile)) {
      $msg = "File Name Already Used, Try Another";
    }
    else {
      $mimeAcc = array("image/jpeg", "image/gif","image/png");

      if (!in_array($_FILES["uploadFile"]["type"], $mimeAcc)) {
        $msg = "Please use image of these extensions : (.gif, .png, .jpg )"; 
      } 
      else {

        if (!move_uploaded_file($tmp, "$folderName/$fileName")) {
          $msg = "Upload Failed";
        }
        else {
          $query = "INSERT INTO news VALUES('', '$title', '$category', '$fileName', '$content', '$pubDate', '$userID', '$visibility')";
          $result = mysqli_query($conn, $query);
    
          if (!$result) {
            $msg = "Error!";
          }
          else {
            unset($_SESSION['title']);
            unset($_SESSION['content']);

            $msg = "Add News Successfully";
            header("Location: index.php?msg=$msg");
            die();
          }
        }
      }
    }

    $_SESSION["content"] = $content;
    $_SESSION["title"] = $title;
    header("Location: index.php?page=addNews&msg=$msg");    
    die();
  }

?>

<?php include_once("formNews.php") ?>