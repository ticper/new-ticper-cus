<?php
	session_start();
	if(isset($_SESSION['UserID']) == ''){
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
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		
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
							if(isset($_SESSION['UserID']) == ''){
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
				if(isset($_SESSION['UserID']) == ''){
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
					require_once('config/config.php');
					$sql = mysqli_query($db_link,"SELECT * FROM tp_org");
					print('<div class="top">');
					print('<h4>団体一覧</h4>');
					print('<ul>');
					while($result = mysqli_fetch_assoc($sql)){
						print('<li><a href="#'.$result['OrgID'].'">・'.$result['OrgName'].'</a></li>');
					}
					print('</ul>');
					print('</div>');
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
						print('<div class="row">');
						while ($result2 = mysqli_fetch_assoc($sql2)) {
							print('<div class="col s12 m5">');
							print('<div class="card">');
							print('<div class="card-image">');
							print('<img src="'.$img_link.''.$result2['FoodID'].'.png">');
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
								print('<input required placeholder="枚数を入力" type="number" name="maisu" min="1" max='.$result2['FoodStock'].' ">');
								print('<input class="btn" type="submit" value="カートに追加">');
								print('</form>');
							}else{
								print('<input class="btn red darken-2" type="submit" value="売り切れ">');
							}
							print('</div>');
							print('</div>');
							print('</div>');							
						}
						print('</div>');
					}
				?>
				<div class="row">
					<div class="col s12 m5">
						<div class="card">
							<div class="card-image">
								<?php
									print('<img src="'.$img_link.'twitter.png">');
								?>
							</div>
							<div class="card-content">
								<p>このページをTwitterで共有する。</p>
      						</div>
      						<div class="card-action">
      							<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a>
      							<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
      						</div>
      					</div>
      				</div>
      			</div>
			</div>
		</div>
	</body>
</html>
