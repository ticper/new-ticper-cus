<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-121847207-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-121847207-1');
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-121847207-5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-121847207-5');
</script>

<?php
	//コンフィグ導入
	require_once('config/config.php');
	
	//セッションスタート
	session_start();
	
	//ログインチェック
	if(isset($_SESSION['C_UserID']) == ''){
		print('<script>alert("カートに食品を追加する前にログインしてください。");location.href = "index.php";</script>');
	
	} else {
		
		//index.phpから投げた内容をローカル変数に入れる
		$foodid = $_POST['FoodID'];
		$maisu = $_POST['maisu'];
		$userid = $_SESSION['C_UserID'];
		
		//SQLの特殊な文字を抜き取る
		$e_foodid = $db_link -> real_escape_string($foodid);
		$s_foodid = htmlspecialchars($e_foodid, ENT_QUOTES);
		
		$e_maisu = $db_link -> real_escape_string($maisu);
		$s_maisu = htmlspecialchars($e_maisu, ENT_QUOTES);
		
		//FoodStockの取得
		$stock = mysqli_query($db_link,"SELECT FoodStock FROM tp_food WHERE FoodID = $foodid");
		$s_stock = mysqli_fetch_assoc($stock);
		
		//データの取得
		$sql = mysqli_query($db_link,"SELECT * FROM tp_cust_carts WHERE UserID = '$userid' AND FoodID = '$foodid'");
		$result = mysqli_fetch_assoc($sql);

		//追加した量が在庫を超えていたら弾く
		if ($s_stock['FoodStock'] >= $result['Sheets'] + $s_maisu){		
		
		//カートチェック
			if($result['Sheets'] == ''){

				//食品を鯖に登録する
				mysqli_query($db_link,"INSERT INTO tp_cust_carts(UserID,FoodID,Sheets) VALUES('$userid','$foodid','$e_maisu')");
			
				//追加されたことを表示してindexに戻す。
				print('<script>alert("食品を追加しました。");location.href = "index.php";</script>');
			} else {
				//Sheetsに数を追加する
				mysqli_query($db_link,"UPDATE tp_cust_carts SET Sheets = Sheets + '$s_maisu' WHERE UserID = '$userid' AND FoodID = '$foodid'");
				//追加されたことを表示してindexに戻す。
				print('<script>alert("食品を追加しました。");location.href = "index.php";</script>');
			}
		} else {
			print('<script>alert("食品の追加した合計が在庫を上回っています。");location.href = "index.php";</script>');
		}
	}
?>