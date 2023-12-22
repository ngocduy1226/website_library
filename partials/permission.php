<?php
if (isset($_SESSION['username']) == false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: login.php');
}else {
	if (isset($_SESSION['username']) == true) {
		$username = $_SESSION['username'];
        $sql_per= mysqli_query($conn, "SELECT * FROM `accounts` WHERE username = '$username';");
		$per = mysqli_fetch_assoc($sql_per);
		// Ngược lại nếu đã đăng nhập
		$permission = $per['level'];

		// Kiểm tra quyền của người đó có phải là admin hay không
		if ($permission == '0') {
			// Nếu không phải admin thì xuất thông báo
			echo "Bạn không đủ quyền truy cập vào trang này<br>";
			echo "<a href='../index.php'> Click để về lại trang chủ</a>";
			exit();
		}
	}
}
?>