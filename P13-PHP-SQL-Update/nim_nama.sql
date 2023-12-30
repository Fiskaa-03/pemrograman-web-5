-- CREATE TABLE detailpesanan
CREATE TABLE `detailpesanan` (
  `id_detailpesanan` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  PRIMARY KEY (`id_detailpesanan`),
  KEY `id_produk` (`id_produk`),
  KEY `id_pesanan` (`id_pesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- CREATE TABLE kategori
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- CREATE TABLE produk
CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `stok` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `id_kategori` (`id_kategori`),
  CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- CREATE TABLE user
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- CREATE TABLE pesanan
CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_pesanan` date NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pesanan`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- INSERT INTO kategori
INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Elektronik'),
(2, 'Pakaian'),
(3, 'Peralatan'),
(4, 'Olahraga'),
(5, 'Kesehatan'),
(6, 'Mainan'),
(7, 'Buku'),
(8, 'Makanan'),
(9, 'Minuman'),
(10, 'Kecantikan');

-- INSERT INTO produk
INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `gambar`, `id_kategori`, `stok`) VALUES
(1, 'Laptop', 15000000, 'gambar1.jpg', 1, 70),
(2, 'T-shirt', 300000, 't-shirt.png', 2, 93),
(3, 'Blender', 1000000, 'blender.png', 3, 100),
(4, 'Sepatu Lari', 500000, 'sepatulari.png', 4, 100),
(5, 'Vitamin C', 40000, 'vitaminc.png', 5, 100),
(6, 'Action Figure', 700000, 'actionfigure.png', 6, 100),
(7, 'Novel', 250000, 'novel.png', 7, 100),
(8, 'Snack', 10000, 'snack.png', 8, 100);

-- INSERT INTO user
INSERT INTO `user` (`id_user`, `role`, `username`, `password`) VALUES
(1, 'Customer', 'Galang_Permana', 'e306763eab0b039ad697d934baf3d51de72852e2bbd5ea2a4f442a851f2e467c'),
(2, 'Admin', 'Padma_Wiguna', 'e306763eab0b039ad697d934baf3d51de72852e2bbd5ea2a4f442a851f2e467c');
