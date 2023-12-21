<?php 

//session_start(); 
 
if (isset($_SESSION['username'])){
    unset($_SESSION['username']); // xóa session login
    unset($_SESSION['cart']);
//    header('location: /');
echo '<script language="javascript"> window.location="login.php";</script>';

}
?>

