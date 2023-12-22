<?php

// Kết nối cơ sở dữ liệu
include '../partials/header.php';
$err = [];
?>


<div class="container">
    <div class="row d-inline">

        <div class="mb-3">
            <h2 style="color:#de3241;" class="text-center tt-text1">GIỎ HÀNG</h2>
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th style="text-align:center;">Ảnh sách</th>
                        <th style="text-align:center;">Tên sách</th>
                        <th style="text-align:center;">Số lượng</th>

                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $tong = 0; ?>
                    <?php foreach ($cart as $key => $value) : $tong += $value['soluong'] ?>
                        <tr class="text-center">
                            <td><img src=" image/<?php echo $value['image'] ?>" width="100px"></td>
                            <td><?php echo $value['name_book'] ?></td>
                            <td>
                                <form action="cart.php">
                                    <!-- <input type="hidden" name ="action" value="update"> -->
                                    <input type="hidden" name="id_book" value="<?php echo $value['id_book'] ?>">
                                    <div class="capnhat">
                                        <span type="text" name="soluong" style="width:80px;" value="1">1</span>
                                        <?php
                                        $query = mysqli_query($conn, "SELECT `quantity` FROM `books` WHERE id_book = $value[id_book]");
                                        $i = mysqli_fetch_assoc($query);
                                        $quantity = (int)$i['quantity'];

                                        if ($value['soluong'] > $quantity) {
                                            $err['soluong'] = 'Hiện tại thư viện đã hết sách ! ';
                                        }

                                        ?>

                                        <p class="erro"><?php echo (isset($err['soluong'])) ? $err['soluong'] : '' ?></p>
                                    </div>
                                </form>
                            </td>

                            <td>
                                <form action="cart.php">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id_book" value="<?php echo $value['id_book'] ?>">
                                    <button class="capnhat btn nut btn-danger" type="submit"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    <tr class="bg-light">
                        <td>Tổng sách:</td>
                        <td colspan="5" style="text-align: center;"> <?php echo $tong ?> </td>
                    </tr>
                </tbody>
            </table>

            <?php if (!isset($err['soluong'])) {
            ?>
                <div class="row justify-content-md-center">

                    <div class="col-md-auto mt-4">
                        <a href="order.php" class="btn btn-cart" width="100%">THÊM THÔNG TIN ĐƠN MƯỢN SÁCH</a>
                    </div>


                </div>

            <?php  } ?>


        </div>
    </div>
</div>
</div>

<?php include '../partials/footer.php'; ?>