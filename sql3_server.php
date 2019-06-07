<?php
  $dsn = 'mysql:host=localhost;dbname=address_book;charset=utf8';
  $user = 'c0117327';
  $password = 'password';
  $data = array();


  try {
    $dbh = new PDO($dsn, $user, $password);
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' ){ 
      $name = filter_input(INPUT_GET, 'name');
      $address = filter_input(INPUT_GET, 'address');
      $phone = filter_input(INPUT_GET, 'phone');
      $email = filter_input(INPUT_GET, 'email');

      if(isset($name) && isset($address) && isset($phone) && isset($email)) {
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