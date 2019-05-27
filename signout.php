<?php
require_once __DIR__ . '/functions.php';
require_logined_session();

// セッション用Cookieの破棄
setcookie(session_name(), '', 1);
// セッションファイルの破棄
session_destroy();
// ログアウト完了後に/login.phpに遷移
header ('Location: ./signin.php');
