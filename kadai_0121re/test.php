//js

<div id="drop_zone">Drop files here</div>
<output id="list"></output>

JS

var dropZone = document.getElementById('drop_zone');
var fileList = document.getElementById('list');

// ドラッグオーバー時に drop_zone の背景色を変更する
dropZone.addEventListener('dragover', function(e) {
e.preventDefault();
e.stopPropagation();
dropZone.style.background = '#eee';
});

// ドラッグアウト時に drop_zone の背景色を戻す
dropZone.addEventListener('dragleave', function(e) {
e.preventDefault();
e.stopPropagation();
dropZone.style.background = '#fff';
});

// ドロップ時に files を取得し、出力する
dropZone.addEventListener('drop', function(e) {
e.preventDefault();
e.stopPropagation();
dropZone.style.background = '#fff';

var files = e.dataTransfer.files;
for (var i = 0; i < files.length; i++) {
fileList.innerHTML += '<li>' + files[i].name + '</li>';
}
});

//php
<form action="upload.php" method="post" enctype="multipart/form-data">
<input type="file" name="image" id="image">
<input type="submit" value="Upload">
</form>


<?php

session_start();
require_once('funcs.php');

//1. POSTデータ取得
$name = $_POST['name'];
$name_kana = $_POST['name_kana'];
$sex = $_POST['sex'];
$birthday = $_POST['birthday'];
$postal_code = $_POST['postal_code'];
$address = $_POST['address'];
// $map = $_POST['map'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$primary_school = $_POST['primary_school'];
$parent_name = $_POST['parent_name'];
$parent_kana = $_POST['parent_kana'];
$workplace = $_POST['workplace'];
$workplace_phone_number = $_POST['workplace_phone_number'];
$parent_phone_number = $_POST['parent_phone_number'];
$health_level = $_POST['health_level'];
$club = $_POST['club'];
$request = $_POST['request'];


//2. DB接続します

require_once('funcs.php');
$pdo = db_conn();


//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO gs_an_table_0107(
name, name_kana, sex, birthday, postal_code,address,map,phone_number,email,
primary_school,parent_name,parent_kana,workplace,
workplace_phone_number,parent_phone_number,health_level,club,request,indate
)
VALUES (
:name, :name_kana, :sex, :birthday, :postal_code,:address,:map,:phone_number,:email,
:primary_school,:parent_name,:parent_kana,:workplace,
:workplace_phone_number,:parent_phone_number,:health_level,:club,:request,sysdate()
);'
);

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':name_kana', $name_kana, PDO::PARAM_STR);
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
$stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);
$stmt->bindValue(':postal_code', $postal_code, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':map', $map, PDO::PARAM_STR);
$stmt->bindValue(':phone_number', $phone_number, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':primary_school', $primary_school, PDO::PARAM_STR);
$stmt->bindValue(':parent_name', $parent_name, PDO::PARAM_STR);
$stmt->bindValue(':parent_kana', $parent_kana, PDO::PARAM_STR);
$stmt->bindValue(':workplace', $workplace, PDO::PARAM_STR);
$stmt->bindValue(':workplace_phone_number', $workplace_phone_number, PDO::PARAM_STR);
$stmt->bindValue(':parent_phone_number', $parent_phone_number, PDO::PARAM_STR);
$stmt->bindValue(':health_level', $health_level, PDO::PARAM_STR);
$stmt->bindValue(':club', $club, PDO::PARAM_STR);
$stmt->bindValue(':request', $request, PDO::PARAM_STR);

$status = $stmt->execute(); //実行


// ４．データ登録処理後
if ($status === false) {
// *** function化する！******\
$error = $stmt->errorInfo();
exit('SQLError:' . print_r($error, true));
} else {
// *** function化する！*****************
header('Location: index.php');
exit();
}
このコードのエラー原因を追求して