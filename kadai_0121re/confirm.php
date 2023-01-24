<?php
// confirm.phpの中身は、ほとんどpost.phpに似ています。
session_start();
require_once('funcs.php');

loginChk();

// post受け取る
$genre = $_POST['genre'];
$title = $_POST['title'];
$review = $_POST['review'];
$coment = $_POST['coment'];
$date = $_POST['date'];
$_SESSION['post']['title'] = $_POST['title'];
$_SESSION['post']['genre'] = $_POST['genre'];
$_SESSION['post']['review'] = $_POST['review'];
$_SESSION['post']['coment'] = $_POST['coment'];
$_SESSION['post']['date'] = $_POST['date'];

// formで送られてきたら
if ($_FILES['img']['name'] !== '') {
    $file_name = $_SESSION['post']['file_name'] = $_FILES['img']['name'];
    $image_data = $_SESSION['post']['image_data'] = file_get_contents($_FILES['img']['tmp_name']);
    $image_type = $_SESSION['post']['image_type'] = exif_imagetype($_FILES['img']['tmp_name']);

// ファイルで送らないけどセッションの中にデータがあれば
} elseif($_FILES['img']['name'] === '' && $_SESSION['post']['image_data'] !== '') {
    $file_name = $_SESSION['post']['file_name'];
    $image_data = $_SESSION['post']['image_data'];
    $image_type = $_SESSION['post']['image_type'];

// formにも、セッションにも何もデータがなければ。
} else {
    $file_name = $_SESSION['post']['file_name'] = '';
    $image_data = $_SESSION['post']['image_data'] = '';
    $image_type = $_SESSION['post']['image_type'] = '';
}

// // 簡単なバリデーション処理。
// if (trim($title) === '' || trim($content) === '') {
//     redirect('input.php?error');
// }

// imgある場合
// 添付ファイルの拡張子を確認する。
// if (!empty($file_name)) {
//     $extension = substr($file_name, -3);
//     if ($extension != 'jpg' && $extension != 'gif' && $extension != 'png') {
//         redirect('input.php?error=1');
//     }
// }
?>

<!DOCTYPE html>
<html lang="ja">


<body>
    <form method="POST" action="insert.php" enctype="multipart/form-data" class="mb-3">
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="hidden" name="title" value="<?= $title ?>">
            <p><?= $title ?></p>
            <label for="genre" class="form-label">ジャンル</label>
            <input type="hidden" name="genre" value="<?= $genre ?>">
            <p><?= $genre ?></p>
            <label for="review" class="form-label">評価</label>
            <input type="hidden" name="review" value="<?= $review ?>">
            <p><?= $review ?></p>
            <label for="coment" class="form-label">コメント</label>
            <input type="hidden" name="coment" value="<?= $coment ?>">
            <p><?= $coment ?></p>
            <label for="date" class="form-label">鑑賞日</label>
            <input type="hidden" name="date" value="<?= $date ?>">
            <p><?= $date ?></p>
        </div>
        <label for="img" class="form-label"></label>
        <input type="hidden" name="img" value="<?= $img ?>">
        <?php if ($image_data) :?>
            <div class="mb-3">
                <img src="image.php">
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">投稿</button>
    </form>

    <a href="input.php?re-register=true">前の画面に戻る</a>
</body>
</html>