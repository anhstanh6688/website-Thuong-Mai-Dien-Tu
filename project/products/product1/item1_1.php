<?php
session_start();
// echo "Session member_id: " . ($_SESSION['member_id'] ?? 'chưa có');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Điện máy xanh - Siêu thị điện máy</title>
    <link rel="stylesheet" href="styleitem.css" />
    <link rel="stylesheet" href="../../../font/fontawesome-free-7.0.0-web/css/all.min.css" />
    <link rel="icon" href="../../images/1742374793_67da878a0f466.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
</head>

<style>
    :root {
        --blue-color: #2297ff;
    }

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
        transition: color 0.5s ease;
    }

    .close-btn:hover {
        color: #ffdddd;
    }


    /* css modal */
    .modal {
        position: fixed;
        top: 0;
        height: 100vh;
        width: 100vw;
        background-color: rgba(0, 0, 0, 0.6);
    }

    .modal__inner {
        width: 400px;
        position: relative;
        top: 50%;
        margin: 0 auto;
        background: white;
        border-radius: 5px;
        /* do vướng header nên 2 góc đầu ko radius cần dùng */
        overflow: hidden;
        animation: modalShow 0.2s linear;
    }

    .modal__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        background: var(--blue-color);
        color: white;
    }

    .modal__header h2 {
        font-weight: 400;
    }

    .modal__body {
        padding: 15px;
    }

    #formComment {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .modal__footer {
        padding: 15px;
        text-align: center;
    }

    .modal__footer button {
        padding: 10px 20px;
        outline: none;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .modal__footer .btn_comment {
        background-color: var(--blue-color);
        color: white;
    }

    .hide {
        display: none;
    }

    @keyframes modalShow {
        from {
            top: -200px;
            opacity: 0;
        }

        to {
            top: 50%;
            opacity: 1;
        }
    }


    /* css cart */

    #add-to-cart-form {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 10px;
        margin: 10px 0;
    }

    /* ô nhập số lượng */
    #add-to-cart-form input[type="text"] {
        width: 60px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
        text-align: center;
        font-size: 16px;
        outline: none;
    }

    /* nút thêm vào giỏ */
    #add-to-cart-form .btn.btn-cart {
        background: var(--blue-color);
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 170px;
    }

    #add-to-cart-form .btn.btn-cart:hover {
        background: #4561efff;
    }

    /* sửa xóa comment */
    .edit-delete {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    /* style chung cho cả 2 nút */
    .edit-delete a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 500;
        line-height: 1;
        text-decoration: none;
        padding: 6px 12px;
        border-radius: 5px;
        cursor: pointer;
    }

    /* nút Xóa */
    .edit-delete .deletecomm {
        background-color: #d54038;
        color: #fff;
    }

    .edit-delete .deletecomm:hover {
        background-color: #b7221a;
    }

    /* nút Sửa */
    .edit-delete .editcomm {
        background-color: #ffc107;
        color: #000;
    }

    .edit-delete .editcomm:hover {
        background-color: #d5af3e;
    }

    .comment .deletecomm {
        margin: 0;
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
                            <a href="../../../trangchu/index.php#subscribe">LIÊN HỆ</a>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <section class="breadcrumb">
        <?php
        include "../../../DB/connect.php";
        include "../../../config.php";
        $this_id = $_GET["this_id"];

        $sql = "SELECT * FROM sanpham WHERE product_id = $this_id";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result)) {
        ?>
            <div class="breadcrumb-links">
                <a href="../product1/index1.php">Tủ lạnh</a> /
                <span><?php echo $row["product_name"]; ?></span>
            </div>
        <?php  } ?>
    </section>

    <!-- video  -->
    <section class="product">
        <div class="product-section">
            <!-- mock link YT -->
            <?php
            include "../../../DB/connect.php";
            include "../../../config.php";
            $this_id = $_GET["this_id"];

            $sql = "SELECT * FROM sanpham WHERE product_id = '$this_id' ";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="video-container">
                    <iframe width="560" height="315" src="<?php echo $row['video_url']; ?>"
                        title="<?php echo $row['product_name']; ?>" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>
            <?php } ?>


            <!-- action buttons -->
            <div class="action-button">
                <!-- Dòng 1: Giỏ hàng + Giá tiền -->
                <div class="cart-row">
                    <!-- <a href="../../../giohang/cart.php?action=add" class="btn btn-cart" id="add"
                        onclick="handleShoppingCart()">
                        <img src="../../images/shopping-cart.png" width="40px" />
                        Thêm vào giỏ
                    </a> -->
                    <?php
                    $this_id = $_GET["this_id"];

                    $sql = "SELECT * FROM sanpham WHERE product_id = '$this_id' ";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <form id="add-to-cart-form" action="../../../giohang/cart.php?action=add" method="POST">
                            <input type="text" value="1" name="quantity[<?= $row['product_id'] ?>]" size="2" /><br />
                            <input type="submit" class="btn btn-cart" id="add" value="Thêm vào giỏ" />
                        </form>
                    <?php } ?>

                    <?php
                    include "../../../DB/connect.php";
                    include "../../../config.php";
                    $this_id = $_GET["this_id"];

                    $sql = "SELECT * FROM sanpham WHERE product_id = '$this_id' ";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <div class="price-box">
                            <span class="label">Giá tiền:</span>
                            <a href="#" class="price"><?php echo number_format($row['price'], 0, ',', '.'); ?>đ</a>
                        </div>
                </div>
            <?php  } ?>

            <!-- Dòng 2: Like - Share - Comment -->
            <div class="action-row">
                <!-- left -->
                <div class="left-actions">
                    <a href="#" class="btn btn-like" id="like" onclick="handleLike()">
                        <img src="../../images/like.png" width="30px" />
                        Thích
                    </a>
                    <a href="#" class="btn btn-share" id="share" onclick="handleShare()">
                        <img src="../../images/send.png" width="30px" />
                        Chia sẻ
                    </a>
                </div>
                <!-- right -->
                <div class="right-actions"></div>
                <a href="#comments" class="btn btn-comment">
                    <img src="../../images/comments.png" width="30px" />
                    Bình luận
                </a>
            </div>
            <img src="../../images/b8fb7e01422e060162a6ba939da5e8e5.png" width="588px" />
            </div>

            <!-- Thông số kỹ thuật -->
            <div class="specs-table">
                <?php
                include "../../../DB/connect.php";
                include "../../../config.php";
                $this_id = $_GET["this_id"];

                $sql = "SELECT * FROM product_specs ps
                        INNER JOIN sanpham sp ON sp.product_id = ps.product_id 
                        WHERE sp.product_id = '$this_id' ";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>

                    <div class="row">
                        <div class="label">Kiểu tủ:</div>
                        <div class="value">
                            <a class="people"><?php echo $row["kieu_tu"]; ?></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="label mouse">Dung tích tổng:</div>
                        <div class="value">
                            <a class="people"><?php echo $row["dung_tich_tong"]; ?></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="label">Dung tích sử dụng:</div>
                        <div class="value">
                            <a class="people"><?php echo $row["dung_tich_su_dung"]; ?></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="label">Dung tích ngăn đá:</div>
                        <div class="value">
                            <?php echo $row["dung_tich_ngan_da"]; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="label">Dung tích ngăn lạnh:</div>
                        <div class="value">
                            <?php echo $row["dung_tich_ngan_lanh"]; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="label">Chất liệu cửa tủ lạnh:</div>
                        <div class="value">
                            <?php echo $row["chat_lieu_cua"]; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="label">Chất liệu khay ngăn lạnh:</div>
                        <div class="value">
                            <?php echo $row["chat_lieu_khay"]; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="label">Chất liệu ống dẫn gas, dàn lạnh:</div>
                        <div class="value">
                            <?php echo $row["chat_lieu_ong"]; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="label">Năm ra mắt:</div>
                        <div class="value">
                            <?php echo $row["nam_ra_mat"]; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="label">Sản xuất tại:</div>
                        <div class="value">
                            <?php echo $row["san_xuat_tai"]; ?>
                        </div>
                    </div>
                    <!-- HASD CODE -->
                    <div class="row">
                        <p>Mức tiêu thụ điện năng</p>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>

                    <div class="row">
                        <p>Công nghệ bảo quản và làm lạnh</p>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>

                    <div class="row">
                        <p>Tiện ích</p>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>

                    <div class="row">
                        <p>Thông tin lắp đặt</p>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                <?php } ?>
            </div>


            <!-- comments -->
            <div class="comment-section" id="comments">
                <h3>Đánh giá Tủ lạnh Samsung Inverter 208 lít RT20HAR8DBU/SV</h3>
                <img src="../../images/5cda8602-33e9-4c85-8c46-a835762ddead.jpg" width="550px" />
                <!-- danh sách comments -->
                <?php
                $this_id = $_GET['this_id'];

                // Lấy tất cả bình luận 
                $sql = "SELECT bl.comment_id, tv.username, bl.rating, bl.comment
                    FROM binhluan bl 
                    JOIN thanhvien tv ON bl.id = tv.id 
                    WHERE bl.product_id = '$this_id'
                    ORDER BY bl.comment_id DESC";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="comment">
                            <p class="author">
                                <?php echo $row['username']; ?>
                                <span class="verified">
                                    <img src="../../images/check.png" width="24px" /> Đã mua tại ĐMX
                                </span>
                            </p>
                            <p class="stars">
                                <?php echo $row['rating'] ?>
                                <span class="recommend">
                                    <img src="../../images/heart.png" width="24px" />Sẽ giới thiệu
                                    cho bạn bè, người thân
                                </span>
                            </p>
                            <p class="content">
                                <?php echo $row['comment']; ?>
                            </p>

                            <!-- delete xóa sửa -->
                            <div class="edit-delete">
                                <a class="deletecomm"
                                    href="../../../crud/deletecomment.php?comment_id=<?php echo $row['comment_id']; ?>&product_id=<?php echo $this_id; ?>&page=item2_2">Xóa</a>
                                <a class="editcomm"
                                    href="../../../crud/editcomment.php?comment_id=<?php echo $row['comment_id']; ?>&product_id=<?php echo $this_id; ?>&page=item2_2">Sửa</a>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>Chưa có bình luận nào.</p>";
                }
                ?>

                <!-- đánh giá + viết đánh giá -->
                <div class="btn--rate">
                    <button class="btn btn-watch">Xem 476 đánh giá</button>
                    <button class="btn btn-write">Viết đánh giá</button>
                </div>
            </div>
        </div>
    </section>

    <!-- modal bình luận -->
    <div class="modal hide">
        <div class="modal__inner">
            <div class="modal__header">
                <h2>Viết đánh giá sản phẩm</h2>
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="modal__body">
                <form action="../../../crud/addcomment.php" method="post" id="formComment">

                    <!-- ID sản phẩm -->
                    <input type="hidden" name="product_id" value="<?php echo $_GET['this_id']; ?>">
                    <input type="hidden" name="redirect" value="<?php echo $_SERVER['REQUEST_URI']; ?>">


                    <!-- Tên người dùng -->
                    <p>
                        Bạn đang bình luận với tên:
                        <strong>
                            <?php echo $_SESSION['mySession']; ?>
                        </strong>
                    </p>

                    <!-- Đánh giá sao -->
                    <label for="rating">Đánh giá:</label>
                    <select id="rating" name="rating" required>
                        <option value="5">⭐⭐⭐⭐⭐ - Rất tốt</option>
                        <option value="4">⭐⭐⭐⭐ - Tốt</option>
                        <option value="3">⭐⭐⭐ - Bình thường</option>
                        <option value="2">⭐⭐ - Kém</option>
                        <option value="1">⭐ - Rất tệ</option>
                    </select>

                    <!-- Nội dung bình luận -->
                    <label for="comment">Bình luận:</label>
                    <textarea id="comment" name="comment" rows="4" required></textarea>
                </form>
            </div>
            <div class="modal__footer">
                <button type="button" class="cancelBtn" name="cancelBtn">Hủy</button>
                <!-- cách ko cần đưa vào form nhưng vẫn sử dụng được là: form="formComment" -->
                <button type="submit" class="btn_comment" name="btn_comment" form="formComment">Gửi</button>
            </div>
        </div>
    </div>

    <!-- slider ảnh -->
    <section class="promo-slider">
        <div class="slider-container">
            <!-- Nút mũi tên trái -->
            <button class="slider-btn prev">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <!-- Danh sách slide -->
            <div class="slider-wrapper">
                <div class="slide">
                    <img src="../../images/87428c55a4c73c9d9801286108db0796.png" alt="Khuyến mãi 1" />
                </div>
                <div class="slide">
                    <img src="../../images/ee28ecdb832295d0e22daf65d06e7a47.png" alt="Khuyến mãi 2" />
                </div>
                <div class="slide">
                    <img src="../../images/87428c55a4c73c9d9801286108db0796.png" alt="Khuyến mãi 3" />
                </div>
            </div>

            <!-- Nút mũi tên phải -->
            <button class="slider-btn next">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </section>

    <!-- Cam kết + SP đã xem -->
    <section class="product-extra">
        <div class="container">
            <!-- Cột trái: Cam kết -->
            <div class="commitment">
                <h3>Điện Máy <span>XANH</span> cam kết</h3>
                <div class="commitment-list">
                    <div class="commitment-item">
                        <i class="fa-solid fa-circle-info"></i>
                        <p>
                            Nếu dùng cho hoạt động kinh doanh (nhà máy, khách sạn, giặt
                            ủi,...) thì không được bảo hành.
                        </p>
                    </div>
                    <div class="commitment-item">
                        <i class="fa-solid fa-shield"></i>
                        <p>Bảo hành máy nén 20 năm</p>
                    </div>
                    <div class="commitment-item">
                        <i class="fa-solid fa-truck"></i>
                        <p>
                            Hư gì đổi nấy <b>12 tháng</b> tận nhà (miễn phí tháng đầu)
                            <a href="#" class="item-1">Xem chi tiết</a>
                        </p>
                    </div>
                    <div class="commitment-item">
                        <i class="fa-solid fa-shield-halved"></i>
                        <p>
                            Bảo hành <b>chính hãng 2 năm</b>, có người đến tận nhà
                            <a href="#" class="item-1">Xem chi tiết bảo hành</a>
                        </p>
                    </div>
                    <div class="commitment-item">
                        <i class="fa-solid fa-box"></i>
                        <p>Thùng tủ lạnh có: Sách hướng dẫn</p>
                    </div>
                    <div class="commitment-item">
                        <i class="fa-solid fa-gears"></i>
                        <p><b>Lắp đặt miễn phí</b> lúc giao hàng</p>
                    </div>
                </div>
            </div>

            <!-- Cột phải: Sản phẩm đã xem -->
            <div class="related-products--top">
                <h3>Sản phẩm đã xem</h3>
                <div class="product-list">
                    <?php
                    $sql = "SELECT * FROM sanpham 
                          ORDER BY RAND() LIMIT 3";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>

                        <div class="product-item">
                            <img style="object-fit: cover;" src="../../images/<?php echo $row["image"]; ?>" alt="San pham">
                            <p class="title--product">
                                <?php echo $row["product_name"]; ?>
                            </p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Sản phẩm thường mua cùng -->
    <section class="related-products">
        <h2>Sản phẩm thường mua cùng</h2>
        <div class="related-list">
            <?php
            include "../../../DB/connect.php";
            include "../../../config.php";

            $sql = "SELECT * FROM sanpham 
                        ORDER BY RAND() LIMIT 5";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>

                <div class="item">
                    <img src="../../../project/images/<?php echo $row["image"]; ?>" alt="Anh dep">
                    <p class="name"> <?php echo $row["product_name"]; ?></p>
                    <p class="price"><?php echo $row["price"]; ?>
                        <del style="font-size: 10px; color: #666; font-weight: 300;"><?php echo $row["old_price"] ?> </del>
                    </p>
                    <div style="font-size: 13px; color: #666; margin-top: 5px; float: left">
                        ⭐ <?php echo $row["rating"]; ?> • Đã bán <?php echo $row["sold_count"]; ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Chatbox -->
    <div class="toggle" id="toggle" onclick="handleClick()">
        <img src="../../../project/images/ai-chat-2gx0cq.png" alt="Anh chatbox">
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
                <img src="../../images/d936cdcc28e1f6d50c8b30eef7255d3d.png" alt="Logo" width="100px" />
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
</body>

