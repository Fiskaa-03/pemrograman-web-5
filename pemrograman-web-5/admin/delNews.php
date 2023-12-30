<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include("../connection.php");

  $newsValue = $_POST["newsValue"];
  $query = "DELETE FROM news WHERE id = $newsValue";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    echo mysqli_errno();
  }

  header("Location: index.php?page=news");
}
?>