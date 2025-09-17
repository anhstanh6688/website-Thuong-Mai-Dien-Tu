<?php
// Giả định file này được nhúng (include) từ file khác, nên không cần include connect.php ở đây
$sql = "SELECT * FROM `order` ORDER BY `order_id` DESC";
$result = $conn->query($sql);
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Quản lý đơn hàng</h2>
    <a href="order/addOrder.php" class="btn btn-primary">Tạo đơn hàng mới</a>
</div>

<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>SĐT</th>
            <th>Địa chỉ</th>
            <th>Ghi chú</th>
            <th>Tổng tiền</th>
            <th>Chi tiết đơn hàng</th>
            <th>Thao tác</th> </tr>
    </thead>
    <tbody>
        <?php
        if($result->num_rows > 0){
            $stt = 1;
            while($row = $result->fetch_assoc()){
                echo "
                    <tr>
                        <td>".$stt++."</td>
                        <td>".$row['order_id']."</td>
                        <td>".$row['name']."</td>
                        <td>".$row['phone']."</td>
                        <td>".$row['address']."</td>
                        <td>".$row['note']."</td>
                        <td>".number_format($row['total'], 0, ',', '.')." VND</td>
                        <td>
                            <a href='order/orderDetail.php?order_id=".$row['order_id']."'>Xem</a>
                        </td>
                        <td>
                            <a href='order/editOrder.php?order_id=".$row['order_id']."' class='btn btn-warning btn-sm'>Sửa</a>
                            <a href='order/deleteOrder.php?order_id=".$row['order_id']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa đơn hàng này không?\")'>Xóa</a>
                        </td>
                    </tr>
                ";
            }
        } else {
            echo "<tr><td colspan='9'>Chưa có đơn hàng nào</td></tr>";
        }
        ?>
    </tbody>
</table>