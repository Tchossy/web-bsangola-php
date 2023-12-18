<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_testimonials') {
  $result_testimonials = $pdo->prepare("SELECT * FROM testimonials ORDER BY id DESC ");
  $result_testimonials->execute();
  $num_testimonials = $result_testimonials->rowCount();

  if ($num_testimonials <= 0) {
    echo $return = "              
      <div class='testimonial-standard-item wow fadeInUp delay-0-2s'>
        <h3>
          <a href='#'>Não há nenhum depoimento cadastrado</a>
        </h3>
      </div>";
  } else {
    $return = "";

    while ($row_testimonials = $result_testimonials->fetch(PDO::FETCH_ASSOC)) {

      extract($row_testimonials);

      $decode_image_testimonial = json_decode($image_testimonial);

      $url_image = "";

      if ($decode_image_testimonial) {
        $url_image = $decode_image_testimonial[0];
      } else {
        $url_image = "https://img.freepik.com/free-vector/realistic-testimonials-studio-background_23-2149985606.jpg";
      }

      $return .= "
      <div class='testimonial-four-item'>
        <div class='testimonial-four-content'>
          <p>
            $description_testimonial
          </p>
        </div>
        <div class='testimonial-four-author'>
          <img src='$url_image' alt='Testimonial Author' />
          <div class='testimonial-four-author-designation'>
            <h4>$name_testimonial</h4>
            <span>$occupation_testimonial</span>
          </div>
        </div>
      </div>
      ";
    }

    echo $return;
  }
}

if ($type_form == 'get_recent_testimonials') {
  $result_testimonials = $pdo->prepare("SELECT * FROM testimonial ORDER BY RAND() LIMIT 3;
  ");
  $result_testimonials->execute();
  $num_testimonials = $result_testimonials->rowCount();

  if ($num_testimonials <= 0) {
    echo $return = "              
      <div class='testimonial-standard-item wow fadeInUp delay-0-2s'>
        <h3>
          <a href='#'>Não há nenhum depoimento cadastrado</a>
        </h3>
      </div>";
  } else {
    $return = "";

    while ($row_testimonials = $result_testimonials->fetch(PDO::FETCH_ASSOC)) {

      extract($row_testimonials);

      $decode_image_testimonial = json_decode($image_testimonial);

      $url_image = "";

      if ($decode_image_testimonial) {
        $url_image = $decode_image_testimonial[0];
      } else {
        $url_image = "https://img.freepik.com/free-vector/realistic-testimonials-studio-background_23-2149985606.jpg";
      }

      $hrefNews = "http://localhost/web-consulado_ponta_negra-php/testimonials/detailsNews/$id";

      $return .= "
      <div class='col-lg-3 col-sm-6'>
        <div class='gallery-item style-three p-0 mt-20 wow fadeInUp delay-0-2s'>
          <img src='$url_image' alt='Gallery' />
          <div class='gallery-content'>
            <h5>
              <a href='/testimonial/details/$id'>$title_testimonial</a>
            </h5>
          </div>
        </div>
      </div>
      ";
    }

    echo $return;
  }
}
