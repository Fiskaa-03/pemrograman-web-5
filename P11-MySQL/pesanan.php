<?php 
$id_user = $_SESSION['id'];
?>

<div class="container flex-grow-1">
  <br>
  <div class="row justify-content-between">
   <div class="col-10"><b>Pesanan </b></div>
   <div class="col-2 d-flex justify-content-end align-items-end">
   </div>
 </div>
</div>

<hr>

<table class="table table-sm border border-dark">
 <thead class="thead-dark">
  <tr>
   <th scope="col" width="5%">No</th>
   <th scope="col">Customer</th>
   <th scope="col">Produk</th>
   <th scope="col">Kategori</th>
   <th scope="col">Harga</th>
   <th scope="col">Jumlah</th>
   <th scope="col">Total</th>
   <th scope="col">Tanggal</th>
 </tr>
</thead>
<tbody>
  <?php

  include "conn.php";
  $que    = "SELECT * FROM detailpesanan 
  JOIN pesanan ON pesanan.id_pesanan = detailpesanan.id_pesanan
  JOIN user ON user.id_user = pesanan.id_user 
  JOIN produk ON produk.id_produk = detailpesanan.id_produk 
  JOIN kategori ON kategori.id_kategori = produk.id_kategori
  where pesanan.id_user = $id_user
  order by pesanan.id_pesanan";
  
  $select = mysqli_query($con,$que);
  $dana   = 0;
  $nomor  = 0;

  while($data= mysqli_fetch_array($select)){
    $nomor  = $nomor + 1;  
    ?>

    <tr>
      <th scope="row"><?php echo $nomor; ?></th>
      <td><?php echo $data['username']; ?></td>
      <td><?php echo $data['nama_produk']; ?></td>
      <td><?php echo $data['nama_kategori']; ?></td>
      <td>
       <?php
       $uang = $data['harga'];
       $uang_format = number_format($uang, 0, ',', '.');
       echo "Rp. " . $uang_format;
       ?>         
     </td>
     <td><?php echo $data['jumlah']; ?></td>
     <td>
       <?php 
       $total = $data['jumlah'] * $data['harga']; 
       $total_format = number_format($total, 0, ',', '.');
       echo "Rp. " . $total_format;
       $dana = $dana + $total;
       ?>
     </td>
     <td><?php echo $data['tanggal_pesanan']; ?></td>
   </tr>
 <?php } ?>
</tbody>
</table>

<?php 
$dana_format = number_format($dana, 0, ',', '.');
?>

<hr>
<table class="table table-sm border border-dark">
 <tbody class="thead-dark">
    <tr>
      <td scope="col" width="5%">&nbsp;</td>
      <td scope="col"><?php echo "<b>Total Semua Pesanan</b> Rp. " . $dana_format; ?></td>
    </tr>
  </tbody>
</table>