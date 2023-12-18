<?php
require 'base/db/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!--====== Required meta tags ======-->
  <meta charset="utf-8" />
  <meta name="description" content="" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!--====== Title ======-->
  <title><?= SITE ?></title>

  <!--====== Favicon Icon ======-->
  <link rel="icon" href="<?= BASE_IMG . "/favicon.png" ?>">

  <!--====== Google Fonts ======-->
  <link
    href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&family=Oswald:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />

  <!--====== Font Awesome ======-->
  <link rel="stylesheet" href="<?= BASE_STYLES . "/font-awesome-5.9.0.css" ?>" />
  <!--====== Bootstrap ======-->
  <link rel="stylesheet" href="<?= BASE_STYLES . "/bootstrap.min.css" ?>" />
  <!--====== Magnific Popup ======-->
  <link rel="stylesheet" href="<?= BASE_STYLES . "/magnific-popup.css" ?>" />
  <!--====== Falticon ======-->
  <link rel="stylesheet" href="<?= BASE_STYLES . "/flaticon.css" ?>" />
  <!--====== Animate ======-->
  <link rel="stylesheet" href="<?= BASE_STYLES . "/animate.css" ?>" />
  <!--====== Slick ======-->
  <link rel="stylesheet" href="<?= BASE_STYLES . "/slick.css" ?>" />
  <!--====== Main Style ======-->
  <link rel="stylesheet" href="<?= BASE_STYLES . "/style.css" ?>" />
</head>

