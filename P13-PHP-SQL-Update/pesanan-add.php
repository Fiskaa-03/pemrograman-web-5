<?php  
session_start();
if (isset($_POST['submit'])) {

    $notification = "";
    $id         = $_POST["id_produk"]; 
    $jumlah     = $_POST["jumlah"]; 
    $stok       = $_POST['stok'];
    $id_user    = $_SESSION['id'];

    $ready = $stok - $jumlah;

    include "sql.php";

    $queryPesanan = "INSERT INTO pesanan (tanggal_pesanan, id_user) VALUES (NOW(), '$id_user')";
    $resultPesanan = mysqli_query($con, $queryPesanan);

    if ($resultPesanan) {

        $idPesanan = mysqli_insert_id($con);

        $reset  = "alter table detailpesanan AUTO_INCREMENT = 1";
        $query  = mysqli_query($con,$reset);

        $queryDetailPesanan = "INSERT INTO detailpesanan (id_produk, jumlah, id_pesanan) VALUES ('$id', '$jumlah', '$idPesanan')";
        $resultDetailPesanan = mysqli_query($con, $queryDetailPesanan);

        $result = mysqli_query($con, "UPDATE produk SET stok='$ready' WHERE id_produk=$id");

    }
    mysqli_close($con);
    header("Location: index.php?page=pesanan");
}
else
{
    header("location:index.php");
}
?> 