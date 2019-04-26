<?php
  function fileCheck() {

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      if(is_uploaded_file($_FILES['selectfile']['tmp_name'])) {
        if(move_uploaded_file($_FILES['selectfile']['tmp_name'], "./".$_FILES['selectfile']['name'])) {
          print("<a>Successful:ファイルのアップロードに成功しました。</a>\n");
        }

      } else {
        print("<a>Error:ファイルが指定されていません。</a>\n");
      }
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
      fileCheck();
    ?>
    <h1>ファイルアップローダー</h1>
    <form action="php-advance-2.php" method="post" enctype="multipart/form-data">
      <input type="file" name="selectfile">
      <input type="submit" value="送信">
    </form>
  </body>
</html>