<body>
  <div class="page-wrapper">
    <!-- Preloader -->
    <!-- <div class="preloader">
      <div class="theme-loader"></div>
    </div> -->

    <!-- main header -->
    <header class="main-header header-three text-white">
      <div class="header-top-wrap bg-blue py-10">
        <div class="container">
          <div class="header-top">
            <div class="top-left">
              <ul>
                <li>
                  Ligue para nós:
                  <a href="callto:244931075826">+244 931 075 826</a>
                </li>
                <li>
                  Email:
                  <a href="mailto:geral@bsangola.com">geral@bsangola.com</a>
                </li>
              </ul>
            </div>
            <div class="top-right">
              <div class="office-time">
                <i class="far fa-clock"></i><span>08h00 - 16h00</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Header-Upper-->
      <div class="header-upper">
        <div class="container clearfix">
          <div class="header-inner d-flex align-items-center">
            <div class="logo-outer">
              <div class="logo">
                <a href="/"><img src="base/images/logos/logo.png" alt="Logo" title="Logo" /></a>
              </div>
            </div>

            <div class="nav-outer clearfix d-flex align-items-center">
              <!-- Main Menu -->
              <nav class="main-menu navbar-expand-lg">
                <div class="navbar-header">
                  <div class="mobile-logo py-15">
                    <a href="/">
                      <img src="base/images/logos/logo.png" alt="Logo" title="Logo" />
                    </a>
                  </div>

                  <!-- Toggle Button -->
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>

                <div class="navbar-collapse collapse clearfix">
                  <ul class="navigation clearfix">
                    <li>
                      <a href="/">Início</a>
                    </li>
                    <li>
                      <a href="/about">Sobre nós</a>
                    </li>
                    <li>
                      <a href="/services">serviço</a>
                    </li>
                    <li>
                      <a href="/products">Produtos</a>
                    </li>
                    <li class="dropdown">
                      <a href="#">Páginas</a>
                      <ul>
                        <li>
                          <a href="/portfolio">Portfólio</a>
                        </li>
                        <li>
                          <a href="/team">Membro da equipe</a>
                        </li>
                        <!-- <li>
                          <a href="#">página de preços</a>
                        </li> -->
                        <li>
                          <a href="/testimonials">Depoimentos</a>
                        </li>
                      </ul>
                    </li>

                    <li>
                      <a href="/blog">Blog</a>
                    </li>
                    <li><a href="/contact">Contato</a></li>
                  </ul>
                </div>
              </nav>
              <!-- Main Menu End-->

              <!-- Menu Button -->
              <!-- <div class="menu-btn">
                <a href="/contact" class="theme-btn">encontre-se conosco</a>
              </div> -->
            </div>
          </div>
        </div>
      </div>
      <!--End Header Upper-->
    </header>

    <main class="page-wrapper">
      <?= $this->section('content') ?>
    </main>

    <!-- Footer Area Start -->
    <footer class="main-footer footer-two bgs-cover text-white pt-150 rpt-115"
      style="background-image: url(base/images/footer/footer-bg-map.png)">
      <div class="container">
        <div class="footer-widget-area pt-85 pb-30">
          <div class="row">
            <div class="col-lg-3 col-sm-6">
              <div class="footer-widget about-widget">
                <div class="footer-logo mb-35">
                  <a href="/"><img src="base/images/logos/logo.png" alt="Logo" /></a>
                </div>
                <div class="text">
                  soluções empresariais com sede em Angola. Oferecemos uma ampla gama de serviços para atender às
                  necessidades dos seus clientes
                </div>
                <ul class="contact-info mt-20">
                  <li>
                    <i class="fas fa-map-marker-alt"></i><span>Luanda, Mutamba <br />Rua 535022, Angola</span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-2 col-6">
              <div class="footer-widget link-widget ml-20 rml-0">
                <h4 class="footer-title">Links Rapidos</h4>
                <ul class="list-style-two">
                  <li><a href="/">Início</a></li>
                  <li><a href="/about">Sobre nós</a></li>
                  <li><a href="/services">serviço</a></li>
                  <li><a href="/products">Produtos</a></li>
                  <li><a href="/blog">Blog</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="footer-widget link-widget ml-20 rml-0">
                <h4 class="footer-title">Explore</h4>
                <ul class="list-style-two">
                  <li><a href="/portfolio">Portfólio</a></li>
                  <li><a href="/team">Equipe</a></li>
                  <li><a href="/testimonials">Depoimentos</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6">
              <div class="footer-widget newsletter-widget">
                <h4 class="footer-title">Newsletter</h4>
                <p>
                  Mantenha-se sempre atualizado, <br />increva-se no nossa newsletter
                </p>
                <form action="#" method="post">
                  <input type="email" name="EMAIL" placeholder="Seu endereço de email" required />
                  <button value="submit">
                    <i class="fa fa-location-arrow"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="copyright-area">
        <div class="container">
          <div class="copyright-inner pt-15">
            <div class="social-style-one mb-10">
              <a href="http://facebook.com"><i class="fab fa-facebook-f"></i></a>
              <a href="http://twitter.com"><i class="fab fa-twitter"></i></a>
              <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
            </div>
            <p>
              Copyright <a href="www.tchossy.com">Tchossy.</a> Todos os
              direitos reservados.
              <br />
              Desenhado por
              <a href="www.rafaelpilartes.com">Rafael Pilartes</a>
            </p>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer Area End -->
  </div>
  <!--End pagewrapper-->

  <!-- Scroll Top Button -->
  <button class="scroll-top scroll-to-target" data-target="html">
    <span class="fa fa-angle-up"></span>
  </button>

  <!--====== Jquery ======-->
  <script src="<?= BASE_JS . "/jquery-3.6.0.min.js" ?>"></script>
  <!--====== Bootstrap ======-->
  <script src="<?= BASE_JS . "/bootstrap.min.js" ?>"></script>
  <!--====== Appear Js ======-->
  <script src="<?= BASE_JS . "/appear.min.js" ?>"></script>
  <!--====== Slick ======-->
  <script src="<?= BASE_JS . "/slick.min.js" ?>"></script>
  <!--====== Magnific Popup ======-->
  <script src="<?= BASE_JS . "/jquery.magnific-popup.min.js" ?>"></script>
  <!--====== Isotope ======-->
  <script src="<?= BASE_JS . "/isotope.pkgd.min.js" ?>"></script>
  <!--  WOW Animation -->
  <script src="<?= BASE_JS . "/wow.js" ?>"></script>
  <!-- Custom script -->
  <script src="<?= BASE_JS . "/script.js" ?>"></script>
</body>

</html>