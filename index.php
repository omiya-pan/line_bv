<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>LINE Backup Viewer</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>LINE Backup Viewer</h1>
    <form name="fileform" method="post" action="view.php" target="_blank" enctype="multipart/form-data">
      <label>自分の名前：<input type="text" name="username" value="" placeholder="LINEのユーザー名"></label>
      <label>バックアップファイル（テキスト形式）：<input type="file" name="file" accept=".txt"></label>
      <input type="submit" value="送信">
    </form>
    <div id="line_container">
      <header>
        <h2>ABCDEFGあああああああああああああああああああああああのトーク履歴</h2>
      </header>
      <div id="messages">
        <div class="date">2017/10/01</div>
        <div class="message message_left">
          <div class="name">おーみや</div>
          <div class="content">こんばんは</div>
          <div class="time">22:14</div>
        </div>
        <div class="notice">2017/10/01<br>あいうえおがグループに招待しました。</div>
        <div class="message message_right">
          <div class="content">こんばんはこんばんはこんばんはこんばんはこんばんはこんばんはこんばんは</div>
          <div class="time">22:21</div>
        </div>
        <div class="message message_left">
          <div class="content">こんばんは</div>
          <div class="time">22:32</div>
        </div>
        <div class="message message_left">
          <div class="name">おーみや</div>
          <div class="content">こんばんはんばんはこんばんはこんばんはこん</div>
          <div class="time">22:34</div>
        </div>
      </div>
    </div>
  </body>
</html>
