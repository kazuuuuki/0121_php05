<?php
session_start();
$_POST['name'] = $_SESSION['name'];
$email = $_POST['email'];
$lpw = $_POST['lpw'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/login.css">
    <title>ログイン/会員登録</title>
</head>
<body>
    <!-- <h1>徒然映画記</h1> -->

<div class="form_area">
    <!-- 会員登録フォーム開始 -->
    <div class="form_wrap">
        <form class="form" name="login_form" action="signup.php" method="post">
            <fieldset>
                <legend>Sign up</legend>
                <label><input type="text" name="name" placeholder="Name"></label><br>
                    <?php if(isset($_GET['errorname'])||isset($_GET['errorne'])||isset($_GET['errornel'])||isset($_GET['errornl'])): ?>
                        <p class="text-error">名前を入力してください</p>
                    <?php endif ?>
                <label><input type="text" name="email" placeholder="Email"></label><br>
                <?php if(isset($_GET['erroremail'])||isset($_GET['errorne'])||isset($_GET['errornel'])||isset($_GET['errorel'])): ?>
                        <p class="text-error">アドレスを入力してください</p>
                    <?php endif ?>
                <label><input type="password" name="lpw" placeholder="Password"></label><br>
                <?php if(isset($_GET['errorlpw'])||isset($_GET['errorel'])||isset($_GET['errornel'])||isset($_GET['errornl'])): ?>
                        <p class="text-error">パスワードを入力してください</p>
                    <?php endif ?>
                <input type="submit" value="Sign up">
            </fieldset>
        </form>
    </div>
    <!-- ログインフォーム開始 -->
    <div class="form_wrap">
        <form class="form" name="login_form" action="login_act.php" method="post">
            <fieldset>
                <legend>Log in</legend>
                <label><input type="text" name="email" placeholder="Email"></label><br>
                <label><input type="password" name="lpw" placeholder="Password"></label><br>
                <input type="submit" value="Log in">
            </fieldset>
        </form>
    </div>
</div>

<!-- フォーム終了 -->
<footer>©︎徒然映画記</footer>
</body>
</html>