<?php
function require_unlogined_session () {
    // セッション開始
    @session_start();
    // ログインしていれば
    if (isset($_SESSION["employee_id"])) {
        header('Location: ./index.php');
        exit;
    }
}

function require_logined_session() {
    // セッション開始
    @session_start();
    // ログインしていなければlogin.phpに遷移
    if (!isset($_SESSION["employee_id"])) {
        header('Location: ./signin.php');
        exit;
    }
}

function db_connect(){
	$dbtype  = 'mysql';
	$host    = 'localhost';
	$db      = 'management';
	$charset = 'utf8';

	$dsn = "$dbtype:host=$host; dbname=$db; charset=$charset";

	try{
		$pdo = new PDO ( $dsn, 'raspberry', 'pi' );
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
	}catch(PDOException $Exception){
		die('エラー:'.$Exception->getMessage());
	}
return $pdo;
}

// htmlspecialchars
function h ($var) {
    if (is_array($var)){
        return array_map(h, $var);
    } else {
        return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
    }
}
