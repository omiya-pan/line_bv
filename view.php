<?php
ini_set("display_errors", On);
error_reporting(E_ALL);

$has_error = false;
$error_msg = "";
$filename = "";

try {
  if (!isset($_FILES["file"])) {
    throw new RuntimeException("不正なページ遷移");
  }
  else {
    if (!isset($_FILES["file"]["error"]) || !is_int($_FILES["file"]["error"])) {
      throw new RuntimeException("不正なパラメータ");
    }
    else if ($_FILES["file"]["error"] !== UPLOAD_ERR_OK) {
      throw new RuntimeException("不正なファイル");
    }
    else {
      $filename = $_FILES["file"]["tmp_name"];

      if (!is_uploaded_file($filename)) {
        throw new RuntimeException("アップロード失敗");
      }
    }
  }

  if (!($fp = fopen($filename, "r"))) {
    throw new RuntimeException("ファイル読み込み失敗");
  }

  while (!feof($fp)) {
    $load = fgets($fp, 4096);
    print $load . "<br>";
  }

  fclose($fp);
}
catch (RuntimeException $e) {
  $has_error = true;
  $error_msg = $e->getMessage();
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
<?php
if ($has_error == true) {
?>
    <p><?php echo $error_msg; ?></p>
<?php
}
?>
  </body>
</html>
