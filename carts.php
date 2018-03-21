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
					$sql = mysqli_query($db_link,"SELECT * FROM tp_food");
					$result = mysqli_fetch_assoc($sql);
					print('<table>')
					print('<thead>');
					//どうやってループしたらいいかな☆
					while(){
						print('<tr>');
						print('<th>');
						print('FoodName');
						print('</th>');
						print('<th>');
						print('FoodPrice');
						print('</th>');
						print('<th>');
						print('Sheets');
						print('</th>');
						print('</tr>');
						print('</thead>');
						print('<tbody>');
						
						print('<tr>');
						print('<td>');
						//食品名
						print('</td>');
						print('</tr>');
						
						print('<tr>');
						print('<td>');
						//値段
						print('</td>');
						print('</tr>')

						print('<tr>');
						print('<td>');
						//枚数
						print('</td>');
						print('</tr>');

						print('</tbody>');
						print('</table>');
					}
				?>
			</div>
		</div>
	</body>
</html>