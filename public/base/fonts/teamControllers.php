<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_teams') {
  $result_teams = $pdo->prepare("SELECT * FROM employees ORDER BY id DESC ");
  $result_teams->execute();
  $num_teams = $result_teams->rowCount();

  if ($num_teams <= 0) {
    echo $return = "              
      <div class='team-standard-item wow fadeInUp delay-0-2s'>
        <h3>
          <a href='#'>Não há nenhum membro da equipe cadastrado</a>
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

      $return .= "
      <div class='col-lg-3 col-sm-6'>
        <div class='team-member style-two wow fadeInUp delay-0-2s'>
          <div class='image'>
            <img src='$url_image' alt='Team Member' />
          </div>
          <div class='member-designation'>
            <h5><a>$name_employee</a></h5>
            <span>$occupation_employee</span>
          </div>
        </div>
      </div>
      ";
    }

    echo $return;
  }
}

if ($type_form == 'get_recent_teams') {
  $result_teams = $pdo->prepare("SELECT * FROM team ORDER BY RAND() LIMIT 3;
  ");
  $result_teams->execute();
  $num_teams = $result_teams->rowCount();

  if ($num_teams <= 0) {
    echo $return = "              
      <div class='team-standard-item wow fadeInUp delay-0-2s'>
        <h3>
          <a href='#'>Não há nenhum membro da equipe cadastrado</a>
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
        <div class='gallery-item style-three p-0 mt-20 wow fadeInUp delay-0-2s'>
          <img src='$url_image' alt='Gallery' />
          <div class='gallery-content'>
            <h5>
              <a href='/team/details/$id'>$title_team</a>
            </h5>
          </div>
        </div>
      </div>
      ";
    }

    echo $return;
  }
}
