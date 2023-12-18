<?php $this->layout("_theme"); ?>

<?php

//conexao da base de dados//
require 'base/db/config.php';

$currentURL = $_SERVER['REQUEST_URI'];

// Obtém a última parte da URI
$parts = explode('/', $currentURL);
$lastPart = end($parts);

$result_product = $pdo->prepare("SELECT * FROM product WHERE id = ? ORDER BY id LIMIT 1");
$result_product->execute(array($lastPart));
$num_product = $result_product->rowCount();

if ($num_product < 1) {
  header('Location: /products');
}

$id_product;
$images_product_all;
$name_product_this;
$description_product_this;
$category_product_this;
$old_price_product_this;
$new_price_product_this;
$stock_product_this;
$product_store_product;
$product_url;
$date_create_product;

while ($row_product = $result_product->fetch(PDO::FETCH_ASSOC)) {
  extract($row_product);

  $decode_images_product = json_decode($images_product);

  $id_product = $id;
  $images_product_all = $decode_images_product;
  $name_product_this = $name_product;
  $description_product_this = $description_product;
  $category_product_this = $category_product;
  $old_price_product_this = $old_price_product;

  $numberFormattedNew = number_format($new_price_product, 2, ',', '.');
  if ($product_store  == 'yes') {
    $new_price_product_this = " $numberFormattedNew Akz";
  } else {
    $new_price_product_this = " $ $numberFormattedNew";
  }

  $stock_product_this = $stock_product;
  // if($stock_product == 'Out of Stock'){
  //   $stock_product_this = 'Fora de Strock';
  // }else{
  //   $stock_product_this = 'Em Strock';
  // }

  $product_store_product = $product_store;
  $product_url = $link_product;
  $date_create_product = $date_create;
}

?>

<!-- Page Banner Start -->
<section class="page-banner bgs-cover overlay pt-50" style="background-image: url(/base/images/banner.jpg)">
  <div class="container">
    <div class="banner-inner">
      <h1 class="page-title"><?= $name_product_this ?></h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Inicío</a></li>
          <li class="breadcrumb-item active">Detalhes do produto</li>
        </ol>
      </nav>
    </div>
  </div>
</section>
<!-- Page Banner End -->

