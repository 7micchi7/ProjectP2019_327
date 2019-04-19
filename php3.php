<?php
  $addresses = array();
  array_push($addresses, array('name'=>'東京太郎', 'address'=>'東京都', 'phone'=>'012-345-6789', 'email'=>'taro@example.com'),
                         array('name'=>'工科花子', 'address'=>'北海道', 'phone'=>'987-654-3210', 'email'=>'hana@example.com'));

  if($_SERVER['REQUEST_METHOD'] == 'POST' && !(empty($_POST['name']) || empty($_POST['address']) || empty($_POST['phone']) || empty($_POST['email']))) {
    array_push($addresses, array('name'=>$_POST['name'], 'address'=>$_POST['address'], 'phone'=>$_POST['phone'], 'email'=>$_POST['email']));
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
    <title>php2.php</title>
  </head>
  <body>
    <?php
      print_table($addresses);
    ?>
    <form action="php3.php" method="post">
      <p>名前:<input type="text" name="name"></p>
      <p>住所:<input type="text" name="address"></p>
      <p>電話:<input type="text" name="phone"></p>
      <p>Email:<input type="text" name="email"></p>
      <input type="submit" value="送信">
    </form>
  </body>
</html>
