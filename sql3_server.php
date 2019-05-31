<?php
  $dsn = 'mysql:host=localhost;dbname=address_book;charset=utf8';
  $user = 'c0117327';
  $password = 'password';
  $data = array();


  try {
    $dbh = new PDO($dsn, $user, $password);
    
    if(!(empty($_POST['name']) || empty($_POST['address']) || empty($_POST['phone']) || empty($_POST['email']))) {
      $sql2 = "INSERT INTO addresses ( name, address, phone, email) VALUES ( :name, :address, :phone, :email)";
      $PDOstmt = $dbh->prepare($sql2);
      $params = array(':name' => $_POST['name'], ':address' => $_POST['address'],':phone' => $_POST['phone'],':email' => $_POST['email']);
      $PDOstmt->execute($params);
    }


    $sql = "SELECT * FROM addresses;";

    $PDOstmt = $dbh->query($sql);

    echo json_encode($PDOstmt->fetchAll(), JSON_UNESCAPED_UNICODE);

  } catch (PDOException $e) {
    var_dump(e);
    exit;
  }
?>