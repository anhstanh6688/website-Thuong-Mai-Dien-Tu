<?php
include '../DB/connect.php';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="icon" href="../project/images/1742374793_67da878a0f466.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background-color: #0d6efd;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 20px;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            position: fixed;
            top: 70px;
            left: 0;
            width: 250px;
            height: calc(100% - 70px);
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            overflow-y: auto;
            transition: background-color 0.3s;
        }

        .sidebar .nav-link {
            color: #ecf0f1;
            font-size: 1.1rem;
            padding: 15px 20px;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar .nav-link:hover {
            background-color: #34495e;
            color: #ffffff;
        }

        .sidebar .nav-item {
            margin-bottom: 5px;
        }

        .main-content {
            margin-left: 250px;
            margin-top: 70px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        /* CSS cho các bảng trong nội dung chính */
        .main-content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .main-content thead {
            background-color: #0d6efd;
            color: white;
        }

        .main-content th,
        .main-content td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: middle;
        }

        .main-content tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .main-content tbody tr:hover {
            background-color: #e9ecef;
            cursor: pointer;
        }

        /* CSS cho chế độ tối */
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        .dark-mode header {
            background-color: #1f1f1f;
            box-shadow: 0 2px 5px rgba(255, 255, 255, 0.1);
        }

        .dark-mode .sidebar {
            background-color: #1e1e1e;
        }

        .dark-mode .sidebar .nav-link {
            color: #b0b0b0;
        }

        .dark-mode .sidebar .nav-link:hover {
            background-color: #2a2a2a;
            color: #ffffff;
        }

        .dark-mode .main-content table {
            background-color: #2c2c2c;
            color: #e0e0e0;
            border-color: #444;
        }

        .dark-mode .main-content thead {
            background-color: #0b5ed7;
            color: #ffffff;
        }

        .dark-mode .main-content th,
        .dark-mode .main-content td {
            border-color: #444;
        }

        .dark-mode .main-content tbody tr:nth-child(even) {
            background-color: #2a2a2a;
        }

        .dark-mode .main-content tbody tr:hover {
            background-color: #383838;
        }
    </style>
</head>

<body>
    <header>
        <h1>Hello Admin</h1>
    </header>

    <div class="d-flex">
        <nav class="sidebar">
            <ul class="nav flex-column h-100">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="index.php?pageLayout=trangChu">
                        <i class="fas fa-home fa-lg me-3"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="index.php?pageLayout=sanPham">
                        <i class="fas fa-box-open fa-lg me-3"></i>
                        <span>Sản phẩm</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="index.php?pageLayout=donHang">
                        <i class="fas fa-clipboard-list fa-lg me-3"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="index.php?pageLayout=binhLuan">
                        <i class="fas fa-comments fa-lg me-3"></i>
                        <span>Bình luận</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="index.php?pageLayout=taiKhoan">
                        <i class="fas fa-users fa-lg me-3"></i>
                        <span>Tài khoản</span>
                    </a>
                </li>
                <li class="nav-item mt-auto">
                    <a class="nav-link d-flex align-items-center" href="index.php?pageLayout=settings">
                        <i class="fas fa-cog fa-lg me-3"></i>
                        <span>Cài đặt</span>
                    </a>
                </li>
            </ul>
        </nav>

        <main class="main-content">
            <?php
            if (isset($_GET['pageLayout'])) {
                switch ($_GET['pageLayout']) {
                    case 'trangChu':
                        include 'trangChu.php';
                        break;
                    case 'sanPham':
                        include 'product/product.php';
                        break;
                    case 'donHang':
                        include 'order/order.php';
                        break;
                    case 'binhLuan':
                        include 'comment/comment.php';
                        break;
                    case 'taiKhoan':
                        include 'account/account.php';
                        break;
                    case 'settings':
                        include 'settings/settings.php';
                        break;
                    default:
                        include 'trangChu.php';
                        break;
                }
            } else {
                include 'trangChu.php';
            }
            ?>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script để lưu và áp dụng chế độ tối từ localStorage
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme) {
            document.body.classList.add(currentTheme);
        }
    </script>
</body>

</html>