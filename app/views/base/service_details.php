<?php $this->layout('_theme');

require "base/db/config.php";

$currentURL = $_SERVER['REQUEST_URI'];

// // Obtém a última parte da URI
$parts = explode('/', $currentURL);
$lastPart = end($parts);

$result_service = $pdo->prepare("SELECT * FROM services WHERE id = ? ORDER BY id LIMIT 1");
$result_service->execute(array($lastPart));
$num_team = $result_service->rowCount();

if ($num_team < 1) {
  header("Location: " . URL_BASE . "/services");
}

while ($row_service = $result_service->fetch(PDO::FETCH_ASSOC)) {
  extract($row_service);

  $decode_image_service = json_decode($image_service);

  $url_image = "";

  if ($decode_image_service) {
    $url_image = $decode_image_service[0];
  } else {
    $url_image = "https://img.freepik.com/free-vector/realistic-news-studio-background_23-2149985606.jpg";
  }

  $decode_image_service = json_decode($image_service);

  $texWithParagraphs = nl2br($description_service);

  $firstString = substr($texWithParagraphs, 0, 1);
?>

  <!-- Page Banner Start -->
  <section class="page-banner bgs-cover overlay pt-50" style="background-image: url(/base/images/banner.jpg)">
    <div class="container">
      <div class="banner-inner">
        <h1 class="page-title"><?php echo $title_service ?></h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicío</a></li>
            <li class="breadcrumb-item active">Service details</li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- Page Banner End -->

  <!-- Service Details Start -->
  <section class="service-details pt-120 rpt-100 pb-100 rpb-80">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="service-sidebar rmb-55 wow fadeInLeft delay-0-2s">
            <div class="widget contact-info-widget contact-image-number style-two bgs-cover overlay" style="background-image: url(/base/images/contact/home-two.jpg);">
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
                      <h5>Mon-Sat 08:00 - 16:00</h5>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="service-details-content wow fadeInRight delay-0-2s">
            <div class="image mb-40">
              <img src="<?php echo $url_image ?>" alt="Service Details" />
            </div>
            <h2><?php echo $title_service ?></h2>
            <p>
              <?php echo $texWithParagraphs ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Service Details End -->


<?php
};
?>

<script src="<?= BASE_ACTIONS . "/actions_services.js" ?>"></script>