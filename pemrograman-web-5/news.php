<?php
  $category = "ECONOMY";
  if(isset($_GET["category"])) {
    $category = $_GET["category"];
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
    WHERE news.status='VISIBLE' AND category='$category'";

  try {
    $result = mysqli_query($conn, $query);
  } catch (Exception $e) {
    error_log($e->getMessage(), 0);
  }
?>

<section class="news-category">
  <div class="container is-flex is-justify-content-space-between">
    <div class="card politics-card">
      <a href="index.php?page=news&category=POLITIC" class="title has-text-white">
        <div class="card-content politics-overlay">
          <p>POLITICS</p>
        </div>
      </a>
    </div>
    <div class="card economy-card">
      <a href="index.php?page=news&category=ECONOMY" class="title has-text-white">
        <div class="card-content economy-overlay">
          <p>ECONOMY</p>
        </div>
      </a>
    </div>
    <div class="card sport-card">
      <a href="index.php?page=news&category=SPORT" class="title has-text-white">
        <div class="card-content sport-overlay">
          <p>SPORT</p>
        </div>
      </a>
    </div>
  </div>
</section>

<section class="news-content">
  <div class="container is-flex is-flex-wrap-wrap is-justify-content-space-between">

    <?php while($data = mysqli_fetch_assoc($result)) : ?>
      <div class="card card-home">
        <div class="card-content">
          <div class="news-content-img">
            <img src="<?= $imgPath . $data["Image"] ?>" alt="content">
          </div>
          <div class="news-content-data">
            <h3 href="#"><?= $data["Title"] ?></h3>
            <p class="date"><?= $data["Date"] ?></p>
            <p>
              <?php
                $textArray = str_word_count($data["Content"], 1);
                $textLimit = implode(' ', array_slice($textArray, 0, 20));
                echo $textLimit . "...";
              ?>
            </p>

            <div class="owner-with-link is-flex is-justify-content-space-between">
              <div class="profile is-flex is-align-items-center">
                <img class="profile-img" src="<?= $profilePath . $data["Profile"] ?>" alt="profile">
                <p>
                  <?= $data["Author"] ?>
                </p>
              </div>
              <a href="index.php?page=newsDetail&id=<?= $data["ID"]?>" class="link-news has-text-link">
                Read More
                <i class="fa-solid fa-arrow-right icon-link-news"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile ?>

  </div>
</section>