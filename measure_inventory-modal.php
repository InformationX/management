<?php

require_once __DIR__ . '/functions.php';
require_logined_session();
header ('Content-Type: text/html; charset=UTF-8');

$measureId = [];
foreach($_POST as $value){
	$measureId[] = $value;
}

?>

<!doctype html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="./img/favicon.ico">

		<title>測定器の棚卸し</title>

		<!-- Bootstrap core CSS -->
		<link href="./dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="./dist/css/index.css" rel="stylesheet">
	</head>
	<body>

		<header>
			<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
				<a class="navbar-brand" href="./index.php">物品管理TOP</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">測定器</a>
							<div class="dropdown-menu" aria-labelledby="dropdown05">
								<a class="dropdown-item" href="./measure_inventory.php">棚卸し</a>
								<a class="dropdown-item disabled" href="#">持ち出し管理</a>
								<a class="dropdown-item disabled" href="#">予約</a>
								<a class="dropdown-item disabled" href="#">登録・廃棄</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">サンプル</a>
							<div class="dropdown-menu" aria-labelledby="dropdown05">
								<a class="dropdown-item disabled" href="#">棚卸し</a>
								<a class="dropdown-item disabled" href="#">持ち出し管理</a>
								<a class="dropdown-item disabled" href="#">登録・廃棄</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">部品</a>
							<div class="dropdown-menu" aria-labelledby="dropdown05">
								<a class="dropdown-item disabled" href="#">検索</a>
								<a class="dropdown-item disabled" href="#">持ち出し管理</a>
								<a class="dropdown-item disabled" href="#">登録・廃棄</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">IT資産</a>
							<div class="dropdown-menu disabled" aria-labelledby="dropdown05">
								<a class="dropdown-item disabled" href="#">棚卸し</a>
								<a class="dropdown-item disabled" href="#">登録・廃棄</a>
							</div>
						</li>
					</ul>

					<form class="form-inline mt-2 mt-md-0" method="post" action="signout.php">
						<ul class="navbar-nav mr-auto"><li class="nav-item mr-sm-2 text-light">ようこそ　<?php echo $_SESSION['employee_name']; ?>　さん</li></ul>
						<button class="btn btn-outline-info my-2 my-sm-0" type="submit" name="signout" value="signout">ログアウト</button>
					</form>
				</div>
			</nav>
		</header>

		<main role="main">

			<div class="container-fluid">

				<div class="row">
					<div class="col-lg-12 mt-5 mb-5 text-center">
						<h1 class="featurette-heading1">測定器の棚卸し</h1>
					</div>
				</div>

				<hr class="featurette-divider">

				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">管理番号を登録して棚卸しする</button>
				<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">管理番号を入力して棚卸しをする</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form class="form-invenroty" method="post" action="">
									<div class="textboxArea">
										<input type="text" class="form-control textbox-inventory" name="id-001" placeholder="管理番号を入力してください">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger add" id="addButton">欄を追加</button>
									<button type="button" onclick="submit()" name="Registration" class="btn btn-primary">登録へ進む</button>
								</form>
							</div>
						</div>
					</div>
				</div>

				<p>
					<?php
						foreach($measureId as $value){
							echo $value;
							echo "<br>";
						}
					?>
				</p>


				<!-- FOOTER -->
				<footer class="container mt-5 mb-5">
					<p class="float-right"><a href="#">トップへ戻る</a></p>
					<p>&copy; 2019 Raspberry Pi Meeting &middot; <a href="#">***</a> &middot; <a href="#">***</a></p>
				</footer>
			</main>

			<!-- Bootstrap core JavaScript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script>window.jQuery || document.write('<script src="./dist/js/jquery-slim.min.js"><\/script>')</script>
			<script src="./dist/js/popper.min.js"></script>
			<script src="./dist/js/bootstrap.min.js"></script>
			<script src="./dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
			<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
			<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
			<script src="./dist/js/holder.min.js"></script>

			<script type="text/javascript">
			//id="addButton"のボタンクリック動作を記述
			$("#addButton").click(function() {
				var nameId = ("000" + (Number($(".textbox-inventory:last").attr("name").slice(-3)) + 1)).slice(-3);
				$(".textboxArea").append('<input type="text" class="form-control textbox-inventory" name="id-' + nameId + '"placeholder="管理番号を入力してください">');
				$(".textbox-inventory:last").focus();
			});

			//"mytextbox"クラスでEnterキーが押されたら、id="addButton"のボタンクリック動作を行う
			$(".textboxArea").keypress(function(e){
				if(e.which == 13){
					$("#addButton").click();
				}
			});

			$("#modal1").on("shown.bs.modal", function () {
				$(".textbox-inventory:last").focus();
			});

		</script>
	</body>
</html>
