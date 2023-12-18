<?php $this->layout("_theme"); ?>
<?php
if ((!isset($_SESSION['adm_deal_days_email']))) {
  header('Location:  /admin');
}
?>

<!-- head-title -->
<div class="head-title">
  <div class="left">
    <h1>Portfólios</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Portfólios</a>
      </li>
    </ul>
  </div>
  <button class="btn-download" data-toggle="modal" data-target="#modalCreate">
    <i class="bx bxs-file-plus"></i>
    <span class="text">Novo Portfólios</span>
  </button>
</div>

<!-- MODAL -->
<div id="modalCreate" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Cadastrar novo Portfólios</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroCad"></span>
    </div>

    <form id="registerForm" class="modalForm">

      <input name="images_files[]" class="form-control" type="file" accept="image/" id="inputImagens">
      <div id="containerImagens"></div>

      <div>
        <label for="title_portfolio">
          Titulo <span class="text-danger">*</span>
        </label>
        <input name="title_portfolio" class="form-control" type="text" placeholder="Titulo do portifolio">
      </div>
      <div>
        <label for="description_portfolio">
          Descrição <span class="text-danger">*</span>
        </label>
        <input name="description_portfolio" class="form-control" type="text" placeholder="Descrição do portifolio">
      </div>

      <button class="base-btn" type="submit">
        Cadastrar Portfólios
      </button>
    </form>
  </div>
</div>

<div id="modalEdite" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Editar dados do Portfólios</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroEditCad"></span>
    </div>

    <form id="editForm" class="modalForm">
      <input id="id_edit" name="id_portfolio" hidden>

      <input name="images_files[]" class="form-control" type="file" accept="image/" id="inputImagensEdit">
      <div id="containerImagensEdit">
        <img id="images_files_edit" />
      </div>

      <div>
        <label for="title_portfolio">
          Titulo <span class="text-danger">*</span>
        </label>
        <input name="title_portfolio" id="title_portfolio_edit" class="form-control" type="text" placeholder="Titulo do portifolio">
      </div>
      <div>
        <label for="description_portfolio">
          Descrição <span class="text-danger">*</span>
        </label>
        <input name="description_portfolio" id="description_portfolio_edit" class="form-control" type="text" placeholder="Descrição do portifolio">
      </div>

      <button class="base-btn" type="submit">
        Actualizar dados do cliente
      </button>
    </form>
  </div>
</div>

<!-- TABLE -->
<div class="table-data">
  <div class="order">
    <div class="containerFilter">
      <div class="numRegister">
        <span>Registos por pagina</span>
        <select id="numRegister">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="15">15</option>
          <option value="20">20</option>
          <option value="25">25</option>
          <option value="30">30</option>
          <option value="35">35</option>
          <option value="40">40</option>
          <option value="45">45</option>
          <option value="50">50</option>
        </select>
      </div>

      <form class="searchRegister" id='searchRegister'>
        <input type="text" placeholder="Procurar" id="searchRegisterValue" />
        <button type="submit" class="search-btn">
          <i class="bx bx-search"></i>
        </button>
      </form>
    </div>

    <div class="head">
      <h3>Todos os Portfólios</h3>
      <i class="bx bx-search"></i>
      <i class="bx bx-filter"></i>
    </div>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Fotografia</th>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Data de registo</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<script src="<?= DASHBOARD_ACTIONS . "/actions_portfolio.js" ?>"></script>