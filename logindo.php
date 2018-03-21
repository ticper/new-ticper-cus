<?php 
	// コンフィグを導入
	require_once('config/config.php');
	
	// index.php から投げた内容をローカル変数に入れる
	$userid = $_POST['userid'];
	$password = $_POST['password'];
	
	// SQLの特殊な文字を抜き取る
	$e_userid = $db_link -> real_escape_string($userid);
	$s_userid = htmlspecialchars($e_userid, ENT_QUOTES);

	$e_password = $db_link -> real_escape_string($password);
	$s_passwors = htmlspecialchars($e_password, ENT_QUOTES);
	
	// SQL文をデータベース鯖に投げる
	$sql = mysqli_query($db_link, "SELECT UserID,UserName,Password FROM tp_user_cust WHERE UserID = '$s_userid'");
	// SQLで帰ってきた答えを配列にする
	$result = mysqli_fetch_assoc($sql);
	
	// ユーザIDとパスワードが一致した場合
	if($s_userid == $result['UserID'] and password_verify($s_password, $result['Password'])) {
	
		// セッション
		session_start();
		$_SESSION['UserID'] = $s_userid;
		$_SESSION['UserName'] = $result['UserName'];
		$logMessage = "ログインしました";
		$sql = mysqli_query($db_link, "INSERT INTO tp_log ('Time', 'Action', 'CustUserID') VALUES (CURRENT_TIMESTAMP, '$logMessage', '$s_userid')");
		print('<script>location.href = "index.php";</script>');
	} else {
		print('<script>alert("ログインに失敗しました。ユーザIDとパスワードを確認してください。"); location.href = "login.php"; </script>');
	}
?>