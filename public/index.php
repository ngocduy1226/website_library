<?php

// Kết nối cơ sở dữ liệu

include '../partials/header.php';

?>

    <section >
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="image/home/home1.jpg" alt="First slide">
              <div class="carousel-caption d-none d-md-block">
                <p>Welcome to</p>
                <h5>BOOKLOVER</h5>
                
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100"  style="height:540px"  src="image/home/home2.jpg" alt="Second slide">
              <div class="carousel-caption d-none d-md-block">

                <h5>BOOKLOVER</h5>
                <p>Sách hay đang đợi các bạn</p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="image/home/home3.jpg" alt="Third slide">
              <div class="carousel-caption d-none d-md-block">
                <h5>BOOKLOVER</h5>
                <p>Sách là người bạn không thể thiếu</p>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </section>
      
    <section class="section-welcome">
        <div class="container ">
           <div class="row section-welcome-pd">
             <div class="col-md-6">
                <div class="wrap-text-welcome text-center">
                  <span>Giới thiệu về</span>
                  <h3>Nhà sách BookLover </h3>
                  <p class="mt-4">Sách quốc văn với nhiều thể loại đa dạng như sách giáo khoa – tham khảo, giáo trình, sách học ngữ, từ điển, sách tham khảo thuộc nhiều chuyên ngành phong phú: văn học, tâm lý – giáo dục, khoa học kỹ thuật, khoa học kinh tế - xã hội, khoa học thường thức, sách phong thủy, nghệ thuật sống, danh ngôn, sách thiếu nhi, truyện tranh, truyện đọc, từ điển, công nghệ thông tin, khoa học – kỹ thuật, nấu ăn, làm đẹp... </p>
                </div>
             </div>

             <div class="col-md-6">
                 <div class="welcome-pic d-block ">
                    <img src="image/home/introduce.jpg" alt="" class="pic-zoom">
                 </div>
             </div>
           </div>
       </div>
    </section>

    <section class="ourmenu mt-5">
      <div class="container">
        <div class="ourmenu-title text-center mb-4">
          <span class="til-1">
            <font style="vertical-align: inherit">
                Khám phá
            </font> 
          </span>
          <h3 class="til-2">
            <font style="vertical-align: inherit">
               <font style="    vertical-align: inherit">
                  Danh mục sách của chúng tôi
               </font>
            </font>
            
          </h3>
        </div>
        <div class="row">
           <div class="col-md-8">
               <div class="row">
                    <div class="col-sm-6">
                        <div class="hov-img-zoom">
                          <img class="pic-ourmenu" src="image/home/home11.jpeg" alt="IMG-MENU" data-pagespeed-url-hash="1982596582" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                          <a href="book.php?brand=tam+ly" class="btn-menu size1 text5 font1 flex-1 text-center">
                            Kĩ năng sống
                          </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                         <div class="hov-img-zoom">
                          <img class="pic-ourmenu" src="image/home/home5.jpg" alt="IMG-MENU" data-pagespeed-url-hash="1982596582" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                          <a href="book.php?brand=Báo%20-%20Tạp%20chí" class="btn-menu size1 text5 font1 flex-1 text-center">
                            Tạp chí
                          </a>
                        </div>
                    </div>
                    <div class="col-12">
                         <div class="hov-img-zoom">
                          <img class="pic-ourmenu" style="height:384px" src="image/home/home4.jpg" alt="IMG-MENU" data-pagespeed-url-hash="1982596582" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                          <a href="book.php?brand=Nghệ%20thuật%20-%20Du%20lịch" class="btn-menu size2 text5 font1 flex-1 text-center">
                            Nghệ thuật
                          </a>
                        </div>
                    </div>
               </div>
           </div>

           <div class="col-md-4">
               <div class="row">
                <div class="col-12">
                  <div class="hov-img-zoom">
                          <img class="pic-ourmenu"  src="image/home/home10.jpeg" alt="IMG-MENU" data-pagespeed-url-hash="1982596582" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                          <a href="book.php?brand=Văn%20học" class="btn-menu size3 text5 font1 flex-1 text-center">
                            Văn học
                          </a>
                        </div>
                </div>
                <div class="col-12">
                  <div class="hov-img-zoom">
                          <img class="pic-ourmenu" src="image/home/home8.jpg" alt="IMG-MENU" data-pagespeed-url-hash="1982596582" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                          <a href="brand=Sách%20học%20ngoại%20ngữ" class="btn-menu size1 text5 font1 flex-1 text-center">
                            Ngoại ngữ
                          </a>
                        </div>
                </div>
                <div class="col-12">
                  <div class="hov-img-zoom">
                          <img class="pic-ourmenu" src="image/home/home9.jpg" alt="IMG-MENU" data-pagespeed-url-hash="1982596582" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                          <a href="book.php?brand=Kinh%20tế" class="btn-menu size4 text5 font1 flex-1 text-center">
                           Kinh tế
                          </a>
                        </div>
                </div>
               </div>
           </div>
        </div>
      </div>
    </section>


     <section class="service bg-light ">
        <div class="container pb-5">
          <div class="row  align-items-end">
            <div class="col-lg-12 text-center my-5">
              <h2 class="" style="font-family:ui-monospace; font-weight:600"  >CÁC DỊCH VỤ TẠI THƯ VIỆN</h2>
            </div>
            
              <div class="col-lg-4 text-center ">
                <div class="col-lg-12  ">
                  <img class="img-fluid " src="./image/sinhnhat.PNG" alt="">
                </div>
                <div class="col-lg-12 ">
                  <h5>Đọc sách miễn phí</h5>
                  <p>khách hàng có thể dễ dàng tìm thấy những cuốn sách hay, đa thể loại của nhiều nhà xuất bản, công ty sách trong và ngoài nước. Cùng tiêu chí không ngừng hoàn thiện, nâng cao chất lượng sản phẩm, dịch vụ,</p>
                </div>
              </div>

              <div class="col-lg-4   text-center">
                <div class="col-lg-12 ">
                  <img class="img-fluid " src="./image/hop.PNG" alt="">
                </div>
                <div class="col-lg-12 ">
                  <h5>Nguồn gốc sách</h5>
                  <p>Phong phú, chính hãng, có nguồn gốc xuất xứ rõ ràng, đến từ những thương hiệu lớn trong và ngoài nước. Ngoài ra, Nhà Sách Phương Nam thường xuyên cập nhật xu hướng để giới thiệu nhiều sản phẩm mới nhằm đáp ứng thị hiếu và nhu cầu của khách hàng.</p>
                </div>
              </div>

              <div class="col-lg-4  text-center">
                <div class="col-lg-12 ">
                  <img class="img-fluid " src="./image/cuoi.PNG" alt="">
                </div>
                <div class="col-lg-12 p-0">
                  <h5>Sự uy tính của BookLover</h5>
                  <p>Danh mục hàng hóa phong phú, nhiều sản phẩm độc quyền, được chọn lọc kỹ càng đã tạo nên sự khác biệt. Đồng thời mang những sản phẩm của hệ thống nhà sách đến với mọi khách hàng trên cả nước.</p>
                </div>
              </div>
           
          </div>
        </div>
      </section>



<?php
include '../partials/footer.php';

?>
