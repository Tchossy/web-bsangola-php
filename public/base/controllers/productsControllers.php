<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_products') {
  $result_products = $pdo->prepare("SELECT * FROM product ORDER BY id DESC ");
  $result_products->execute();
  $num_products = $result_products->rowCount();

  if ($num_products <= 0) {
    echo $return = "              
      <div class='product-standard-item wow fadeInUp delay-0-2s'>
        <h3>
          <a href='#'>Não há nenhuma noticia cadastrada</a>
        </h3>
      </div>";
  } else {
    $return = "";

    while ($row_products = $result_products->fetch(PDO::FETCH_ASSOC)) {

      extract($row_products);

      $decode_images_product = json_decode($images_product);

      $url_image = "";

      if ($decode_images_product) {
        $url_image = $decode_images_product[0];
      } else {
        $url_image = "https://img.freepik.com/free-vector/realistic-products-studio-background_23-2149985606.jpg";
      }

      $hrefNews = "http://localhost/web-consulado_ponta_negra-php/products/detailsNews/$id";

      $return .= "
      <div class='product-item'>
        <div class='image'>
          <img src='$url_image' alt='Product' />
          <a href='products/details/$id' class='theme-btn style-six'>Ver detalhes</a>
        </div>
        <div class='title-price'>
          <h5><a href='products/details/$id'>$name_product</a></h5>
          <span class='shop-price'>
            <span class='price'>$new_price_product</span>
          </span>
        </div>
        <div class='rating'>
          <i class='fas fa-star'></i>
          <i class='fas fa-star'></i>
          <i class='fas fa-star'></i>
          <i class='fas fa-star'></i>
          <i class='fas fa-star'></i>
        </div>
      </div>
      ";
    }

    echo $return;
  }
}

if ($type_form == 'get_recent_products') {
  $result_products = $pdo->prepare("SELECT * FROM product ORDER BY RAND() LIMIT 5;
  ");
  $result_products->execute();
  $num_products = $result_products->rowCount();

  if ($num_products <= 0) {
    echo $return = "              
      <div class='product-standard-item wow fadeInUp delay-0-2s'>
        <h3>
          <a href='#'>Não há nenhuma noticia cadastrada</a>
        </h3>
      </div>";
  } else {
    $return = "";

    while ($row_products = $result_products->fetch(PDO::FETCH_ASSOC)) {

      extract($row_products);

      $decode_images_product = json_decode($images_product);

      $url_image = "";

      if ($decode_images_product) {
        $url_image = $decode_images_product[0];
      } else {
        $url_image = "https://img.freepik.com/free-vector/realistic-products-studio-background_23-2149985606.jpg";
      }

      $hrefNews = "http://localhost/web-consulado_ponta_negra-php/products/detailsNews/$id";

      $return .= "
      <div class='widget-news-item'>
        <img src='$url_image' alt='News' />
        <div class='widget-news-content'>
          <h5>
            <a href='product/details/$id'>$title_product</a>
          </h5>
          <span class='date'><a href='#'>$date_create</a></span>
        </div>
      </div>
      ";
    }

    echo $return;
  }
}
