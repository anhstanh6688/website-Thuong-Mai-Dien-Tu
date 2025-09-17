<?php
include '../DB/connect.php';

$sql = "SELECT * FROM sanpham ORDER BY product_id DESC";
$result = $conn->query($sql);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Quản lý sản phẩm</h2>
    <a href="../../crud/addproduct.php" class="btn btn-success">
        Thêm sản phẩm
    </a>
</div>

<table class="table table-striped table-hover table-bordered">
    <thead class="table-primary">
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Loại</th>
            <th>Tên</th>
            <th>Chi tiết sản phẩm</th>
            <th>Giá</th>
            <th>Giá cũ</th>
            <th>Giảm</th>
            <th>Quà tặng</th>
            <th>Đánh giá</th>
            <th>Đã bán</th>
            <th>Ảnh</th>
            <th>Video</th>
            <th>Thông số</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            $stt = 1;
            while ($row = $result->fetch_assoc()) {
                echo "
                        <tr>
                            <td>" . $stt++ . "</td>
                            <td>" . $row['product_id'] . "</td>
                            <td>" . $row['product_type'] . "</td>
                            <td>" . $row['product_name'] . "</td>
                            <td>" . $row['description'] . "</td>
                            <td>" . $row['price'] . "</td>
                            <td>" . $row['old_price'] . "</td>
                            <td>" . $row['discount_percent'] . '%' . "</td>
                            <td>" . $row['gift'] . "</td>
                            <td>" . $row['rating'] . '⭐️' . "</td>
                            <td>" . $row['sold_count'] . "</td>
                            <td><img src='../project/images/" . $row['image'] . "' alt='" . $row['product_name'] . "' class='img-fluid' style='max-width: 80px;'></td>
                            <td><video width='150' controls><source src='../project/images/" . $row['video_url'] . "' type='video/mp4'>Chuyển sang youtube</video></td>
                            <td><a href='product/productSpecs.php?product_id=" . $row['product_id'] . "' class='btn btn-info btn-sm'>Xem chi tiết</a></td>
                            <td class=\"d-flex justify-content-center\" >
                                <a href='../../crud/editproduct.php?this_id=" . $row['product_id'] . "' class='btn btn-warning btn-sm me-2'>Sửa</a>
                                <a href='../../crud/deleteproduct.php?this_id=" . $row['product_id'] . "' class='btn btn-danger btn-sm'>Xóa</a>
                            </td>
                        </tr>
                    ";
            }
        } else {
            echo "<tr><td colspan='15'>Chưa có sản phẩm nào</td></tr>";
        }
        ?>
    </tbody>
</table>