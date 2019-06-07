<?php
  $dsn = 'mysql:host=localhost;dbname=address_book;charset=utf8';
  $user = 'c0117327';
  $password = 'password';
  $data = array();


  try {
    $dbh = new PDO($dsn, $user, $password);
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' ){ 
      $name = filter_input(INPUT_POST, 'name');
      $address = filter_input(INPUT_POST, 'address');
      $phone = filter_input(INPUT_POST, 'phone');
      $email = filter_input(INPUT_POST, 'email');

      if(!empty($name) && !empty($address) && !empty($phone) && !empty($email)) {
        $sql2 = "INSERT INTO addresses ( name, address, phone, email) VALUES ( :name, :address, :phone, :email)";
        $PDOstmt = $dbh->prepare($sql2);
        $params = array(':name' => $name, ':address' => $address, ':phone' => $phone, ':email' => $email);
        $PDOstmt->execute($params);
      }
    }


    $sql = "SELECT * FROM addresses;";

    $PDOstmt = $dbh->query($sql);

    echo json_encode($PDOstmt->fetchAll(), JSON_UNESCAPED_UNICODE);

  } catch (PDOException $e) {
    var_dump(e);
    exit;
  }
?>