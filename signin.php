<?php

require_once __DIR__ . '/functions.php';
require_unlogined_session();



// エラーを格納する配列を初期化
$errors = "初回のみ、任意の暗証番号でログインすると登録されます。";

// POSTのときのみ実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//$usernameと$passwordにPOSTされた値を格納
	foreach (['employee_id','password'] as $key) {
		$$key = filter_input(INPUT_POST, $key);
	}
	//(実際にはフォームで弾かれるが)社員番号またはパスワードが空欄のときはエラーで弾く。
	if ( $employee_id === "" || $password ==="" ) {
		$errors = "ユーザ名またはパスワードが入力されていません。";
	} else {
		//社員番号とパスワードが入力されているとき
		$employee_id = h($employee_id);		//エンティティ化(安全な文字列に変換)

		//DBに接続してemployee_idが一致するデータを検索
		$pdo = db_connect();
		$sql = 'SELECT * FROM employee WHERE employee_id = '.$employee_id;
		$stmh = $pdo->prepare($sql);
		$stmh->execute();
		$count=$stmh->rowCount();

		if($count>0){
			//employee_idが一致するデータがDBにあるとき、検索結果を$resultに格納
			$result = $stmh->fetch(PDO::FETCH_ASSOC);
			$employee_name = $result['employee_name'];		//ついでに社員名を変数に格納

			if(is_null($result['password_hash'])){
				//DBのpassword_hashがNULLだったら入力内容をDBに登録(初回登録)
				$password_hash = password_hash(h($password),PASSWORD_BCRYPT);
				$pdo->beginTransaction(); //トランザクション開始
				$sql = "UPDATE employee SET password_hash = :password_hash WHERE employee_id = :employee_id";
				$stmh = $pdo->prepare($sql);  //prepareメソッドで各テーブル名(password_hash,employee_id)に対しパラメータ(:password_hash,:employee_id)を与える。

				$stmh->bindValue(':employee_id',$employee_id,PDO::PARAM_INT);
				$stmh->bindValue(':password_hash',$password_hash,PDO::PARAM_STR);
				$stmh->execute(); //プリペアドステートメントの実行
				$pdo->commit(); //トランザクションをコミット
				$errors = "暗証番号を登録しました";
			} else {
				//DBのpasswrod_hashがNULLでなかったら、パスワードを認証
				if (password_verify($password, $result['password_hash'])){
					// 認証が成功
					// セッションIDの追跡を防ぐ
					session_regenerate_id(true);
					//社員番号と社員名をセッションにセット
					$_SESSION['employee_id'] = $employee_id;
					$_SESSION['employee_name'] = $employee_name;
					// ログイン後にindex.phpに遷移
					header ('Location: ./index.php');
					exit;
					}
					// 認証が失敗
	        $errors = "ユーザ名またはパスワードが違います";
			}
		} else{
			//employee_idが一致するデータがDBにないとき
			$errors = "存在しない社員番号です";
		}
	}
}

header ('Content-Type: text/html; charset=UTF-8');
?>

<!doctype html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="generator" content="">
		<link rel="icon" href="./img/favicon.ico">
		<title>物品管理ログインページ</title>

		<!-- Bootstrap core CSS -->
		<link href="./dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<style>
			.bd-placeholder-img {
				font-size: 1.125rem;
				text-anchor: middle;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}

			@media (min-width: 768px) {
				.bd-placeholder-img-lg {
					font-size: 3.5rem;
				}
			}
		</style>
		<!-- Custom styles for this template -->
		<link href="./dist/css/signin.css" rel="stylesheet">
	</head>

  <body class="text-center">

		<form class="form-signin" method="post" action="">
			<img class="mb-4" src="./img/img_title.png" alt="" width="144" height="144">
			<h1 class="h3 mb-3 font-weight-normal">物品管理　ログインページ</h1>
			<label for="inputEmail" class="sr-only">社員番号</label>
			<input type="text" name="employee_id" class="form-control" placeholder="社員番号" required autofocus>
			<label for="inputPassword" class="sr-only">暗証番号</label>
			<input type="password" name="password" class="form-control" placeholder="暗証番号" required>
			<button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
			<?php echo $errors; ?>
			<p class="mt-5 mb-3 text-muted">&copy; 2019 Raspberry Pi Meeting</p>
		</form>
	</body>
</html>
