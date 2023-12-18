<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'create_blog') {
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

  $image_blog_form = $_FILES['images_files'];
  $images_array_blog_form = [];

  $title_blog_form = $dataForm['title_blog'];
  $description_blog_form = $dataForm['description_blog'];
  $category_blog_form = $dataForm['category_blog'];
  $author_blog_form = $dataForm['author_blog'];
  $epigraph_blog_form = $dataForm['epigraph_blog'];

  $date_create_blog_form = $completeDate;

  $result_blog = $pdo->prepare("SELECT * FROM blogs WHERE description_blog = ? ORDER BY id ");
  $result_blog->execute(array($description_blog_form));
  $num_blog = $result_blog->rowCount();

  if ($num_blog >= 1) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Este email já encontra-se cadastrado </div>"];
  } else {
    if (empty($title_blog_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo titulo está vazio </div>"];
    } elseif (empty($description_blog_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo descrição está vazio </div>"];
    } elseif (empty($category_blog_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo categoria está vazio </div>"];
    } elseif (empty($author_blog_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo autor está vazio </div>"];
    } elseif (empty($epigraph_blog_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo epigrafe está vazio </div>"];
    } else {

      foreach ($image_blog_form['name'] as $key => $name) {
        $size_max = 2097152; //2MB
        $accept  = array("jpg", "png", "jpeg");
        $extension  = pathinfo($image_blog_form['name'][$key], PATHINFO_EXTENSION);

        if ($image_blog_form['size'][$key] >= $size_max) {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
        } else {
          if (in_array($extension, $accept)) {
            // echo "Permitido";
            $folder = '../../_imagesDb/blogs/';

            if (!is_dir($folder)) {
              mkdir($folder, 755, true);
            }

            // Nome temporário do arquivo
            $tmp = $image_blog_form['tmp_name'][$key];
            // Novo nome do arquivo
            $newName = "img_blogs-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

            if (move_uploaded_file($tmp, $folder . $newName)) {
              $image_blogs = 'https://bsangola.com//_imagesDb/blogs/' . $newName;
              array_push($images_array_blog_form, $image_blogs);
              // echo "Upload realizado com sucesso!";
            } else {
              $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
            }
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
          }
        }
      }

      $encode_images_array_blog = json_encode($images_array_blog_form);

      $sql = $pdo->prepare("INSERT INTO blogs values(null,?,?,?,?,?,?,?)");

      if ($sql->execute(array(
        $encode_images_array_blog,
        $title_blog_form,
        $description_blog_form,
        $category_blog_form,
        $author_blog_form,
        $epigraph_blog_form,
        $date_create_blog_form
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Cliente cadastrado com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao cadastrar notícia </div>"];
      };
    }

    echo json_encode($return);
  }
}

if ($type_form == 'get_blogs') {
  $num_register = $_GET['numRegister'];

  $result_blogs = $pdo->prepare("SELECT * FROM blogs ORDER BY id DESC LIMIT :limitRegister");
  $result_blogs->bindParam(':limitRegister', $num_register, PDO::PARAM_INT);
  $result_blogs->execute();
  $num_blogs = $result_blogs->rowCount();

  if ($num_blogs <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhuma notícia cadastrado no momento </div>";
  } else {
    $return = "";

    while ($row_blog = $result_blogs->fetch(PDO::FETCH_ASSOC)) {
      extract($row_blog);

      $decode_image_blog = json_decode($image_blog);

      $url_image = "";

      if ($image_blog !== '[]') {
        $url_image = $decode_image_blog[0];
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
            <p>$title_blog</p>
          </td>
          <td>
            <p>$description_blog</p>
          </td>
          <td>
            <p>$category_blog</p>
          </td>
          <td>
            <p>$author_blog</p>
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

if ($type_form == 'get_all_blog_search') {
  $searchRegister = $_GET['searchRegisterValue'];

  if (empty($searchRegister)) {
    $return = ['error' => true, 'msg' => "O campo de pesquisa está vazio"];
  } else {
    $result_search = $pdo->prepare("SELECT * FROM blogs WHERE name_blog LIKE :searchTerm");
    $result_search->bindValue(':searchTerm', '%' . $searchRegister . '%', PDO::PARAM_STR);
    $result_search->execute();
    $num_search = $result_search->rowCount();

    if ($num_search <= 0) {
      $return = ['error' => true, 'msg' => "Erro: Não foi encontrado nenhum registo"];
    } else {

      $dataRegister = "";

      while ($row_blog = $result_search->fetch(PDO::FETCH_ASSOC)) {

        extract($row_blog);

        $decode_image_blog = json_decode($image_blog);

        $url_image = "";

        if ($image_blog !== '[]') {
          $url_image = $decode_image_blog[0];
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
              <p>$title_blog</p>
            </td>
            <td>
              <p>$description_blog</p>
            </td>
            <td>
              <p>$category_blog</p>
            </td>
            <td>
              <p>$author_blog</p>
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

if ($type_form == 'delete_blogs') {
  $id_blog = $_GET['idCustomer'];

  $result_blog = $pdo->prepare("DELETE FROM blogs WHERE id=?");

  if ($result_blog->execute(array($id_blog))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir o notícia"];
  } else {
    $return = ['error' => true, 'msg' =>  "O notícia não foi excluído :)"];
  }
}

if ($type_form == 'get_blog') {
  $id_blog = $_GET['idCustomer'];

  $result_blog = $pdo->prepare("SELECT * FROM blogs WHERE id = ? ORDER BY id LIMIT 1");
  $result_blog->execute(array($id_blog));
  $num_blog = $result_blog->rowCount();

  if ($num_blog >= 1) {
    $row_blog = $result_blog->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_blog];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhum notícia com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'edite_blog') {
  $id_blog = $dataForm['id_blog'];

  $image_blog_form = $_FILES['images_files'];
  $images_array_blog_form = [];

  $title_blog_form = $dataForm['title_blog'];
  $description_blog_form = $dataForm['description_blog'];
  $category_blog_form = $dataForm['category_blog'];
  $author_blog_form = $dataForm['author_blog'];
  $epigraph_blog_form = $dataForm['epigraph_blog'];

  $return = "";

  if (empty($title_blog_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo titulo está vazio </div>"];
  } elseif (empty($description_blog_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo descrição está vazio </div>"];
  } elseif (empty($category_blog_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo categoria está vazio </div>"];
  } elseif (empty($author_blog_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo autor está vazio </div>"];
  } elseif (empty($epigraph_blog_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo epigrafe está vazio </div>"];
  } else {

    foreach ($image_blog_form['name'] as $key => $name) {
      $size_max = 2097152; //2MB
      $accept  = array("jpg", "png", "jpeg");
      $extension  = pathinfo($image_blog_form['name'][$key], PATHINFO_EXTENSION);

      if ($image_blog_form['size'][$key] >= $size_max) {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
      } else {
        if (in_array($extension, $accept)) {
          // echo "Permitido";
          $folder = '../../_imagesDb/blogs/';

          if (!is_dir($folder)) {
            mkdir($folder, 755, true);
          }

          // Nome temporário do arquivo
          $tmp = $image_blog_form['tmp_name'][$key];
          // Novo nome do arquivo
          $newName = "img_blogs-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

          if (move_uploaded_file($tmp, $folder . $newName)) {
            $image_blogs = 'https://bsangola.com//_imagesDb/blogs/' . $newName;
            array_push($images_array_blog_form, $image_blogs);
            // echo "Upload realizado com sucesso!";
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
          }
        } else {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
        }
      }
    }

    $encode_images_array_blog = json_encode($images_array_blog_form);

    if ($images_array_blog_form == []) {
      $sql = $pdo->prepare("UPDATE blogs SET title_blog=?, description_blog=?, category_blog=?, author_blog=?, epigraph_blog=? WHERE id=? ");

      if ($sql->execute(array(
        $title_blog_form,
        $description_blog_form,
        $category_blog_form,
        $author_blog_form,
        $epigraph_blog_form,
        $id_blog
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do notícia actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do notícia </div>"];
      };
    } else {
      $sql = $pdo->prepare("UPDATE blog SET image_blog=?, name_blog=?, description_blog=?, occupation_blog=? WHERE id=? ");

      if ($sql->execute(array(
        $encode_images_array_blog,
        $name_blog_form,
        $description_blog_form,
        $occupation_blog_form,
        $id_blog
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do notícia actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do notícia </div>"];
      };
    }
  }
  echo json_encode($return);
}