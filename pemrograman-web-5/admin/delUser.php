<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include("../connection.php");

  $userValue = $_POST["userValue"];
  $query = "DELETE FROM user WHERE id = $userValue";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    echo mysqli_errno();
  }

  header("Location: index.php?page=user");
}
?>