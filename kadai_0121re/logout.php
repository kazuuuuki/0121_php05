<?php
session_start();
//sessionを初期化
$_SESSION = array();

//Cookieに保存してあるsessionIDを破棄
if (isset($_COOKIE[session_name()])){
    setcookie(session_name(), '', time() - 42000, '/');
}

//サーバー側でのセッションIDの破棄
session_destroy();

//処理後、login.phpへ遷移
header("Location: login.php");
exit();
