<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'create_testimonial') {
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

  $image_testimonial_form = $_FILES['images_files'];
  $images_array_testimonial_form = [];

  $name_testimonial_form = $dataForm['name_testimonial'];
  $description_testimonial_form = $dataForm['description_testimonial'];
  $occupation_testimonial_form = $dataForm['occupation_testimonial'];

  $date_create_testimonial_form = $completeDate;

  $result_testimonial = $pdo->prepare("SELECT * FROM testimonials WHERE description_testimonial = ? ORDER BY id ");
  $result_testimonial->execute(array($description_testimonial_form));
  $num_testimonial = $result_testimonial->rowCount();

  if ($num_testimonial >= 1) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Este email já encontra-se cadastrado </div>"];
  } else {
    if (empty($name_testimonial_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome está vazio </div>"];
    } elseif (empty($description_testimonial_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
    } else {

      foreach ($image_testimonial_form['name'] as $key => $name) {
        $size_max = 2097152; //2MB
        $accept  = array("jpg", "png", "jpeg");
        $extension  = pathinfo($image_testimonial_form['name'][$key], PATHINFO_EXTENSION);

        if ($image_testimonial_form['size'][$key] >= $size_max) {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
        } else {
          if (in_array($extension, $accept)) {
            // echo "Permitido";
            $folder = '../../_imagesDb/testimonials/';

            if (!is_dir($folder)) {
              mkdir($folder, 755, true);
            }

            // Nome temporário do arquivo
            $tmp = $image_testimonial_form['tmp_name'][$key];
            // Novo nome do arquivo
            $newName = "img_testimonials-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

            if (move_uploaded_file($tmp, $folder . $newName)) {
              $image_testimonials = 'https://bsangola.com//_imagesDb/testimonials/' . $newName;
              array_push($images_array_testimonial_form, $image_testimonials);
              // echo "Upload realizado com sucesso!";
            } else {
              $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
            }
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
          }
        }
      }

      $encode_images_array_testimonial = json_encode($images_array_testimonial_form);

      $sql = $pdo->prepare("INSERT INTO testimonials values(null,?,?,?,?,?)");

      if ($sql->execute(array(
        $encode_images_array_testimonial,
        $name_testimonial_form,
        $description_testimonial_form,
        $occupation_testimonial_form,
        $date_create_testimonial_form
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Cliente cadastrado com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao cadastrar depoimento </div>"];
      };
    }

    echo json_encode($return);
  }
}

if ($type_form == 'get_testimonials') {
  $num_register = $_GET['numRegister'];

  $result_testimonials = $pdo->prepare("SELECT * FROM testimonials ORDER BY id DESC LIMIT :limitRegister");
  $result_testimonials->bindParam(':limitRegister', $num_register, PDO::PARAM_INT);
  $result_testimonials->execute();
  $num_testimonials = $result_testimonials->rowCount();

  if ($num_testimonials <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum depoimento cadastrado no momento </div>";
  } else {
    $return = "";

    while ($row_testimonial = $result_testimonials->fetch(PDO::FETCH_ASSOC)) {
      extract($row_testimonial);

      $decode_image_testimonial = json_decode($image_testimonial);

      $url_image = "";

      if ($image_testimonial !== '[]') {
        $url_image = $decode_image_testimonial[0];
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
            <p>$name_testimonial</p>
          </td>
          <td>
            <p>$description_testimonial</p>
          </td>
          <td>
            <p>$occupation_testimonial</p>
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

if ($type_form == 'get_all_testimonial_search') {
  $searchRegister = $_GET['searchRegisterValue'];

  if (empty($searchRegister)) {
    $return = ['error' => true, 'msg' => "O campo de pesquisa está vazio"];
  } else {
    $result_search = $pdo->prepare("SELECT * FROM testimonials WHERE name_testimonial LIKE :searchTerm");
    $result_search->bindValue(':searchTerm', '%' . $searchRegister . '%', PDO::PARAM_STR);
    $result_search->execute();
    $num_search = $result_search->rowCount();

    if ($num_search <= 0) {
      $return = ['error' => true, 'msg' => "Erro: Não foi encontrado nenhum registo"];
    } else {

      $dataRegister = "";

      while ($row_testimonial = $result_search->fetch(PDO::FETCH_ASSOC)) {

        extract($row_testimonial);

        $decode_image_testimonial = json_decode($image_testimonial);

        $url_image = "";

        if ($image_testimonial !== '[]') {
          $url_image = $decode_image_testimonial[0];
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
              <p>$name_testimonial</p>
            </td>
            <td>
              <p>$description_testimonial</p>
            </td>
            <td>
              <p>$occupation_testimonial</p>
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

if ($type_form == 'delete_testimonials') {
  $id_testimonial = $_GET['idCustomer'];

  $result_testimonial = $pdo->prepare("DELETE FROM testimonials WHERE id=?");

  if ($result_testimonial->execute(array($id_testimonial))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir o depoimento"];
  } else {
    $return = ['error' => true, 'msg' =>  "O depoimento não foi excluído :)"];
  }
}

if ($type_form == 'get_testimonial') {
  $id_testimonial = $_GET['idCustomer'];

  $result_testimonial = $pdo->prepare("SELECT * FROM testimonials WHERE id = ? ORDER BY id LIMIT 1");
  $result_testimonial->execute(array($id_testimonial));
  $num_testimonial = $result_testimonial->rowCount();

  if ($num_testimonial >= 1) {
    $row_testimonial = $result_testimonial->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_testimonial];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhum depoimento com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'edite_testimonial') {
  $id_testimonial = $dataForm['id_testimonial'];

  $image_testimonial_form = $_FILES['images_files'];
  $images_array_testimonial_form = [];

  $name_testimonial_form = $dataForm['name_testimonial'];
  $description_testimonial_form = $dataForm['description_testimonial'];
  $occupation_testimonial_form = $dataForm['occupation_testimonial'];

  $return = "";

  if (empty($name_testimonial_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome está vazio </div>"];
  } elseif (empty($description_testimonial_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
  } elseif (empty($occupation_testimonial_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo nº de telefone está vazio </div>"];
  } else {

    foreach ($image_testimonial_form['name'] as $key => $name) {
      $size_max = 2097152; //2MB
      $accept  = array("jpg", "png", "jpeg");
      $extension  = pathinfo($image_testimonial_form['name'][$key], PATHINFO_EXTENSION);

      if ($image_testimonial_form['size'][$key] >= $size_max) {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
      } else {
        if (in_array($extension, $accept)) {
          // echo "Permitido";
          $folder = '../../_imagesDb/testimonials/';

          if (!is_dir($folder)) {
            mkdir($folder, 755, true);
          }

          // Nome temporário do arquivo
          $tmp = $image_testimonial_form['tmp_name'][$key];
          // Novo nome do arquivo
          $newName = "img_testimonials-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

          if (move_uploaded_file($tmp, $folder . $newName)) {
            $image_testimonials = 'https://bsangola.com//_imagesDb/testimonials/' . $newName;
            array_push($images_array_testimonial_form, $image_testimonials);
            // echo "Upload realizado com sucesso!";
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
          }
        } else {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
        }
      }
    }

    $encode_images_array_testimonial = json_encode($images_array_testimonial_form);

    if ($images_array_testimonial_form == []) {
      $sql = $pdo->prepare("UPDATE testimonials SET name_testimonial=?, description_testimonial=?, occupation_testimonial=? WHERE id=? ");

      if ($sql->execute(array(
        $name_testimonial_form,
        $description_testimonial_form,
        $occupation_testimonial_form,
        $id_testimonial
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do depoimento actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do depoimento </div>"];
      };
    } else {
      $sql = $pdo->prepare("UPDATE testimonial SET image_testimonial=?, name_testimonial=?, description_testimonial=?, occupation_testimonial=? WHERE id=? ");

      if ($sql->execute(array(
        $encode_images_array_testimonial,
        $name_testimonial_form,
        $description_testimonial_form,
        $occupation_testimonial_form,
        $id_testimonial
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do depoimento actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do depoimento </div>"];
      };
    }
  }
  echo json_encode($return);
}
