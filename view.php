<?php
ini_set("display_errors", On);
error_reporting(E_ALL);

function get_dayofweek($date) {
  $dow = array("日", "月", "火", "水", "木", "金", "土");
  $datetime = new DateTime($date);

  return $dow[$datetime->format("w")];
}

$username = $_POST["username"];
$has_error = false;
$error_msg = "";
$filename = "";
$content = "";
$title = "";
$messages = array();
$dates = array();
$message_num_date = array();
$message_num_person = array();

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
            $title = str_replace("[LINE] ", "", $items[0]);
          }
          else if (strpos($items[0], "保存日時") !== false) {

          }
          else {
            $date = explode("(", $items[0])[0];
            $dates[] = $date;
            $message_num_date[$date] = 0;
          }
        
          break;

        case 2:
          $messages[] = array(
            "date" => $date,
            "time" => explode("\t", $line)[0],
            "content" => str_replace("\n", "<br>", htmlspecialchars(explode("\t", $line)[1])),
          );
      
          break;

        case 3:
          $name = explode("\t", $line)[1];
          $messages[] = array(
            "date" => $date,
            "time" => explode("\t", $line)[0],
            "name" => htmlspecialchars($name),
            "content" => str_replace("\n", "<br>", htmlspecialchars(explode("\t", $line)[2]))
          );
          $message_num_date[$date] += 1;

          if (array_key_exists($name, $message_num_person)) {
            $message_num_person[$name] += 1;
          }
          else {
            $message_num_person[$name] = 1;
          }
        
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
<?php
if ($has_error == false) {
?>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
      google.charts.load('current', {'packages': ['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', '名前');
        data.addColumn('number', 'メッセージ数');
        data.addRows([
<?php
  arsort($message_num_person);

  foreach ($message_num_person as $person => $num) {
?>
        ['<?php echo $person; ?>', <?php echo $num; ?>],
<?php
  }
?>
      ]);

        var formatter = new google.visualization.NumberFormat({
          suffix: '件',
          fractionDigits: 0
        });
        formatter.format(data, 1);

        var options = {
          'fontSize': 16
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart'));
        chart.draw(data, options);
      }
    </script>
<?php
}
?>
  </head>
  <body>
<?php
if ($has_error == true) {
?>
    <p><?php echo $error_msg; ?></p>
<?php
}
else {
?>
    <div id="container">
      <div id="line_container">
        <header>
          <h2><?php echo htmlspecialchars($title); ?></h2>
        </header>
        <div id="messages">
<?php
  $prev_date = "";

  foreach ($messages as $message) {
    if ($message["date"] != $prev_date) {
?>
          <div class="date" id="<?php echo str_replace("/", "", $message["date"]); ?>"><?php echo $message["date"]; ?>(<?php echo get_dayofweek($message["date"]); ?>)</div>
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
?>
        </div>
      </div>
      <div id="date_select">
        <ul>
<?php
  foreach ($dates as $date) {
?>
          <li><a class="datelink" href="#<?php echo str_replace("/", "", $date); ?>"><div class="datelink_date"><?php echo $date; ?>(<?php echo get_dayofweek($date); ?>)</div><div class="datelink_num"><?php echo $message_num_date[$date]; ?>件</div></a></li>
<?php
  }
?>
        </ul>
      </div>
      <div id="person_chart">
        <div id="chart" style="width: 100%; height: 100%;"></div>
      </div>
    </div>
<?php
}
?>
  </body>
</html>
