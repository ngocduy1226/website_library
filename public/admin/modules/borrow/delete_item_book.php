<?php 
    $id_borrow = $_GET['id_borrow'];
    $id_book=  $_GET['id_book'];
    $sql = mysqli_query($conn, "DELETE FROM `item_borrow` WHERE id_borrow = $id_borrow AND id_book = $id_book");
    echo '<script language="javascript">alert("Bạn xóa sách trong đơn hàng thành công!"); 
    window.location="index.php?action=quan-ly-muon-sach&query=xem&id_borrow='.$id_borrow.'";</script>';
?>