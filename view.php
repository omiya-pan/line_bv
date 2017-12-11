<?php
try {
  if (!isset($_FILES["file"])) {
    throw new RuntimeException("不正なページ遷移");
  }
  else {
    if (!isset($_FILES["upfile"]["error"]) || !is_int($_FILES["upfile"]["error"])) {
      throw new RuntimeExeption("不正なパラメータ");
    }
    else if ($_FILES["file"]["error"] !== UPLOAD_ERR_OK) {
      throw new RuntimeExeption("不正なファイル");
    }
    else {
      $filename = $_FILES["file"]["name"];
      $tmpname = $_FILES["file"]["tmp_name"];

      if (!move_upload_file($tmpname, "upload/" . $filename)) {
        throw new RuntimeException("アップロード失敗");
      }
    }
  }
}
catch (RuntimeException $e) {
  echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>LINE Backup Viewer</title>
  </head>
  <body>
    <h1>LINE Backup Viewer</h1>
    
  </body>
</html>
