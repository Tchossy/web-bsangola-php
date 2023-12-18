<?php $this->layout('_theme');

require "base/db/config.php";

$currentURL = $_SERVER['REQUEST_URI'];

// // Obtém a última parte da URI
$parts = explode('/', $currentURL);
$lastPart = end($parts);

$result_portfolio = $pdo->prepare("SELECT * FROM portfolio WHERE id = ? ORDER BY id LIMIT 1");
$result_portfolio->execute(array($lastPart));
$num_team = $result_portfolio->rowCount();

if ($num_team < 1) {
  header("Location: " . URL_BASE . "/portfolio");
}

while ($row_portfolio = $result_portfolio->fetch(PDO::FETCH_ASSOC)) {
  extract($row_portfolio);

  $decode_image_portfolio = json_decode($image_portfolio);

  $url_image = "";

  if ($decode_image_portfolio) {
    $url_image = $decode_image_portfolio[0];
  } else {
    $url_image = "https://img.freepik.com/free-vector/realistic-news-studio-background_23-2149985606.jpg";
  }

  $decode_image_portfolio = json_decode($image_portfolio);

  $texWithParagraphs = nl2br($description_portfolio);

  $firstString = substr($texWithParagraphs, 0, 1);
?>

<!-- Page Banner Start -->
<section class="page-banner bgs-cover overlay pt-50" style="background-image: url(/base/images/banner.jpg)">
  <div class="container">
    <div class="banner-inner">
      <h1 class="page-title"><?php echo $title_portfolio ?></h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Inicío</a></li>
          <li class="breadcrumb-item active">Detalher portfolio</li>
        </ol>
      </nav>
    </div>
  </div>
</section>
<!-- Page Banner End -->

<!-- Portfolio Details Start -->
<section class="portfolio-details pt-120 rpt-100 pb-90 rpb-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="portfolio-details-content rmb-55 wow fadeInUp delay-0-2s">
          <div class="image mb-35">
            <img src="<?php echo $url_image ?>" alt="Portfolio Details" />
          </div>
          <h2><?php echo $title_portfolio ?></h2>
          <p>
            <?php echo $description_portfolio ?>
          </p>
          <!-- 
          <div class="row mt-45">
            <div class="col-sm-6">
              <div class="image mb-30 wow fadeInUp delay-0-2s">
                <img src="/base/images/gallery/portfolio-middle-1.jpg" alt="Portfolio" />
              </div>
            </div>
            <div class="col-sm-6">
              <div class="image mb-30 wow fadeInUp delay-0-4s">
                <img src="/base/images/gallery/portfolio-middle-2.jpg" alt="Portfolio" />
              </div>
            </div>
          </div>
           -->
        </div>
      </div>
      <div class="col-lg-4">
        <div class="portfolio-sidebar">
          <!-- <div class="widget widget-portfolio-info bg-lighter p-45 wow fadeInUp delay-0-3s">
            <h3 class="widget-title">Project Details</h3>
            <ul>
              <li>
                <h4>Project Name:</h4>
                <p>Software License Management</p>
              </li>
              <li>
                <h4>Clients:</h4>
                <p>Management</p>
              </li>
              <li>
                <h4>Category:</h4>
                <p>Template blocks</p>
              </li>
              <li>
                <h4>Project Year:</h4>
                <p>August 12, 2021</p>
              </li>
            </ul>
          </div> -->
          <div
            class="widget contact-info-widget contact-image-number style-two bgs-cover overlay wow fadeInUp delay-0-2s"
            style="background-image: url(/base/images/contact/home-two.jpg);">
            <div class="widget contact-info-widget contact-image-number style-two bgs-cover overlay"
              style="background-image: url(/base/images/contact/home-two.jpg);">
              <div class="contact-informations text-white">
                <h3>Não hesite em contactar-nos</h3>
                <ul class="contact-info">
                  <li>
                    <i class="fas fa-phone-alt"></i>
                    <div class="content">
                      <span>Ligue para nós</span>
                      <h5>
                        <a href="callto:+244931075826">+244 931 075 826</a>
                      </h5>
                    </div>
                  </li>
                  <li>
                    <i class="fas fa-envelope"></i>
                    <div class="content">
                      <span>Escreva para nós</span>
                      <h5>
                        <a href="mailto:geral@bsangola.com">geral@bsangola.com</a>
                      </h5>
                    </div>
                  </li>
                  <li>
                    <i class="fas fa-clock"></i>
                    <div class="content">
                      <span>Horário de atendimento</span>
                      <h5>Seg-Sab 08:00 - 16:00</h5>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Portfolio Details End -->

<!-- Next Prev Post Start -->
<div class="next-prev-post">
  <div class="container">
    <div class="next-prev-wrap">
      <a href="<?php echo $id - 1 ?>" class="prev-post wow fadeInRight delay-0-2s">
        <i class="fas fa-arrow-left"></i>
        <span>Postagem anterior</span>
      </a>
      <a href="<?php echo $id + 1 ?>" class="prev-post wow fadeInLeft delay-0-2s">
        <span>Próxima postagem</span>
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div>
</div>
<!-- Next Prev Post End -->

<!-- Portfolio Section Start -->
<section class="portfolio-section py-110 rpy-90">
  <div class="container">
    <div class="section-title mb-30">
      <h2>Projetos relacionados</h2>
    </div>
    <div class="row" id="containerRecentPortfolios">

    </div>
  </div>
</section>
<!-- Portfolio Section End -->

<?php
};
?>

<script src="<?= BASE_ACTIONS . "/actions_portfolio.js" ?>"></script>