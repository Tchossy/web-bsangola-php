<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_blogs') {
  $result_blogs = $pdo->prepare("SELECT * FROM blogs ORDER BY id DESC ");
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
      <div class='blog-standard-item wow fadeInUp delay-0-2s'>
      <div class='image'>
        <img src='$url_image' alt='Blog Standard' />
      </div>
      <div class='blog-header'>
        <ul class='post-meta-item mr-15'>
          <li>
            <i class='far fa-user'></i>
            <a href='#' rel='bookmark'> $author_blog </a>
          </li>
          <li>
            <i class='fas fa-calendar-alt'></i>
            <a href='blog/details/$id'>$date_create</a>
          </li>
        </ul>
      </div>
      <h3>
        <a href='blog/details/$id'>$title_blog</a>
      </h3>
      <p>
        $description_blog
      </p>
      <a href='blog/details/$id' class='theme-btn'>Ler mais</a>
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
      <div class='widget-news-item'>
        <img src='$url_image' alt='News' />
        <div class='widget-news-content'>
          <h5>
            <a href='blog/details/$id'>$title_blog</a>
          </h5>
          <span class='date'><a href='#'>$date_create</a></span>
        </div>
      </div>
      ";
    }

    echo $return;
  }
}
