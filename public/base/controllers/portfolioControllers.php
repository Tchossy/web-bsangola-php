<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_portfolios') {
  $result_portfolios = $pdo->prepare("SELECT * FROM portfolio ORDER BY id DESC ");
  $result_portfolios->execute();
  $num_portfolios = $result_portfolios->rowCount();

  if ($num_portfolios <= 0) {
    echo $return = "              
      <div class='portfolio-standard-item wow fadeInUp delay-0-2s'>
        <h3>
          <a href='#'>Não há nenhum trabalho feito cadastrada</a>
        </h3>
      </div>";
  } else {
    $return = "";

    while ($row_portfolios = $result_portfolios->fetch(PDO::FETCH_ASSOC)) {

      extract($row_portfolios);

      $decode_image_portfolio = json_decode($image_portfolio);

      $url_image = "";

      if ($decode_image_portfolio) {
        $url_image = $decode_image_portfolio[0];
      } else {
        $url_image = "https://img.freepik.com/free-vector/realistic-portfolios-studio-background_23-2149985606.jpg";
      }

      $return .= "
      <div class='col-lg-3 col-sm-6'>
        <div class='gallery-item wow fadeInUp delay-0-2s'>
          <img src='$url_image' alt='Gallery' />
          <div class='gallery-content'>
            <span class='category'><a href='portfolio/details/$id'>$title_portfolio</a></span>
            <h5 style='text-overflow: ellipsis; overflow: hidden; max-width: 300px; height: 1.2em; white-space: nowrap;'>
              <a href='portfolio/details/$id'>$description_portfolio</a>
            </h5>
          </div>
        </div>
      </div>
      ";
    }

    echo $return;
  }
}

if ($type_form == 'get_recent_portfolios') {
  $result_portfolios = $pdo->prepare("SELECT * FROM portfolio ORDER BY RAND() LIMIT 3;
  ");
  $result_portfolios->execute();
  $num_portfolios = $result_portfolios->rowCount();

  if ($num_portfolios <= 0) {
    echo $return = "              
      <div class='portfolio-standard-item wow fadeInUp delay-0-2s'>
        <h3>
          <a href='#'>Não há nenhum trabalho feito cadastrada</a>
        </h3>
      </div>";
  } else {
    $return = "";

    while ($row_portfolios = $result_portfolios->fetch(PDO::FETCH_ASSOC)) {

      extract($row_portfolios);

      $decode_image_portfolio = json_decode($image_portfolio);

      $url_image = "";

      if ($decode_image_portfolio) {
        $url_image = $decode_image_portfolio[0];
      } else {
        $url_image = "https://img.freepik.com/free-vector/realistic-portfolios-studio-background_23-2149985606.jpg";
      }

      $hrefNews = "http://localhost/web-consulado_ponta_negra-php/portfolios/detailsNews/$id";

      $return .= "
      <div class='col-lg-3 col-sm-6'>
        <div class='gallery-item style-three p-0 mt-20 wow fadeInUp delay-0-2s'>
          <img src='$url_image' alt='Gallery' />
          <div class='gallery-content'>
            <h5>
              <a href='/portfolio/details/$id'>$title_portfolio</a>
            </h5>
          </div>
        </div>
      </div>
      ";
    }

    echo $return;
  }
}
