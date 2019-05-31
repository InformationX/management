<?php

require_once __DIR__ . '/functions.php';
require_logined_session();
header ('Content-Type: text/html; charset=UTF-8');

//配列の宣言
$measureId = [];
$inventory_info =[];

//変数の宣言
$floor = "0";
$ew = "0";
$ns = "0";
$placeDetail = "";
$measureQty = 0;

//DBに接続して棚卸し時期を取得
$pdo = db_connect();
$sql = 'SELECT * FROM inventory order by inventory_id desc limit 1';
$stmh = $pdo->prepare($sql);
$stmh->execute();
$inventory_info = $stmh->fetch(PDO::FETCH_ASSOC);

// POSTのときのみ実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//POSTされた場所データを変数に代入
	$floor = $_POST["floor"];
	$ew = $_POST["ew"];
	$ns = $_POST["ns"];
	$placeDetail = h($_POST["placeDetail"]);
	//場所ボタンが押されたら
	if($_POST["info"] === "place"){
		//現状は特に何もしない

	//idの登録ボタンが押されたら
	}else if($_POST["info"] === "registration"){
		//POSTされたデータのうち、管理番号のみ$measureId[]に格納
		//keyの頭が"id"かつ、valueが空欄でないとき、$measureIdに管理番号を登録
		foreach($_POST as $key => $value){
			if(substr($key,0,2) === "id"){
				if($value != ""){
					$measureId[] = $value;
				}
			}
		}
		//$measureIdに登録した管理番号の数を格納
		$measureQty = count($measureId);
		//$measureIdの内容をDBに登録&関連情報取得
		foreach($measureId as $key){
			$sql_inventory = 'SELECT measure.measure_id, measure.measure_name, measure.measure_inventory_code, employee.employee_name, inventory.inventory_name
			FROM ((measure LEFT OUTER JOIN employee ON measure.measure_administrator_id = employee.employee_id)
			LEFT OUTER JOIN inventory ON measure.measure_inventory_id = inventory.inventory_id)
			WHERE measure.measure_id = "' .$key.'"';

			$stmh_inventory = $pdo->prepare($sql_inventory);
			$stmh_inventory -> execute();
			$temp = $stmh_inventory->fetch(PDO::FETCH_ASSOC);

			$inventory_info[] = array("id"=>$temp["measure_id"]);
		}


		$sql_emp = 'SELECT * FROM employee';
		$stmh_emp = $pdo->prepare($sql_emp);
		$stmh_emp->execute();
		while($hoge = $stmh_emp->fetch(PDO::FETCH_ASSOC)){
			$emp[] = $hoge;
		}
	}
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

				<div class="row">
					<div class="col-sm-10 mx-auto text-center">
						<h4>今回の棚卸しは「 <?=$inventory_info["inventory_name"];?> 」です。</h3>
					</div>
				</div>

				<hr class="featurette-divider">

				<div class="row">
					<div class="col-sm-11 mx-auto">
					<h3 class="mb-3">STEP1　棚卸し場所の設定</h3>

					<form class="needs-validation" method="post">
						<div class="col-sm-4 mb-3">
							<label for="country">フロア</label>
							<select class="custom-select d-block w-100" onchange="selFloor(this);" name="floor">
								<option value="0">選んでください</option>
								<?php
								for($i = 1;$i < 8;$i++){
									if($i === intval($floor)){
										echo '<option value="' . $i . '" selected>' . $i . '階</option>';
									} else {
										echo '<option value="' . $i . '">' . $i . '階</option>';
									}
								}
								 ?>
							</select>
							<div class="invalid-feedback">
								Please select a valid country.
							</div>
						</div>
						<div class="col-sm-4 mb-3">
							<div class="row">
								<div class="col-md-6">
									<label for="state">柱位置(東西)</label>
									<select class="custom-select d-block w-100" name ="ew">
										<option value="0">選んでください</option>
										<?php
										for($i = 1;$i < 15;$i++){
											if($i === intval($ew)){
												echo '<option value="' . $i . '" selected>' . $i . '</option>';
											} else {
												echo '<option value="' . $i . '">' . $i . '</option>';
											}
										}
										 ?>
									</select>
								</div>
								<div class="col-md-6">
									<label for="state">柱位置(南北)</label>
									<select class="custom-select d-block w-100" name="ns">
										<option value="0">選んでください</option>
										<?php
											if($ns === "1"){
												echo '<option value="1" selected>A(小野測器側)</option>';
											} else {
												echo '<option value="1">A(小野測器側)</option>';
											}
											if($ns === "2"){
												echo '<option value="2" selected>B(中央)</option>';
											} else {
												echo '<option value="2">B(中央)</option>';
											}
											if($ns === "3"){
												echo '<option value="3" selected>C(線路側)</option>';
											} else {
												echo '<option value="3">C(線路側)</option>';
											}
										 ?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-4 mb-3">
							<label for="zip">場所の詳細</label>
							<input type="text" class="form-control" name="placeDetail" placeholder="" value="<?= $placeDetail ?>">
						</div>
						<button type="submit" class="btn btn-primary mx-3" name="info" value="place">場所を確定</button>
						<?php
						if($floor === "1" || $floor === "2" || $floor === "3" || $floor === "4" || $floor === "5" || $floor === "6" || $floor === "7"){
							echo '<button type="button" class="btn btn-primary mx-3" data-toggle="modal" data-target="#modal3" id="map">地図を表示</button>';
						} else{
							echo '<button type="button" class="btn btn-primary mx-3" data-toggle="modal" data-target="#modal3" id="map" disabled>地図を表示</button>';
						}
						 ?>

						<!-- 地図のモーダルウィンドウ -->
						<div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="label3" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="label3">白山<?=$floor?>階地図</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="img_floor">
										<img class="mb-4" src="./img/img_<?=$floor?>F.JPG" alt="" width="100%">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<!-- 地図のモーダルウィンドウ　ここまで -->

					</form>
				</div>
			</div>

				<hr class="featurette-divider">

				<div class="row">
					<div class="col-sm-11 mx-auto">
						<h3>STEP2　棚卸し物品の登録</h3>
						<?php
							if($floor && $ew && $ns){
								echo '<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modal1">管理番号を登録して棚卸しする</button>';
							} else{
								echo '<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modal1" disabled>管理番号を登録して棚卸しする</button>';
							}
						 ?>

						<!-- 管理番号登録のモーダルウィンドウ -->
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
												<input type="hidden" class="form-control textbox-inventory" name="info" value="registration">
												<input type="hidden" class="form-control textbox-inventory" name="floor" value="<?=$floor?>">
												<input type="hidden" class="form-control textbox-inventory" name="ew" value="<?=$ew?>">
												<input type="hidden" class="form-control textbox-inventory" name="ns" value="<?=$ns?>">
												<input type="hidden" class="form-control textbox-inventory" name="placeDetail" value="<?=$placeDetail?>">
												<input type="text" class="form-control textbox-inventory" name="id-001" placeholder="管理番号を入力してください">
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-danger add" id="addButton">欄を追加</button>
											<button type="button" class="btn btn-primary" onclick="submit()">登録</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- 管理番号登録のモーダルウィンドウ　ここまで -->
					</div>
				</div>

				<p>
					<?php
						print_r($_POST);
						echo "<br>";
						print_r($measureId);
						echo "<br>";
						print_r($temp);
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

			//フロア選択時にモーダルの地図を反映
			function selFloor(obj){
				if(obj.value == "1"){
					$("#label3").html("白山1階地図");
					$(".img_floor").html('<img class="mb-4" src="./img/img_1F.JPG" alt="" width="100%">');
					$("#map").prop("disabled", false);
				}else if(obj.value == "2"){
					$("#label3").html("白山2階地図");
					$(".img_floor").html('<img class="mb-4" src="./img/img_2F.JPG" alt="" width="100%">');
					$("#map").prop("disabled", false);
				}else if(obj.value == "3"){
					$("#label3").html("白山3階地図");
					$(".img_floor").html('<img class="mb-4" src="./img/img_3F.JPG" alt="" width="100%">');
					$("#map").prop("disabled", false);
				}else if(obj.value == "4"){
					$("#label3").html("白山4階地図");
					$(".img_floor").html('<img class="mb-4" src="./img/img_4F.JPG" alt="" width="100%">');
					$("#map").prop("disabled", false);
				}else if(obj.value == "5"){
					$("#label3").html("白山5階地図");
					$(".img_floor").html('<img class="mb-4" src="./img/img_5F.JPG" alt="" width="100%">');
					$("#map").prop("disabled", false);
				}else if(obj.value == "6"){
					$("#label3").html("白山6階地図");
					$(".img_floor").html('<img class="mb-4" src="./img/img_6F.JPG" alt="" width="100%">');
					$("#map").prop("disabled", false);
				}else if(obj.value == "7"){
					$("#label3").html("白山7階地図");
					$(".img_floor").html('<img class="mb-4" src="./img/img_7F.JPG" alt="" width="100%">');
					$("#map").prop("disabled", false);
				}else if(obj.value == "0"){
					$("#label3").html("白山2階地図");
					$(".img_floor").html('<img class="mb-4" src="./img/img_2F.JPG" alt="" width="100%">');
					$("#map").prop("disabled", true);
				}
			}

		</script>
	</body>
</html>
