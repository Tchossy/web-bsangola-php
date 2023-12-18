<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_services') {
  $result_services = $pdo->prepare("SELECT * FROM services ORDER BY id DESC ");
  $result_services->execute();
  $num_services = $result_services->rowCount();

  if ($num_services <= 0) {
    echo $return = "              
      <div class='service-standard-item wow fadeInUp delay-0-2s'>
        <h3>
          <a href='#'>Não há nenhum serviço cadastrada</a>
        </h3>
      </div>";
  } else {
    $return = "";

    while ($row_services = $result_services->fetch(PDO::FETCH_ASSOC)) {

      extract($row_services);

      $decode_image_service = json_decode($image_service);

      $url_image = "";

      if ($decode_image_service) {
        $url_image = $decode_image_service[0];
      } else {
        $url_image = "https://img.freepik.com/free-vector/realistic-services-studio-background_23-2149985606.jpg";
      }

      $return .= "
      <div class='col-lg-4 col-sm-6'>
        <div class='service-item-four wow fadeInUp delay-0-2s'>
          <div class='image'>
            <img src='$url_image' alt='Service' />
          </div>
          <div class='service-four-content'>
            <div class='service-title-area'>
              <span class='category'><a href='/services/details/$id'>$title_service</a></span>
            </div>
          </div>
        </div>
      </div>
      ";
    }

    echo $return;
  }
}

if ($type_form == 'get_recent_services') {
  $result_services = $pdo->prepare("SELECT * FROM services ORDER BY RAND() LIMIT 5;
  ");
  $result_services->execute();
  $num_services = $result_services->rowCount();

  if ($num_services <= 0) {
    echo $return = "              
      <div class='service-standard-item wow fadeInUp delay-0-2s'>
        <h3>
          <a href='#'>Não há nenhum serviço cadastrado</a>
        </h3>
      </div>";
  } else {
    $return = "";

    while ($row_services = $result_services->fetch(PDO::FETCH_ASSOC)) {

      extract($row_services);

      $decode_image_service = json_decode($image_service);

      $url_image = "";

      if ($decode_image_service) {
        $url_image = $decode_image_service[0];
      } else {
        $url_image = "https://img.freepik.com/free-vector/realistic-services-studio-background_23-2149985606.jpg";
      }

      $hrefNews = "http://localhost/web-consulado_ponta_negra-php/services/detailsNews/$id";

      $return .= "
      <div class='widget-news-item'>
        <img src='$url_image' alt='News' />
        <div class='widget-news-content'>
          <h5>
            <a href='service-details.html'>$title_service</a>
          </h5>
          <span class='date'><a href='#'>$date_create</a></span>
        </div>
      </div>
      ";
    }

    echo $return;
  }
}
