<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>LINE Backup Viewer</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div id="top_container">
      <h1>LINE Backup Viewer</h1>
      <p>スマートフォン版LINEアプリで保存したテキスト形式のトーク履歴バックアップファイルを見やすく表示します。</p>
      <form name="fileform" method="post" action="view.php" target="_blank" enctype="multipart/form-data">
        <div class="form_row">
          <label>バックアップファイル：</label>
          <input type="file" name="file" accept=".txt">
        </div>
        <div class="form_row">
          <label>自分のユーザー名：</label>
          <input type="text" name="username" value="" placeholder="">
        </div>
        <div class="form_row" style="text-align: center;">
          <input type="submit" value="送信">
        </div>
      </form>
      <h2>LINE Backup Viewerとは</h2>
      <p>LINE Backup Viewerは、スマートフォン内に保存されているLINEのトーク履歴データを使って、トーク履歴の始まりから終わりまでを自由に検索したりさかのぼったりして見返すことができるツールです。</p>
      <ul>
        <li>スマートフォン版LINEにトーク履歴のデータが残っていれば、すべてのメッセージを表示することができます。</li>
        <li>指定した日付にすぐジャンプすることができます。最新のメッセージからさかのぼる必要はありません。</li>
        <li>日ごとのメッセージ件数や、個人トーク、グループトークにおける人ごとのメッセージ件数・割合がわかります。</li>
      </ul>
      <p>トーク履歴は以下のように表示されます。日付ジャンプ機能やメッセージ件数の割合表示は実際に使って確かめてみてください。</p>
      <div id="line_container" style="width: 25rem; margin: 0 auto;">
        <header>
          <h2>パン屋さんのトーク履歴</h2>
        </header>
        <div id="messages">
          <div class="date">2017/10/01(日)</div>
          <div class="message message_left">
            <div class="name">パン</div>
            <div class="content">こんばんは</div>
            <div class="time">22:14</div>
          </div>
          <div class="date">2017/10/02(月)</div>
          <div class="message message_right">
            <div class="content">まだ起きてる人いる？</div>
            <div class="time">1:33</div>
          </div>
          <div class="message message_left">
              <div class="name">パン</div>
              <div class="content">起きてるよ</div>
            <div class="time">1:35</div>
          </div>
          <div class="message message_left">
            <div class="name">ライス</div>
            <div class="content">こんばんは</div>
            <div class="time">1:36</div>
          </div>
        </div>
      </div>
      <h2>使い方</h2>
      <ol>
        <li>お手持ちのスマートフォンでLINEアプリを起動し、トーク履歴を保存したいトークのトーク画面を開きます。</li>
        <li>トーク設定画面を開き、「トーク履歴をバックアップ」から「テキスト形式でバックアップ」を選択します。</li>
        <li>Googleドライブなど、パソコンからファイルを参照できる場所にバックアップファイルを保存します。</li>
        <li>このページを開き、バックアップファイルを選択します。</li>
        <li>トーク画面でメッセージを右側に表示するユーザーのユーザー名（基本的に自分のユーザー名）を入力します。</li>
        <li>「送信」ボタンをクリックすると、トーク履歴が新しいウィンドウ（タブ）で表示されます。</li>
        <li>右上の日付一覧のうちいずれかの日付をクリックすると、その日付のメッセージにジャンプします。</li>
        <li>右下にはメッセージの送信者ごとの件数と割合が円グラフで表示されます。</li>
      </ol>
      <h2>注意事項</h2>
      <ul>
        <li>このツールはパソコン専用です。また、Internet ExplorerとEdgeには対応していません。動作確認環境はGoogle Chrome 63です。</li>
        <li>バックアップファイルに含まれるメッセージ件数にかかわらずすべてのメッセージを一度に表示するため、メッセージ件数の多いトーク履歴を送信すると、表示に時間がかかったり、動作が重くなったりすることがあります。</li>
        <li>スマートフォン版LINEアプリの見た目に似せたデザインになっていますが、送信者のアイコン画像が表示されなかったり、フォントが環境に依存したものになったりして忠実な再現にはなっていないため、故意に編集されたトーク履歴ファイルを使ってもLINEの画面を偽装することはできません。</li>
        <li>選択したバックアップファイルは一時的にサーバーにアップロードされますが、メッセージを読み込む作業中に使われるもので、処理が終わると同時に自動的に削除されます。そのため、サーバー上にプライバシーに関わるデータが残ることはありません。ただし、送信ボタンをクリックした後、ページがすべて表示されるまでの処理中に画面を閉じた場合に関しては、確実なファイル削除が保証できないため、処理中に画面を閉じないようにしてください。</li>
      </ul>
    </div>
  </body>
</html>
