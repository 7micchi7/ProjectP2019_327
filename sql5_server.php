<?php
  $dsn = 'mysql:host=localhost;dbname=address_book;charset=utf8';
  $user = 'c0117327';
  $password = 'password';
  $data = array();


  try {
    $dbh = new PDO($dsn, $user, $password);
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' ){ 
      $id = filter_input(INPUT_POST, 'id');
      $name = filter_input(INPUT_POST, 'name');
      $address = filter_input(INPUT_POST, 'address');
      $phone = filter_input(INPUT_POST, 'phone');
      $email = filter_input(INPUT_POST, 'email');
      $type = filter_input(INPUT_POST, 'type');

      if(!empty($name) && !empty($address) && !empty($phone) && !empty($email) && $type==="add") {
        $sql2 = "INSERT INTO addresses ( name, address, phone, email) VALUES ( :name, :address, :phone, :email)";
        $PDOstmt = $dbh->prepare($sql2);
        $params = array(':name' => $name, ':address' => $address, ':phone' => $phone, ':email' => $email);
        $PDOstmt->execute($params);
      }

      if($type==="update" && !empty($id)) {
        $sql = "UPDATE addresses SET ";
        if(!empty($name)) $updateElement[] = "name = :name";
        if(!empty($address)) $updateElement[] = "address = :address";
        if(!empty($phone)) $updateElement[] = "phone = :phone";
        if(!empty($email)) $updateElement[] = "email = :email";

        if(count($updateElement) > 0) {
          $strElement = implode(', ', $updateElement);
          $sql .= $strElement. " WHERE id = :id";
        }
        $sql .= ";";

        if(!empty($name)) $preElem[':name'] = $name;
        if(!empty($address)) $preElem[':address'] = $address;
        if(!empty($phone))$preElem[':phone'] = $phone;
        if(!empty($email)) $preElem[':email'] = $email;
        $preElem[':id'] = $id;

        $PDOstmt = $dbh->prepare($sql);
        $PDOstmt->execute($preElem);
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
        $strElement = implode(' AND ', $searchElement);
        $sql .= " WHERE " . $strElement;
      }

      $sql .= ";";

      $preElem = [];

      if(!empty($name)) $preElem[':name'] = $name;
      if(!empty($address)) $preElem[':address'] = $address;
      if(!empty($phone))$preElem[':phone'] = $phone;
      if(!empty($email)) $preElem[':email'] = $email;

      if(count($preElem) > 0) {
        $PDOstmt = $dbh->prepare($sql);
        $PDOstmt->execute($preElem);
      }

      $PDOstmt = $dbh->query($sql);

      echo json_encode($PDOstmt->fetchAll(), JSON_UNESCAPED_UNICODE);
    }

  } catch (PDOException $e) {
    var_dump(e);
    exit;
  }
?>