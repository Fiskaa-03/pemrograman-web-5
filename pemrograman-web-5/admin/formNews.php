<?php
  $status = "";
  $title = "";
  $category = "";
  $image = "";
  $content = "";
  $pubDate = "";
  $msg = "";
  $msgEdit = "";
  $newsID = "";

  if (isset($_GET["msg"])) {
    $msg = $_GET["msg"];
  }

  if (isset($_SESSION["content"])) {
    $content = $_SESSION["content"];
  }

  if (isset($_SESSION["title"])) {
    $title = $_SESSION["title"];
  }

  if ($_GET["page"] == "addNews") {
    $status = "Add";
    $processForm = "addNews";
  }

  if ($_GET["page"] == "editNews") {
    $status = "Edit";
    $newsID = $_GET["id"];

    $query = "SELECT * FROM news WHERE ID=$newsID";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    $title = $data["title"];
    $category = $data["category"];
    $image = $data["image"];
    $content = $data["content"];
    $pubDate = $data["publicationDate"];
    
    if (isset($_GET["msgEdit"])) {
      $msgEdit = $_GET["msgEdit"];
      $title = $_SESSION["title"];
      $content = $_SESSION["content"];
      $pubDate = $_SESSION["pubDate"];
    }

    $processForm = "editNews";
  }
?>

<div class="column pt-5">
  <p class="has-text-danger has-text-centered is-size-5"><?= $msg; ?></p>
  <p class="has-text-danger has-text-centered is-size-5"><?= $msgEdit; ?></p>
  <h1 class="is-size-2 mb-2">News Form <?= $status; ?></h1>

  <form action="index.php?page=<?= $processForm; ?>" method="post" enctype="multipart/form-data">
    <div class="field">
      <label class="label">Title</label>
      <div class="control">
        <input class="input" name="title" type="text" placeholder="Type Your Title Here" value="<?= $title; ?>" required>
      </div>
    </div>

    <div class="field">
      <label class="label">Category</label>
      <div class="control">
        <div class="select is-fullwidth">
          <select name="category" id="cat">
            <option value="POLITIC" <?php echo ($category == 'POLITIC') ? 'selected' : ''; ?>>Politics</option>
            <option value="ECONOMY" <?php echo ($category == 'ECONOMY') ? 'selected' : ''; ?>>Economy</option>
            <option value="SPORT" <?php echo ($category == 'SPORT') ? 'selected' : ''; ?>>Sport</option>
          </select>
        </div>
      </div>
    </div>

    <div class="field">
      <label class="label">Image</label>
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
      <label class="label">Content</label>
      <div class="control">
        <textarea class="textarea" name="content" placeholder="Write your content here" required><?= $content; ?></textarea>
      </div>
    </div>

    <div class="field">
      <label class="label">Publication Date</label>
      <div class="control">
        <input class="input" name="pubDate" type="date" value="<?= $pubDate; ?>" required>
      </div>
    </div>
    
    <?php if($_SESSION["role"] == "ADMIN") : ?>

      <div class="field">
        <label class="label">Visibility</label>
        <div class="control">
          <div class="select is-fullwidth">
            <select name="visibility" id="vis">
              <option value="VISIBLE">Visible</option>
              <option value="UNVISIBLE">Unvisible</option>
            </select>
          </div>
        </div>
      </div>

    <?php endif ?>

    <div class="field is-grouped mt-5">
      <div class="control">
        <input type="hidden" name="id" value="<?= $newsID; ?>">
        <button type="submit" name="submit" value="submit" class="button is-primary"><?= $status ?></button>
        <a href="index.php?page=news" class="button">Back</a>
      </div>
    </div>
  </form>
</div>