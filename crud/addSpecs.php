<?php
    include "../DB/connect.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Thêm thông số kỹ thuật</title>

    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        background: #f4f6f9;
        color: #333;
    }

    .container {
        max-width: 900px;
        margin: 30px auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px 40px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .form-item {
        display: flex;
        flex-direction: column;
    }

    .form-item label {
        font-weight: 600;
        margin-bottom: 6px;
        color: #444;
    }

    .form-item input,
    .form-item select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 15px;
        width: 100%;
        transition: all 0.3s;
        margin-bottom: 8px;
    }

    .form-item input:focus,
    .form-item select:focus {
        border-color: #2980b9;
        outline: none;
        box-shadow: 0 0 5px rgba(41, 128, 185, 0.5);
    }

    .form-item img {
        margin-bottom: 8px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    .btn-submit {
        grid-column: span 2;
        margin-top: 20px;
        padding: 14px;
        border: none;
        border-radius: 8px;
        background: #3498db;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        text-align: center;
    }

    .btn-submit:hover {
        background: #2980b9;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Thêm thông số kỹ thuật cho sản phẩm </h2>
        <form method="post" enctype="multipart/form-data" class="form-grid">
            <!-- cột trái -->
            <div class="form-group">
                <div class="form-item">
                    <label>ID sản phẩm:</label>
                    <input type="text" name="product_id">

                    <label>Kiểu tủ:</label>
                    <input type="text" name="kieu_tu">

                    <label>Dung tích tổng:</label>
                    <input type="text" name="dung_tich_tong">

                    <label>Dung tích sử dụng:</label>
                    <input type="text" name="dung_tich_su_dung">

                    <label>Dung tích ngăn đá:</label>
                    <input type="text" name="dung_tich_ngan_da">

                    <label>Dung tích ngăn lạnh:</label>
                    <input type="text" name="dung_tich_ngan_lanh">
                </div>
            </div>
            <!-- cột phải -->
            <div class="form-group">
                <div class="form-item">
                    <label>Chất liệu cửa:</label>
                    <input type="text" name="chat_lieu_cua">

                    <label>Chất liệu khay:</label>
                    <input type="text" name="chat_lieu_khay">

                    <label>Chất liệu ống:</label>
                    <input type="text" name="chat_lieu_ong">

                    <label>Năm ra mắt:</label>
                    <input type="text" name="nam_ra_mat">

                    <label>Sản xuất tại:</label>
                    <input type="text" name="san_xuat_tai">
                </div>
            </div>
            <button type="submit" name="submit" class="btn-submit">Thêm thông số </button>
        </form>
    </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $product_id        = $_POST['product_id'];
    $kieu_tu           = $_POST['kieu_tu'];
    $dung_tich_tong    = $_POST['dung_tich_tong'];
    $dung_tich_su_dung = $_POST['dung_tich_su_dung'];
    $dung_tich_ngan_da = $_POST['dung_tich_ngan_da'];
    $dung_tich_ngan_lanh = $_POST['dung_tich_ngan_lanh'];
    $chat_lieu_cua     = $_POST['chat_lieu_cua'];
    $chat_lieu_khay    = $_POST['chat_lieu_khay'];
    $chat_lieu_ong     = $_POST['chat_lieu_ong'];
    $nam_ra_mat        = $_POST['nam_ra_mat'];
    $san_xuat_tai      = $_POST['san_xuat_tai'];

    $sql = "INSERT INTO product_specs(product_id, kieu_tu, dung_tich_tong, dung_tich_su_dung, dung_tich_ngan_da, dung_tich_ngan_lanh, chat_lieu_cua, chat_lieu_khay, chat_lieu_ong, nam_ra_mat, san_xuat_tai)
            VALUES ('$product_id', '$kieu_tu', '$dung_tich_tong', '$dung_tich_su_dung', '$dung_tich_ngan_da', '$dung_tich_ngan_lanh', '$chat_lieu_cua', '$chat_lieu_khay', '$chat_lieu_ong', '$nam_ra_mat', '$san_xuat_tai')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Thêm specs thành công !');</script>";
    } else {
        echo "<script>alert('Lỗi !');</script>" . mysqli_error($conn);
    }
}
?>