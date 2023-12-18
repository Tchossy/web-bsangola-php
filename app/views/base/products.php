<?php $this->layout('_theme') ?>

<!-- Page Banner Start -->
<section class="page-banner bgs-cover overlay pt-50" style="background-image: url(/base/images/banner.jpg)">
  <div class="container">
    <div class="banner-inner">
      <h1 class="page-title">Produtos</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Início</a></li>
          <li class="breadcrumb-item active">Produtos</li>
        </ol>
      </nav>
    </div>
  </div>
</section>
<!-- Page Banner End -->

<!-- Shop Page Area Start -->
<section class="shop-page-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="shop-grid-content pt-120 rpt-100 pb-110 rpb-70">
          <div class="shop-shorter mb-40">
            <div class="sort-text">
              <!-- <span>Showing 1-9 of 11 Result</span> -->
              <span>Listagem de produtos</span>
            </div>
            <!-- <div class="products-dropdown">
              <select>
                <option value="default">Default Sorting</option>
                <option value="new" selected>Short by Latest</option>
                <option value="old">Oldest Product</option>
                <option value="hight-to-low">High To Low</option>
                <option value="low-to-high">Low To High</option>
              </select>
            </div> -->
          </div>

          <div class="row">
            <!-- PRODUCT -->
            <div class="col-md-4 col-6 col-small" id="containerProducts">
              <!-- PRODUCT ITEM -->
              <div class="product-item">
                <div class="image">
                  <img src="/base/images/shop/product-1.jpg" alt="Product" />
                  <a href="products/details/1" class="theme-btn style-six">Ver detalhes</a>
                </div>
                <div class="title-price">
                  <h5><a href="products/details/1">Black Lamp</a></h5>
                  <span class="shop-price">
                    <span class="price">100</span>
                  </span>
                </div>
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
              </div>
            </div>
          </div>

          <!-- <ul class="pagination flex-wrap mt-40 justify-content-center">
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
              <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
            </li>
          </ul> -->
        </div>
      </div>
      <div class="col-lg-4 col-sm-9">
        <div class="shop-sidebar mt-120 rmt-0 rmb-100">
          <!-- Search Products -->
          <!-- <div class="widget widget-search wow fadeInUp delay-0-2s">
            <h3 class="widget-title">Product Search</h3>
            <form action="#">
              <input type="text" placeholder="Search Products.." class="searchbox" required />
              <button type="submit" class="searchbutton fa fa-search"></button>
            </form>
          </div> -->
          <!-- Recent News -->
          <!-- <div class="widget widget-products wow fadeInUp delay-0-4s">
            <h3 class="widget-title">Recent News</h3>
            <div class="widget-products-wrap">
              <div class="widget-product-item">
                <a href="products/details/1"><img src="/base/images/shop/widget-1.jpg" alt="Product" /></a>
                <div class="widget-product-content">
                  <h6><a href="products/details/1">white Lamp</a></h6>
                  <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </div>
                  <span class="shop-price">
                    <span class="price">150</span>
                  </span>
                </div>
              </div>
              <div class="widget-product-item">
                <a href="products/details/1"><img src="/base/images/shop/widget-2.jpg" alt="Product" /></a>
                <div class="widget-product-content">
                  <h6><a href="products/details/1">Cooler</a></h6>
                  <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </div>
                  <span class="shop-price">
                    <del><span class="price">100</span></del>
                    <span class="current-price">50</span>
                  </span>
                </div>
              </div>
              <div class="widget-product-item">
                <a href="products/details/1"><img src="/base/images/shop/widget-3.jpg" alt="Product" /></a>
                <div class="widget-product-content">
                  <h6><a href="products/details/1">Black Lamp</a></h6>
                  <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </div>
                  <span class="shop-price">
                    <span class="price">100</span>
                  </span>
                </div>
              </div>
              <div class="widget-product-item">
                <a href="products/details/1"><img src="/base/images/shop/widget-4.jpg" alt="Product" /></a>
                <div class="widget-product-content">
                  <h6><a href="products/details/1">Watch box</a></h6>
                  <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </div>
                  <span class="shop-price">
                    <span class="price">100</span>
                  </span>
                </div>
              </div>
              <div class="widget-product-item">
                <a href="products/details/1"><img src="/base/images/shop/widget-3.jpg" alt="Product" /></a>
                <div class="widget-product-content">
                  <h6><a href="products/details/1">Smart watch</a></h6>
                  <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </div>
                  <span class="shop-price">
                    <span class="price">80</span>
                  </span>
                </div>
              </div>
            </div>
          </div> -->
          <div class="widget widget-call-action wow fadeInUp delay-0-2s">
            <div class="call-action-widget">
              <h2>Trabalhar juntos</h2>
              <p>
                Não perca a oportunidade de criar um projecto incrivel connosco
              </p>
              <a class="theme-btn style-five btn-circle" href="/contact">Contate agora <i
                  class="fas fa-angle-double-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Shop Page Area End -->

<script src="<?= BASE_ACTIONS . "/actions_products.js" ?>"></script>