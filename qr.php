<?php
	session_start();
	if(isset($_SESSION['C_UserID']) == ''){
		print('<script>alert("不正なリクエスト");location.href = "index.php";</script>');
	
	}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<!-- エンコード設定 -->
		<meta charset="UTF-8">
		
		<!-- 検索エンジンに掲載させない -->
		<meta name="robots" content="noindex,nofollow">
		
		<!-- レスポンシブデザイン -->
		<meta name="viewport" content="width=device-width,initial-scale=1.0/">
		
		<!-- ページタイトル -->
		<title>Ticper</title>
		
		<!-- jQuery導入 -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		
		<!-- Materialize導入 -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/css/materialize.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/js/materialize.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		<!-- Googleアナクリティクス -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113412923-2"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			
			gtag('config', 'UA-113412923-2');
		</script>
	</head>
	<body>
		<ul id="user-menu1" class="dropdown-content">
			<li><a href="viewticket.php">チケットページ</a></li>
			<li class="divider" tabindex="-1"></li>
			<li><a href="carts.php">カートを見る</a></li>
			<li class="divider" tabindex="-1"></li>
			<li><a href="receipt.php">領収書</a></li>
			<li class="divider" tabindex="-1"></li>
			<li><a href="logout.php" class="red-text">ログアウト</a></li>
		</ul>

		<ul id="user-menu2" class="dropdown-content">
			<li><a href="viewticket.php" class=" teal-text text-lighten-1">チケットページ</a></li>
			<li class="divider" tabindex="-1"></li>
			<li><a href="carts.php" class=" teal-text text-lighten-1">カートを見る</a></li>
			<li class="divider" tabindex="-1">
			<li><a href="receipt.php" class=" teal-text text-lighten-1">領収書</a></li>
		</ul>

		<nav class="light-blue darken-4">
			<div class="container">
				<div class="nav-wrapper">
					<a href="index.php" class="brand-logo">Ticper</a>
					<a href="#!" data-target="mobilemenu" class="sidenav-trigger"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">
						<?php
							if(isset($_SESSION['C_UserID']) == ''){
								print('<li><a href="login.php">ログイン</a></li>');
								print('<li><a href="u_register.php">新規登録</a></li>');
							}else{
								print('<li><a class="dropdown-trigger1" data-target="user-menu1">'.$_SESSION['UserName'].'さん<i class="material-icons right">arrow_drop_down</i></a></li>');
							}
						?>
					</ul>
				</div>
			</div>
		</nav>
		
		<ul class="sidenav" id="mobilemenu">
			<?php
				if(isset($_SESSION['C_UserID']) == ''){
					print('<li><a href="login.php">ログイン</a></li>');
					print('<li><a href="u_register.php">新規登録</a></li>');
				}else{
					print('<li><a class="dropdown-trigger2" data-target="user-menu2">'.$_SESSION['UserName'].'さん<i class="material-icons right">arrow_drop_down</i></a></li>');
					print('<li><div class="divider"></div></li>');
					print('<li><a href="logout.php" class="red-text" style="margin-top: 2px;">ログアウト</a></li>');
				}
			?>
		</ul>
		
		<script>
			$(document).ready(function(){
				$('.sidenav').sidenav();
				$('.dropdown-trigger1').dropdown();
			});
		</script>

		<script>
			$(document).ready(function(){
				$('.sidenav').sidenav();
				$('.dropdown-trigger2').dropdown();
			});
		</script>

		<script>
			$(document).ready(function(){
				$('.sidenav').sidenav();
			});
		</script>
					
		<div class="container">
			<div class="col s12">
				<?php
					$userid = $_SESSION['C_UserID'];
					print('<div class="center">');
					print('<br><br><img src="https://api.qrserver.com/v1/create-qr-code/?data='.$userid.'&size=200x200" alt="QRコード"/><br>');
					print('<br>この画面を受付で表示してください。<br><br>');
					print('<a href="carts.php"><input class="btn" type="submit" value="BACK"></a>　<a href="viewticket.php"><input class="btn" type="submit" value="NEXT"></a>');
					print('</div>');
				?>
			</div>
		</div>
	</body>
</html>