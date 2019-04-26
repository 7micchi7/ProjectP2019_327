<?php
session_start();

function sessionCheck() {
  if(!isset($_SESSION['count'])) {
    print("<a>初めての訪問です！</a>\n");
    $_SESSION['count'] = 1;
  } else {
    $_SESSION['count']++;
    print("<a>". $_SESSION['count']. "回目の訪問です。</a>\n");
  }
}

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>php-advance-1.php</title>
  </head>
  <body>
    <?php
      sessionCheck();
    ?>
  </body>
</html>
