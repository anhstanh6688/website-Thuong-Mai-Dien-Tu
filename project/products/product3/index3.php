<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Điện máy xanh - Siêu thị điện máy</title>
    <link rel="stylesheet" href="styleindex.css" />
    <link rel="stylesheet" href="../../../font/fontawesome-free-7.0.0-web/css/all.min.css" />

    <link rel="icon" href="../../images/1742374793_67da878a0f466.png" />

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

.chatbox-header {
    background: #4caf50;
    color: #fff;
    padding: 10px;
    font-weight: bold;
}

.chatbox-body {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
    font-size: 14px;
}

.message {
    margin: 10px 0;
    padding: 8px;
    border-radius: 6px;
    max-width: 80%;
}

.message.bot {
    background: #f1f1f1;
}


.chatbox-footer {
    display: flex;
    border-top: 1px solid #ddd;
}

.chatbox-footer input {
    flex: 1;
    border: none;
    padding: 10px;
    font-size: 14px;
}

.chatbox-footer button {
    background: #4caf50;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
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

/* css lọc */
.filter-bar {
    margin-bottom: 20px;
}

.filter-bar input {
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 250px;
    padding: 8px;
    outline: none;
    transition: border-color 0.3s;
}

.filter-bar input:focus {
    border-color: #007bff;
}


.filter-bar select {
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
    transition: border-color 0.3s;
}

.filter-bar select:focus {
    border-color: #007bff;
}

.filter-bar button {
    padding: 8px;
    border-radius: 5px;
    cursor: pointer;
    outline: none;
    transition: background-color 0.3s ease;
}

.filter-bar button:hover {
    background-color: #d7dde3ff;
}
</style>

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

    <!-- Header -->
    <header>
        <div class="container">
            <div class="nav">
                <div class="logo">
                    <img src="../../images/d936cdcc28e1f6d50c8b30eef7255d3d.png" />
                </div>

                <div class="menu">
                    <div class="menu_list">
                        <a href="../../../trangchu/index.php">TRANG CHỦ</a>
                    </div>

                    <div class="menu_list dropdown">
                        <a href="#">GIỚI THIỆU</a>
                        <i class="fa-solid fa-angle-down"></i>
                        <ul>
                            <li><a href="#">Về chúng tôi</a></li>
                            <li><a href="#">Đội ngũ</a></li>
                            <li><a href="#">Lịch sử phát triển</a></li>
                        </ul>
                    </div>

                    <div class="menu_list">
                        <a href="#products">
                            <a href="../../../trangchu/index.php#products">SẢN PHẨM</a>
                        </a>
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
                        <a href="#subscribe">
                            <a href="../../index.html#subscribe">LIÊN HỆ</a>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <section class="breadcrumb">
        <div class="breadcrumb-links">
            <a href="../../../trangchu/index.php">Trang chủ</a> /
            <span>Television</span>
        </div>
    </section>

    <!-- banner -->
    <div class="img--banner">
        <img id="bannerImg" src="../../images/Tu-lanh-Mobile2.jpg" />
    </div>

    <!-- products -->
    <div class="product--services" id="products">
        <!-- head -->
        <h2>Các sản phẩm tivi</h2>
        <p>
            Khám phá bộ sưu tập thiết bị điện tử, tivi chất lượng cao với giá
            cả hợp lý
        </p>

        <!-- search + filter -->
        <form method="GET" class="filter-bar">
            <!-- theo tên -->
            <input type="text" name="searchName" placeholder="Tìm theo tên..."
                value="<?php echo isset($_GET['searchName']) ? $_GET['searchName'] : '' ?>">
            <!-- theo giá -->
            <select name="type">
                <option value="chuachon"
                    <?php if(isset($_GET["type"]) && $_GET["type"] == "chuachon") echo "selected"; ?>>Chưa chọn</option>
                <option value="1" <?php if(isset($_GET["type"]) && $_GET["type"] == "1") echo "selected"; ?>>
                    Dưới 5 triệu
                </option>
                <option value="2" <?php if(isset($_GET["type"]) && $_GET["type"] == "2") echo "selected"; ?>>
                    5 - 10 triệu
                </option>
                <option value="3" <?php if(isset($_GET["type"]) && $_GET["type"] == "3") echo "selected"; ?>>
                    10 - 20 triệu
                </option>
                <option value="4" <?php if(isset($_GET["type"]) && $_GET["type"] == "4") echo "selected"; ?>>
                    Trên 20 triệu
                </option>
            </select>


            <button type="submit" name="btnTimKiem">Tìm kiếm</button>
        </form>

        <!-- list-products -->
        <div class="product--grid">
            <?php 
            include "../../../DB/connect.php";
            include "../../../config.php";
        
            if (isset($_GET["btnTimKiem"])) {
                $type = $_GET["type"];
                // bấm tìm kiếm
                $findName = $_GET["searchName"];
                $sql = "SELECT * FROM sanpham WHERE product_name LIKE '%$findName%' AND product_type = 'tivi' ";

                if($type == "1") {
                    $sql .= "AND price < 5000000";
                }else if($type == "2") {
                    $sql .= "AND price BETWEEN 5000000 AND 10000000 ";
                }elseif ($type == "3") {
                    $sql .= "AND price BETWEEN 10000000 AND 20000000 ";
                } elseif ($type == "4") {
                    $sql .= "AND price > 20000000 ";
                }
                
             }else {
                // mặc định render tủ lạnh
                $sql = "SELECT * FROM sanpham WHERE product_type='tivi'";
            }

            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result)) {
        ?>
            <div class="product--item">
                <img width="250px" src="../../images/<?php echo $row["image"]; ?>" alt="Anh dep">
                <h3><?php echo $row["product_name"] ?></h3>
                <div style="color: red; font-weight: bold; font-size: 16px">
                    <?php echo number_format($row['price'], 0, ',', '.'); ?>₫
                </div>
                <div style="font-size: 13px; margin-top: 4px">
                    <del style="color: #888">
                        <?php echo number_format($row['old_price'], 0, ',', '.'); ?>₫
                    </del>
                    <span style="color: red; font-weight: bold; margin-left: 5px">
                        <?php echo $row["discount_percent"]; ?>%
                    </span>
                </div>
                <div style="font-size: 13px; margin-top: 5px; color: #333">
                    <?php echo $row["gift"]; ?>
                </div>
                <div class="rating">
                    ⭐ <?php echo $row['rating']; ?> • Đã bán <?php echo $row['sold_count']; ?>
                </div>
                <br>
                <a href="../product3/item3_3.php?this_id=<?php echo $row["product_id"]; ?>"
                    style="display:inline-block; padding:6px 12px; border-radius:5px; font-size:14px; text-decoration:none; font-weight:500; margin:5px; background-color:#007bff; color:#fff;">
                    Xem chi tiết
                </a>
                <a href="../../../CRUD/editproduct.php?this_id=<?php echo $row["product_id"]; ?>"
                    style="display:inline-block; padding:6px 12px; border-radius:5px; font-size:14px; text-decoration:none; font-weight:500; margin:5px; background-color:#ffc107; color:#333;">
                    Sửa
                </a>
                <a href="../../../CRUD/deleteproduct.php?this_id=<?php echo $row["product_id"]; ?>"
                    style="display:inline-block; padding:6px 12px; border-radius:5px; font-size:14px; text-decoration:none; font-weight:500; margin:5px; background-color:#dc3545; color:#fff;">
                    Xóa
                </a>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- Chatbox -->
    <div class="toggle" id="toggle" onclick="handleClick()">
        <img src="../../images/ai-chat-2gx0cq.png" alt="Anh chatbox">
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
    <footer class=" footer-container">
        <!-- Các cột nội dung -->
        <div class="footer-content">
            <!-- Cột 1: Logo + địa chỉ -->
            <div class="footer-col">
                <img src="../../images/d936cdcc28e1f6d50c8b30eef7255d3d.png" alt="Logo" width="100px" />
                <p><strong>Địa chỉ:</strong> 136 Trần Phú, Q. Hà Đông, Hà Nội</p>
                <p>
                    <strong>Điện thoại:</strong>
                    <a href="tel:1800 1060">1800 1060</a>
                </p>
                <p>
                    <strong>Email:</strong>
                    <a href="otro@dienmayxanh.vn">otro@dienmayxanh.vn</a>
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
</body>

<script>
const imageList = [
    " ../../images/banner5.jpg",
    " ../../images/banner6.png",
    " ../../images/banner7.jpg",
    " ../../images/banner9.jpg",
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

</html>