<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>LINE Backup Viewer</title>
  </head>
  <body>
    <h1>LINE Backup Viewer</h1>
    <form name="fileform" method="post" action="view.php" target="_blank" enctype="multipart/form-data">
      <label>自分の名前：<input type="text" name="username" value="" placeholder="LINEのユーザー名"></label>
      <label>バックアップファイル（テキスト形式）：<input type="file" name="file" accept="text/plain"></label>
      <input type="submit" value="送信">
    </form>
  </body>
</html>