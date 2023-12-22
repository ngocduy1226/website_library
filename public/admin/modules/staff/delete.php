<?php  
   $id_staff = $_GET['id_staff'];
   $sql = "UPDATE `staffs` SET `status_staff` = '1' WHERE `staffs`.`id_staff` = $id_staff";
   $query = mysqli_query($conn,$sql);
   //header('location: index.php?action=qldanhmucsp&query=danhsach');
  echo '<script language="javascript">alert("Bạn đã xóa nhân viên thành công!"); window.location="index.php?action=quan-ly-nhan-vien&query=danh-sach";</script>';

?>