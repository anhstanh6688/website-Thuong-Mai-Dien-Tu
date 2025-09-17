<?php
include '../../DB/connect.php';

if(isset($_GET['order_id'])){
    $order_id = intval($_GET['order_id']);

    $sql_order = "SELECT total FROM `order` WHERE order_id = ?";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bind_param("i", $order_id);
    $stmt_order->execute();
    $result_order = $stmt_order->get_result();
    $order_total = 0;
    if ($result_order->num_rows > 0) {
        $order_total_row = $result_order->fetch_assoc();
        $order_total = $order_total_row['total'];
    }
    $stmt_order->close();

    $sql = "SELECT * FROM `order_detail` WHERE order_id = $order_id ORDER BY `order_detail_id` DESC";
    $result = $conn->query($sql);

    $sql_products = "SELECT product_id, product_name, price FROM `sanpham` ORDER BY product_name ASC";
    $result_products = $conn->query($sql_products);
    $products_data = [];
    if ($result_products) {
        $products_data = $result_products->fetch_all(MYSQLI_ASSOC);
    }
} else {
    echo "ID đơn hàng không hợp lệ.";
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Chi tiết đơn hàng ID: <?php echo $order_id; ?></h2>
    <a href="addOrderDetail.php?order_id=<?php echo $order_id; ?>" class="btn btn-primary">Thêm chi tiết đơn hàng</a>
</div>
<style>
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    background: #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
}

thead {
    background: #007bff;
    color: #fff;
}

th, td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
}

tbody tr:nth-child(even) {
    background: #f8f9fa;
}

tbody tr:hover {
    background: #e9f5ff;
}

h2 {
    font-size: 22px;
    font-weight: bold;
}

p strong {
    font-size: 16px;
    color: #dc3545;
}

.btn {
    border-radius: 6px;
    padding: 6px 12px;
    font-size: 14px;
}

</style>

<p><strong>Tổng tiền đơn hàng: <?php echo number_format($order_total, 0, ',', '.') . " VND"; ?></strong></p>

<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>ID đơn hàng</th>
            <th>ID sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Thao tác</th> </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            $stt = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $stt++ . "</td>";
                echo "<td>" . $row['order_detail_id'] . "</td>";
                echo "<td>" . $row['order_id'] . "</td>";
                echo "<td>" . $row['product_id'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . number_format($row['price'], 0, ',', '.') . " VND</td>";
                echo "<td>";
               
                echo "<a href='editOrderDetail.php?order_detail_id=" . $row['order_detail_id'] . "&order_id=" . $order_id . "' class='btn btn-warning btn-sm me-2'>Sửa</a>";
                
                echo "<a href='deleteOrderDetail.php?order_detail_id=" . $row['order_detail_id'] . "&order_id=" . $order_id . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa chi tiết này không?\")'>Xóa</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Không có chi tiết đơn hàng nào.</td></tr>";
        }
        ?>
    </tbody>
</table>