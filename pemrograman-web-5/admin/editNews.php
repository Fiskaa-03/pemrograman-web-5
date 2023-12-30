<?php
  $msg = "";
  $errorMsg = "";
  // ini_set('display_errors', 0);

  if (isset($_POST["submit"])) {
    $userID = $_SESSION["id"];
    $newsID = $_POST["id"];
    $title = htmlentities(mysqli_real_escape_string($conn, $_POST["title"]));
    $category = htmlentities(mysqli_real_escape_string($conn, $_POST["category"]));
    $content = htmlentities(mysqli_real_escape_string($conn, $_POST["content"]));
    $pubDate = htmlentities(mysqli_real_escape_string($conn, $_POST["pubDate"]));

    if (isset($_POST["visibility"])) {
      $visibility = htmlentities(mysqli_real_escape_string($conn, $_POST["visibility"]));
    } else {
      $visibility = "UNVISIBLE";
    }

    $query = "
      UPDATE news SET 
        title = '$title',
        category = '$category',
        content = '$content',
        publicationDate = '$pubDate',
        status = '$visibility'
      WHERE id = '$newsID'";

    if (isset($_FILES)) {
      $folderName = "../public/uploads";
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
          UPDATE news SET 
            title = '$title',
            category = '$category',
            image = '$fileName',
            content = '$content',
            publicationDate = '$pubDate',
            status = '$visibility'
          WHERE id = '$newsID'";
      }
    }

    try {
      $result = mysqli_query($conn, $query);
      $msg = "Edit News Successfully";
      unset($_SESSION['title']);
      unset($_SESSION['content']);
      header("Location: index.php?msg=$msg");
      die();
    } catch(Exception $e) {
      error_log($e->getMessage(), 0);
      $msg = "Edit Failed, Try another image";
    }
    
    
    $_SESSION["title"] = $title;
    $_SESSION["content"] = $content;
    $_SESSION["pubDate"] = $pubDate;
    header("Location: index.php?page=editNews&msgEdit=$msg&id=$newsID");    
    die();
  }
?>

<?php include_once("formNews.php") ?>