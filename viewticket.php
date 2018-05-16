<?php
	session_start();
	if(isset($_SESSION['UserID']) == '') {
		print('<script>location.href = "index.php";</script>');
	} else {

	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />

    <title>食券ページ</title>
		
    <meta name="robots" content="noindex,nofollow" />

    <meta name="viewport" content="width=device-width,initial-scale=1.0">

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/css/materialize.min.css">
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/js/materialize.min.js"></script>
    	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
      <li><a href="#!">チケットページ</a></li>
      <li class="divider" tabindex="-1"></li>
      <li><a href="carts.php">カートを見る</a></li>
    </ul>

    <ul id="user-menu2" class="dropdown-content #b9f6ca green accent-1">
      <li><a href="#!">チケットページ</a></li>
      <li class="divider" tabindex="-1"></li>
      <li><a href="carts.php">カートを見る</a></li>
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
                print('<li><a href="#!" class="dropdown-trigger1" data-target="user-menu1">'.$_SESSION['UserName'].'さん<i class="material-icons right">arrow_drop_down</i></a></li>');
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
          print('<li><a href="#!" class="dropdown-trigger2" data-target="user-menu2">'.$_SESSION['UserName'].'さん<i class="material-icons right">arrow_drop_down</i></a></li>');
          print('<li><a href="logout.php">ログアウト</a></li>');
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
    		<h2>食券</h2>
    			<div class="row">
    				<?php
            require_once('config/config.php');
              $UserID = $_SESSION['UserID'];
    					$now = 0;
    					$goukei = 0;
    					$sql = mysqli_query($db_link, "SELECT * FROM tp_ticket WHERE UserID = '$UserID' AND Used = '0'");
    					while ($result = mysqli_fetch_assoc($sql)) {
    						print('<div class="col s12 m3">');
    						print('<img src="https://api.qrserver.com/v1/create-qr-code/?data='.$result['TicketACode'].'&size=200x200" alt="QRコード" /><br>');
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
    							$now = 0;    						}
    					}
    				?>
    				
   	 			</div>
    		</div>
    	</div>
    </body>
</html>