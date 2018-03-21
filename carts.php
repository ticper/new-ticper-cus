<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<!-- エンコード設定 -->
		<meta charset="UTF-8">
		
		<!-- 検索エンジンに掲載させない -->
		<meta name="robots" content="noindex,nofollow">
		
		<!-- レスポンシブデザイン -->
		<meta name="vieport" content="width=device-width,initial-scale=1.0/">
		
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
		<nav class="light-blue darken-4">
			<div class="container">
				<div class="nav-wrapper">
					<a href="index.php" class="brand-logo">Ticper</a>
					<a href="#!" data-target="mobilemenu" class="sidenav-trigger"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">
						<?php
							if(isset($_SESSION['UserID']) == ''){
								print('<li><a href="login.php">ログイン</a></li>');
								print('<li><a href="u_register.php">新規登録</a></li>');
							}else{
								print('<li><a href="#!">'.$_SESSION['UserName'].'さん</a></li>');
								print('<li><a href="#!">カートを見る</a></li>');
								print('<li><a href="logout.php">ログアウト</a></li>');
							}
						?>
					</ul>
				</div>
			</div>
		</nav>
		
		<ul class="sidenav" id="mobilemenu">
			<?php
				if(isset($_SESSION['UserID']) == ''){
					print('<li><a href="login.php">ログイン</a></li>');
					print('<li><a href="u_register.php">新規登録</a></li>');
				}else{
					print('<li><a href="#!">'.$_SESSION['UserName'].'さん</a></li>');
					print('<li><a href="#!">カートを見る</a></li>');
					print('<li><a href="logout.php">ログアウト</a></li>');
				}
			?>
		</ul>
		
		<script>
			$(document).ready(function(){
				$('.sidenav').sidenav();
			});
		</script>
					
		<div class="container">
			<div class="col s12">
				<?php
					require_once('config/config.php');
					$foodid = 1;
					$OrgID = 1;
					$userid = $_SESSION['UserID'];
					$sql = mysqli_query($db_link,"SELECT * FROM tp_cust_carts WHERE UserID = '$userid' AND FoodID = '$foodid'");
					print('<h4>カート一覧</h4>');
					while($result = mysqli_fetch_assoc($sql)){
						$sql2 = mysqli_query($db_link, "SELECT * FROM tp_food WHERE OrgID = '$OrgID'");
						$result2 = mysqli_fetch_assoc($sql2);
						print('<div class="col s12 m4">');
						print('<div class="card">');
						print('<div class="card-image">');
						print('<img src="img/'.$result2['FoodID'].'.png">');
						print('<span class="card-title">'.$result2['FoodName'].'</span>');
						print('</div>');
						print('<div class="card-content">');
						print('<div class="chip">');
						print('<p>'.$result2['FoodPrice'].'円</p>');
						print('</div>');
						print('<div class="chip">');
						print('<p>残り'.$result['Sheets'].'個</p>');
						print('</div>');
						print('<p><br>'.$result2['FoodDescription'].'</p>');
						print('</div>');
						print('<div class="card-action">');
						print('<form action="#!" method="POST">');
						print('<input type="hidden" name="FoodID" value="'.$result2['FoodID'].'">');
						print('<input placeholder="削除する枚数を入力" type="number" name="maisu" min="1" max='.$result['Sheets'].' '.$result2['FoodStock'].'">');
						print('<input class="btn red darken-2" type="submit" value="削除">');
						print('</form>');
						print('</div>');
						print('</div>');
						$foodid = $foodid + 1;
						$OrgID = $OrgID +1;
						$sql = mysqli_query($db_link,"SELECT * FROM tp_cust_carts WHERE UserID = '$userid' AND FoodID = $foodid");
					}
				?>
			</div>
		</div>
	</body>
</html>