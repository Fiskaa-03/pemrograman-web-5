<?php
  $id = "";
  if (isset($_GET["id"])) {
    $id = $_GET["id"];
  }

  $query = "
    SELECT
      user.name AS Author,
      user.profile AS Profile,
      news.id AS ID,
      news.title AS Title,
      news.image AS Image,
      news.content AS Content,
      news.publicationDate AS Date
    FROM news
    JOIN user ON news.authorID = user.id 
    WHERE news.id=$id";
  
  try {
    $result = mysqli_query($conn, $query);
  } catch (Exception $e) {
    error_log($e->getMessage(), 0);
  }

?>

<section class="news-content">
  <div class="column container has-centered is-three-fifths">

    <?php while($data = mysqli_fetch_assoc($result)) : ?>
      <div class="card">
        <div class="card-content">

          <div class="news-content-img">
            <img src="<?= $imgPath . $data["Image"] ?>" alt="content">
          </div>

          <div class="news-content-data">
            <h3 href="#"><?= $data["Title"] ?></h3>
            <p class="date"><?= $data["Date"] ?></p>
            <p>
              <?= $data["Content"];?>
            </p>

            <div class="owner-with-link is-flex is-justify-content-space-between">
              <div class="profile is-flex is-align-items-center">
                <img class="profile-img" src="<?= $profilePath . $data["Profile"] ?>" alt="profile">
                <p>
                  <?= $data["Author"] ?>
                </p>
              </div>
              <a href="index.php" class="link-news has-text-link">
                <i class="fa-solid fa-arrow-left icon-link-news"></i>
                Back
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile ?>

  </div>
</section>