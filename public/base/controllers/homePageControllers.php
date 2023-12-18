<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_recent_teams') {
  $result_teams = $pdo->prepare("SELECT * FROM employees ORDER BY RAND() LIMIT 3;
  ");
  $result_teams->execute();
  $num_teams = $result_teams->rowCount();

  if ($num_teams <= 0) {
    echo $return = "              
      <div class='team-standard-item wow fadeInUp delay-0-2s'>
        <h3>
          <a href='#'>Não há nenhuma noticia cadastrada</a>
        </h3>
      </div>";
  } else {
    $return = "";

    while ($row_teams = $result_teams->fetch(PDO::FETCH_ASSOC)) {

      extract($row_teams);

      $decode_image_employee = json_decode($image_employee);

      $url_image = "";

      if ($decode_image_employee) {
        $url_image = $decode_image_employee[0];
      } else {
        $url_image = "https://img.freepik.com/free-vector/realistic-teams-studio-background_23-2149985606.jpg";
      }

      $hrefNews = "http://localhost/web-consulado_ponta_negra-php/teams/detailsNews/$id";

      $return .= "
      <div class='col-lg-3 col-sm-6'>
        <div class='team-member style-two wow fadeInUp delay-0-2s'>
          <div class='image'>
            <img src='$url_image' alt='Team Member' />
          </div>
          <div class='member-designation'>
            <h5><a href='/team/details/$id'>$name_employee</a></h5>
            <span>Design Lead</span>
          </div>
        </div>
      </div>
      ";
    }

    echo $return;
  }
}

if ($type_form == 'get_recent_testimonials') {
  $result_testimonials = $pdo->prepare("SELECT * FROM testimonials ORDER BY RAND() LIMIT 3;
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
      <div class='testimonial-item wow fadeInLeft delay-0-2s'>
        <div class='author-description'>
          <img src='$url_image' alt='Author' />
          <div class='designation'>
            <h5>$name_testimonial</h5>
            <span>$occupation_testimonial</span>
          </div>
          <i class='fas fa-quote-right'></i>
        </div>
        <p>
          $description_testimonial
        </p>
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
      <div class='gallery-item style-three'>
        <img src='$url_image' alt='Gallery' />
        <div class='gallery-content'>
          <h5>
          <a href='/portfolio/details/$id'>$title_portfolio</a>
          </h5>
        </div>
      </div>
      ";
    }

    echo $return;
  }
}

if ($type_form == 'get_recent_blogs') {
  $result_blogs = $pdo->prepare("SELECT * FROM blogs ORDER BY RAND() LIMIT 5;
  ");
  $result_blogs->execute();
  $num_blogs = $result_blogs->rowCount();

  if ($num_blogs <= 0) {
    echo $return = "              
      <div class='blog-standard-item wow fadeInUp delay-0-2s'>
        <h3>
          <a href='#'>Não há nenhuma noticia cadastrada</a>
        </h3>
      </div>";
  } else {
    $return = "";

    while ($row_blogs = $result_blogs->fetch(PDO::FETCH_ASSOC)) {

      extract($row_blogs);

      $decode_image_blog = json_decode($image_blog);

      $url_image = "";

      if ($decode_image_blog) {
        $url_image = $decode_image_blog[0];
      } else {
        $url_image = "https://img.freepik.com/free-vector/realistic-blogs-studio-background_23-2149985606.jpg";
      }

      $hrefNews = "http://localhost/web-consulado_ponta_negra-php/blogs/detailsNews/$id";

      $return .= "
      <div class='col-xl-4 col-md-6'>
        <div class='news-item style-two wow fadeInUp delay-0-2s'>
          <div class='image'>
            <img src='$url_image' alt='News' />
          </div>
          <div class='news-content'>
            <div class='news-author'>
              <img src='https://cdn-icons-png.flaticon.com/512/3177/3177440.png' alt='Authro' />
            </div>
            <ul class='post-meta-item'>
              <li>
                <b>By <a href='#'>$author_blog</a></b>
              </li>
              <li>
                <i class='fas fa-calendar-alt'></i>
                <a href='blog/details/$id' rel='bookmark'>$date_create</a>
              </li>
            </ul>
            <h4>
              <a href='blog/details/$id'>$title_blog</a>
            </h4>
            <p style='white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 550px;'>
              $description_blog
            </p>
          </div>
        </div>
      </div>
      ";
    }

    echo $return;
  }
}
