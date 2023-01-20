<?php
//セッション開始
session_start();

$id = $_GET['id'];
$genre = $_POST["genre"];
$title = $_POST["title"];
$review = $_POST["review"];
$date = $_POST["date"];
$coment = $_POST["coment"];

require_once('funcs.php');

//ログイン認証
loginChk();

//DB接続
$dbConn = db_conn();

// var_dump("$id");

//データ取得
// WHERE id=:idを利用して、１つだけ情報を取得してください。
$stmt = $dbConn->prepare('SELECT * FROM movie_log WHERE id=:id;');
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();


//データ表示
$result = '';
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();
}

?>


<html>
<head>
    <meta charset="utf-8">
    <title>大切なことは全て映画が教えてくれた</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/movieJS.css">
</head>

<body>
    <!-- フォームラッパー -->
    <div class="form_wrapper">
    <!-- フォーム開始 -->
    <form action="update.php" method="post" class="form">
    <h1 class="main_title">#徒然映画記</h1>
    <a href="read.php" class="conf">記録を確認</a>

        <!-- ジャンルの入力 -->
        <div class="genre_all content">
            <?php
            $genres = array("アクション", "コメディ", "ヒューマンドラマ", "サスペンス", "SF", "スポーツ", "ホラー", "ミリタリー", "ミュージカル", "ラブロマンス", "社会派");
            ?>
            <select name="genre" class="genre" >
               <option value="<?= $result["genre"] ?>"><?= $result["genre"] ?></option> 
               <?php
                foreach ($genres as $genre){
                   echo "<option value='{$genre}'>{$genre}</option>";
                }
               ?>
            </select>
        </div>
        <!-- 作品名の入力 -->
        <div class="title_all content">
            <input type="text" name="title" placeholder="作品名" class="title" value="<?= $result["title"] ?>">
        </div>
        <!-- 評価の入力 -->
        <div class="review_all content">
            <?php
            $reviews = array("★","★★","★★★","★★★★","★★★★★");
            ?>
            <select name="review" class="review">
                <option value="<?= $result["review"]?>"><?= $result["review"]?></option>
                <?php
                foreach($reviews as $review){
                    echo "<option value='{$review}'>{$review}</option>";
                }
                ?>
            </select>
        </div>
        <div class="coment_all content">
            <textarea class="coment" name="coment" rows="4" cols="40" placeholder="レビュー"><?= $result["coment"] ?></textarea>
        </div>
        <!-- 鑑賞日の入力 -->
        <div class="date_all content">
            <input type="date" name="date" class="date" value="<?= $result["date"] ?>">
            <p class="data_text">(鑑賞日を入力)</p>
        </div>
        <!-- 送信ボタン -->
        <div class="sent_all">
            <input type="hidden" name="id" value="<?= $result['id'] ?>">
            <button value="更新" class="sent">更新</button><br>

        </div>
    </form>
    </div>
    <!-- フォームラッパーここまで -->


    <!-- 検索エリア -->
    <form id="form_search">
        <input type="text" placeholder="Search" id="search" class="search">
    </form>

    <div id="main"></div>
    <!-- 検索エリアここまで -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="main.js"></script>
</body>

</html>