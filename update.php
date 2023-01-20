<?php
//セッション開始
session_start();
$genre = $_POST["genre"];
$title = $_POST["title"];
$review = $_POST["review"];
$date = $_POST["date"];
$coment = $_POST["coment"];
$id = $_POST['id']; // ←追加

// var_dump("$id");

//1. DB接続
require_once('funcs.php');
$dbConn = db_conn();



// UPDATE文にする
$stmt = $dbConn->prepare( 'UPDATE movie_log SET genre = :genre, title = :title, review = :review, coment = :coment, date = :date WHERE id = :id;' );

$stmt->bindValue(':genre', $genre, PDO::PARAM_STR);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':review', $review, PDO::PARAM_STR);
$stmt->bindValue(':coment', $coment, PDO::PARAM_STR);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);// 数値の場合 PDO::PARAM_INT
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    //*** function化する！*****************
    header('Location: read.php');
    exit();
}