<?php
	//コンフィグ導入
	require_once('config/config.php');
	
	//セッションスタート
	session_start();
	
	//ログインチェック
	if(isset($_SESSION['UserID']) == ''){
		print('<script>alert("カートに食品を追加する前にログインしてください。");location.href = "index.php";</script>');
	
	} else {
		
		//index.phpから投げた内容をローカル変数に入れる
		$foodid = $_POST['FoodID'];
		$maisu = $_POST['maisu'];
		$userid = $_SESSION['UserID'];
		
		//SQLの特殊な文字を抜き取る
		$e_foodid = $db_link -> real_escape_string($foodid);
		$s_foodid = htmlspecialchars($e_foodid, ENT_QUOTES);
		
		$e_maisu = $db_link -> real_escape_string($maisu);
		$s_maisu = htmlspecialchars($e_maisu, ENT_QUOTES);
		
		//ReservationIDチェック
		
		
		//食品を鯖に登録する
		mysqli_query($db_link,"INSERT INTO tp_cust_carts(UserID,FoodID,Sheets) VALUES('$userid','$foodid','$e_maisu')");
		
		//追加されたことを表示してindexに戻す。
		print('<script>alert("食品を追加しました。");location.href = "index.php";</script>');
	}
?>