<?php
//セッション開始
session_start();

//画像データ格納
$editIMG = '<img src="img/edit.png">';
$deleteIMG = '<img src="img/delete.png">';

require_once('funcs.php');
//認証チェック
loginChk();

//1. DB接続
$dbConn = db_conn();

//2. データ取得SQL作成
$stmt = $dbConn->prepare("SELECT * FROM movie_log");
$status = $stmt->execute();

//3. データ表示
$view = "";
if($status == false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {
    //elseの中はSQLを実行成功した場合
    //selectデータの数だけ自動でループしてくれる
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .=
            '<ul class="ac">' .
            '<li class="ac-parent">'.'🎬 ' . h($result["title"]) .' 🎬</li>'.
            '<li class="ac-child"><div class="ac-wrap"><div class="ac-hl">【ジャンル】</div>' .
            '<p>' . h($result["genre"]) . '</p></div><hr>' .
            '<div class="ac-wrap"><div class="ac-hl">【スコア】</div>' .
            '<p>' . h($result["review"]) . '</p></div><hr>' .
            '<div class="ac-wrap"><div class="ac-hl">【鑑賞日】</div>' .
            '<p>' . h($result["date"]) . '</p></div><hr>' .
            '<div class="ac-wrap"><div class="ac-hl">【レビュー】</div>' .
            '<p>' . h($result["coment"]) . '</p></div>'.
            '<img src="../kadai_movie/movie_img/'.$content['img'].'">'. //画像反映
            '<a href="detail.php?id='.$result["id"].' "class="edit">'.
            $editIMG.'</a><a href="delete.php?id='.$result["id"].' "class="delete">'.
            $deleteIMG.'</a></li></ul>';
    }

}

?>

<html>
<head>
    <meta charset="utf-8">
    <title>読み込み用</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="main_wrapper">
        <h1 class="main_title read_title">#徒然映画記</h1>
        <a href="input.php" class="entry">記録する</a>
        <a href="logout.php" class="entry">ログアウト</a>
    
    </header>
    <div class="write_wrapper">
        <?= $view ?>    
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="read.js"></script>
</body>

</html>