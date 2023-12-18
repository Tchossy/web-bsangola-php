<?php $this->layout('_theme');

require "base/db/config.php";

$currentURL = $_SERVER['REQUEST_URI'];

// // Obtém a última parte da URI
$parts = explode('/', $currentURL);
$lastPart = end($parts);

$result_blog = $pdo->prepare("SELECT * FROM blogs WHERE id = ? ORDER BY id LIMIT 1");
$result_blog->execute(array($lastPart));
$num_team = $result_blog->rowCount();

if ($num_team < 1) {
  header("Location: " . URL_BASE . "/blog");
}

while ($row_blog = $result_blog->fetch(PDO::FETCH_ASSOC)) {
  extract($row_blog);

  $decode_image_blog = json_decode($image_blog);

  $url_image = "";

  if ($decode_image_blog) {
    $url_image = $decode_image_blog[0];
  } else {
    $url_image = "https://img.freepik.com/free-vector/realistic-news-studio-background_23-2149985606.jpg";
  }

  $decode_image_blog = json_decode($image_blog);

  $texWithParagraphs = nl2br($description_blog);

  $firstString = substr($texWithParagraphs, 0, 1);
?>


  <!-- Page Banner Start -->
  <section class="page-banner bgs-cover overlay pt-50" style="background-image: url(/base/images/banner.jpg)">
    <div class="container">
      <div class="banner-inner">
        <h1 class="page-title"><?php echo $title_blog; ?></h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicío</a></li>
            <li class="breadcrumb-item active">Detalhes do blog</li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- Page Banner End -->

  <!-- Blog Details Area Start -->
  <section class="blog-details-area bg-lighter">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="blog-details-content pt-120 rpt-100 pb-95 rpb-75 pr-15 rpr-0">
            <div class="image wow fadeInUp delay-0-2s">
              <img src="<?php echo $url_image; ?>" alt="Blog Standard" />
            </div>
            <div class="blog-header">
              <ul class="post-meta-item mr-15">
                <li>
                  <i class="far fa-user"></i>
                  <a href="#" rel="bookmark">
                    <?php echo $author_blog; ?>
                  </a>
                </li>
                <li>
                  <i class="fas fa-calendar-alt"></i>
                  <a href="#">
                    <?php echo $date_create; ?>
                  </a>
                </li>
              </ul>

            </div>
            <h3>
              <?php echo $title_blog; ?>
            </h3>
            <p>
              <?php echo $texWithParagraphs; ?>
            </p>
            <blockquote>
              <?php echo $epigraph_blog; ?>
              <!-- <span class="author">Tony R. Francois</span> -->
            </blockquote>
            <div class="blog-footer mb-40">
              <div class="popular-tags mb-15">
                <b>Categoria :</b> <a href="#"><?php echo $category_blog; ?></a>
              </div>

            </div>

          </div>
        </div>
        <div class="col-lg-4 col-sm-9">
          <div class="blog-sidebar mt-120 rmy-100">
            <div class="widget widget-recent-post wow fadeInUp delay-0-4s">
              <h3 class="widget-title">Notícias recentes</h3>
              <!-- LIST BLOGS -->
              <div class="widget-news-wrap" id="containerRecentBlogs">
                <!-- DETAILS BLOG -->
              </div>
            </div>
            <div class="widget widget-call-action wow fadeInUp delay-0-2s">
              <div class="call-action-widget">
                <h2>Trabalhar juntos</h2>
                <p>
                  Não perca a oportunidade de criar um projecto incrivel connosco
                </p>
                <a class="theme-btn style-five btn-circle" href="/contact">Contate agora <i class="fas fa-angle-double-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Blog Details Area End -->

<?php
};
?>

<script src="<?= BASE_ACTIONS . "/actions_blogs.js" ?>"></script>