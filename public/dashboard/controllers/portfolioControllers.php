<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'create_portfolio') {
  $data = date('D');
  $mes = date('M');
  $dia = date('d');
  $ano = date('Y');

  $semana = array(
    'Sun' => 'Domingo',
    'Mon' => 'Segunda-Feira',
    'Tue' => 'Terca-Feira',
    'Wed' => 'Quarta-Feira',
    'Thu' => 'Quinta-Feira',
    'Fri' => 'Sexta-Feira',
    'Sat' => 'Sábado'
  );

  $mes_extenso = array(
    'Jan' => 'Janeiro',
    'Feb' => 'Fevereiro',
    'Mar' => 'Marco',
    'Apr' => 'Abril',
    'May' => 'Maio',
    'Jun' => 'Junho',
    'Jul' => 'Julho',
    'Aug' => 'Agosto',
    'Nov' => 'Novembro',
    'Sep' => 'Setembro',
    'Oct' => 'Outubro',
    'Dec' => 'Dezembro'
  );

  $completeDate =  $semana["$data"] . ", {$dia} de " . $mes_extenso["$mes"] . " de {$ano}";

  $image_portfolio_form = $_FILES['images_files'];
  $images_array_portfolio_form = [];

  $title_portfolio_form = $dataForm['title_portfolio'];
  $description_portfolio_form = $dataForm['description_portfolio'];

  $date_create_portfolio_form = $completeDate;

  $result_portfolio = $pdo->prepare("SELECT * FROM portfolio WHERE description_portfolio = ? ORDER BY id ");
  $result_portfolio->execute(array($description_portfolio_form));
  $num_portfolio = $result_portfolio->rowCount();

  if ($num_portfolio >= 1) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Este email já encontra-se cadastrado </div>"];
  } else {
    if (empty($title_portfolio_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome está vazio </div>"];
    } elseif (empty($description_portfolio_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
    } else {

      foreach ($image_portfolio_form['name'] as $key => $name) {
        $size_max = 2097152; //2MB
        $accept  = array("jpg", "png", "jpeg");
        $extension  = pathinfo($image_portfolio_form['name'][$key], PATHINFO_EXTENSION);

        if ($image_portfolio_form['size'][$key] >= $size_max) {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
        } else {
          if (in_array($extension, $accept)) {
            // echo "Permitido";
            $folder = '../../_imagesDb/portfolios/';

            if (!is_dir($folder)) {
              mkdir($folder, 755, true);
            }

            // Nome temporário do arquivo
            $tmp = $image_portfolio_form['tmp_name'][$key];
            // Novo nome do arquivo
            $newName = "img_portfolios-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

            if (move_uploaded_file($tmp, $folder . $newName)) {
              $image_portfolios = 'https://bsangola.com//_imagesDb/portfolios/' . $newName;
              array_push($images_array_portfolio_form, $image_portfolios);
              // echo "Upload realizado com sucesso!";
            } else {
              $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
            }
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
          }
        }
      }

      $encode_images_array_portfolio = json_encode($images_array_portfolio_form);

      $sql = $pdo->prepare("INSERT INTO portfolio values(null,?,?,?,?)");

      if ($sql->execute(array(
        $encode_images_array_portfolio,
        $title_portfolio_form,
        $description_portfolio_form,
        $date_create_portfolio_form
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Cliente cadastrado com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao cadastrar portfólio </div>"];
      };
    }

    echo json_encode($return);
  }
}

if ($type_form == 'get_portfolios') {
  $num_register = $_GET['numRegister'];

  $result_portfolios = $pdo->prepare("SELECT * FROM portfolio ORDER BY id DESC LIMIT :limitRegister");
  $result_portfolios->bindParam(':limitRegister', $num_register, PDO::PARAM_INT);
  $result_portfolios->execute();
  $num_portfolios = $result_portfolios->rowCount();

  if ($num_portfolios <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum portfólio cadastrado no momento </div>";
  } else {
    $return = "";

    while ($row_portfolio = $result_portfolios->fetch(PDO::FETCH_ASSOC)) {
      extract($row_portfolio);

      $decode_image_portfolio = json_decode($image_portfolio);

      $url_image = "";

      if ($image_portfolio !== '[]') {
        $url_image = $decode_image_portfolio[0];
      } else {
        $url_image = "https://www.pngfind.com/pngs/m/470-4703547_icon-user-icon-hd-png-download.png";
      }

      $return .= "
        <tr>
          <td>
            <p>$id</p>
          </td>
          <td>
            <img src='$url_image' />
          </td>
          <td>
            <p>$title_portfolio</p>
          </td>
          <td>
            <p>$description_portfolio</p>
          </td>
          <td>$date_create</td>
          <td>
            <button onclick='editeCustomer($id)' class='btn-edit'>
              <i class='fas fa-edit'></i>
            </button>
            <button onclick='deleteCustomer($id)' class='btn-delete'>
              <i class='fas fa-trash-alt'></i>
            </button>
          </td>
        </tr>
      ";
    }

    echo $return;
  }
}

if ($type_form == 'get_all_portfolio_search') {
  $searchRegister = $_GET['searchRegisterValue'];

  if (empty($searchRegister)) {
    $return = ['error' => true, 'msg' => "O campo de pesquisa está vazio"];
  } else {
    $result_search = $pdo->prepare("SELECT * FROM portfolio WHERE title_portfolio LIKE :searchTerm");
    $result_search->bindValue(':searchTerm', '%' . $searchRegister . '%', PDO::PARAM_STR);
    $result_search->execute();
    $num_search = $result_search->rowCount();

    if ($num_search <= 0) {
      $return = ['error' => true, 'msg' => "Erro: Não foi encontrado nenhum registo"];
    } else {

      $dataRegister = "";

      while ($row_portfolio = $result_search->fetch(PDO::FETCH_ASSOC)) {

        extract($row_portfolio);

        $decode_image_portfolio = json_decode($image_portfolio);

        $url_image = "";

        if ($image_portfolio !== '[]') {
          $url_image = $decode_image_portfolio[0];
        } else {
          $url_image = "https://www.pngfind.com/pngs/m/470-4703547_icon-user-icon-hd-png-download.png";
        }

        $dataRegister .= "
          <tr>
            <td>
              <p>$id</p>
            </td>
            <td>
              <img src='$url_image' />
            </td>
            <td>
              <p>$title_portfolio</p>
            </td>
            <td>
              <p>$description_portfolio</p>
            </td>
            <td>$date_create</td>
            <td>
              <button onclick='editeCustomer($id)' class='btn-edit'>
                <i class='fas fa-edit'></i>
              </button>
              <button onclick='deleteCustomer($id)' class='btn-delete'>
                <i class='fas fa-trash-alt'></i>
              </button>
            </td>
          </tr>
        ";
      }

      $return = ['error' => false, 'msg' => $dataRegister];
    }
  }

  echo json_encode($return);
}

if ($type_form == 'delete_portfolios') {
  $id_portfolio = $_GET['idCustomer'];

  $result_portfolio = $pdo->prepare("DELETE FROM portfolio WHERE id=?");

  if ($result_portfolio->execute(array($id_portfolio))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir o portfólio"];
  } else {
    $return = ['error' => true, 'msg' =>  "O portfólio não foi excluído :)"];
  }
}

if ($type_form == 'get_portfolio') {
  $id_portfolio = $_GET['idCustomer'];

  $result_portfolio = $pdo->prepare("SELECT * FROM portfolio WHERE id = ? ORDER BY id LIMIT 1");
  $result_portfolio->execute(array($id_portfolio));
  $num_portfolio = $result_portfolio->rowCount();

  if ($num_portfolio >= 1) {
    $row_portfolio = $result_portfolio->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_portfolio];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhum portfólio com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'edite_portfolio') {
  $id_portfolio = $dataForm['id_portfolio'];

  $image_portfolio_form = $_FILES['images_files'];
  $images_array_portfolio_form = [];

  $title_portfolio_form = $dataForm['title_portfolio'];
  $description_portfolio_form = $dataForm['description_portfolio'];

  $return = "";

  if (empty($title_portfolio_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome está vazio </div>"];
  } elseif (empty($description_portfolio_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
  } else {

    foreach ($image_portfolio_form['name'] as $key => $name) {
      $size_max = 2097152; //2MB
      $accept  = array("jpg", "png", "jpeg");
      $extension  = pathinfo($image_portfolio_form['name'][$key], PATHINFO_EXTENSION);

      if ($image_portfolio_form['size'][$key] >= $size_max) {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
      } else {
        if (in_array($extension, $accept)) {
          // echo "Permitido";
          $folder = '../../_imagesDb/portfolios/';

          if (!is_dir($folder)) {
            mkdir($folder, 755, true);
          }

          // Nome temporário do arquivo
          $tmp = $image_portfolio_form['tmp_name'][$key];
          // Novo nome do arquivo
          $newName = "img_portfolios-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

          if (move_uploaded_file($tmp, $folder . $newName)) {
            $image_portfolios = 'https://bsangola.com//_imagesDb/portfolios/' . $newName;
            array_push($images_array_portfolio_form, $image_portfolios);
            // echo "Upload realizado com sucesso!";
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
          }
        } else {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
        }
      }
    }

    $encode_images_array_portfolio = json_encode($images_array_portfolio_form);

    if ($images_array_portfolio_form == []) {
      $sql = $pdo->prepare("UPDATE portfolio SET title_portfolio=?, description_portfolio=? WHERE id=? ");

      if ($sql->execute(array(
        $title_portfolio_form,
        $description_portfolio_form,
        $id_portfolio
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do portfólio actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do portfólio </div>"];
      };
    } else {
      $sql = $pdo->prepare("UPDATE portfolio SET image_portfolio=?, title_portfolio=?, description_portfolio=? WHERE id=? ");

      if ($sql->execute(array(
        $encode_images_array_portfolio,
        $title_portfolio_form,
        $description_portfolio_form,
        $id_portfolio
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do portfólio actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do portfólio </div>"];
      };
    }
  }
  echo json_encode($return);
}