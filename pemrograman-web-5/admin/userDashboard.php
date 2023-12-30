<?php
  $msg = "";
  $id = $_SESSION["id"];

  if (isset($_GET["msg"])) {
    $msg = $_GET["msg"];
  }

  $query = "
    SELECT
      id as ID,
      name AS Username,
      email AS Email,
      role AS Role,
      status AS Status
    FROM
      user
  ";

  if ($_SESSION["role"] != "ADMIN") {
    $query = "
      SELECT
        id as ID,
        name AS Username,
        email AS Email,
        role AS Role,
        status AS Status
      FROM
        user
      WHERE
        id=$id;
    ";
  }

  $result = mysqli_query($conn, $query);
  if(!$result) {
    echo "Not Right Query";
  }
?>

<div class="column pt-5">
  <p class="has-text-success has-text-centered is-size-5"><?= $msg; ?></p>
  <h1 class="is-size-2">User Dashboard</h1>

  <div class="table-container mt-5">
    <?php if($_SESSION["role"] == "ADMIN") : ?>
      <a class="button is-success" href="index.php?page=addUser">Add User</a>
    <?php endif ?>

    <table class="table is-fullwidth">
      <!-- Your table content -->
      <thead>
        <tr>
          <th><abbr title="Position">ID</abbr></th>
          <th><abbr title="Position">Name</abbr></th>
          <th><abbr title="Position">Email</abbr></th>
          <th><abbr title="Position">Role</abbr></th>
          <th><abbr title="Position">Status</abbr></th>
          <th><abbr title="Position">Action</abbr></th>
        </tr>
      </thead>
      <tbody>
        <?php while($data = mysqli_fetch_assoc($result)) : ?>
          <tr>
            <td><?= $data["ID"]; ?></td>
            <td><?= $data["Username"]; ?></td>
            <td><?= $data["Email"]; ?></td>
            <td><?= $data["Role"]; ?></td>
            <td><?= $data["Status"]; ?></td>
            <td>
              <a href="#" onclick="deleteData(<?= $data['ID']; ?>)">
                <?php if ($data["ID"] == 1) : ?>
                  <i class="fa-solid fa-trash-can has-text-danger"></i>
                <?php else : ?>
                  <i
                    class="fa-solid fa-trash-can js-modal-trigger has-text-danger" 
                    data-target="modal-delete-data">
                  </i>
                <?php endif ?>
              </a>

              <a href="<?= $data["ID"] == 1 ? "" : "index.php?page=editUser&id=" . $data["ID"] ?>">
                <i
                  class="fa-regular fa-pen-to-square ml-1 has-text-info">
                </i>
              </a>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>
  </div>
</div>

<div id="modal-delete-data" class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Confirm Delete</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <div class="modal-card-body">
      <h1>Are you sure want to delete this data?</h1>
    </div>
    <footer class="modal-card-foot">
      <form action="delUser.php" method="POST">
        <input type="hidden" name="userValue" class="dataValue">
        <button class="button is-danger deleteData">Delete</button>
      </form>
      <button class="button ml-2">Cancel</button>
    </footer>
  </div>
</div>