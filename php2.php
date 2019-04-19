<?php
    $addresses = array(array('name'=>'東京太郎', 'address'=>'東京都', 'phone'=>'012-345-6789', 'email'=>'taro@example.com'),
                       array('name'=>'工科花子', 'address'=>'北海道', 'phone'=>'987-654-3210', 'email'=>'hana@example.com'));
    
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
  </body>
</html>