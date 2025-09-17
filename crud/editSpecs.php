<?php
include "../DB/connect.php";

$spec_id = $_GET["spec_id"];

$sql = "SELECT * FROM product_specs WHERE spec_id = '$spec_id'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

if (isset($_POST["btn_Sua"])) {
    $product_id = $_POST['product_id'];
    $kieu_tu = $_POST['kieu_tu'];
    $dung_tich_tong = $_POST['dung_tich_tong'];
    $dung_tich_su_dung = $_POST['dung_tich_su_dung'];
    $dung_tich_ngan_da = $_POST['dung_tich_ngan_da'];
    $dung_tich_ngan_lanh = $_POST['dung_tich_ngan_lanh'];
    $chat_lieu_cua = $_POST['chat_lieu_cua'];
    $chat_lieu_khay = $_POST['chat_lieu_khay'];
    $chat_lieu_ong = $_POST['chat_lieu_ong'];
    $nam_ra_mat = $_POST['nam_ra_mat'];
    $san_xuat_tai = $_POST['san_xuat_tai'];

    $sql = "UPDATE product_specs SET 
                product_id = '$product_id',
                kieu_tu = '$kieu_tu',
                dung_tich_tong = '$dung_tich_tong',
                dung_tich_su_dung = '$dung_tich_su_dung',
                dung_tich_ngan_da = '$dung_tich_ngan_da',
                dung_tich_ngan_lanh = '$dung_tich_ngan_lanh',
                chat_lieu_cua = '$chat_lieu_cua',
                chat_lieu_khay = '$chat_lieu_khay',
                chat_lieu_ong = '$chat_lieu_ong',
                nam_ra_mat = '$nam_ra_mat',
                san_xuat_tai = '$san_xuat_tai'
            WHERE spec_id = '$spec_id'";

    mysqli_query($conn, $sql);

    echo "<script>alert('Cập nhật thành công!'); window.location.href='../admin/product/productSpecs.php?product_id=$product_id';</script>";
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa thông số kỹ thuật</title>
    <style>
        body {
            background: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 40px;
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

        .form-item input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            transition: 0.3s;
        }

        .form-item input:focus {
            border-color: #2980b9;
            outline: none;
            box-shadow: 0 0 5px rgba(41, 128, 185, 0.5);
        }

        .btn-submit {
            grid-column: span 2;
            justify-self: center;
            margin-top: 20px;
            padding: 14px 50px;
            border: none;
            border-radius: 8px;
            background: #3498db;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background: #2980b9;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Sửa thông số kỹ thuật ID: <?php echo $spec_id; ?></h2>
        <form method="post" class="form-grid">
            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">

            <!-- Cột trái -->
            <div class="form-item">
                <label>Kiểu tủ:</label>
                <input type="text" name="kieu_tu" value="<?php echo $row['kieu_tu']; ?>">
            </div>

            <div class="form-item">
                <label>Dung tích tổng:</label>
                <input type="text" name="dung_tich_tong" value="<?php echo $row['dung_tich_tong']; ?>">
            </div>

            <div class="form-item">
                <label>Dung tích sử dụng:</label>
                <input type="text" name="dung_tich_su_dung" value="<?php echo $row['dung_tich_su_dung']; ?>">
            </div>

            <div class="form-item">
                <label>Dung tích ngăn đá:</label>
                <input type="text" name="dung_tich_ngan_da" value="<?php echo $row['dung_tich_ngan_da']; ?>">
            </div>

            <div class="form-item">
                <label>Dung tích ngăn lạnh:</label>
                <input type="text" name="dung_tich_ngan_lanh" value="<?php echo $row['dung_tich_ngan_lanh']; ?>">
            </div>

            <!-- Cột phải -->
            <div class="form-item">
                <label>Chất liệu cửa:</label>
                <input type="text" name="chat_lieu_cua" value="<?php echo $row['chat_lieu_cua']; ?>">
            </div>

            <div class="form-item">
                <label>Chất liệu khay:</label>
                <input type="text" name="chat_lieu_khay" value="<?php echo $row['chat_lieu_khay']; ?>">
            </div>

            <div class="form-item">
                <label>Chất liệu ống:</label>
                <input type="text" name="chat_lieu_ong" value="<?php echo $row['chat_lieu_ong']; ?>">
            </div>

            <div class="form-item">
                <label>Năm ra mắt:</label>
                <input type="text" name="nam_ra_mat" value="<?php echo $row['nam_ra_mat']; ?>">
            </div>

            <div class="form-item">
                <label>Sản xuất tại:</label>
                <input type="text" name="san_xuat_tai" value="<?php echo $row['san_xuat_tai']; ?>">
            </div>

            <!-- Nút submit ở giữa -->
            <button type="submit" name="btn_Sua" class="btn-submit">Lưu thay đổi</button>
        </form>
    </div>
</body>

</html>