<?php

//関数の定義 DB接続
function connect_to_db()
{
    // DB接続の設定
    // DB名は自分で設定したもの`gsacf_x00_00`にする
    $dbn = 'mysql:dbname=gsaf_d07_21;charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = '';

    try {
        // ここでDB接続処理を実行する
        return new PDO($dbn, $user, $pwd);//returneに変える
    } catch (PDOException $e) {
        // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }
}
