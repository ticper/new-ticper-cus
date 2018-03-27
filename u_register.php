<?php
	session_start();
	if(isset($_SESSION['UserID']) != ''){
		print('<script>alert("既にログインしています。一旦ログアウトしてからアクセスしてください。")</script>');
		print('<script>location.href = "index.php";</script>');
	}
?>
<!DOCTYPE HTML>
<html lang="ja">
	<head>
		<!-- エンコード設定 -->
		<meta charset="UTF-8" />
		
		<!-- 検索エンジンに掲載させない -->
		<meta name="robots" content="noindex,nofollow" />
		<!-- レスポンシブデザイン -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<!-- ページタイトル -->
		<title>新規作成 - Ticper</title>
		
		<!-- jQuery(フレームワーク)導入 -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- Materialize(フレームワーク)導入 -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/css/materialize.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/js/materialize.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		<!-- Googleアナリティクス -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113412923-2"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			
			gtag('config', 'UA-113412923-2');
		</script>
	</head>
	<body>
		<nav class="light-blue darken-4">
			<div class="container">
				<div class="nav-wrapper">
					<a href="index.php" class="brand-logo">Ticper</a>
					<a href="#" data-target="mobilemenu" class="sidenav-trigger"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">
						<li><a href="login.php">ログイン</a></li>
						<li><a href="u_register.php">新規登録</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
		<ul class="sidenav" id="mobilemenu">
			<li><a href="login.php">ログイン</a></li>
			<li><a href="u_register.php">新規登録</a></li>
		</ul>
		
		<script>
			$(document).ready(function(){
				$('.sidenav').sidenav();
			});
		</script>
		
		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2>新規登録</h2>
					<p>アカウント情報を入力してください。</p>
					<p>ニックネーム以外は日本語と全角文字は使えません</p>
			</div>
			<div class="row">
				<form class="col s12" action="registerdo.php" method="POST">
					<div class="row">
						<div class="input-field col s12">
							<input id="userid" name="userid" class="validate" type="text" onKeyup="this.value=this.value.replace(//[^-_@+*;:#$%&^A-Z^a-z^0-9]+/i,'')" onblur="this.value=this.value.replace(/[^-_@+*;:#$%&^A-Z^a-z^0-9]+/i,'')" required>
							<label for="userid">ユーザID</label>
						</div>
						<div class="input-field col s12">
							<input id="username" name="username" class="validate" type="text" required>
							<label for="username">ニックネーム</label>
						</div>
						<div class="input-field col s12">
							<input id="password" name="password" class="validate" type="password" onKeyup="this.value=this.value.replace(//[^-_@+*;:#$%&^A-Z^a-z^0-9]+/i,'')" onblur="this.value=this.value.replace(/[^-_@+*;:#$%&^A-Z^a-z^0-9]+/i,'')" required>
							<label for="password">パスワード</label>
						</div>
						<div class="input-field col s12">
							<input type="submit" value="登録" class="btn">
						</div>
						<!--全角文字の削除 -->
						
					</div>
				</form>
			</div>
		</div>
	</body>
</html>