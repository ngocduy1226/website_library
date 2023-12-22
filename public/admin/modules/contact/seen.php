<?php 
   
  //  $row_page = 10;
  //  include "../pagination_first.php";
  // $sql = "SELECT * FROM contacts order by status_cnt ASC  LIMIT $begin, $row_page";
  $sql = "SELECT * FROM contacts WHERE status_cnt = 0 OR status_cnt = 1 order by status_cnt ASC";
   $query = mysqli_query($conn, $sql);
   //$sql_trang = mysqli_query($conn,"SELECT * FROM ketnoi") ;

   $id_contact = $_GET['id_contact']; 
  // echo $id_KN;
   $seen_query = mysqli_query($conn,"SELECT * FROM `contacts` WHERE id_contact = $id_contact;"); 
   $seen = mysqli_fetch_assoc($seen_query);
   

   if(isset($_POST['check-seen'])){
      $up_query = mysqli_query($conn,"UPDATE `contacts` SET `status_cnt`='1' WHERE id_contact= $id_contact ;"); 
   }


    $sql_count_cont = mysqli_query($conn,"SELECT COUNT(id_contact) AS NumberCon FROM contacts;");
    $count_cont = mysqli_fetch_assoc($sql_count_cont);
    $count_connect = (int)$count_cont['NumberCon'];


    
$sql_count_cont_bin = mysqli_query($conn, "SELECT COUNT(id_contact) AS NumberCon FROM contacts WHERE status_cnt = 2;");
$count_cont_bin = mysqli_fetch_assoc($sql_count_cont_bin);
$count_connect_bin = (int)$count_cont_bin['NumberCon'];
?>

<style>
     .modal-footer {
        justify-content: space-between;
        
  }
  .btn_cal {
    padding: 10px 20px;
    background-color: #333;
    color: #f1f1f1;
    border-radius: 0;
    transition: .2s;
  }
  .btn_cal:hover, .btn_cal:focus {
    border: 1px solid #333;
    background-color: #fff;
    color: #000;
  }

   .modal-header {
    display: inline;
   }
  .modal-header, h4, .close {
    background-color: #333;
    color: #fff !important;
    text-align: center;
    font-size: 30px;
  }
  
  h3, h4 {
    margin: 10px 0 30px 0;
    letter-spacing: 10px;
    font-size: 20px;
    color: #111;
        font-family: inherit;
    font-weight: 500;
    line-height: 1.1
}
  .modal-header, .modal-body {
    padding: 40px 50px;
  }
  
    .modal-header .close {
            margin-top: -38px;
    margin-right: -38px;
    padding: 10px;
    }  
  

  .user-icon {
    font-size: 14px;
    margin-right: 5px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 1px solid #000;
    line-height: 30px !important;
    text-align: center;
    color: #000;
  }
</style>


<div class="content-wrapper">
  <div class="content-header">
    
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">DANH SÁCH KẾT NỐI</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Kết nối</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>


  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex" style="justify-content: space-between;">
              <h3 class="card-title"> Các kết nối(<?php echo $count_connect ?>)</h3>

              <h3 class="card-title ml-5"><a href="index.php?action=quan-ly-ket-noi&query=thung-rac">Thùng rác( <?php echo  $count_connect_bin ?>)</a></h3>

            </div>
            <div class="card-body">


              <table id="example1" class="table table-bordered table-striped" style="text-align:center;">
                <thead class="thead-dark">
                  <tr>
                  <tr>
                    <th>#</th>
                    <th>ID kết nối</th>
                    <th>Tên đăng nhập</th>
                    <th>Email</th>
                    <th>Ngày gửi</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                  </tr>
                  </tr>
                </thead>
                <tbody>
                    <?php  
                    $i = 1;
                      while($row = mysqli_fetch_assoc($query)){
                    ?>
                        <tr>
                            <td><?php  echo $i++; ?></td>
                            <td><?php  echo $row['id_contact']; ?></td>
                            <td><?php  echo $row['username']; ?></td>
                            <td><?php  echo $row['email']; ?></td>
                            <td><?php echo date('d/m/y H:i', $row['date_send'])?>    </td>
                            <td>
                                <?php if($row['status_cnt'] == 0){ ?>
                                  <span class="badge bg-danger">   Chưa đọc </span>
                                <?php } else{ ?>
                                  <span class="badge bg-success">   Đã đọc </span>
                                <?php } ?>
                            </td>
                             <!-- <td>
                               <a class="btn btn-primary" href="?action=qlketnoi&query=xem&id_KN=<?php echo $row['id_KN'] ?>">Xem</a> 
                            </td> -->
                             <td>
                                <a data-toggle="modal" data-target="#myModal" href="#"><button class="btn btn-primary" ><i class="fa-solid fa-arrow-up-right-from-square"></i></button></a>
                                <a onclick = "return Delete('<?php echo $row['id_contact'] ?>')" class="btn btn-danger" aria-disabled="true" href="?action=quan-ly-ket-noi&query=xoa&id_contact=<?php echo $row['id_contact'] ?>"><i class="fa-regular fa-trash-can"></i></a>
                            </td>
                        </tr>

                   <?php } ?>
                </tbody>
              </table>

                       <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="text-center">
               <span><i class="fa-solid fa-message"></i></span> 
               <span>Tin nhắn</span> 
           </h4>
        </div>
        <div class="modal-body">
            <div>
                <span class="" ><i class="user-icon fa-solid fa-user"></i></span>
                <span><?php echo $seen['username'] ?></span>
            </div>
           <div class="mb-5 mt-2" style=" border: 3px solid #ccc; border-radius:10px;">
                <?php echo $seen['content'] ?>
           </div>
          <form role="form" method="POST">
              <button name="check-seen" type="submit" class="btn_cal btn-block">Đã xem
                <span><i class="fa-solid fa-check"></i></span>
              </button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn_cal btn-danger btn-default pull-left" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </button>
          <p>Need <a href="#">help?</a></p>
        </div>
      </div>
    </div>
  </div>   
            </div>


          </div>
        </div>
      </div>

    </div>

  </section>

</div>


<script>
   function Delete(name){
    return confirm("Bạn có chắc chắn muốn xóa kết nối không ?");
   }
</script>

