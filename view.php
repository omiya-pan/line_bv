<?php
ini_set("display_errors", On);
error_reporting(E_ALL);

$username = $_POST["username"];
$has_error = false;
$error_msg = "";
$filename = "";
$content = "";
$title = "";
$messages = array();

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

  if (($content = file_get_contents($filename)) === false) {
    throw new RuntimeException("ファイル読み込み失敗");
  }

  $date = "";

  foreach (explode("\r\n", $content) as $line) {
    if ($line != "") {
      $items = explode("\t", $line);
      
      switch (count($items)) {
        case 1:
          if (strpos($items[0], "[LINE]") !== false) {
            $title = $items[0];
          }
          else if (strpos($items[0], "保存日時")) {

          }
          else {
            $date = explode("(", $items[0])[0];
          }
        
          break;

        case 2:
          $messages[] = array(
            "date" => $date,
            "time" => explode("\t", $line)[0],
            "content" => explode("\t", $line)[1],
          );
      
          break;

        case 3:
          $messages[] = array(
            "date" => $date,
            "time" => explode("\t", $line)[0],
            "name" => explode("\t", $line)[1],
            "content" => explode("\t", $line)[2]
          );
        
          break;
      }
    }
  }
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
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>LINE Backup Viewer</h1>
<?php
if ($has_error == true) {
?>
    <p><?php echo $error_msg; ?></p>
<?php
}
else {
?>
    <div id="line_container">
      <header>
        <h2><?php echo $title; ?></h2>
      </header>
      <div id="messages">
<?php
  $prev_date = "";

  foreach ($messages as $message) {
    if ($message["date"] != $prev_date) {
?>
        <div class="date"><?php echo $message["date"]; ?></div>
<?php
    }

    switch (count($message)) {
      case 3:
?>
        <div class="notice"><?php echo $message["time"]; ?><br><?php echo $message["content"]; ?></div>
<?php
        break;
    
      case 4:
        if ($message["name"] == $username) {
?>
        <div class="message message_right">
          <div class="content"><?php echo $message["content"]; ?></div>
          <div class="time"><?php echo $message["time"]; ?></div>
        </div>
<?php
        }
        else {
?>
        <div class="message message_left">
          <div class="name"><?php echo $message["name"]; ?></div>
          <div class="content"><?php echo $message["content"]; ?></div>
          <div class="time"><?php echo $message["time"]; ?></div>
        </div>
<?php            
        }

        break;
    }

    $prev_date = $message["date"];
  }
}
?>
      </div>
    </div>
  </body>
</html>
