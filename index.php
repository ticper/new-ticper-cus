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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<!-- Materialize導入 -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/css/materialize.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/js/materialize.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!-- 画像遅延読み込み -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/4.1.4/lazysizes.min.js" async=""></script>
		
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
		<style>
			#loader-bg {
  			display: none;
  			position: fixed;
  			width: 100%;
  			height: 100%;
  			top: 0px;
  			left: 0px;
  			background: #FFF;
  			z-index: 1;
			}
			#loader {
			  display: none;
			  position: fixed;
			  top: 50%;
			  left: 50%;
			  width: 200px;
			  height: 200px;
			  margin-top: -100px;
			  margin-left: -100px;
			  text-align: center;
			  color: #000;
			  z-index: 2;
			}
			.card-title {
				display: block;
				width: 100%;
				background-color: #00000088;
			}
		</style>
		<script>
			$(function() {
			  var h = $(window).height();
			 
			  $('#wrap').css('display','none');
			  $('#loader-bg ,#loader').height(h).css('display','block');
			});
			 
			$(window).load(function () { //全ての読み込みが完了したら実行
			  $('#loader-bg').delay(900).fadeOut(800);
			  $('#loader').delay(600).fadeOut(300);
			  $('#wrap').css('display', 'block');
			});
			 
			//10秒たったら強制的にロード画面を非表示
			$(function(){
			  setTimeout('stopload()',10000);
			});
			 
			function stopload(){
			  $('#wrap').css('display','block');
			  $('#loader-bg').delay(900).fadeOut(800);
			  $('#loader').delay(600).fadeOut(300);
			}
		</script>
		<script>
			(function(d) {
    			var config = {
    			kitId: 'xtw4rkq',
    			scriptTimeout: 3000,
    			async: true
    			},
    			h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
			})(document);
		</script>
		<style>
			body {
				font-family: kozuka-gothic-pr6n, sans-serif;

				font-weight: 400;

				font-style: normal;
			}
		</style>
	</head>
	<body>
		<?php
		if(isset($_SESSION['C_UserID']) == ''){print('
		<div id="loader-bg">
  			<div id="loader">
    			<img src="img/load.gif" width="100" height="100" alt="Now Loading..." />
    			<p>Now Loading...</p>
  			</div>
		</div>
		');}
		?>
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
		<div class="wrap">
		<div class="container">
			<div class="col s12">
				<?php
					if(isset($_SESSION['C_UserID']) != '') {
					} else {
						print("<script>M.toast({html: '画面上のメニューボタンを押してログインまたは新規登録してください。'})</script>");
						print('<br><br><a data-target="modal-login" class="modal-trigger btn">ログイン</a>&nbsp;<a data-target="modal-register" class="modal-trigger btn">新規登録</a>');
					}
					require_once('config/config.php');
					$sql = mysqli_query($db_link, "SELECT News FROM tp_news");
					print('<ul class="collection with-header">');
					print('<li class="collection-header"><h5>お知らせ</h5></li>');
					while($result = mysqli_fetch_assoc($sql)) {
						if($result['News'] == '0') {
							print('<li class="collection-item">お知らせはありません。</li>');
						} else {
        					print('<li class="collection-item">'.$result['News'].'</li>');
						}
					}
					if(isset($_SESSION['C_UserID']) != '') {
					} else {
						print('<li class="collection-item"><a data-target="modal-login" class="modal-trigger">ログイン</a>か<a data-target="modal-register" class="modal-trigger">新規登録</a>しましょう。</li>');
					}
					print('</ul>');
					print('<ul class="collapsible">');
					print('<li><div class="collapsible-header"><i class="material-icons">event_note</i>ステージ情報（1階エントランス）</div>');
					print('<div class="collapsible-body"><table>');
					$sql2 = mysqli_query($db_link, "SELECT StageName, DATE_FORMAT(StartTime, '%H:%i') AS timeinstring1, DATE_FORMAT(EndTime, '%H:%i') AS timeinstring2 FROM tp_stage WHERE Start = 1 AND Finish = 0");
					while($result2 = mysqli_fetch_assoc($sql2)) {
						if($result2['StageName'] == 0) {
							print('<tr><th colspan="3">現在開催中のステージはありません</th></tr>');
						} else {
							print('<tr><th>'.$result2['StageName'].'</th><td>'.$result2['timeinstring1'].'~'.$result2['timeinstring2'].'</td><th>開催中！</th></tr>');
						}
					}
					$sql3 = mysqli_query($db_link, "SELECT StageName, DATE_FORMAT(StartTime, '%H:%i') AS timeinstring1, DATE_FORMAT(EndTime, '%H:%i') AS timeinstring2 FROM tp_stage WHERE Start = 0 AND Finish = 0");
					while($result3 = mysqli_fetch_assoc($sql3)) {
						print('<tr><th>'.$result3['StageName'].'</th><td>'.$result3['timeinstring1'].'~'.$result3['timeinstring2'].'</td><th>開催予定！</th></tr>');
					}
					print('</table></div></li></ul>');
					$sql4 = mysqli_query($db_link, "SELECT COUNT(*) AS num FROM tp_food");
					$result4 = mysqli_fetch_assoc($sql4);
					$fi = rand(1, $result4['num']);
					$sql5 = mysqli_query($db_link, "SELECT * FROM tp_food WHERE FoodID = '$fi'");
					print('<h4>あなたへのおすすめ</h4>');
					while ($result5 = mysqli_fetch_assoc($sql5)) {
						print('<div class="col s5 m12">');
						print('<div class="card">');
						print('<div class="card-image">');
						print('<img src="'.$img_link.''.$result5['FoodID'].'.png">');
						print('<span class="card-title" style="font-weight: bold;">'.$result5['FoodName'].'</span>');
						print('</div>');
						print('<div class="card-content">');
						print('<div class="chip">');
						print('<p>'.$result5['FoodPrice'].'円</p>');
						print('</div>');
						if($result5['FoodStock'] == 0) {
							print('<div class="chip red">');
							print('<p style="color: white;"><b>売り切れました。</b></p>');
							print('</div>');
						} elseif($result5['FoodStock'] <= $result5['FoodStockFrom'] * 0.1) {
							print('<div class="chip red">');
							print('<p style="color: white;"><b>あと少しです！</b></p>');
							print('</div>');
						} elseif ($result5['FoodStock'] < $result5['FoodStockFrom'] * 0.5) {
							print('<div class="chip yellow">');
							print('<p><b>まだあります！</b></p>');
							print('</div>');	
						} else {
							print('<div class="chip green">');
							print('<p style="color: white;"><b>順調に売れています！</b></p>');
							print('</div>');
						}
						print('<p><br>'.$result5['FoodDescription'].'</p>');
						print('</div>');
						print('<div class="card-action">');
						if($result5['FoodStock']!=0){
							if(isset($_SESSION['C_UserID']) != '') {
								print('<form action="addfood.php" method="POST">');
								print('<input type="hidden" name="FoodID" value="'.$result5['FoodID'].'">');
								print('<input required placeholder="枚数を入力" type="number" name="maisu" min="1" max="5">');
								print('<input class="btn" type="submit" value="カートに追加">');
								print('</form>');
							} else {
								print('<p><a style="margin:0;" data-target="modal-login" class="modal-trigger cyan-text text-accent-3">ログイン</a>または<a style="margin:0;" data-target="modal-register" class="modal-trigger cyan-text text-accent-3">新規登録</a>してください。</p>');
							}
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
					$sql6 = mysqli_query($db_link, "SELECT * FROM tp_org WHERE OrgKind = 1");
					print('<ul class="collapsible">');
					while ($result6 = mysqli_fetch_assoc($sql6)) {
						print('<li>');
						print('<div class="collapsible-header" id="'.$result6['OrgID'].'">');
						print('<b>'.$result6['OrgName'].'</b>');
						print('</div>');
						print('<div class="collapsible-body"><h6>'.$result6['OrgPlace'].'</h6>');
						$orgid = $result6['OrgID'];
						$sql7 = mysqli_query($db_link, "SELECT Status FROM tp_org WHERE OrgID = '$orgid'");
						$result7 = mysqli_fetch_assoc($sql7);
						print("<h6>混雑度:");
						if($result7['Status'] == 0) {
							print("空いている");
						} elseif ($result7['Status'] == 1) {
							print("少し混んでいる");
						} elseif ($result7['Status'] == 2) {
							print("結構混んでいる");
						} elseif ($result7['Status'] == 3) {
						print("超混んでいる");
						}
						print("</h6>");
						print('<h5>食品一覧</h5>');
						$OrgID = $result6['OrgID'];
						$sql8 = mysqli_query($db_link, "SELECT * FROM tp_food WHERE OrgID = '$OrgID'");
						print('<div class="row">');
						while ($result8 = mysqli_fetch_assoc($sql8)) {
							print('<div class="col s12 m5">');
							print('<div class="card">');
							print('<div class="card-image">');
							print('<img data-src="'.$img_link.''.$result8['FoodID'].'.png" class="lazyload">');
							print('<span class="card-title" style="font-weight: bold;">'.$result8['FoodName'].'</span>');
							print('</div>');
							print('<div class="card-content">');
							print('<div class="chip">');
							print('<p>'.$result8['FoodPrice'].'円</p>');
							print('</div>');
							if($result8['FoodStock'] == 0) {
								print('<div class="chip red">');
								print('<p style="color: white;"><b>売り切れました。</b></p>');
								print('</div>');
							} elseif($result8['FoodStock'] <= $result8['FoodStockFrom'] * 0.1) {
								print('<div class="chip red">');
								print('<p style="color: white;"><b>あと少しです！</b></p>');
								print('</div>');
							} elseif ($result8['FoodStock'] < $result8['FoodStockFrom'] * 0.5) {
								print('<div class="chip yellow">');
								print('<p><b>まだあります！</b></p>');
								print('</div>');	
							} else {
								print('<div class="chip green">');
								print('<p style="color: white;"><b>順調に売れています！</b></p>');
								print('</div>');
							}
							print('<p><br>'.$result8['FoodDescription'].'</p>');
							print('</div>');
							print('<div class="card-action">');
							if($result8['FoodStock']!=0){
								if(isset($_SESSION['C_UserID']) != '') {
									print('<form action="addfood.php" method="POST">');
									print('<input type="hidden" name="FoodID" value="'.$result8['FoodID'].'">');
									print('<input required placeholder="枚数を入力" type="number" name="maisu" min="1" max="5">');
									print('<input class="btn" type="submit" value="カートに追加">');
									print('</form>');
								} else {
									print('<p><a style="margin:0;" data-target="modal-login" class="modal-trigger cyan-text text-accent-3">ログイン</a>または<a style="margin:0;" data-target="modal-register" class="modal-trigger cyan-text text-accent-3"> 新規登録</a>してください。</p>');
								}
							}else{
							}
							print('</div>');
							print('</div>');
							print('</div>');							
							}
							print('</div></div></li>');
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
											print('<img data-src="'.$img_link.'0.png" class="lazyload">');
										?>
										<span class="card-title" style="font-weight: bold;">会計本部</span>
									</div>
									<div class="card-action">
										<?php
											$sql9 = mysqli_query($db_link, "SELECT Status FROM tp_org WHERE OrgID = '0'");
											$result9 = mysqli_fetch_assoc($sql);
											print('<p>混雑度:');
											if($result9['Status'] == 0) {
												print("空いている");
											} elseif ($result9['Status'] == 1) {
												print("少し混んでいる");
											} elseif ($result9['Status'] == 2) {
												print("結構混んでいる");
											} elseif ($result9['Status'] == 3) {
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
										print('<img data-src="'.$img_link.'twitter.png" class="lazyload">');
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
    					$sql = mysqli_query($db_link, "SELECT * FROM tp_ticket WHERE UserID = '$UserID' AND Used = '1' AND Changed = '0'");
    					while($result = mysqli_fetch_assoc($sql)) {
    						print('<center>受付番号</center>');
    						print('<center><font size="5"><b>'.$result['ChangeNo'].'番</b></font></center>');
    						$FoodID = $result['FoodID'];
    						$sql2 = mysqli_query($db_link, "SELECT FoodName FROM tp_food WHERE FoodID = '$FoodID'");
    						$result2 = mysqli_fetch_assoc($sql2);
    						print('<center>'.$result2['FoodName']."は現在調理中です。</center>");
    						print('<hr />');

    					}
    					$now = 0;
       					$sql3 = mysqli_query($db_link, "SELECT * FROM tp_ticket WHERE UserID = '$UserID' AND Used = '0'");
	   					while ($result3 = mysqli_fetch_assoc($sql3)) {
			   				print('<div class="col">');
	    					print('<img style="margin: 10px 10px 10px;"data-src="https://chart.apis.google.com/chart?chs=200x200&cht=qr&chl='.$result3['TicketACode'].'" alt="QRコード"  class="lazyload"/><br>');
    						$foodid = $result3['FoodID'];
    						$sql4 = mysqli_query($db_link, "SELECT FoodName, OrgID, FoodPrice FROM tp_food WHERE FoodID = '$foodid'");
   							$result4 = mysqli_fetch_assoc($sql4);
   							$OrgID = $result4['OrgID'];
   							$sql5 = mysqli_query($db_link, "SELECT OrgName, OrgPlace FROM tp_org WHERE OrgID = '$OrgID'");
   							$result5 = mysqli_fetch_assoc($sql5);
   							print('<b>'.$result4['FoodName'].'</b>('.$result3['Sheets'].'枚)<br>');
    						print($result5['OrgName'].'<br>('.$result5['OrgPlace'].'で交換)<br>');
    						print('AC:'.$result3['TicketACode'].'<br>');
    						$money = $result4['FoodPrice'] * $result3['Sheets'];
   							print('<b>'.$money.'円</b>');
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
					print('<img style="margin: 10px 10px 10px;" data-src="https://chart.apis.google.com/chart?chs=200x200&cht=qr&chl='.$userid.'" alt="QRコード" class="lazyload"/><br>');
					print('<br>この画面を受付で表示してください。<br><br>');
					print('UserID: '.$userid.'<br><br>');
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
			}elseif($_GET['ec'] == "1") {
				print("<script>jQuery(document).ready(function(){jQuery('#modal-viewticket').modal('open');});</script>");
			}elseif($_GET['ec'] == "2") {
				print("<script>jQuery(document).ready(function(){jQuery('#modal-cart').modal('open');});</script>");
			}elseif($_GET['ec'] == "3") {
				print("<script>jQuery(document).ready(function(){jQuery('#modal-register').modal('open');});</script>");
			}elseif($_GET['ec'] == "4") {
				print("<script>jQuery(document).ready(function(){jQuery('#modal-login').modal('open');});</script>");
			}
		?>
		</div>
	</body>
</html>
