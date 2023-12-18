<?php $this->layout('_theme') ?>

<!-- Page Banner Start -->
<section class="page-banner bgs-cover overlay pt-50" style="background-image: url(/base/images/banner.jpg)">
  <div class="container">
    <div class="banner-inner">
      <h1 class="page-title">Serviços</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Início</a></li>
          <li class="breadcrumb-item active">Serviços</li>
        </ol>
      </nav>
    </div>
  </div>
</section>
<!-- Page Banner End -->

<!-- Services Start -->
<section class="services-four pt-115 rpt-95 pb-100 rpb-150">
  <div class="container">
    <div class="row justify-content-between align-items-center mb-40">
      <div class="col-lg-6 wow fadeInLeft delay-0-2s">
        <div class="section-title mb-35">
          <span class="sub-title">Serviços Diversificados</span>
          <h2>
            Soluções para todas as suas necessidades
          </h2>
        </div>
      </div>
      <div class="col-lg-5 wow fadeInRight delay-0-2s">
        <p>
          Na BSA, estamos empenhados em oferecer um leque abrangente de serviços para atender a todas as suas demandas.
          Nossa equipe altamente qualificada e experiente está pronta para fornecer soluções eficazes e personalizadas
          para cada projeto. Explore os serviços abaixo e descubra como podemos ajudá-lo a alcançar seus objetivos com
          excelência.
        </p>
      </div>
    </div>
    <!-- SERVICE LIST -->
    <div class="row" id="containerServices">
      <!-- SERVICE ITEM -->
      <div class="col-lg-4 col-sm-6">
        <div class="service-item-four wow fadeInUp delay-0-2s">
          <div class="image">
            <img src="/base/images/services/service-1.jpg" alt="Service" />
          </div>
          <div class="service-four-content">
            <div class="service-title-area">
              <span class="category">Web Delopment</span>
              <h3><a href="service-details.html">IT Management</a></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Services End -->

<script src="<?= BASE_ACTIONS . "/actions_services.js" ?>"></script>