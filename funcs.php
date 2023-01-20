<?php

//XSS対応
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}


//db接続
function db_conn(){
    try{
        $pdo = new PDO('mysql:dbname=hw_0114;charset=utf8;host=localhost', 'root', '');
        return $pdo;
    } catch (PDOException $e){
        exit('DB接続失敗:' . $e->getMessage());
    }
}

//ログインチェック処理
function loginChk(){
    if(!isset($_SESSION['chk_ssid'])||$_SESSION['chk_ssid']!= session_id()){
        exit('ろぐいんしっぱい');
    }else{
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}