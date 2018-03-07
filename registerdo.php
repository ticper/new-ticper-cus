<?php 
	// コンフィグを導入
	require_once('config/config.php');
	
	// index.php から投げた内容をローカル変数に入れる
	$userid = $_POST['userid'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// SQLの特殊な文字を抜き取る
	$e_userid = $db_link -> real_escape_string($userid);
	$e_username = $db_link -> real_escape_string($username);
	$e_password = $db_link -> real_escape_string($password);
	
	//Passwordをhashする
	$h_password = password_hash($e_password,PASSWORD_DEFAULT);
	
	// ユーザーデータを鯖に登録する
	mysqli_query($db_link,"INSERT INTO tp_user_cust(UserID,UserName,Password) VALUES('$e_userid','$e_username','$h_password')");
	
	// SQL文をデータベース鯖に投げる
	$sql = mysqli_query($db_link, "SELECT UserID,UserName,Password FROM tp_user_cust WHERE UserID = '$e_userid'");
	
	// SQLで帰ってきた答えを配列にする
	$result = mysqli_fetch_assoc($sql);
	
	// ユーザIDとパスワードが一致した場合
	if($e_userid == $result['UserID'] and password_verify($e_password, $result['Password'])) {
	
	// セッション
	session_start();
	$logMessage = "アカウントを作成";
	$sql = mysqli_query($db_link, "INSERT INTO tp_log ('Time', 'Action', 'CustUserID') VALUES (CURRENT_TIMESTAMP, '$logMessage', '$e_userid')");
	print('<script>location.href = "login.php";</script>');
	} else {
	print('<script>alert("登録に失敗しました。ユーザー名が重複している可能性があります。別のユーザーIDを使用してください"); location.href = "u_register.php"; </script>');
	}
?>
