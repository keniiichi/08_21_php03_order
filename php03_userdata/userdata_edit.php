<?php
// var_dump($_GET);
// exit();


// 関数ファイル読み込み
include("functions.php");

// 送信されたidをgetで受け取る
$id = $_GET['id'];

// DB接続&id名でテーブルから検索
$pdo = connect_to_db();
$sql = 'SELECT * FROM users_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー管理（編集画面）</title>
</head>

<body>
  <form action="userdata_update.php" method="POST">
    <fieldset>
      <legend>ユーザー管理（編集画面）</legend>
      <a href="userdata_read.php">一覧画面</a>
      <!-- タグに初期値として設定 -->
      <div>
        名前: <input type="text" name="username" value="<?= $record["username"] ?>">
      </div>
      <div>
        パスワード: <input type="text" name="password" value="<?= $record["password"] ?>">
      </div>
      <!-- id を type="hidden"を使って見えないように送る -->
      <input type="hidden" name="id" value="<?= $record['id'] ?>">
      <div>
        <button>更新</button>
      </div>

    </fieldset>
  </form>

</body>

</html>