<script>
    //Sự kiện click Like-Share-Add
    function handleLike() {
        alert("Like sản phẩm này thành công !");
        const likeBtn = document.getElementById("like");
        likeBtn.innerHTML = `
        <img src="../../images/like.png" width="30px" />
        Đã like
      `;
    }

    function handleShare() {
        alert("Share sản phẩm này thành công !");
        const likeBtn = document.getElementById("share");
        likeBtn.innerHTML = `
        <img src="../../images/send.png" width="30px" />
        Đã share
      `;
    }

    function handleShoppingCart() {
        alert("Thêm vào giỏ hàng thành công !");
        const likeBtn = document.getElementById("add");
        likeBtn.innerHTML = `
        <img src="../../images/shopping-cart.png" width="40px" />
        Đã thêm vào giỏ
      `;
    }
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

    // modal
    let btnOpen = document.querySelector(".btn.btn-write");
    let modal = document.querySelector(".modal");
    let iconBtn = document.querySelector(".modal__header i");
    let btnClose = document.querySelector(".cancelBtn");

    function toggleModal() {
        modal.classList.toggle('hide')
    }

    btnOpen.addEventListener('click', toggleModal)
    btnClose.addEventListener('click', toggleModal)
    iconBtn.addEventListener('click', toggleModal)
</script>

</html>