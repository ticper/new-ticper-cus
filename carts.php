<?php
	session_start();
	if(isset($_SESSION['UserID']) == ''){
		print('<script>alert("ログインしてからアクセスしてください。")</script>');
		print('<script>location.href = "index.php";</script>');
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
								print('<li><a href="carts.php">カートを見る</a></li>');
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
					print('<li><a href="carts.php">カートを見る</a></li>');
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
				<h4>カート</h4>
				<?php
					require_once('config/config.php');
					print('<table>');
					print('<thead>');
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
					print('<th>');
					print('Option');
					print('</th>');
					print('<th>');
					print('Delete');
					print('</th>');
					print('</tr>');
					print('</thead>');
					print('<tbody>');
					$sql = mysqli_query($db_link,"SELECT * FROM tp_food");
					$price = 0;
					while ($result =  mysqli_fetch_assoc($sql)) {
						$userid = $_SESSION['UserID'];
						$foodid = $result['FoodID'];
						$sql2 = mysqli_query($db_link,"SELECT * FROM tp_cust_carts WHERE UserID = '$userid' AND FoodID = '$foodid'");
						$result2 = mysqli_fetch_assoc($sql2);
						if($result2['Sheets'] != 0){
							print('<tr>');
							print('<td>');
							print($result['FoodName']);
							print('</td>');
							print('<td>');
							print($result['FoodPrice']);
							print('</td>');
							print('<td>');
							print($result2['Sheets']);
							print('</td>');
							print('<td>');
							print('<form action="deletefood.php" method="POST">');
							print('<input type="hidden" name="userid" value="'.$_SESSION['UserID'].'">');
							print('<input type="hidden" name="foodid" value="'.$result2['FoodID'].'">');
							print('<input required placeholder="削除する枚数" type="number" name="maisu" min="1" max='.$result2['Sheets'].' ">');
							print('</td>');
							print('<td>');
							print('<input class="btn red darken-2 right" type="submit" value="削除">');
							print('</form>');
							print('</td>');
							print('</tr>');
							$price = $price + ($result['FoodPrice'] * $result2['Sheets']);
						}
					}
					print('</tbody>');
					print('</table>');
				
					if($price != 0){
				
						print('<div class="center">');
						print('<br><h6>合計'.$price.'円です。</h6><br>');
						print('<a href="index.php"><input class="btn" type="submit" value="戻る"></a>');
						print('　');
						print('<a href="qr.php"><input class="btn" type="submit" value="NEXT"></a>');
						print('</div>');

					} else {

						print('<div class="center">');
						print('<br><h5>カートの中身が空です。</h5><br>');
						print('<a href="index.php"><input class="btn" type="submit" value="戻る"></a>');
					}
				?>
			</div>
		</div>
	</body>
</html>