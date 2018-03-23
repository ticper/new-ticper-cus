<?php
    session_start();
    //飛んできた情報を格納する
    $userid = $_SESSION['UserID'];
    $foodid = $_POST['foodid'];
    $maisu = $_POST['maisu'];

    //読み込み
    require_once('config/config.php');
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
    print('<script>location.href = "carts.php";</script>');

	} else {
		print('<script>alert("削除枚数がカートに入っている枚数を上回っています。")</script>');
		print('<script>location.href = "carts.php";</script>');
	}
?>