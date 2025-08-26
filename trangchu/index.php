<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Điện máy xanh - Siêu thị điện máy</title>
    <link rel="stylesheet" href="../trangchu/style.css" />
    <link rel="stylesheet" href="../font/fontawesome-free-7.0.0-web/css/all.min.css" />
    <link rel="icon" href="./images/1742374793_67da878a0f466.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
</head>

<style>
.toggle {
    display: block;
    position: fixed;
    bottom: 20px;
    right: 20px;
    cursor: pointer;
    transition: transform 0.2s ease;

}

.toggle:hover {
    transform: scale(1.1);
}

.toggle img {
    border-radius: 5px;
    height: 50px;
    width: 50px;
    object-fit: cover;
}

.chatbox {
    display: none;
    width: 300px;
    height: 400px;
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    animation: slideUp 0.3s ease;
}

@keyframes slideUp {
    from {
        transform: translateY(50px);
        opacity: 0;
    }

    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.message.user {
    background: #dcf8c6;
    /* tự động căn chỉnh ra trái */
    margin-left: auto;
    margin-bottom: 185px;
}

.close-btn {
    font-size: 13px;
    float: right;
    right: 5px;
    cursor: pointer;
    transition: color 0.2s ease;
}

.close-btn:hover {
    color: #ffdddd;
}
</style>


<?php
    include "../DB/connect.php";
    include "../config.php";
    session_start();

    // kiểm tra session bên login.php có tồn tại không
    if(!isset($_SESSION["mySession"])) {
        header("location:" . BASE_URL .  "auth/login.php");
    }
?>

<?php 
    include "../DB/connect.php";
    include "../config.php";

    if(!isset($_SESSION["mySession"])) {
        header("location" . BASE_URL . "auth/login.php");
    }

?>

<body>
    <!-- on header -->
    <div class="head">
        <!-- head left -->
        <div class="head--left">
            <p class="title__head">
                <i class="fa-regular fa-clock"></i>
                Mở cửa 8:00-17:30: Thứ 2 - Thứ 7
            </p>
        </div>
        <!-- head right -->
        <div class="head--right">
            <div class="info">
                <i class="fa-regular fa-envelope"></i>
                <a>team7@gmail.com</a>
            </div>
            <div class="info">
                <i class="fa-solid fa-phone"></i>
                <a>0399501846</a>
            </div>
            <div class="info--call">LIÊN HỆ</div>
        </div>
    </div>

    <!-- header -->
    <header>
        <div class="container">
            <div class="nav">
                <div class="logo">
                    <img src="../project/images/d936cdcc28e1f6d50c8b30eef7255d3d.png" />
                </div>

                <div class="menu">
                    <div class="menu_list">TRANG CHỦ</div>

                    <div class="menu_list dropdown">
                        GIỚI THIỆU
                        <i class="fa-solid fa-angle-down"></i>
                        <ul>
                            <li><a href="#">Về chúng tôi</a></li>
                            <li><a href="#">Đội ngũ</a></li>
                            <li><a href="#">Lịch sử phát triển</a></li>
                        </ul>
                    </div>

                    <div class="menu_list">
                        <a href="#products">SẢN PHẨM</a>
                    </div>

                    <div class="menu_list dropdown">
                        TIN TỨC
                        <i class="fa-solid fa-angle-down"></i>
                        <ul>
                            <li><a href="#">Tin khuyến mãi</a></li>
                            <li><a href="#">Tin công nghệ</a></li>
                            <li><a href="#">Blog chia sẻ</a></li>
                        </ul>
                    </div>

                    <div class="menu_list">
                        <a href="#subscribe">LIÊN HỆ</a>
                    </div>
                </div>

                <!-- list icon -->
                <div class="list-icon">
                    <div class="item">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>

                    <div class="item--dropdown">
                        <i class="fa-regular fa-user"></i>
                        <span>Hello Admin!</span>
                        <ul>
                            <li><a href=" <?php echo BASE_URL . 'auth/signup.php'; ?>">Đăng ký</a></li>
                            <li><a href=" <?php echo BASE_URL . 'auth/logout.php'; ?> ">Đăng xuất</a></li>
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

    <!-- banner -->
    <div class="img--banner">
        <img id="bannerImg"
            src="../project/images/y-tuong-quang-cao-cua-dien-may-xanh-f8020d7a-fa8c-4752-be90-7fb46e78c9b2.jpg" />
    </div>

    <!-- products -->
    <div class="product--services" id="products">
        <!-- head -->
        <h2>Danh mục sản phẩm</h2>
        <p>
            Khám phá bộ sưu tập thiết bị điện tử, điện lạnh chất lượng cao với giá
            cả hợp lý
        </p>

        <!-- list-products -->
        <div class="product--grid">
            <div class="product--item">
                <img src="../project/images/refrigerator.png" width="85px" />
                <h3>Tủ lạnh</h3>
                <p>
                    Tủ lạnh các loại: Side by Side, Inverter, Mini - Tiết kiệm điện, bảo
                    quản thực phẩm tươi ngon
                </p>
                <a href="<?php echo BASE_URL . 'project/products/product1/index1.php'; ?>" class="detail-link">Xem tủ
                    lạnh</a>

            </div>

            <div class="product--item">
                <img src="../project/images/washing-machine.png" width="85px" />
                <h3>Máy giặt</h3>
                <p>
                    Máy giặt cửa trước, cửa trên - Công nghệ Inverter, giặt sạch, tiết
                    kiệm nước
                </p>
                <a href="<?php echo BASE_URL . 'project/products/product2/index2.php'; ?>" class="detail-link">Xem máy
                    giặt</a>
            </div>

            <div class="product--item">
                <img src="../project/images/television.png" width="85px" />
                <h3>Television</h3>
                <p>Smart TV 4K, OLED, QLED - Màn hình sắc nét, âm thanh sống động</p>
                <a href="../project/products/product3/index3.php" class="detail-link">Xem tivi</a>
            </div>

            <div class="product--item">
                <img src="../project/images/ac.png" width="85px" />
                <h3>Điều hòa</h3>
                <p>
                    Máy lạnh Inverter, 2 chiều - Làm lạnh nhanh, tiết kiệm điện năng
                </p>
                <a href="<?php echo BASE_URL . 'project/products/product4/index4.php'; ?>" class="detail-link">Xem điều
                    hòa</a>
            </div>

            <div class="product--item">
                <img src="../project/images/speaker.png" width="85px" />
                <h3>Loa</h3>
                <p>
                    Loa chất lượng âm thanh sống động, mạnh mẽ. Thiết kế hiện đại, phù
                    hợp mọi không gian
                </p>
                <a href="<?php echo BASE_URL . 'project/products/product5/index5.php'; ?>" class="detail-link">Xem
                    loa</a>
            </div>
        </div>
    </div>

    <!-- features -->
    <section class="intro--cards">
        <!-- 3 box dịch vụ -->
        <div class="container--box">
            <div class="card">
                <img src="../project/images/customer-support.png" width="70px" />
                <h3>Chuyên nghiệp - Tận tâm</h3>
                <p>
                    Đội ngũ tư vấn viên & chăm sóc khách hàng kinh nghiệm, chuyên
                    nghiệp, tận tâm
                </p>
                <a href="#">Xem thêm</a>
            </div>
            <div class="card">
                <img src="../project/images/shield.png" width="70px" />
                <h3>Bảo hành chính hãng</h3>
                <p>
                    Cam kết bảo hành chính hãng, hỗ trợ đổi trả nhanh chóng và minh bạch
                    với mọi sản phẩm.
                </p>
                <a href="#">Xem thêm</a>
            </div>
            <div class="card">
                <img src="../project/images/outline.png" width="70px" />
                <h3>Giao hàng tận nơi</h3>
                <p>
                    Giao hàng nhanh chóng toàn quốc, lắp đặt tận nơi cho các thiết bị
                    điện tử, điện lạnh.
                </p>
                <a href="#">Xem thêm</a>
            </div>
        </div>
    </section>

    <section class="service--intro">
        <!-- Text giới thiệu + Hình ảnh -->
        <div class="container--introduce">
            <div class="content">
                <h2>Dịch vụ bán hàng và hậu mãi Điện Máy Xanh</h2>
                <p>
                    Với hệ thống siêu thị toàn quốc, Điện Máy Xanh mang đến cho khách
                    hàng trải nghiệm mua sắm tiện lợi, đa dạng sản phẩm cùng dịch vụ hậu
                    mãi tận tâm.
                </p>
                <ul class="feature-list">
                    <li class="list">
                        <img src="../project/images/check.png" width="20px" />
                        Dịch đơn giản và dễ sử dụng
                    </li>
                    <li class="list">
                        <img src="../project/images/check.png" width="20px" />
                        Đội ngũ nhân viên tiêu chuẩn
                    </li>
                    <li class="list">
                        <img src="../project/images/check.png" width="20px" />
                        Chính sách bảo hành dịch vụ
                    </li>
                    <li class="list">
                        <img src="../project/images/check.png" width="20px" />
                        Quản lý chi tiết, dễ sử dụng
                    </li>
                    <li class="list">
                        <img src="../project/images/check.png" width="20px" />
                        Bảo hành chất lượng dịch vụ
                    </li>
                    <li class="list">
                        <img src="../project/images/check.png" width="20px" />
                        Quản lý lịch sử, số tiền đã sử dụng
                    </li>
                </ul>
                <p>
                    Hơn cả một nơi mua sắm, Điện Máy Xanh mang đến dịch vụ và trải
                    nghiệm khách hàng hàng đầu trong lĩnh vực bán lẻ điện máy tại Việt
                    Nam.
                </p>
                <a href="#">Xem thêm</a>
            </div>

            <div class="intro--image">
                <img src="../project/images/cleanza-about-0x0.jpg" alt="Intro Image" />
            </div>
        </div>
    </section>

    <section class="why--choose">
        <!-- Hình ảnh + Lý do chọn chúng tôi -->
        <div class="container--choose">
            <div class="intro--image">
                <img src="../project/images/cleanza-why-0x0.jpg" alt="Intro Image" />
            </div>
            <div class="content">
                <h2>Tại sao chọn Điện Máy Xanh?</h2>
                <p>
                    Chúng tôi không chỉ cung cấp sản phẩm điện máy chất lượng, mà còn
                    mang đến trải nghiệm mua sắm tiện lợi và dịch vụ chăm sóc khách hàng
                    tận tâm.
                </p>

                <h3>Giao hàng siêu tốc</h3>
                <p>
                    Đặt hàng online và nhận sản phẩm chỉ sau vài giờ, lắp đặt tận nơi.
                </p>

                <h3>Giá cả minh bạch</h3>
                <p>
                    Cam kết giá niêm yết rõ ràng, nhiều chương trình ưu đãi hấp dẫn mỗi
                    ngày.
                </p>

                <h3>Dịch vụ đa dạng</h3>
                <p>
                    Hỗ trợ trả góp, bảo hành, lắp đặt, đổi trả,... giúp bạn an tâm mua
                    sắm.
                </p>

                <h3>An tâm mua sắm</h3>
                <p>
                    Mỗi sản phẩm đều được bảo hành chính hãng, đổi trả nhanh chóng nếu
                    phát sinh lỗi.
                </p>
            </div>
        </div>
    </section>

    <!-- Sản phẩm đặc quyền -->
    <div class="special-products">
        <h2>Sản Phẩm Đặc Quyền</h2>
        <div class="special-products-container">
            <!-- banner bên trái -->
            <div class="special-banner">
                <img src="../project/images/8a620917c501c24c17de50daa95bbffb.png" alt="Banner sản phẩm" />
            </div>

            <!-- bên phải: Sản phẩm -->
            <div class="special-list">
                <!-- Sản phẩm  -->
                <?php 
                    include "../DB/connect.php";
                    include "../config.php";

                    $sql = "SELECT * FROM sanpham ORDER BY RAND() LIMIT 4";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($result)) {
                ?>
                <div class="product-card">
                    <span class="label new"><?php echo "Mẫu mới" ?></span>
                    <img width="40px" height="40px" src="../project/images/<?php echo $row["image"];?>"
                        alt="Ảnh đặc quyền">
                    <h3><?php echo $row["product_name"]; ?></h3>
                    <p class="desc"><?php echo $row["description"] ?></p>
                    <div class="price">
                        <span class="new-price"><?php echo number_format($row['price'], 0, ',', '.'); ?>₫</span><br>
                        <span class="old-price"><?php echo number_format($row['old_price'], 0, ',', '.'); ?>₫</span>
                    </div>
                    <p class="gift"><?php echo $row['gift']; ?></p>
                    <div class="rating">⭐ <?php echo $row['rating']; ?> • Đã bán <?php echo $row['sold_count']; ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Tuần lễ thương hiệu -->
    <section class="banner-brand-weed">
        <!-- Tiêu đề -->
        <div class="box-title">Tuần Lễ Thương Hiệu SamSung</div>
        <!-- Banner -->
        <div class="box-banner">
            <img src="../project/images/e9050055090749250b37a0b4ffc7cc6b.png" />
        </div>
    </section>

    <!-- Gian hàng ưu đãi -->
    <section class="banner-offers">
        <!-- Tiêu đề -->
        <div class="box-title">Gian Hàng Ưu Đãi</div>
        <!-- list banner -->
        <div class="box-banner-offers">
            <div class="item">
                <img src="../project/images/1465ba30bac4777e6544f999238e4dc0.png" />
            </div>
            <div class="item">
                <img src="../project/images/545b2b7f8cb477c5f9f6f30f72b2c020.png" />
            </div>
            <div class="item">
                <img src="../project/images/28102771abaaed4a8de67f5c8e75597a.png" />
            </div>
            <div class="item">
                <img src="../project/images/d4e8c2faca7d2f60ad6961412f53e767.png" />
            </div>
        </div>
    </section>

    <!-- Chủ đề -->
    <section class="home-news">
        <!-- phần đầu -->
        <h2 class="title-new">#CHỦ ĐỀ</h2>
        <div class="btn-news">
            <button class="btn active">Khuyến mãi</button>
            <button class="btn">Mạng xã hội Điện máy XANH</button>
        </div>
        <!-- chủ đề list - phần sau -->
        <div class="list-news">
            <!-- các item -->
            <div class="item-news">
                <img src="../project/images/chude1.png" alt="Sale sập sàn" />
                <p>
                    NGÀY SALE SẬP SÀN. Duy nhất 17h ngày 09/08 Cơ hội trúng tủ lạnh 45
                    lít/ Quạt lửng trị giá lên đến 2.74 triệu
                </p>
            </div>
            <div class="item-news">
                <img src="../project/images/chude2.jpg" alt="Laptop HP 240" />
                <p>
                    Mua Laptop HP 240 giá chỉ từ 11.790.000đ – Tặng chuột không dây,
                    Office miễn phí, ưu đãi trả chậm 0%
                </p>
            </div>
            <div class="item-news">
                <img src="../project/images/chude3.png" alt="Phiếu mua hàng" />
                <p>TẶNG PHIẾU MUA HÀNG ĐẾN 500.000Đ KHI MUA SẢN PHẨM GIA DỤNG</p>
            </div>
            <div class="item-news">
                <img src="../project/images/chude4.png" alt="Tủ lạnh LG" />
                <p>Đón hè rực rỡ: Thay cũ đổi mới tủ lạnh LG cực hấp dẫn</p>
            </div>
        </div>
        <!-- Xem thêm -->
        <a href="#" class="xem-them">Xem thêm</a>
    </section>

    <!-- Liên hệ -->
    <section class="subscribe--section" id="subscribe">
        <h2>Đăng ký nhận tin</h2>
        <p>Nhận thông tin sản phẩm mới nhất, tin khuyến mãi và nhiều hơn nữa.</p>

        <div class="subscribe--form">
            <div class="form--group">
                <input type="email" placeholder="Email" />
                <input type="text" placeholder="Tên" />
            </div>
            <button type="submit">ĐĂNG KÝ</button>
        </div>
    </section>

    <!-- Chatbox -->
    <div class="toggle" id="toggle" onclick="handleClick()">
        <img src="../project/images/ai-chat-2gx0cq.png" alt="Anh chatbox">
    </div>

    <div class="chatbox" id="chatbox">
        <!-- header -->
        <div class="chatbox-header">
            <span>Chat với chúng tôi</span>
            <span class="close-btn" onclick="closeChatbox()"><i class="fa-solid fa-x"></i></span>
        </div>
        <!-- body -->
        <div class="chatbox-body">
            <div class="message bot">Xin chào! Mình có thể giúp gì cho bạn?</div>
            <div class="message user">Mình muốn hỏi về sản phẩm</div>
        </div>
        <!-- footer-chat -->
        <div class="chatbox-footer">
            <input type="text" placeholder="Nhập tin nhắn..." />
            <button>Gửi</button>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer-container">
        <!-- Các cột nội dung -->
        <div class="footer-content">
            <!-- Cột 1: Logo + địa chỉ -->
            <div class="footer-col">
                <img src="../project/images/d936cdcc28e1f6d50c8b30eef7255d3d.png" alt="Logo" width="100px" />
                <p><strong>Địa chỉ:</strong> 136 Trần Phú, Q. Hà Đông, Hà Nội</p>
                <p>
                    <strong>Điện thoại:</strong>
                    <a href="tel:1800 1060">1800 1060</a>
                </p>
                <p>
                    <strong>Email:</strong>
                    <a href="hotro@dienmayxanh.vn">hotro@dienmayxanh.vn</a>
                </p>
            </div>

            <!-- Cột 2: Thông tin thành viên -->
            <div class="footer-col">
                <h3>Thông tin thành viên</h3>
                <ul>
                    <li>Nguyễn Việt Anh</li>
                    <li>Lê Ngọc Ánh</li>
                    <li>Nguyễn Quốc Cường</li>
                    <li>Lê Văn Hiếu</li>
                    <li>Hoàng Thu Huyền</li>
                </ul>
            </div>

            <!-- Cột 3: Hỗ trợ khách hàng -->
            <div class="footer-col">
                <h3>Hỗ trợ khách hàng</h3>
                <ul>
                    <li><a href="#">Hướng dẫn mua hàng</a></li>
                    <li><a href="#">Chính sách bảo hành</a></li>
                    <li><a href="#">Giao hàng & Thanh toán</a></li>
                    <li><a href="#">Tra cứu đơn hàng</a></li>
                    <li><a href="#">Câu hỏi thường gặp</a></li>
                </ul>
            </div>

            <!-- Cột 4: Dịch vụ khách hàng -->
            <div class="footer-col">
                <h3>Dịch vụ khách hàng</h3>
                <ul>
                    <li><a href="#">Tư vấn mua hàng</a></li>
                    <li><a href="#">Góp ý, khiếu nại</a></li>
                    <li><a href="#">Chăm sóc sau bán</a></li>
                    <li><a href="#">Thông tin khuyến mãi</a></li>
                    <li><a href="#">Bảo trì, sửa chữa</a></li>
                </ul>
            </div>

            <!-- Bản đồ Google Maps -->
            <div class="footer-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.0069797857645!2d105.84968891533288!3d21.03144919314226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab9292a301a5%3A0x858d011847ebfd10!2zxJDDtG5oIFRpw6puIEhvw6BuZywgSOG6o2kgS2nhu4duLCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1681362878895!5m2!1sen!2s"
                    allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>
    </footer>

    <script>
    const imageList = [
        "../project/images/banner5.jpg",
        "../project/images/banner7.jpg",
        "../project/images/banner9.jpg",
    ];

    const bannerImg = document.getElementById("bannerImg");

    // Preload ảnh
    const preloadImages = imageList.map((src) => {
        const img = new Image();
        img.src = src;
        return img;
    });

    let currentIndex = 0;

    function changeBanner() {
        currentIndex = (currentIndex + 1) % imageList.length;
        bannerImg.src = imageList[currentIndex];
    }
    setInterval(changeBanner, 2000);
    </script>

    <script>
    const toggleElement = document.getElementById("toggle");
    const chatboxElement = document.getElementById("chatbox")

    function handleClick() {
        chatboxElement.style.display = "block";
        toggleElement.style.display = "none";
    }

    function closeChatbox() {
        toggleElement.style.display = "block"
        chatboxElement.style.display = "none"
    }
    </script>
</body>

</html>