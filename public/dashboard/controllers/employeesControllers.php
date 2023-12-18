<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'create_employee') {
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

  $image_employee_form = $_FILES['images_files'];
  $images_array_employee_form = [];

  $name_employee_form = $dataForm['name_employee'];
  $email_employee_form = $dataForm['email_employee'];
  $occupation_employee_form = $dataForm['occupation_employee'];

  $date_create_employee_form = $completeDate;

  $result_employee = $pdo->prepare("SELECT * FROM employees WHERE email_employee = ? ORDER BY id ");
  $result_employee->execute(array($email_employee_form));
  $num_employee = $result_employee->rowCount();

  if ($num_employee >= 1) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Este email já encontra-se cadastrado </div>"];
  } else {
    if (empty($name_employee_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome está vazio </div>"];
    } elseif (empty($email_employee_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
    } else {

      foreach ($image_employee_form['name'] as $key => $name) {
        $size_max = 2097152; //2MB
        $accept  = array("jpg", "png", "jpeg");
        $extension  = pathinfo($image_employee_form['name'][$key], PATHINFO_EXTENSION);

        if ($image_employee_form['size'][$key] >= $size_max) {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
        } else {
          if (in_array($extension, $accept)) {
            // echo "Permitido";
            $folder = '../../_imagesDb/employees/';

            if (!is_dir($folder)) {
              mkdir($folder, 755, true);
            }

            // Nome temporário do arquivo
            $tmp = $image_employee_form['tmp_name'][$key];
            // Novo nome do arquivo
            $newName = "img_employees-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

            if (move_uploaded_file($tmp, $folder . $newName)) {
              $image_employees = 'https://bsangola.com//_imagesDb/employees/' . $newName;
              array_push($images_array_employee_form, $image_employees);
              // echo "Upload realizado com sucesso!";
            } else {
              $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
            }
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
          }
        }
      }

      $encode_images_array_employee = json_encode($images_array_employee_form);

      $sql = $pdo->prepare("INSERT INTO employees values(null,?,?,?,?,?)");

      if ($sql->execute(array(
        $encode_images_array_employee,
        $name_employee_form,
        $email_employee_form,
        $occupation_employee_form,
        $date_create_employee_form
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Cliente cadastrado com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao cadastrar funcionário </div>"];
      };
    }

    echo json_encode($return);
  }
}

if ($type_form == 'get_employees') {
  $num_register = $_GET['numRegister'];

  $result_employees = $pdo->prepare("SELECT * FROM employees ORDER BY id DESC LIMIT :limitRegister");
  $result_employees->bindParam(':limitRegister', $num_register, PDO::PARAM_INT);
  $result_employees->execute();
  $num_employees = $result_employees->rowCount();

  if ($num_employees <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum funcionário cadastrado no momento </div>";
  } else {
    $return = "";

    while ($row_employee = $result_employees->fetch(PDO::FETCH_ASSOC)) {
      extract($row_employee);

      $decode_image_employee = json_decode($image_employee);

      $url_image = "";

      if ($image_employee !== '[]') {
        $url_image = $decode_image_employee[0];
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
            <p>$name_employee</p>
          </td>
          <td>
            <p>$email_employee</p>
          </td>
          <td>
            <p>$occupation_employee</p>
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

if ($type_form == 'get_all_employee_search') {
  $searchRegister = $_GET['searchRegisterValue'];

  if (empty($searchRegister)) {
    $return = ['error' => true, 'msg' => "O campo de pesquisa está vazio"];
  } else {
    $result_search = $pdo->prepare("SELECT * FROM employees WHERE name_employee LIKE :searchTerm");
    $result_search->bindValue(':searchTerm', '%' . $searchRegister . '%', PDO::PARAM_STR);
    $result_search->execute();
    $num_search = $result_search->rowCount();

    if ($num_search <= 0) {
      $return = ['error' => true, 'msg' => "Erro: Não foi encontrado nenhum registo"];
    } else {

      $dataRegister = "";

      while ($row_employee = $result_search->fetch(PDO::FETCH_ASSOC)) {

        extract($row_employee);

        $decode_image_employee = json_decode($image_employee);

        $url_image = "";

        if ($image_employee !== '[]') {
          $url_image = $decode_image_employee[0];
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
              <p>$name_employee</p>
            </td>
            <td>
              <p>$email_employee</p>
            </td>
            <td>
              <p>$occupation_employee</p>
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

if ($type_form == 'delete_employees') {
  $id_employee = $_GET['idCustomer'];

  $result_employee = $pdo->prepare("DELETE FROM employees WHERE id=?");

  if ($result_employee->execute(array($id_employee))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir o funcionário"];
  } else {
    $return = ['error' => true, 'msg' =>  "O funcionário não foi excluído :)"];
  }
}

if ($type_form == 'get_employee') {
  $id_employee = $_GET['idCustomer'];

  $result_employee = $pdo->prepare("SELECT * FROM employees WHERE id = ? ORDER BY id LIMIT 1");
  $result_employee->execute(array($id_employee));
  $num_employee = $result_employee->rowCount();

  if ($num_employee >= 1) {
    $row_employee = $result_employee->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_employee];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhum funcionário com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'edite_employee') {
  $id_employee = $dataForm['id_employee'];

  $image_employee_form = $_FILES['images_files'];
  $images_array_employee_form = [];

  $name_employee_form = $dataForm['name_employee'];
  $email_employee_form = $dataForm['email_employee'];
  $occupation_employee_form = $dataForm['occupation_employee'];

  $return = "";

  if (empty($name_employee_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome está vazio </div>"];
  } elseif (empty($email_employee_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
  } elseif (empty($occupation_employee_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo nº de telefone está vazio </div>"];
  } else {

    foreach ($image_employee_form['name'] as $key => $name) {
      $size_max = 2097152; //2MB
      $accept  = array("jpg", "png", "jpeg");
      $extension  = pathinfo($image_employee_form['name'][$key], PATHINFO_EXTENSION);

      if ($image_employee_form['size'][$key] >= $size_max) {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
      } else {
        if (in_array($extension, $accept)) {
          // echo "Permitido";
          $folder = '../../_imagesDb/employees/';

          if (!is_dir($folder)) {
            mkdir($folder, 755, true);
          }

          // Nome temporário do arquivo
          $tmp = $image_employee_form['tmp_name'][$key];
          // Novo nome do arquivo
          $newName = "img_employees-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

          if (move_uploaded_file($tmp, $folder . $newName)) {
            $image_employees = 'https://bsangola.com//_imagesDb/employees/' . $newName;
            array_push($images_array_employee_form, $image_employees);
            // echo "Upload realizado com sucesso!";
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
          }
        } else {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
        }
      }
    }

    $encode_images_array_employee = json_encode($images_array_employee_form);

    if ($images_array_employee_form == []) {
      $sql = $pdo->prepare("UPDATE employees SET name_employee=?, email_employee=?, occupation_employee=? WHERE id=? ");

      if ($sql->execute(array(
        $name_employee_form,
        $email_employee_form,
        $occupation_employee_form,
        $id_employee
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do funcionário actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do funcionário </div>"];
      };
    } else {
      $sql = $pdo->prepare("UPDATE employee SET image_employee=?, name_employee=?, email_employee=?, occupation_employee=?, login_password_employee=? WHERE id=? ");

      if ($sql->execute(array(
        $encode_images_array_employee,
        $name_employee_form,
        $email_employee_form,
        $occupation_employee_form,
        $new_password,
        $id_employee
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do funcionário actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do funcionário </div>"];
      };
    }
  }
  echo json_encode($return);
}
