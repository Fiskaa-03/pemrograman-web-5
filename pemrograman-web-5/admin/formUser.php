<?php
  $statusForm = "";
  $name = "";
  $email = "";
  $password = "";
  $status = "";
  $profile = "";
  $msg = "";

  if ($_GET["page"] == "addUser") {
    $statusForm = "Add";
    $processForm = "addUser";
  }

  if ($_GET["page"] == "editUser") {
    $statusForm = "Edit";
    $processForm = "editUser";

    $userID = $_GET["id"];
    $query = "SELECT * FROM user WHERE ID=$userID";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);    

    $name = $data["name"];
    $email = $data["email"];
    $status = $data["status"];
  }

?>

<div class="column pt-5">
  <p class="has-text-danger has-text-centered is-size-5"><?= $msg; ?></p>
  <h1 class="is-size-2 mb-2">User Form <?= $statusForm; ?></h1>

  <form action="index.php?page=<?= $processForm; ?>" method="post" enctype="multipart/form-data">
    <div class="field">
      <label class="label">Image Profile</label>
      <div class="control">
        <div id="file-js-example" class="file has-name is-small is-fullwidth">
          <label class="file-label">
            <input class="file-input" name="uploadFile" value="<?=$image?>" type="file" accept = ".jpg, .png, .gif">
            <span class="file-cta">
              <span class="file-icon">
                <i class="fas fa-upload"></i>
              </span>
              <span class="file-label">
                Choose a file…
              </span>
            </span>
            <span class="file-name">
              No File Uploaded
            </span>
          </label>
        </div>
        <p class="help is-success">Please use .jpg, .png, or .gif</p>
        <p class="help is-success">Tips: To avoid upload failures, use filenames with specific formats. Ex: yourname_filename</p>
      </div>
    </div>

    <div class="field">
      <label class="label">Name</label>
      <div class="control">
        <input class="input" name="name" type="text" placeholder="Type Name Here" value="<?= $name; ?>" required>
      </div>
    </div>

    <div class="field">
      <label class="label">Email</label>
      <div class="control">
        <input class="input" name="email" type="email" placeholder="Type Email Here" value="<?= $email; ?>" required>
      </div>
    </div>

    <?php if ($_GET["page"] == "addUser") : ?>
      <div class="field">
        <label class="label">Password</label>
        <div class="control">
          <input class="input" name="password" type="password" placeholder="*****" value="<?= $password; ?>" required>
        </div>
      </div>
    <?php endif ?>

    <div class="field">
      <label class="label">Role</label>
      <div class="control">
          <div class="select is-fullwidth">
            <select name="role" id="role">
              <option value="USER">User</option>
              <option value="ADMIN" disabled>Admin</option>
            </select>
          </div>
        </div>
    </div>

    <?php if($_SESSION["role"] == "ADMIN") : ?>
      <div class="field">
        <label class="label">Status</label>
        <div class="control">
          <div class="select is-fullwidth">
            <select name="status" id="vis">
              <option value="WAITING" <?php echo ($status == 'WAITING') ? 'selected' : ''; ?>>Waiting</option>
              <option value="ACTIVE" <?php echo ($status == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
            </select>
          </div>
        </div>
      </div>
    <?php endif ?>

    <div class="field is-grouped mt-5">
      <div class="control">
        <input type="hidden" name="id" value="<?= $userID; ?>">
        <button type="submit" name="submit" value="submit" class="button is-primary"><?= $statusForm ?></button>
        <a href="index.php?page=user" class="button">Back</a>
      </div>
    </div>
  </form>
</div>