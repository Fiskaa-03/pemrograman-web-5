<div class="row row-cols-1 row-cols-md-4 g-3">
  <?php
  $que    = "SELECT * FROM produk INNER JOIN kategori ON produk.id_kategori=kategori.id_kategori order by id_produk";
  $select = mysqli_query($con, $que);

  while ($data = mysqli_fetch_array($select)) {
    ?>
    <form action="index.php?page=pesanan-add" method="post">
      <div class="col">
        <div class="card h-100">
          <img src="images/<?php echo $data['gambar']; ?>" class="card-img-top p-2" alt="..." width="300" height="200">
          <div class="card-body">
            <h5 class="card-title"><?php echo $data['nama_produk']; ?></h5>
            <p class="card-text"><?php echo $data['nama_kategori']; ?> | Stok: <?php echo $data['stok']; ?></p>
            <hr>
            <form>
              <input type="hidden" name="id_produk" value="<?php echo $data['id_produk']; ?>">
              <input type="hidden" name="tanggal" value="<?php echo date('Y-m-d'); ?>">
              <input type="hidden" name="stok" value="<?php echo $data['stok']; ?>">
              <div class="form-group d-flex">
                <input class="form-control form-control-sm max-width-input" type="number" min="1" max="<?php echo $data['stok']; ?>" name="jumlah">&nbsp;
                <?php if(isset($_SESSION['status'])) { ?>
                  <?php if ($_SESSION['status'] == "login") { ?>
                    <input class="btn btn-dark btn-sm ml-2" type="submit" name="submit" value="beli">
                  <?php } ?>                      
                <?php } else if(!isset($_SESSION['status'])) { ?>
                  <a href="index.php" class="btn btn-dark btn-sm ml-2">beli</a>
                <?php } ?>  
              </div>
            </form>
          </div>
        </div>
      </div>
    </form>
  <?php } ?>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login</h5>
      </div>
      <div class="modal-body">
        <form action="index.php?page=login" method="post">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <br>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" minlength="8" required>
          </div>
          <br>
          <button type="submit" class="btn btn-dark">login</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerModalLabel">Register</h5>
      </div>
      <div class="modal-body">
        <form action="index.php?page=register" method="post">
          <div class="form-group">
            <label for="username1">Username:</label>
            <input type="text" class="form-control" id="username1" name="username1" minlength="8" maxlength="20" required>
          </div>
          <br>
          <div class="form-group">
            <label for="password1">Password:</label>
            <input type="password" class="form-control" id="password1" name="password1" minlength="8" maxlength="20" required>
          </div>
          <br>
          <div class="form-group">
            <label for="role1">Role:</label>
            <select class="form-control" id="role1" name="role1" required>
              <option value="Admin">Admin</option>
              <option value="Customer">Customer</option>
            </select>
          </div>
          <br>
          <div class="form-group">
            <label for="password1">Role Password:</label>
            <input type="password" class="form-control" id="r_password1" name="r_password1" required>
          </div>
          <br>
          <button type="submit" class="btn btn-dark">register</button>             
        </form>
      </div>
    </div>
  </div>
</div>