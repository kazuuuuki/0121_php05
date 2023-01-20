<?php
session_start();
$name = $_POST['name'];
$email = $_POST['email'];
$lpw = $_POST['lpw'];

//バリデーション
if(trim($name)===''){
    header('location: login.php?errorname');
}
if(trim($email)===''){
    header('location: login.php?erroremail');
}
if(trim($lpw)===''){
    header('location: login.php?errorlpw');
}
if(trim($name)===''&& trim($email)===''){
    header('location: login.php?errorne');
}
if(trim($name)===''&& trim($lpw)===''){
    header('location: login.php?errornl');
}
if(trim($email)===''&& trim($lpw)===''){
    header('location: login.php?errorel');
}
if(trim($name)===''&& trim($email)===''&& trim($lpw)===''){
    header('location: login.php?errornel');
}

//pwハッシュ化
$hashedPW = password_hash($lpw, PASSWORD_DEFAULT);

//func呼び出し
require_once('funcs.php');

//DB接続
$dbConn = db_conn();


//DB登録

$stmt = $dbConn->prepare(
    'INSERT INTO user_data(id,name,email,lpw,date)
    VALUES(NULL,:name,:email,:lpw,CURRENT_TIMESTAMP)'
);
$stmt->bindValue(':name',$name,PDO::PARAM_STR);
$stmt->bindValue(':email',$email,PDO::PARAM_STR);
$stmt->bindValue(':lpw',$hashedPW,PDO::PARAM_STR);
$res = $stmt->execute();

// //データ登録処理後
if($res === false){
    $error = $stmt->errorInfo();
    echo "<script>alert('とうろくしっぱい');</script>";
    exit('えらーめっせーじ：' . print_r($error, true));
}else{
    echo "<script>alert('とうろくかんりょう★ろぐいんしてね');</script>";
    echo "<script>setTimeout(function(){ location.href='login.php' }, 1000);</script>";
    // header('Location:login.php');
}