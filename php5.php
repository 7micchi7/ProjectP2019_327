
<?php

  $addresses = array();

  function fileRead() {

    $filename = "./addresses.json";
    $addresses = array();
    $fileContents = null;

    if(file_exists($filename)){
      $fileContents = file_get_contents($filename);
    } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
    } else {
      print("<a>読み込めませんでした。</a>\n");
    }

    if(isset($fileContents)) {
      $addresses = json_decode($fileContents, true);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && !(empty($_POST['name']) || empty($_POST['address']) || empty($_POST['phone']) || empty($_POST['email']))) {
      array_push($addresses, array('name'=>$_POST['name'], 'address'=>$_POST['address'], 'phone'=>$_POST['phone'], 'email'=>$_POST['email']));
      $file = fopen($filename, "w");
      fwrite($file, json_encode($addresses, JSON_UNESCAPED_UNICODE));
      fclose($file);
    }
    return $addresses;
  }
    
  function print_table($P_Address) {
    $rt = '<table border="1">'.
          '<tr><th>名前</th>'.
              '<th>住所</th>'. 
              '<th>電話</th>'. 
              '<th>Email</th></tr>';

    foreach($P_Address as $key) {
      $rt .= '<tr><td>'. $key['name']. '</td>'.
                 '<td>'. $key['address']. '</td>'.
                 '<td>'. $key['phone']. '</td>'.
                 '<td>'. $key['email']. '</td></tr>';
    };
    $rt .= '</table>';

    print($rt);
  }
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>php5.php</title>
  </head>
  <body>
    <?php
      $addresses = fileRead();
      print_table($addresses);
    ?>
    <form action="php5.php" method="post">
      <p>名前:<input type="text" name="name"></p>
      <p>住所:<input type="text" name="address"></p>
      <p>電話:<input type="text" name="phone"></p>
      <p>Email:<input type="text" name="email"></p>
      <input type="submit" value="送信">
    </form>
  </body>
</html>

