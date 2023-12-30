<?php
$que_produk = "SELECT produk.nama_produk AS nama, SUM(detailpesanan.jumlah) AS jumlah_penjualan
FROM detailpesanan
JOIN pesanan ON pesanan.id_pesanan = detailpesanan.id_pesanan
JOIN produk ON produk.id_produk = detailpesanan.id_produk
JOIN kategori ON kategori.id_kategori = produk.id_kategori
GROUP BY produk.nama_produk";

$que_kategori = "SELECT kategori.nama_kategori AS nama, SUM(detailpesanan.jumlah) AS jumlah_penjualan
FROM detailpesanan
JOIN pesanan ON pesanan.id_pesanan = detailpesanan.id_pesanan
JOIN produk ON produk.id_produk = detailpesanan.id_produk
JOIN kategori ON kategori.id_kategori = produk.id_kategori
GROUP BY kategori.nama_kategori";

$select_produk = mysqli_query($con, $que_produk);
$select_kategori = mysqli_query($con, $que_kategori);

$xValuesProduk = array(); // Array to store x-axis labels for produk
$yValuesProduk = array(); // Array to store corresponding y-axis values for produk

$xValuesKategori = array(); // Array to store x-axis labels for kategori
$yValuesKategori = array(); // Array to store corresponding y-axis values for kategori

while ($row_produk = mysqli_fetch_assoc($select_produk)) {
$xValuesProduk[] = $row_produk['nama'];
$yValuesProduk[] = $row_produk['jumlah_penjualan'];
}

while ($row_kategori = mysqli_fetch_assoc($select_kategori)) {
$xValuesKategori[] = $row_kategori['nama'];
$yValuesKategori[] = $row_kategori['jumlah_penjualan'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Charts</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>
<body>
  <div class="row justify-content-between">
    <div class="col-10"><b>Produk </b></div>
  </div>

  <hr>

  <canvas id="chart-produk" style="width:100%;max-width:600px"></canvas>

  <script>
    var xValuesProduk = <?php echo json_encode($xValuesProduk); ?>;
    var yValuesProduk = <?php echo json_encode($yValuesProduk); ?>;
    var barColorProduk = "black"; 

    new Chart("chart-produk", {
      type: "horizontalBar",
      data: {
        labels: xValuesProduk,
        datasets: [{
          backgroundColor: barColorProduk,
          data: yValuesProduk
        }]
      },
      options: {
        scales: {
          xAxes: [{
            ticks: {
              beginAtZero: true
            }
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
        legend: {
          display: false
        },
        title: {
          display: true,
        }
      }
    });
  </script>

  <br>

  <div class="row justify-content-between">
    <div class="col-10"><b>Kategori </b></div>
  </div>

  <hr>

  <canvas id="chart-kategori" style="width:100%;max-width:600px"></canvas>

  <script>
    var xValuesKategori = <?php echo json_encode($xValuesKategori); ?>;
    var yValuesKategori = <?php echo json_encode($yValuesKategori); ?>;
    var barColorKategori = "black"; 

    new Chart("chart-kategori", {
      type: "horizontalBar",
      data: {
        labels: xValuesKategori,
        datasets: [{
          backgroundColor: barColorKategori,
          data: yValuesKategori
        }]
      },
      options: {
        scales: {
          xAxes: [{
            ticks: {
              beginAtZero: true
            }
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
        legend: {
          display: false
        },
        title: {
          display: true,
        }
      }
    });
  </script>
  
</body>
</html>
