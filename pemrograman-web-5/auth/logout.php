<?php
session_start();

$_SESSION['status'] = "logout";
session_destroy();

header("Location: ../index.php?msg=Log Out Successfully");
exit();
?>