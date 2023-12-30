<?php
session_start();
include "sql.php";

// Inisialisasi notifikasi menjadi string kosong
$notification = "";

// Lakukan proses autentikasi di sini
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username   = $_POST['username1'];
  $password   = $_POST['password1'];
  $role       = $_POST['role1'];
  $r_password = $_POST['r_password1'];

  // Gunakan kunci (key) untuk enkripsi password dengan hash HMAC
  $key = "primakara";
  $hashedpassword = hash_hmac("sha256", $password, $key);

  if($role=="Admin" && $r_password=="webadmin") 
  {
    $notification = "berhasil registrasi admin, username: $username, password: $password";
    $reset        = "alter table user AUTO_INCREMENT = 1";
    $query        = mysqli_query($con,$reset);
    $result       = mysqli_query($con, "INSERT INTO user (role,username,password) VALUES ('$role','$username','$hashedpassword')");
  } 
  else if($role=="Customer" && $r_password=="webcustomer") 
  {
    $notification = "berhasil registrasi customer, username: $username, password: $password";
    $reset        = "alter table user AUTO_INCREMENT = 1";
    $query        = mysqli_query($con,$reset);
    $result       = mysqli_query($con, "INSERT INTO user (role,username,password) VALUES ('$role','$username','$hashedpassword')");    
  } 
  else 
  {
    $notification = "terdapat kesalahan registrasi";
  }
}

// Redirect ke halaman index dengan membawa notifikasi sebagai parameter URL
header("Location: index.php?notification=" . urlencode($notification));
exit(); // Pastikan untuk keluar setelah melakukan redirect
?>
