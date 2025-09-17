<?php
include '../../DB/connect.php';

if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);
    $sql = "SELECT * FROM `product_specs` WHERE product_id = $product_id ORDER BY `spec_id` DESC";
    $result = mysqli_query($conn, $sql);
} else {
    echo "ID sản phẩm không hợp lệ.";
    exit;
}
?>

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

    .form-item span {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 15px;
        transition: 0.3s;
    }

    .form-item span:focus {
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

    .spec-actions {
        grid-column: span 2;
        margin-top: 20px;
        text-align: center;
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .spec-actions a {
        display: inline-block;
        padding: 10px 25px;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        transition: 0.3s;
    }

    /* Nút sửa */
    .spec-actions .edit {
        background: #3498db;
    }

    .spec-actions .edit:hover {
        background: #2980b9;
    }

    /* Nút quay về */
    .spec-actions .back {
        background: #7f8c8d;
    }

    .spec-actions .back:hover {
        background: #636e72;
    }
</style>

<?php

while ($row = mysqli_fetch_array($result)) {
?>
    <div class="container">
        <h3>Thông số ID: <?php echo $row['spec_id']; ?></h3>
        <div class="form-grid">
            <div class="form-item">
                <label>ID sản phẩm:</label>
                <span><?php echo $row['product_id']; ?></span>
            </div>
            <div class="form-item">
                <label>Kiểu:</label>
                <span><?php echo $row['kieu_tu']; ?></span>
            </div>
            <div class="form-item">
                <label>Dung tích tổng:</label>
                <span><?php echo $row['dung_tich_tong']; ?></span>
            </div>
            <div class="form-item">
                <label>Dung tích sử dụng:</label>
                <span><?php echo $row['dung_tich_su_dung']; ?></span>
            </div>
            <div class="form-item">
                <label>Dung tích ngăn đá:</label>
                <span><?php echo $row['dung_tich_ngan_da']; ?></span>
            </div>
            <div class="form-item">
                <label>Dung tích ngăn lạnh:</label>
                <span><?php echo $row['dung_tich_ngan_lanh']; ?></span>
            </div>
            <div class="form-item">
                <label>Chất liệu cửa:</label>
                <span><?php echo $row['chat_lieu_cua']; ?></span>
            </div>
            <div class="form-item">
                <label>Chất liệu khay:</label>
                <span><?php echo $row['chat_lieu_khay']; ?></span>
            </div>
            <div class="form-item">
                <label>Chất liệu ống:</label>
                <span><?php echo $row['chat_lieu_ong']; ?></span>
            </div>
            <div class="form-item">
                <label>Năm ra mắt:</label>
                <span><?php echo $row['nam_ra_mat']; ?></span>
            </div>
            <div class="form-item">
                <label>Sản xuất tại:</label>
                <span><?php echo $row['san_xuat_tai']; ?></span>
            </div>
            <div class='spec-actions'>
                <a href='../../crud/editSpecs.php?spec_id=<?php echo $row["spec_id"]; ?>' class='edit'>Sửa thông số</a>
                <a href='../index.php?pageLayout=sanPham' class='back'>Quay về sản phẩm</a>
            </div>
        </div>
    <?php } ?>