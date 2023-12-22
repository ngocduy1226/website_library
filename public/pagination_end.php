<?php

            if (isset($_GET['brand'])) {
                $get_brand = $_GET['brand'];
            } else {
                $action = '';
                $query = '';
            }
            ?>
            <nav aria-label="Page navigation example">

                <?php
                $row_count = mysqli_num_rows($sql_trang);
                $total_page = ceil($row_count / $row_page);
                ?>
                <p> Trang:<?php echo $total_page ?></p>
                <ul class="pagination justify-content-center">
                    <?php
                    if ($page > 3) {
                        $first_page = 1;
                    ?>
                        <li class="page-item">
                            <a class="page-link text-dark" href="?brand=<?php echo $get_brand ?>&trang=<?php echo $first_page ?>">First</a>
                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    if ($page > 1) {
                        $prev_page = $page - 1;
                    ?>
                        <li class="page-item">
                            <a class="page-link text-dark" href="?brand=<?php echo $get_brand ?>&trang=<?php echo $prev_page ?>">Prev</a>

                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i != $page) {

                    ?>
                            <li class="page-item">
                                <?php if ($i > $page - 3 && $i < $page + 3) { ?>
                                    <a class="page-link text-dark" href="?brand=<?php echo $get_brand ?>&trang=<?php echo $i; ?>"><?php echo $i ?></a>
                            </li>

                        <?php
                                }
                            } else {
                        ?>
                        <li class="page-item">
                            <strong class="current-page page-item page-link bg-dark text-white"> <?php echo $i ?> </strong>
                        </li>
                    <?php
                            }
                        }

                        if ($page < $total_page - 1) {
                            $next_page = $page + 1;
                    ?>
                    <li class="page-item">
                        <a class="page-link text-dark" href="?brand=<?php echo $get_brand ?>&trang=<?php echo $next_page ?>">Next</a>

                    </li>
                <?php
                        }

                        if ($page < $total_page - 3) {
                            $end_page = $total_page;
                ?>
                    <li class="page-item">
                        <a class="page-link text-dark" href="?brand=<?php echo $get_brand ?>&trang=<?php echo $end_page ?>">End</a>

                    </li>
                <?php
                        }
                ?>

                </ul>
            </nav>