<!-- トラッキング（統括） -->
<script>
			window.dataLayer = window.dataLayer || [];
  			function gtag(){dataLayer.push(arguments);}
  			gtag('js', new Date());

  			gtag('config', 'UA-121847207-5');
</script>
<?php
    session_start();
    if(isset($_SESSION['C_UserID']) == ''){
        print('<script>alert("ログインしてからアクセスしてください。")</script>');
		print('<script>location.href = "index.php";</script>');
		exit();
    }
    //飛んできた情報を格納する
    $userid = $_SESSION['C_UserID'];
    $foodid = $_POST['foodid'];
    $maisu = $_POST['maisu'];

    if($maisu < 0){
    		print('<script>alert("値が不正です。")</script>');
			print('<script>location.href = "index.php";</script>');
			exit();
   	} else {
		//読み込み
		require_once('config/config.php');
		$foodid = $db_link -> real_escape_string($foodid);//SQL Injection
		$foodid = htmlspecialchars($foodid, ENT_QUOTES);//XSS

		$maisu = $db_link -> real_escape_string($maisu);//SQL Injection
		$maisu = htmlspecialchars($maisu, ENT_QUOTES);//XSS

		$sql = mysqli_query($db_link,"SELECT * FROM tp_cust_carts WHERE UserID = '$userid' AND FoodID = '$foodid'");
		$result = mysqli_fetch_assoc($sql);

		$maisu = $result['Sheets'] - $maisu;

		if($maisu >= 0){
			if($maisu == 0){
				mysqli_query($db_link,"DELETE FROM tp_cust_carts WHERE UserID = '$userid' AND FoodID = '$foodid'");
			} else {

				mysqli_query($db_link,"UPDATE tp_cust_carts SET Sheets = '$maisu' WHERE UserID = '$userid' AND FoodID = '$foodid'");
			}

		print('<script>alert("削除しました。")</script>');
		print('<script>location.href = "index.php?ec=2";</script>');

		} else {
			print('<script>alert("削除枚数がカートに入っている枚数を上回っています。")</script>');
			print('<script>location.href = "index.php";</script>');
		}
	}
?>