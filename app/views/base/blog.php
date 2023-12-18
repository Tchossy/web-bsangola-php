<?php $this->layout('_theme') ?>

<!-- Page Banner Start -->
<section class="page-banner bgs-cover overlay pt-50" style="background-image: url(/base/images/banner.jpg)">
  <div class="container">
    <div class="banner-inner">
      <h1 class="page-title">Blog</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Início</a></li>
          <li class="breadcrumb-item active">Blog</li>
        </ol>
      </nav>
    </div>
  </div>
</section>
<!-- Page Banner End -->

<!-- Blog Page Area Start -->
<section class="blog-page-area bg-lighter">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <!-- LIST BLOG -->
        <div class="blog-standard-content pt-120 rpt-100 pb-110 rpb-90 pr-15 rpr-0" id="containerBlogs">
          <!-- ITEM BLOG -->
        </div>
        <!-- PAGINATION -->
        <ul class="pagination flex-wrap">
          <li class="page-item disabled">
            <span class="page-link"><i class="fas fa-chevron-left"></i></span>
          </li>
          <li class="page-item active">
            <span class="page-link">
              01
              <span class="sr-only">(current)</span>
            </span>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">02</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">03</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
          </li>
        </ul>
      </div>
      <div class="col-lg-4 col-sm-9">
        <div class="blog-sidebar mt-120 rmy-100">
          <div class="widget widget-search wow fadeInUp delay-0-2s">
            <form action="#">
              <input type="text" placeholder="Search" class="searchbox" required />
              <button type="submit" class="searchbutton fa fa-search"></button>
            </form>
          </div>
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
<!-- Blog Page Area End -->

<script src="<?= BASE_ACTIONS . "/actions_blogs.js" ?>"></script>