<?php

require_once __DIR__ . '/functions.php';
require_logined_session();
header ('Content-Type: text/html; charset=UTF-8');

?>

<!doctype html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="./img/favicon.ico">

		<title>物品管理TOPページ</title>

		<!-- Bootstrap core CSS -->
		<link href="./dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="./dist/css/index.css" rel="stylesheet">
	</head>
	<body>

		<header>
			<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
				<a class="navbar-brand" href="#">物品管理TOP</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">測定器</a>
							<div class="dropdown-menu" aria-labelledby="dropdown05">
								<a class="dropdown-item" href="#">棚卸し</a>
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

			<div class="container-fluid marketing">

				<div class="row">
					<div class="col-lg-12 mt-5 mb-5 text-center">
						<h1 class="featurette-heading1">物品管理TOPページ</h1>

					</div>
				</div>

				<hr class="featurette-divider">

				<!-- Three columns of text below the carousel -->
				<div class="row">
					<div class="col-sm-3 text-center">
						<img src="./img/img_measure.png" alt="Generic placeholder image" width="140" height="140">
						<h2>測定器</span></h2>
						<div class="col-sm-9 mx-auto">
							<p><a class="btn btn-secondary btn-block" href="#measure" role="button">移動する<br><img src="https://icongr.am/feather/arrow-down-circle.svg?size=16&color=ffffff" /></a></p>
						</div>
					</div><!-- /.col-lg-4 -->
					<div class="col-sm-3 text-center">
						<img src="./img/img_sample.png" alt="Generic placeholder image" width="140" height="140">
						<h2>サンプル</h2>
						<div class="col-sm-9 mx-auto">
							<p><a class="btn btn-secondary btn-block" href="#sample" role="button">移動する<br><img src="https://icongr.am/feather/arrow-down-circle.svg?size=16&color=ffffff" /></a></p>
						</div>
					</div><!-- /.col-lg-4 -->
					<div class="col-sm-3 text-center">
						<img src="./img/img_parts.png" alt="Generic placeholder image" width="140" height="auto">
						<h2>部品</h2>
						<div class="col-sm-9 mx-auto">
							<p><a class="btn btn-secondary btn-block" href="#parts" role="button">移動する<br><img src="https://icongr.am/feather/arrow-down-circle.svg?size=16&color=ffffff" /></a></p>
						</div>
					</div><!-- /.col-lg-4 -->
					<div class="col-sm-3 text-center">
 					 <img src="./img/img_pc.png" alt="Generic placeholder image" width="140" height="auto">
 					 <h2>IT資産</h2>
					 <div class="col-sm-9 mx-auto">
						 <p><a class="btn btn-secondary btn-block" href="#pc" role="button">移動する<br><img src="https://icongr.am/feather/arrow-down-circle.svg?size=16&color=ffffff" /></a></p>
					 </div>
 				 </div><!-- /.col-lg-4 -->
			 </div><!-- /.row -->


				<!-- START THE FEATURETTES -->

				<hr class="featurette-divider">

				<!-- ここから測定器管理メニュー -->
				<div class="row featurette" id="measure">
					<div class="container-fluid bg-primary-pale  text-center">
						<h2 class="featurette-heading mt-7 mb-5">測定器を管理する</h2>
							<div class="card-deck mt-3 mb-3">

								<div class="card mb-4 shadow-sm">
									<div class="card-header">
										<h4 class="my-0 font-weight-normal text-center">棚卸し</h4>
									</div>
									<div class="card-body">
										<ul class="mt-3 mb-4 list-unstyled">
											<li>棚卸し情報を登録する</li>
											<li>棚卸し状況を確認する</li>
											<li>未完了の測定器を表示する</li>
										</ul>
										<button type="button" class="btn btn-lg btn-block btn-primary">棚卸しをはじめる</button>
									</div>
								</div>

								<div class="card mb-4 shadow-sm">
									<div class="card-header">
										<h4 class="my-0 font-weight-normal text-center">持ち出し管理</h4>
									</div>
									<div class="card-body">
										<ul class="mt-3 mb-4 list-unstyled">
											<li>測定器を借りる</li>
											<li>測定器を返す</li>
											<li>測定器の貸し借りの履歴を見る</li>
										</ul>
										<button type="button" class="btn btn-lg btn-block btn-outline-secondary">借りる・返す</button>
									</div>
								</div>

								<div class="card mb-4 shadow-sm">
									<div class="card-header">
										<h4 class="my-0 font-weight-normal text-center">予約</h4>
									</div>
									<div class="card-body">
										<ul class="mt-3 mb-4 list-unstyled">
											<li>測定器を予約する</li>
											<li>予約状況を確認する</li>
											<li>過去の予約を見る</li>
										</ul>
										<button type="button" class="btn btn-lg btn-block btn-outline-secondary">予約をする</button>
									</div>
								</div>

								<div class="card mb-4 shadow-sm">
									<div class="card-header">
										<h4 class="my-0 font-weight-normal text-center">登録・廃棄</h4>
									</div>
									<div class="card-body">
										<ul class="mt-3 mb-4 list-unstyled">
											<li>測定器の登録をする</li>
											<li>測定器を破棄する</li>
											<li>測定器の情報を更新する</li>
										</ul>
										<button type="button" class="btn btn-lg btn-block btn-outline-secondary">登録・廃棄をする</button>
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- 測定器管理メニューここまで -->

				 <hr class="featurette-divider">

				<!-- ここからサンプル管理メニュー -->
				<div class="row featurette" id="sample">
					<div class="container-fluid text-center">
						<h2 class="featurette-heading mt-7 mb-5">サンプルを管理する</h2>
						<div class="card-deck mt-3 mb-3">

							<div class="card mb-4 shadow-sm">
								<div class="card-header">
									<h4 class="my-0 font-weight-normal text-center">棚卸し</h4>
								</div>
								<div class="card-body">
									<ul class="mt-3 mb-4 list-unstyled">
										<li>棚卸し情報を登録する</li>
										<li>棚卸し状況を確認する</li>
										<li>未完了のサンプルを表示する</li>
									</ul>
									<button type="button" class="btn btn-lg btn-block btn-outline-secondary">棚卸しをはじめる</button>
								</div>
							</div>

							<div class="card mb-4 shadow-sm">
								<div class="card-header">
									<h4 class="my-0 font-weight-normal text-center">持ち出し管理</h4>
								</div>
								<div class="card-body">
									<ul class="mt-3 mb-4 list-unstyled">
										<li>サンプルを借りる</li>
										<li>サンプルを返す</li>
										<li>サンプルの貸し借りの履歴を見る</li>
									</ul>
									<button type="button" class="btn btn-lg btn-block btn-outline-secondary">借りる・返す</button>
								</div>
							</div>

							<div class="card mb-4 shadow-sm">
								<div class="card-header">
									<h4 class="my-0 font-weight-normal text-center">登録・廃棄</h4>
								</div>
								<div class="card-body">
									<ul class="mt-3 mb-4 list-unstyled">
										<li>サンプル登録をする</li>
										<li>サンプルを破棄する</li>
										<li>サンプルの情報を更新する</li>
									</ul>
									<button type="button" class="btn btn-lg btn-block btn-outline-secondary">登録・廃棄をする</button>	</div>
								</div>

							</div>
						</div>
					</div>
					<!-- サンプル管理メニューここまで -->

				<hr class="featurette-divider">

				<!-- ここから部品管理メニュー -->
				<div class="row featurette" id="parts">
					<div class="container-fluid bg-primary-pale text-center">
						<h2 class="featurette-heading mt-7 mb-5">部品を管理する</h2>
						<div class="card-deck mt-3 mb-3">

							<div class="card mb-4 shadow-sm">
								<div class="card-header">
									<h4 class="my-0 font-weight-normal text-center">検索</h4>
								</div>
								<div class="card-body">
									<ul class="mt-3 mb-4 list-unstyled">
										<li>部品を検索する</li>
										<li>部品の場所を確認する</li>
										<li></li>
									</ul>
									<button type="button" class="btn btn-lg btn-block btn-outline-secondary">検索をする</button>
								</div>
							</div>

							<div class="card mb-4 shadow-sm">
								<div class="card-header">
									<h4 class="my-0 font-weight-normal text-center">持ち出し管理</h4>
								</div>
								<div class="card-body">
									<ul class="mt-3 mb-4 list-unstyled">
										<li>リールを借りる</li>
										<li>リールを返す</li>
										<li>部品の貸し借りの履歴を見る</li>
									</ul>
									<button type="button" class="btn btn-lg btn-block btn-outline-secondary">借りる・返す</button>
								</div>
							</div>

							<div class="card mb-4 shadow-sm">
								<div class="card-header">
									<h4 class="my-0 font-weight-normal text-center">登録・廃棄</h4>
								</div>
								<div class="card-body">
									<ul class="mt-3 mb-4 list-unstyled">
										<li>部品を登録する</li>
										<li>部品を廃棄する</li>
										<li>部品情報を更新する</li>
									</ul>
									<button type="button" class="btn btn-lg btn-block btn-outline-secondary">登録・廃棄をする</button>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- 部品管理メニューここまで -->

				<hr class="featurette-divider">

				<!-- ここからIT資産メニュー -->
				<div class="row featurette" id="pc">
					<div class="container-fluid text-center">
						<h2 class="featurette-heading mt-7 mb-5">IT資産を管理する</h2>
							<div class="card-deck mt-3 mb-3">

								<div class="card mb-4 shadow-sm">
									<div class="card-header">
										<h4 class="my-0 font-weight-normal text-center">棚卸し</h4>
									</div>
									<div class="card-body">
										<ul class="mt-3 mb-4 list-unstyled">
											<li>棚卸し情報を登録する</li>
											<li>棚卸し状況を確認する</li>
											<li>未完了のIT資産を表示する</li>
										</ul>
										<button type="button" class="btn btn-lg btn-block btn-outline-secondary">棚卸しをはじめる</button>
									</div>
								</div>

								<div class="card mb-4 shadow-sm">
									<div class="card-header">
										<h4 class="my-0 font-weight-normal text-center">登録・廃棄</h4>
									</div>
									<div class="card-body">
										<ul class="mt-3 mb-4 list-unstyled">
											<li>IT資産を登録する</li>
											<li>IT資産を廃棄する</li>
											<li>IT資産情報を更新する</li>
										</ul>
										<button type="button" class="btn btn-lg btn-block btn-outline-secondary">登録・廃棄をする</button>
									</div>
								</div>

								<div class="card mb-4 shadow-sm">
									<div class="card-header">
										<h4 class="my-0 font-weight-normal text-center">Reserved</h4>
									</div>
									<div class="card-body">
										<ul class="mt-3 mb-4 list-unstyled">
											<li>***</li>
											<li>***</li>
											<li>***</li>
										</ul>
										<button type="button" class="btn btn-lg btn-block btn-outline-secondary">***</button>
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- IT資産メニューここまで -->

					<hr class="featurette-divider">

					<!-- /END THE FEATURETTES -->

				</div><!-- /.container -->


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
		</body>
</html>
