<?php
session_start();
$name = $_POST['name'];
$email = $_POST['email'];
$lpw = $_POST['lpw'];

//1.接続
require_once('funcs.php');
$dbConn = db_conn();

//2.データ登録SQL作成
$sql = "SELECT * FROM user_data WHERE email=:email";
$stmt = $dbConn->prepare($sql); //prepare()メソッドでSQLと接続
$stmt->bindvalue(':email',$email); //bindvalueメソッドでPDOプレースホルダと変数を紐づける
// $stmt->bindvalue(':lpw',$lpw); //↑に同じく
$res = $stmt->execute(); //execute()メソッドで取得したデータを"true"or"false"で返す

//SQL実行時にエラーがある場合
if($res === false){ //execute()メソッドが実行に失敗した場合
    $error = $stmt->errorInfo(); //errorInfo()は実行時に発生したエラーに関する詳細情報を返す
        exit("QueryError:" . $error[2]);
}

//3.抽出データ数を取得
$val = $stmt->fetch(); //fetchメソッドでPDOデータから1レコードのみ取得

//4.該当レコードがあればSESSIONに値を代入
if($val["id"] != "" && password_verify($lpw,$val['lpw'])){
    $_SESSION["chk_ssid"] = session_id(); //sessionIDを発行して"chk_ssid"に代入
    $_SESSION["name"] = $val['name']; //"name"にDBにあるnameの値を代入
    //Login処理OKの場合select.phpへ遷移
    header("Location: read.php");
} else{
    //Login処理NGの場合login.phpへ遷移
    header("Location: login.php");
}
//処理終了
exit();