<!-- Shop Page Area Start -->
<section class="shop-details-area py-120 rpy-100">
  <div class="container">
    <div class="row">
      <!-- LEFT -->
      <div class="col-lg-8">
        <div class="shop-details-content">
          <div class="row">
            <div class="col-md-6">
              <div class="product-gallery">
                <a href="<?= $images_product_all[0] ?>" class="product-image-preview">
                  <img src="<?= $images_product_all[0] ?>" alt="Preview" />
                </a>
              </div>
              <div class="product-thumb py-10 mb-40">
                <!-- <?php
                      foreach ($images_product_all as $image_url) :
                        echo "
                      <div class='product-thumb-item'>
                        <img src='$image_url' alt='Thumb' />
                      </div>
                    ";
                      endforeach;
                      ?> -->
              </div>
            </div>
            <div class="col-md-6">
              <div class="descriptions mb-50">
                <h2><?= $name_product_this ?></h2>
                <div class="rating-review d-flex align-items-center mb-10">
                  <div class="rating mr-5">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </div>
                  <!-- <a href="#">(1 customer review)</a> -->
                </div>
                <div class="shop-price">
                  <del><span class="price"><?= $old_price_product_this ?></span></del>
                  <b class="current-price"><?= $new_price_product_this ?></b>
                </div>
                <p>
                  <!-- <?= $description_product_this ?> -->
                </p>
                <!-- <form action="#" class="add-to-cart mr-10 mb-25">
                  <button type="submit" class="theme-btn">
                    Add to Cart
                  </button>
                </form> -->
                <ul class="product-meta">
                  <li>Categoria: <a href="#"><?= $category_product_this ?></a></li>
                  <!-- <li>
                    Tags: <a href="#">cooler</a> <a href="#">smart</a>
                  </li> -->
                </ul>
              </div>
            </div>
          </div>
          <ul class="nav product-information-tab mb-30">
            <li>
              <a href="#details" data-toggle="tab" class="active show">Descrição</a>
            </li>
            <!-- <li><a href="#review" data-toggle="tab">Review (1)</a></li> -->
          </ul>
          <div class="tab-content mb-85">
            <div class="tab-pane active fade show" id="details">
              <h2>Descrição</h2>
              <p>
                <?= $description_product_this ?>
              </p>
            </div>
            <div class="tab-pane fade" id="review">
              <h2>1 review for Cooler</h2>
              <div class="review-item mb-55 pt-10">
                <div class="reviewer-img">
                  <img src="/base/images/shop/reviewer-1.png" alt="Reviewer Image" />
                </div>
                <div class="reviewer-review">
                  <div class="reviewer-header">
                    <h6>Robert Down</h6>
                    <span class="date">7 Jan, 2022</span>
                    <div class="ratings">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                    </div>
                  </div>
                  <p>
                    Morbi interdum mollis sapien. Sed ac risus. Phasellus
                    lacinia, magna a ullamcorper laoreet, lectus arcu
                    pulvinar risus, vitae facilisis libero dolor purus.
                    Sed vel lacus.
                  </p>
                  <a href="#" class="reply">Reply</a>
                </div>
              </div>
              <form id="review-form" name="review_form" class="review-form" action="#" method="POST">
                <h3>Add A Review</h3>
                <div class="row clearfix">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" name="first_name" id="name" class="form-control" value="" placeholder="Full Name" required="" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="email" name="email" id="email" class="form-control" value="" placeholder="Email Address" required="" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea name="message" id="message" class="form-control" rows="5" placeholder="Write a Comment" required=""></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="your-rating mb-20 d-flex align-items-center">
                      <h6 class="mb-0 mr-15">Your Rating:</h6>
                      <div class="ratings" id="your-rating">
                        <i class="fas fa-star selected"></i>
                        <i class="fas fa-star selected"></i>
                        <i class="fas fa-star selected"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group text-left text-md-right mb-0">
                      <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="" />
                      <button class="theme-btn br-30" type="submit" data-loading-text="Please wait...">
                        Submit <i class="fas fa-angle-double-right"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- <div class="section-title mb-45">
            <h2>Related products</h2>
          </div>
          <div class="row">
            <div class="col-md-4 col-6 col-small">
              <div class="product-item">
                <div class="image">
                  <img src="/base/images/shop/product-1.jpg" alt="Product" />
                  <a href="shop-details.html" class="theme-btn style-six">Add to cart</a>
                </div>
                <div class="title-price">
                  <h5><a href="shop-details.html">Black Lamp</a></h5>
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
            <div class="col-md-4 col-6 col-small">
              <div class="product-item">
                <div class="image">
                  <span class="sale">Sale!</span>
                  <img src="/base/images/shop/product-2.jpg" alt="Product" />
                  <a href="shop-details.html" class="theme-btn style-six">Add to cart</a>
                </div>
                <div class="title-price">
                  <h5><a href="shop-details.html">Cooler</a></h5>
                  <span class="shop-price">
                    <del><span class="price">100</span></del>
                    <b class="current-price">50</b>
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
            <div class="col-md-4 col-6 col-small">
              <div class="product-item">
                <div class="image">
                  <img src="/base/images/shop/product-3.jpg" alt="Product" />
                  <a href="shop-details.html" class="theme-btn style-six">Add to cart</a>
                </div>
                <div class="title-price">
                  <h5><a href="shop-details.html">Digital lamp</a></h5>
                  <span class="shop-price">
                    <span class="price">100</span>
                  </span>
                </div>
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="far fa-star"></i>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>

      <!-- RIGHT -->
      <div class="col-lg-4 col-sm-9">
        <div class="shop-sidebar rmt-55">

          <!-- <div class="widget widget-products wow fadeInUp delay-0-4s">
            <h3 class="widget-title">Recent News</h3>
            <div class="widget-products-wrap">
              <div class="widget-product-item">
                <a href="shop-details.html"><img src="/base/images/shop/widget-1.jpg" alt="Product" /></a>
                <div class="widget-product-content">
                  <h6><a href="shop-details.html">white Lamp</a></h6>
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
                <a href="shop-details.html"><img src="/base/images/shop/widget-2.jpg" alt="Product" /></a>
                <div class="widget-product-content">
                  <h6><a href="shop-details.html">Cooler</a></h6>
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
                <a href="shop-details.html"><img src="/base/images/shop/widget-3.jpg" alt="Product" /></a>
                <div class="widget-product-content">
                  <h6><a href="shop-details.html">Black Lamp</a></h6>
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
                <a href="shop-details.html"><img src="/base/images/shop/widget-4.jpg" alt="Product" /></a>
                <div class="widget-product-content">
                  <h6><a href="shop-details.html">Watch box</a></h6>
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
                <a href="shop-details.html"><img src="/base/images/shop/widget-3.jpg" alt="Product" /></a>
                <div class="widget-product-content">
                  <h6><a href="shop-details.html">Smart watch</a></h6>
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
              <a class="theme-btn style-five btn-circle" href="/contact">Contate agora <i class="fas fa-angle-double-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Shop Page Area End -->