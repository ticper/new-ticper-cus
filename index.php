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
					$sql = mysqli_query($db_link,"SELECT * FROM tp_org");
					print('<h4>団体一覧</h4>');
					print('<ul>');
					while($result = mysqli_fetch_assoc($sql)){
						print('<li><a href="#'.$result['OrgID'].'">・'.$result['OrgName'].'</a></li>');
					}
					print('</ul>');
				?>
				<?php
					require_once('config/config.php');
					$sql = mysqli_query($db_link, "SELECT * FROM tp_org");
					while ($result = mysqli_fetch_assoc($sql)) {
						print('<div id="'.$result['OrgID'].'">');
						print('<h4>'.$result['OrgName'].'</h4>');
						print('</div>');
						print('<h6>'.$result['OrgPlace'].'</h6>');
						print('<h5>食品一覧</h5>');
						$OrgID = $result['OrgID'];
						$sql2 = mysqli_query($db_link, "SELECT * FROM tp_food WHERE OrgID = '$OrgID'");
						$jun = 0;
						print('<div class="row">');
						while ($result2 = mysqli_fetch_assoc($sql2)) {
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
							print('<p>残り'.$result2['FoodStock'].'個</p>');
							print('</div>');
							print('<p><br>'.$result2['FoodDescription'].'</p>');
							print('</div>');
							print('<div class="card-action">');
							if($result2['FoodStock']!=0){
								print('<form action="addfood.php" method="POST">');
								print('<input type="hidden" name="FoodID" value="'.$result2['FoodID'].'">');
								print('<input placeholder="枚数を入力" type="number" name="maisu"'.$result2['FoodStock'].'">');
								print('<input class="btn" type="submit" value="カートに追加">');
								print('</form>');
							}else{
								print('<input class="btn red darken-2" type="submit" value="売り切れ">');
							}
							print('</div>');
							print('</div>');
							print('</div>');
							$jun = $jun + 1;
							if($jun == 3) {
								print('</div><div class="row">');
							}
						}
						print('</div>');
					}
				?>
			</div>
		</div>
	</body>
</html>