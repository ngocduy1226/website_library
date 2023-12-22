<?php  
   $id_KN = $_GET['id_contact'];

   $sql = "UPDATE `contacts` SET `status_cnt` =  2  where id_contact = $id_KN";
   $query = mysqli_query($conn,$sql);
   echo '<script> window.location="index.php?action=quan-ly-ket-noi&query=danh-sach";</script>';

?>