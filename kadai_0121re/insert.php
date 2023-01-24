<?php
//insert.php
session_start();
//1. POSTデート取得
// $genre = $_GET["genre"];
$genre = $_POST['genre'];	
// $genre = filter_input(INPUT_POST, 'genre');//この形にする
// var_dump($genre);
// $title = ($_GET['title']);
$title = $_POST['title'];	
// $title = filter_input(INPUT_POST, 'title');
// var_dump($title);
// var_dump($title);
// $review = $_GET['review'] ;
$review = $_POST['review'];	
// $review = filter_input(INPUT_POST, 'review');
// var_dump($review);
// var_dump( $_POST['review'] );
// $date = $_GET['date'];
$date = $_POST['date'];	
// $date = filter_input(INPUT_POST, 'date');
// var_dump($date);
// $coment = $_GET['coment'];
$coment = $_POST['coment'];	
// $coment = filter_input(INPUT_POST, 'coment');
// var_dump($coment);
// exit;
// var_dump( $coment);
$img = $_FILES['img'];


//2. DB接続
require_once('funcs.php');
loginChk();
$dbConn = db_conn();
// ★★★★Macはimagesフォルダの書き込み権限を変更してください。★★★★
if ($_SESSION['post']['image_data'] !== "") {
    $img = date('YmdHis') . '_' . $_SESSION['post']['file_name'];
    file_put_contents("movie_img/$img", $_SESSION['post']['image_data']);
}
// echo '<pre>';
// var_dump($_SESSION['post']['image_data']);
// echo '</pre>';
//3-1. SQL文を用意
$stmt = $dbConn->prepare(
    'INSERT INTO
    movie_log(id,  genre , title , review , coment,  img, date)
    VALUES(null , :genre , :title , :review , :coment,  :img, :date)');
// echo '<pre>';
// var_dump($stmt);
// echo '</pre>';
//3-2. バインド変数を用意
$stmt->bindValue(':genre', $genre, PDO::PARAM_STR);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':review', $review, PDO::PARAM_STR);
$stmt->bindValue(':coment', $coment, PDO::PARAM_STR);
$stmt->bindValue(':img', $img, PDO::PARAM_STR);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
//3. 実行
$status = $stmt->execute();
echo '<pre>';
var_dump($status);
echo '</pre>';
//4. データ登録処理
if($status === false){
    //SQL実行時にエラーがある場合(エラーオブジェクト取得して表示)
    $error = $stmt->errorInfo();
    exit('ErrorMessage:' . $error[2]);
}else{
    //5. input.phpへリダイレクト
    $_SESSION['post'] = [];
    // redirect("read.php");
    header('Location: ' . 'read.php', true, 303);//この形にする
}
?>