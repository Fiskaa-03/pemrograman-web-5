<?php
  $msg = "";
  if (isset($_GET["msg"])) {
    $msg = $_GET["msg"];
  }
  
  $id = $_SESSION["id"];
  $role = $_SESSION["role"];
  $query = "
    SELECT
      news.id AS ID,
      user.name AS Author,
      news.title AS Title,
      news.category AS Category,
      news.publicationDate AS Date,
      news.status AS Status
    FROM
      news
    JOIN
      user ON news.authorID = user.id
  ";
  
  if($role != "ADMIN") { 
    $query .= " WHERE news.authorID = $id; ";
  }

  $result = mysqli_query($conn, $query);
  if(!$result) {
    echo "Not Right Query";
  }
  // var_dump(mysqli_fetch_assoc($result));
?>

<div class="column pt-5">
  <p class="has-text-success has-text-centered is-size-5"><?= $msg; ?></p>
  <h1 class="is-size-2">News Dashboard</h1>

  <div class="table-container mt-5">
    <a class="button is-success" href="index.php?page=addNews">Add News</a>
    <table class="table is-fullwidth">
      <!-- Your table content -->
      <thead>
        <tr>
          <th><abbr title="Position">ID</abbr></th>
          <th><abbr title="Position">Author</abbr></th>
          <th><abbr title="Position">Title</abbr></th>
          <th><abbr title="Position">Category</abbr></th>
          <th><abbr title="Position">Publication Date</abbr></th>
          <th><abbr title="Position">Status</abbr></th>
          <th><abbr title="Position">Action</abbr></th>
        </tr>
      </thead>
      <tbody>
        <?php while($data = mysqli_fetch_assoc($result)) : ?>
          <tr>
            <td><?= $data["ID"]; ?></td>
            <td><?= $data["Author"]; ?></td>
            <td><?= $data["Title"]; ?></td>
            <td><?= $data["Category"]; ?></td>
            <td><?= $data["Date"]; ?></td>
            <td><?= $data["Status"]; ?></td>
            <td>
              <a href="#" onclick="deleteData(<?= $data['ID']; ?>)">
                <i
                  class="fa-solid fa-trash-can js-modal-trigger has-text-danger" 
                  data-target="modal-delete-data" >
                </i>
                <?php $newsID = $data["ID"]; ?>
              </a>

              <a href="index.php?page=editNews&id=<?= $data["ID"] ?>" class="">
                <i
                  class="fa-regular fa-pen-to-square ml-1 has-text-info"
                  style="">
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
      <form action="delNews.php" method="POST">
        <input type="hidden" name="newsValue" class="dataValue">
        <button class="button is-danger deleteData">Delete</button>
      </form>
      <button class="button ml-2">Cancel</button>
    </footer>
  </div>
</div>