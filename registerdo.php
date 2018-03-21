<?php 
	// コンフィグを導入
	require_once('config/config.php');
	
	// index.php から投げた内容をローカル変数に入れる
	$userid = $_POST['userid'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// SQLの特殊な文字を抜き取る
	$e_userid = $db_link -> real_escape_string($userid);
	$s_userid = htmlspecialchars($e_userid, ENT_QUOTES);
	
	$e_username = $db_link -> real_escape_string($username);
	$s_username = htmlspecialchars($e_username, ENT_QUOTES);

	$e_password = $db_link -> real_escape_string($password);
	$s_password = htmlspecialchars($e_password, ENT_QUOTES);
	
	//Passwordをhashする
	$h_password = password_hash($s_password,PASSWORD_DEFAULT);
	
	//ID重複チェック
	$sql = mysqli_query($db_link, "SELECT UserID,UserName,Password FROM tp_user_cust WHERE UserID = '$s_userid'");
	$result = mysqli_fetch_assoc($sql);
	if($s_userid == $result['UserID']){
		print('<script>alert("登録に失敗しました。ユーザー名が重複している可能性があります。別のユーザーIDを使用してください"); location.href = "u_register.php";</script>');
	} else {
		
		// ユーザーデータを鯖に登録する
		mysqli_query($db_link,"INSERT INTO tp_user_cust(UserID,UserName,Password) VALUES('$s_userid','$s_username','$h_password')");
		
		// SQL文をデータベース鯖に投げる
		$sql = mysqli_query($db_link, "SELECT UserID,UserName,Password FROM tp_user_cust WHERE UserID = '$s_userid'");
		// SQLで帰ってきた答えを配列にする
		$result = mysqli_fetch_assoc($sql);
		
		// ユーザIDとパスワードが一致した場合
		if($s_userid == $result['UserID'] and password_verify($s_password, $result['Password'])) {
		
			// セッション
			session_start();
			$_SESSION['UserID'] = $s_userid;
			$_SESSION['UserName'] = $s_username;
			$logMessage = "アカウントを作成";
			$sql = mysqli_query($db_link, "INSERT INTO tp_log ('Time', 'Action', 'CustUserID') VALUES (CURRENT_TIMESTAMP, '$logMessage', '$s_userid')");
			print('<script>location.href = "index.php";</script>');
		} else {
			print('<script>alert("エラーが発生しました。もういちどやり直してください。"); location.href = "u_register.php"; </script>');
		}
	}
?>
