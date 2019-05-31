<?php
  $dsn = 'mysql:host=localhost;dbname=address_book;charset=utf8';
  $user = 'c0117327';
  $password = 'password';
  $data = array();

  try {
    $dbh = new PDO($dsn, $user, $password);

    $sql = "SELECT * FROM addresses";

    $PDOstmt = $dbh->query($sql);

    echo json_encode($PDOstmt->fetchAll(), JSON_UNESCAPED_UNICODE);

  } catch (PDOException $e) {
    exit;
  }
?>