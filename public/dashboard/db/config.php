<?php

$mode = 'local';

if ($mode == 'local') {
  $dbHost = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbName = "bsangola";
}
if ($mode == 'producao') {
  $dbHost = "localhost";
  $dbUsername = "u399967863_adm_bsangola";
  $dbPassword = "BSAngola2023";
  $dbName = "u399967863_bsangola";
}
try {
  $pdo = new PDO(
    "mysql:host=$dbHost;dbname=$dbName",
    $dbUsername,
    $dbPassword,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
  );
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
  echo "Falha ao se conectar com o banco da dados" . $erro->getMessage()();
}
