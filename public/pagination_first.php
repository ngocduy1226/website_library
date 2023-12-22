<?php  
   if(isset($_GET['trang'])){
    $page = $_GET['trang'];
  }else {
    $page = 1;
  }
  
//echo $page;
  if($page == '' || $page == 1){
    $begin = 0;
  }else{
     $begin = ($page*$row_page) - $row_page;
  }
?>