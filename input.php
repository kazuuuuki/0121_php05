<?php
//セッション開始
session_start();
require_once('funcs.php');
loginChk();

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
    <form action="confirm.php" method="post" class="form" enctype="multipart/form-data">
    <h1 class="main_title">#徒然映画記</h1>
    <a href="read.php" class="conf">記録を確認</a>

        <!-- ジャンルの入力 -->
        <div class="genre_all content">
            <?php
            $genres = array("アクション", "コメディ", "ヒューマンドラマ", "サスペンス", "SF", "スポーツ", "ホラー", "ミリタリー", "ミュージカル", "ラブロマンス", "社会派");
            ?>
            <select name="genre" class="genre">
               <option value="未選択">ジャンルを選択</option> 
               <?php
                foreach ($genres as $genre){
                   echo "<option value='{$genre}'>{$genre}</option>";
                }
               ?>
            </select>
        </div>
        <!-- 作品名の入力 -->
        <div class="title_all content">
            <input type="text" name="title" placeholder="作品名" class="title">
        </div>
        <!-- 評価の入力 -->
        <div class="review_all content">
            <?php
            $reviews = array("★","★★","★★★","★★★★","★★★★★");
            ?>
            <select name="review" class="review">
                <option value="未選択">スコアを入力</option>
                <?php
                foreach($reviews as $review){
                    echo "<option value='{$review}'>{$review}</option>";
                }
                ?>
            </select>
        <!-- コメント入力 -->
        </div>
        <div class="coment_all content">
            <textarea class="coment" name="coment" rows="4" cols="40" placeholder="レビュー"></textarea>
        </div>
        <!-- 鑑賞日の入力 -->
        <div class="date_all content">
            <input type="date" name="date" class="date" >
            <p class="data_text">(鑑賞日を入力)</p>
        </div>
        <!-- 画像アップロード -->
        <label>
        <div class="img_all content">
            <span class="img_label" title="ファイル選択">
                <img src="../kadai_movie/img/input_movie.png" >
                <p class="img_text">画像選択</p>
            </span>
            <input type="file" name="img" class="img">
        </div>
        </label>
        <!-- 送信ボタン -->
        <div class="sent_all">
            <button value="登録" class="sent">登録</button><br>
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
