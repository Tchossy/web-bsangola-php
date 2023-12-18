<?php $this->layout('_theme') ?>

<!-- Page Banner Start -->
<section class="page-banner bgs-cover overlay pt-50" style="background-image: url(/base/images/banner.jpg)">
  <div class="container">
    <div class="banner-inner">
      <h1 class="page-title">Portfólio</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Início</a></li>
          <li class="breadcrumb-item active">Portfólio</li>
        </ol>
      </nav>
    </div>
  </div>
</section>
<!-- Page Banner End -->

<!-- Gallery Section Start -->
<section class="gallery-section overlay text-white pt-115 rpt-95 pb-100 rpb-80">
  <div class="container-fluid px-0">
    <div class="section-title text-center mb-55">
      <span class="sub-title">Nossa Galeria</span>
      <h2>Alguns de Nossos Trabalhos</h2>
    </div>
    <!-- LIST PORTIFOLIO -->
    <div class="row small-gap" id="containerPortfolios">
      <!-- ITEM PORTIFOLIO -->
    </div>
  </div>
</section>
<!-- Gallery Section End -->

<script src="<?= BASE_ACTIONS . "/actions_portfolio.js" ?>"></script>