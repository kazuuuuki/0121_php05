<?php

$id = $_GET['id'];

//1. DB接続
require_once('funcs.php');
$dbConn = db_conn();


//データ取得
// WHERE id=:idを利用して、１つだけ情報を取得してください。
$stmt = $dbConn->prepare('DELETE FROM movie_log WHERE id=:id;');
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();


if($status === false){
    //SQL実行時にエラーがある場合(エラーオブジェクト取得して表示)
    $error = $stmt->errorInfo();
    exit('ErrorMessage:' . $error[2]);
}else{
    //5. input.phpへリダイレクト
    header("Location:read.php");
    exit();
}


?>
