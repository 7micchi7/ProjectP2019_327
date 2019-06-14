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
      $sql = "SELECT * FROM addresses;";

      $PDOstmt = $dbh->query($sql);

      echo json_encode($PDOstmt->fetchAll(), JSON_UNESCAPED_UNICODE);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
      $name = filter_input(INPUT_GET, 'name');
      $address = filter_input(INPUT_GET, 'address');
      $phone = filter_input(INPUT_GET, 'phone');
      $email = filter_input(INPUT_GET, 'email');
      $sql = "SELECT * FROM addresses";


      $searchElement = [];

      if(!empty($name)) $searchElement[] = "name = :name";
      if(!empty($address)) $searchElement[] = "address = :address";
      if(!empty($phone)) $searchElement[] = "phone = :phone";
      if(!empty($email)) $searchElement[] = "email = :email";

      if(count($searchElement) > 0) {
        $searchElement = implode(' AND ', $searchElement);
        $sql .= " WHERE " . $searchElement;
      }

      $sql .= ";";

      if(!empty($name)) $elem[':name'] = $name;
      if(!empty($address)) $elem[':address'] = $address;
      if(!empty($phone))$elem[':phone'] = $phone;
      if(!empty($email)) $elem[':email'] = $email;

      $PDOstmt = $dbh->prepare($sql);
      $PDOstmt->execute($elem);

      echo json_encode($PDOstmt->fetchAll(), JSON_UNESCAPED_UNICODE);
    }

  } catch (PDOException $e) {
    var_dump(e);
    exit;
  }
?>