<?php 
    
    if (session_status() === PHP_SESSION_NONE) { //tránh gọi sesstion start quá nhiều 
        session_start();
    }
    
    include __DIR__ . "/config.php"; //include tuyệt đối
?>
<!-- header -->
<header>
    <div class="container">
        <div class="nav">
            <div class="logo">
                <img src="<?php echo BASE_URL; ?>/project/images/d936cdcc28e1f6d50c8b30eef7255d3d.png" />
            </div>

            <div class="menu">
                <div class="menu_list"><a href="<?php echo BASE_URL; ?>trangchu/index.php">TRANG CHỦ</a></div>

                <div class="menu_list dropdown">
                    GIỚI THIỆU <i class="fa-solid fa-angle-down"></i>
                    <ul>
                        <li><a href="#">Về chúng tôi</a></li>
                        <li><a href="#">Đội ngũ</a></li>
                        <li><a href="#">Lịch sử phát triển</a></li>
                    </ul>
                </div>

                <div class="menu_list"><a href="<?php echo BASE_URL; ?>trangchu/index.php#products">SẢN PHẨM</a></div>

                <div class="menu_list dropdown">
                    TIN TỨC <i class="fa-solid fa-angle-down"></i>
                    <ul>
                        <li><a href="#">Tin khuyến mãi</a></li>
                        <li><a href="#">Tin công nghệ</a></li>
                        <li><a href="#">Blog chia sẻ</a></li>
                    </ul>
                </div>

                <div class="menu_list"><a href="<?php echo BASE_URL; ?>trangchu/index.php#subscribe">LIÊN HỆ</a></div>
            </div>

            <!-- list icon -->
            <div class="list-icon">
                <div class="item">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>

                <div class="item--dropdown">
                    <i class="fa-regular fa-user"></i>
                    <span>
                        <?php 
                            if(isset($_SESSION["mySession"])) {
                                echo "Xin chào, " . htmlspecialchars($_SESSION["mySession"]);
                            } else {
                                echo "Tài khoản";
                            }
                        ?>
                    </span>
                    <ul>
                        <li><a href="<?php echo BASE_URL . 'auth/signup.php'; ?>">Đăng ký</a></li>
                        <li><a href="<?php echo BASE_URL . 'auth/logout.php'; ?>">Đăng xuất</a></li>
                    </ul>
                </div>

                <div class="item--dropdown">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <ul>
                        <li><a href="#">Bạn chưa có đơn hàng nào!</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>