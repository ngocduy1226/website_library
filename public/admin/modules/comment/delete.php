<?php  
   $id_CMT = $_GET['id_CMT'];

   $sql = "UPDATE `comments` SET `status_cmt`= 2 where id_CMT = $id_CMT";
   $query = mysqli_query($conn,$sql);
  echo '<script language="javascript"> window.location="index.php?action=quan-ly-binh-luan&query=danh-sach";</script>';
?>