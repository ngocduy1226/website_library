<?php  
   $id_borrow = $_GET['id_borrow'];
  $sql = "UPDATE `borrows` SET `deleteOn`= 0 WHERE id_borrow = $id_borrow";
   $query = mysqli_query($conn,$sql);
  echo '<script language="javascript"> window.location="index.php?action=quan-ly-muon-sach&query=danh-sach";</script>';
?>