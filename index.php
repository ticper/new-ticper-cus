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
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		
		<!-- ページタイトル -->
		<title>Ticper</title>
		
		<!-- jQuery導入 -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		
		<!-- Materialize導入 -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/css/materialize.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/js/materialize.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		<!-- Googleアナリティクス -->
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-121847207-5"></script>
		
		<!-- トラッキング（統括） -->
		<script>
			window.dataLayer = window.dataLayer || [];
  			function gtag(){dataLayer.push(arguments);}
  			gtag('js', new Date());

  			gtag('config', 'UA-121847207-5');
		</script>

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
			<li><a data-target="modal-viewticket" class="modal-trigger">チケットページ</a></li>
			<li class="divider" tabindex="-1"></li>
			<li><a data-target="modal-cart" class="modal-trigger">カートを見る</a></li>
			<li class="divider" tabindex="-1"></li>
			<li><a data-target="modal-receipt" class="modal-trigger">領収書</a></li>
			<li class="divider" tabindex="-1"></li>
			<li><a onclick="disp()" class="red-text">ログアウト</a></li>
		</ul>

		<ul id="user-menu2" class="dropdown-content">
			<li><a data-target="modal-viewticket" class="modal-trigger">チケットページ</a></li>
			<li class="divider" tabindex="-1"></li>
			<li><a data-target="modal-cart" class="modal-trigger">カートを見る</a></li>
			<li class="divider" tabindex="-1">
			<li><a data-target="modal-receipt" class="modal-trigger">領収書</a></li>
		</ul>

		<nav class="light-blue darken-4">
			<div class="container">
				<div class="nav-wrapper">
					<a href="index.php" class="brand-logo">Ticper</a>
					<a href="#!" data-target="mobilemenu" class="sidenav-trigger" id="tap"><i class="material-icons">menu</i></a>
					<div class="tap-target" data-target="tap">
    					<div class="tap-target-content">
      						<h5>ログイン/新規登録しましょう</h5>
      						<p><i class="material-icons">menu</i>をタップしてログインか新規登録をします。</p>
    					</div>
  					</div>
					<ul class="right hide-on-med-and-down">
						<?php
							if(isset($_SESSION['C_UserID']) == ''){
								print('<li><a data-target="modal-login" class="modal-trigger" id="loginbtn">ログイン</a></li>');
								print('<li><a data-target="modal-register" class="modal-trigger">新規登録</a></li>');
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
					print('<li><a data-target="modal-login" class="modal-trigger">ログイン</a></li>');
					print('<li><a data-target="modal-register" class="modal-trigger">新規登録</a></li>');
				}else{
					print('<li><a class="dropdown-trigger2" data-target="user-menu2">'.$_SESSION['UserName'].'さん<i class="material-icons right">arrow_drop_down</i></a></li>');
					print('<li><div class="divider"></div></li>');
					print('<li><a onClick="disp()" class="red-text" style="margin-top: 2px;">ログアウト</a></li>');
				}
			?>
		</ul>
		
		<script>
			$(document).ready(function(){
				$('.sidenav').sidenav();
				$('.dropdown-trigger1').dropdown();
				$('.dropdown-trigger2').dropdown();
				$('.sidenav').sidenav();
    			$('.modal').modal();
				$('.collapsible').collapsible(); 
			});
			function disp(){
				if (window.confirm('本当にログアウトしますか？')) {
					location.href = "logout.php";
				}
				else{
				}
			}
		</script>

		<div class="container">
			<div class="col s12">
				
				<?php
					if(isset($_SESSION['C_UserID']) != '') {
					} else {
						print("<script>M.toast({html: '画面上のメニューボタンを押してログインまたは新規登録してください。'})</script>");
					}
					require_once('config/config.php');
					$sql = mysqli_query($db_link, "SELECT News FROM tp_news");
					print('<ul class="collection with-header">');
					print('<li class="collection-header"><h4>お知らせ</h4></li>');
					while($result = mysqli_fetch_assoc($sql)) {
        				print('<li class="collection-item">'.$result['News'].'</li>');
					}
					print('</ul>');
					$sql = mysqli_query($db_link,"SELECT * FROM tp_org WHERE OrgKind = 1");
					$sql2 = mysqli_query($db_link, "SELECT COUNT(*) AS num FROM tp_food");
					$result = mysqli_fetch_assoc($sql2);
					$fi = rand(1, $result['num']);
					$sql2 = mysqli_query($db_link, "SELECT * FROM tp_food WHERE FoodID = '$fi'");
					print('<h4>あなたへのおすすめ</h4>');
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
								if($result2['FoodStock'] == 0) {
									print('<div class="chip red">');
									print('<p style="color: white;"><b>売り切れました。</b></p>');
									print('</div>');
								} elseif($result2['FoodStock'] <= 10) {
									print('<div class="chip red">');
									print('<p style="color: white;"><b>あと少しです！</b></p>');
									print('</div>');
								} elseif ($result2['FoodStock'] < 30) {
									print('<div class="chip yellow">');
									print('<p><b>まだあります！</b></p>');
									print('</div>');	
								} elseif ($result2['FoodStock'] >= 30) {
									print('<div class="chip green">');
									print('<p style="color: white;"><b>順調に売れています！</b></p>');
									print('</div>');
								}
								print('<p><br>'.$result2['FoodDescription'].'</p>');
								print('</div>');
								print('<div class="card-action">');
								if($result2['FoodStock']!=0){
									if(isset($_SESSION['C_UserID']) != '') {
										print('<form action="addfood.php" method="POST">');
										print('<input type="hidden" name="FoodID" value="'.$result2['FoodID'].'">');
										print('<input required placeholder="枚数を入力" type="number" name="maisu" min="1" max="5">');
										print('<input class="btn" type="submit" value="カートに追加">');
										print('</form>');
									} else {
										print('<p><a data-target="modal-login" class="modal-trigger">ログイン</a>または<a data-target="modal-register" class="modal-trigger">新規登録</a>してください。</p>');
									}
								}else{
								}
								print('</div>');
								print('</div>');
								print('</div>');							
								}
					print('<div class="top">');
					print('<h4>団体一覧</h4>');
					print('<p>団体を選択すると、メニューが表示されます。</p>');
					print('</div>');
				?>
				<?php
					$sql = mysqli_query($db_link, "SELECT * FROM tp_org WHERE OrgKind = 1");
					print('<ul class="collapsible">');
					while ($result = mysqli_fetch_assoc($sql)) {
						if($result['OrgID'] == 0){
						
						} else {
							print('<li>');
							print('<div class="collapsible-header" id="'.$result['OrgID'].'">');
							print('<b>'.$result['OrgName'].'</b>');
							print('</div>');
							print('<div class="collapsible-body"><h6>'.$result['OrgPlace'].'</h6>');
							$orgid = $result['OrgID'];
							$sql3 = mysqli_query($db_link, "SELECT Status FROM tp_org WHERE OrgID = '$orgid'");
							$result3 = mysqli_fetch_assoc($sql3);
							print("<h6>混雑度:");
							if($result3['Status'] == 0) {
								print("空いている");
							} elseif ($result3['Status'] == 1) {
								print("少し混んでいる");
							} elseif ($result3['Status'] == 2) {
								print("結構混んでいる");
							} elseif ($result3['Status'] == 3) {
							print("超混んでいる");
							}
							print("</h6>");
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
								if($result2['FoodStock'] == 0) {
									print('<div class="chip red">');
									print('<p style="color: white;"><b>売り切れました。</b></p>');
									print('</div>');
								} elseif($result2['FoodStock'] <= 10) {
									print('<div class="chip red">');
									print('<p style="color: white;"><b>あと少しです！</b></p>');
									print('</div>');
								} elseif ($result2['FoodStock'] < 30) {
									print('<div class="chip yellow">');
									print('<p><b>まだあります！</b></p>');
									print('</div>');	
								} elseif ($result2['FoodStock'] >= 30) {
									print('<div class="chip green">');
									print('<p style="color: white;"><b>順調に売れています！</b></p>');
									print('</div>');
								}
								print('<p><br>'.$result2['FoodDescription'].'</p>');
								print('</div>');
								print('<div class="card-action">');
								if($result2['FoodStock']!=0){
									if(isset($_SESSION['C_UserID']) != '') {
										print('<form action="addfood.php" method="POST">');
										print('<input type="hidden" name="FoodID" value="'.$result2['FoodID'].'">');
										print('<input required placeholder="枚数を入力" type="number" name="maisu" min="1" max="5">');
										print('<input class="btn" type="submit" value="カートに追加">');
										print('</form>');
									} else {
										print('<p><a data-target="modal-login" class="modal-trigger">ログイン</a>または<a data-target="modal-register" class="modal-trigger">新規登録</a>してください。</p>');
									}
								}else{
								}
								print('</div>');
								print('</div>');
								print('</div>');							
								}
								print('</div></div></li>');
							}

						}
					?>
				<li>
					<div class="collapsible-header" id="<?php print($OrgID+1);?>">
						<b>その他</b>
					</div>
					<div class="collapsible-body">
						<div class="row">
							<div class="col s12 m5">
								<div class="card">
									<div class="card-image">
										<?php
											print('<img src="'.$img_link.'0.png">');
										?>
									</div>
									<div class="card-content">
										<p>会計本部</p>
									</div>
									<div class="card-action">
										<?php
											$sql = mysqli_query($db_link, "SELECT Status FROM tp_org WHERE OrgID = '0'");
											$result = mysqli_fetch_assoc($sql);
											print('<p>混雑度:');
											if($result['Status'] == 0) {
												print("空いている");
											} elseif ($result['Status'] == 1) {
												print("少し混んでいる");
											} elseif ($result['Status'] == 2) {
												print("結構混んでいる");
											} elseif ($result['Status'] == 3) {
												print("超混んでいる");
											}
											print('<p>')
										?>
								</div>
							</div>
						</div>
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
	      		</li>
			</div>
		</div>
				  <div id="modal-viewticket" class="modal">
    		<div class="modal-content">
      			<h4>チケットを表示する</h4>
      			<?php
    					$UserID = $_SESSION['C_UserID'];
    					$now = 0;
       					$sql = mysqli_query($db_link, "SELECT * FROM tp_ticket WHERE UserID = '$UserID' AND Used = '0'");
	   					while ($result = mysqli_fetch_assoc($sql)) {
			   				print('<div class="col">');
	    					print('<img style="margin: 10px 10px 10px;"src="https://chart.apis.google.com/chart?chs=200x200&cht=qr&chl='.$result['TicketACode'].'" alt="QRコード" /><br>');
    						$foodid = $result['FoodID'];
    						$sql2 = mysqli_query($db_link, "SELECT FoodName, OrgID, FoodPrice FROM tp_food WHERE FoodID = '$foodid'");
   							$result2 = mysqli_fetch_assoc($sql2);
   							$OrgID = $result2['OrgID'];
   							$sql3 = mysqli_query($db_link, "SELECT OrgName, OrgPlace FROM tp_org WHERE OrgID = '$OrgID'");
   							$result3 = mysqli_fetch_assoc($sql3);
   							print('<b>'.$result2['FoodName'].'</b>('.$result['Sheets'].'枚)<br>');
    						print($result3['OrgName'].'<br>('.$result3['OrgPlace'].'で交換)<br>');
   							print('<b>'.$result2['FoodPrice'].'円</b>');
    						print('</div>');
    						$now = $now + 1;
   							if ($now == 3) {
    							print('</div><div class="row">');
    							$now = 0;
   							}
   						}
   						$sql = mysqli_query($db_link, "SELECT COUNT(*) AS FoodID FROM tp_ticket WHERE UserID = '$UserID' AND Used = '0'");
						$result = mysqli_fetch_assoc($sql);
   						if($result['FoodID'] == '0') {
   							print('<h5>未使用の食券はありません</h5>');
   						}
    				?>	
    		</div>
    		<div class="modal-footer">
      			<a href="#!" class="modal-close btn">閉じる</a>
    		</div>
  		</div>
		<div id="modal-login" class="modal">
    		<div class="modal-content">
      			<h4>ログイン</h4>
      			<form action="logindo.php" method="POST">
					<h5>ログインID</h5>
					<input type="text" name="userid" class="validate">
					<h5>パスワード</h5>
					<input type="password" name="password" class="validate">
					<button type="submit" class="btn">ログインする</button>
				</form>
    		</div>
    		<div class="modal-footer">
      			<a href="#!" class="modal-close btn">閉じる</a>
    		</div>
  		</div>
		<div id="modal-register" class="modal">
    		<div class="modal-content">
      			<h4>新規登録</h4>
      			<form action="registerdo.php" method="POST">
					<h5>ユーザID</h5>
					<input type="text" name="userid" class="validate">
					<h5>ニックネーム</h5>
					<input type="text" name="username" class="validate">
					<h5>パスワード</h5>
					<input type="password" name="password" class="validate">
					<button type="submit" class="btn">ログインする</button>
				</form>
    		</div>
    		<div class="modal-footer">
      			<a href="#!" class="modal-close btn">閉じる</a>
    		</div>
  		</div>
		  <div id="modal-receipt" class="modal">
    		<div class="modal-content">
				<h4>領収書</h4>
				<table>
					<thead>
						<tr>
							<th>商品名</th>
							<th>値段</th>
							<th>枚数</th>
						</tr>
					</thead>
					<tbody>
						<?php
							require_once('config/config.php');
							$userid = $_SESSION['C_UserID'];
							$sql = mysqli_query($db_link,"SELECT FoodID,Sheets FROM tp_ticket WHERE UserID = '$userid'");
							$goukei = 0;
							while($result = mysqli_fetch_assoc($sql)){
								$foodid = $result['FoodID'];
								$sql2 = mysqli_query($db_link,"SELECT FoodName,FoodPrice FROM tp_food WHERE FoodID = '$foodid'");
								$result2 = mysqli_fetch_assoc($sql2);
								print('<tr>');
								print('<td>');
								print($result2['FoodName']);
								print('</td>');
								print('<td>');
								print($result2['FoodPrice']);
								print('</td>');
								print('<td>');
								print($result['Sheets']);
								print('</td>');
								$goukei = $goukei + $result2['FoodPrice'] * $result['Sheets'];
							}

						?>
					</tbody>
				</table>
				<?php
					print('<p style="text-align:right;">上記商品代として、'.$goukei.'円を領収いたしました。</p>');
				?>
    		</div>
    		<div class="modal-footer">
      			<a href="#!" class="modal-close btn">閉じる</a>
    		</div>
  		</div>
  				<div id="modal-cart" class="modal">
    		<div class="modal-content">
      			<h4>カート</h4>
      			<?php
					print('<table>');
					print('<thead>');
					print('<tr>');
					print('<th>');
					print('食品名');
					print('</th>');
					print('<th>');
					print('価格');
					print('</th>');
					print('<th>');
					print('枚数');
					print('</th>');
					print('<th>');
					print('オプション');
					print('</th>');
					print('<th>');
					print('削除');
					print('</th>');
					print('</tr>');
					print('</thead>');
					print('<tbody>');
					$sql = mysqli_query($db_link,"SELECT * FROM tp_food");
					$price = 0;
					while ($result =  mysqli_fetch_assoc($sql)) {
						$userid = $_SESSION['C_UserID'];
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
							print('<input type="hidden" name="userid" value="'.$_SESSION['C_UserID'].'">');
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
						print('<h6>合計'.$price.'円です。</h6><br>');
						print('<a data-target="modal-qr" class="modal-trigger btn">お会計</a>');
						print('</div>');

					} else {

						print('<div class="center">');
						print('<br><h5>カートの中身が空です。</h5>');
						print('<a href="index.php"><input class="btn" type="submit" value="戻る"></a>');
					}

					$userid = $_SESSION['C_UserID'];
				?>
    		</div>
    		<div class="modal-footer">
      			<a href="#!" class="modal-close btn">閉じる</a>
    		</div>
  		</div>
		<div id="modal-qr" class="modal">
			<div class="modal-content">
				<h4>お会計</h4>
    			<?php
    				print('<div class="center">');
					print('<img src="https://chart.apis.google.com/chart?chs=300x300&cht=qr&chl='.$userid.'" alt="QRコード"/><br>');
					print('<br>この画面を受付で表示してください。<br><br>');
					print('<a href="checkin.php"><input class="btn" type="submit" value="支払いました"></a>');
					print('</div>');
				?>
    		</div>
    		<div class="modal-footer">
    			<a href="#!" class="modal-close btn">閉じる</a>
    		</div>
    	</div>
		  


		<?php
			if($_GET['ec'] == "0") {
				print("<script>jQuery(document).ready(function(){jQuery('#modal-login').modal('open');});</script>");
			} else {
			}
			if($_GET['ec'] == "1") {
				print("<script>jQuery(document).ready(function(){jQuery('#modal-viewticket').modal('open');});</script>");
			}if($_GET['ec'] == "2") {
				print("<script>jQuery(document).ready(function(){jQuery('#modal-cart').modal('open');});</script>");
			}if($_GET['ec'] == "3") {
				print("<script>jQuery(document).ready(function(){jQuery('#modal-register').modal('open');});</script>");
			}if($_GET['ec'] == "4") {
				print("<script>jQuery(document).ready(function(){jQuery('#modal-login').modal('open');});</script>");
			}
		?>
	</body>
</html>
