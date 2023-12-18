<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'create_service') {
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

  $image_service_form = $_FILES['images_files'];
  $images_array_service_form = [];

  $title_service_form = $dataForm['title_service'];
  $description_service_form = $dataForm['description_service'];

  $date_create_service_form = $completeDate;

  $result_service = $pdo->prepare("SELECT * FROM services WHERE description_service = ? ORDER BY id ");
  $result_service->execute(array($description_service_form));
  $num_service = $result_service->rowCount();

  if ($num_service >= 1) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Este email já encontra-se cadastrado </div>"];
  } else {
    if (empty($title_service_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome está vazio </div>"];
    } elseif (empty($description_service_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
    } else {

      foreach ($image_service_form['name'] as $key => $name) {
        $size_max = 2097152; //2MB
        $accept  = array("jpg", "png", "jpeg");
        $extension  = pathinfo($image_service_form['name'][$key], PATHINFO_EXTENSION);

        if ($image_service_form['size'][$key] >= $size_max) {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
        } else {
          if (in_array($extension, $accept)) {
            // echo "Permitido";
            $folder = '../../_imagesDb/services/';

            if (!is_dir($folder)) {
              mkdir($folder, 755, true);
            }

            // Nome temporário do arquivo
            $tmp = $image_service_form['tmp_name'][$key];
            // Novo nome do arquivo
            $newName = "img_services-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

            if (move_uploaded_file($tmp, $folder . $newName)) {
              $image_services = 'https://bsangola.com//_imagesDb/services/' . $newName;
              array_push($images_array_service_form, $image_services);
              // echo "Upload realizado com sucesso!";
            } else {
              $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
            }
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
          }
        }
      }

      $encode_images_array_service = json_encode($images_array_service_form);

      $sql = $pdo->prepare("INSERT INTO services values(null,?,?,?,?)");

      if ($sql->execute(array(
        $encode_images_array_service,
        $title_service_form,
        $description_service_form,
        $date_create_service_form
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Cliente cadastrado com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao cadastrar serviço </div>"];
      };
    }

    echo json_encode($return);
  }
}

if ($type_form == 'get_services') {
  $num_register = $_GET['numRegister'];

  $result_services = $pdo->prepare("SELECT * FROM services ORDER BY id DESC LIMIT :limitRegister");
  $result_services->bindParam(':limitRegister', $num_register, PDO::PARAM_INT);
  $result_services->execute();
  $num_services = $result_services->rowCount();

  if ($num_services <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum serviço cadastrado no momento </div>";
  } else {
    $return = "";

    while ($row_service = $result_services->fetch(PDO::FETCH_ASSOC)) {
      extract($row_service);

      $decode_image_service = json_decode($image_service);

      $url_image = "";

      if ($image_service !== '[]') {
        $url_image = $decode_image_service[0];
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
            <p>$title_service</p>
          </td>
          <td>
            <p>$description_service</p>
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

if ($type_form == 'get_all_service_search') {
  $searchRegister = $_GET['searchRegisterValue'];

  if (empty($searchRegister)) {
    $return = ['error' => true, 'msg' => "O campo de pesquisa está vazio"];
  } else {
    $result_search = $pdo->prepare("SELECT * FROM services WHERE title_service LIKE :searchTerm");
    $result_search->bindValue(':searchTerm', '%' . $searchRegister . '%', PDO::PARAM_STR);
    $result_search->execute();
    $num_search = $result_search->rowCount();

    if ($num_search <= 0) {
      $return = ['error' => true, 'msg' => "Erro: Não foi encontrado nenhum registo"];
    } else {

      $dataRegister = "";

      while ($row_service = $result_search->fetch(PDO::FETCH_ASSOC)) {

        extract($row_service);

        $decode_image_service = json_decode($image_service);

        $url_image = "";

        if ($image_service !== '[]') {
          $url_image = $decode_image_service[0];
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
              <p>$title_service</p>
            </td>
            <td>
              <p>$description_service</p>
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

if ($type_form == 'delete_services') {
  $id_service = $_GET['idCustomer'];

  $result_service = $pdo->prepare("DELETE FROM services WHERE id=?");

  if ($result_service->execute(array($id_service))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir o serviço"];
  } else {
    $return = ['error' => true, 'msg' =>  "O serviço não foi excluído :)"];
  }
}

if ($type_form == 'get_service') {
  $id_service = $_GET['idCustomer'];

  $result_service = $pdo->prepare("SELECT * FROM services WHERE id = ? ORDER BY id LIMIT 1");
  $result_service->execute(array($id_service));
  $num_service = $result_service->rowCount();

  if ($num_service >= 1) {
    $row_service = $result_service->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_service];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhum serviço com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'edite_service') {
  $id_service = $dataForm['id_service'];

  $image_service_form = $_FILES['images_files'];
  $images_array_service_form = [];

  $title_service_form = $dataForm['title_service'];
  $description_service_form = $dataForm['description_service'];

  $return = "";

  if (empty($title_service_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome está vazio </div>"];
  } elseif (empty($description_service_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
  } else {

    foreach ($image_service_form['name'] as $key => $name) {
      $size_max = 2097152; //2MB
      $accept  = array("jpg", "png", "jpeg");
      $extension  = pathinfo($image_service_form['name'][$key], PATHINFO_EXTENSION);

      if ($image_service_form['size'][$key] >= $size_max) {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
      } else {
        if (in_array($extension, $accept)) {
          // echo "Permitido";
          $folder = '../../_imagesDb/services/';

          if (!is_dir($folder)) {
            mkdir($folder, 755, true);
          }

          // Nome temporário do arquivo
          $tmp = $image_service_form['tmp_name'][$key];
          // Novo nome do arquivo
          $newName = "img_services-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

          if (move_uploaded_file($tmp, $folder . $newName)) {
            $image_services = 'https://bsangola.com//_imagesDb/services/' . $newName;
            array_push($images_array_service_form, $image_services);
            // echo "Upload realizado com sucesso!";
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
          }
        } else {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
        }
      }
    }

    $encode_images_array_service = json_encode($images_array_service_form);

    if ($images_array_service_form == []) {
      $sql = $pdo->prepare("UPDATE services SET title_service=?, description_service=? WHERE id=? ");

      if ($sql->execute(array(
        $title_service_form,
        $description_service_form,
        $id_service
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do serviço actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do serviço </div>"];
      };
    } else {
      $sql = $pdo->prepare("UPDATE services SET image_service=?, title_service=?, description_service=? WHERE id=? ");

      if ($sql->execute(array(
        $encode_images_array_service,
        $title_service_form,
        $description_service_form,
        $id_service
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do serviço actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do serviço </div>"];
      };
    }
  }
  echo json_encode($return);
}
