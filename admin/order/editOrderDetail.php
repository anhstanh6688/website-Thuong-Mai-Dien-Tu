<?php
include '../../DB/connect.php';

$message = '';

if (!isset($_GET['order_detail_id']) || !isset($_GET['order_id'])) {
    echo "ID chi tiết hoặc ID đơn hàng không hợp lệ.";
    exit();
}

$order_detail_id = intval($_GET['order_detail_id']);
$order_id = intval($_GET['order_id']);

// Lấy thông tin chi tiết đơn hàng hiện tại để điền vào form
$sql_select = "SELECT * FROM `order_detail` WHERE order_detail_id = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $order_detail_id);
$stmt_select->execute();
$result_select = $stmt_select->get_result();

if ($result_select->num_rows === 0) {
    echo "Không tìm thấy chi tiết đơn hàng.";
    exit();
}
$detail_data = $result_select->fetch_assoc();
$stmt_select->close();

// Lấy danh sách sản phẩm để hiển thị trong dropdown
$sql_products = "SELECT product_id, product_name, price FROM `sanpham` ORDER BY product_name ASC";
$result_products = $conn->query($sql_products);
$products_data = [];
if ($result_products) {
    $products_data = $result_products->fetch_all(MYSQLI_ASSOC);
}

// Xử lý khi form được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_product_id = $_POST['product_id'];
    $new_quantity = $_POST['quantity'];
    $new_price = $_POST['price'];

    // Tính tổng giá mới
    $total_price = $new_quantity * $new_price;

    $conn->begin_transaction();

    try {
        // Cập nhật chi tiết đơn hàng
        $sql_update_detail = "UPDATE `order_detail` SET product_id = ?, quantity = ?, price = ? WHERE order_detail_id = ?";
        $stmt_update_detail = $conn->prepare($sql_update_detail);
        $stmt_update_detail->bind_param("iiii", $new_product_id, $new_quantity, $total_price, $order_detail_id);

        if (!$stmt_update_detail->execute()) {
            throw new Exception("Lỗi khi cập nhật chi tiết đơn hàng: " . $stmt_update_detail->error);
        }

        // Tính lại tổng tiền của đơn hàng
        $sql_update_total = "UPDATE `order` SET total = (SELECT SUM(price) FROM `order_detail` WHERE order_id = ?) WHERE order_id = ?";
        $stmt_update_total = $conn->prepare($sql_update_total);
        $stmt_update_total->bind_param("ii", $order_id, $order_id);

        if (!$stmt_update_total->execute()) {
            throw new Exception("Lỗi khi cập nhật tổng tiền: " . $stmt_update_total->error);
        }

        $conn->commit();
        $message = "Cập nhật chi tiết đơn hàng thành công!";
        // Chuyển hướng người dùng về trang chi tiết đơn hàng
        header("Location: orderDetail.php?order_id=" . $order_id);
        exit();

    } catch (Exception $e) {
        $conn->rollback();
        $message = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Chi Tiết Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Sửa Chi Tiết Đơn Hàng (ID: <?php echo $order_detail_id; ?>)</h2>
    <?php if ($message): ?>
        <div class="alert <?php echo strpos($message, 'thành công') !== false ? 'alert-success' : 'alert-danger'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <form action="editOrderDetail.php?order_id=<?php echo $order_id; ?>&order_detail_id=<?php echo $order_detail_id; ?>" method="post">
        <div class="mb-3">
            <label for="product_id" class="form-label">Tên Sản phẩm:</label>
            <select class="form-select" id="product_id" name="product_id" required onchange="updatePrice(this)">
                <option value="">-- Chọn sản phẩm --</option>
                <?php 
                foreach ($products_data as $product) {
                    $selected = ($product['product_id'] == $detail_data['product_id']) ? 'selected' : '';
                    echo "<option value='" . $product['product_id'] . "' data-price='" . $product['price'] . "' " . $selected . ">" . $product['product_name'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Số lượng:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required min="1" value="<?php echo htmlspecialchars($detail_data['quantity']); ?>" oninput="updatePrice(document.getElementById('product_id'))">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá (đơn giá):</label>
            <input type="number" class="form-control" id="price" name="price" required min="0" value="<?php echo htmlspecialchars($detail_data['price'] / $detail_data['quantity']); ?>" readonly>
        </div>
        
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <a href="orderDetail.php?order_id=<?php echo $order_id; ?>" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<script>
    // Chuyển dữ liệu PHP sang JavaScript
    const productsData = <?php echo json_encode($products_data); ?>;

    // Hàm cập nhật giá dựa trên sản phẩm đã chọn và số lượng
    function updatePrice(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const pricePerItem = selectedOption.getAttribute('data-price');
        const quantityInput = document.getElementById('quantity');
        const priceInput = document.getElementById('price');
        
        if (pricePerItem) {
            priceInput.value = pricePerItem;
        } else {
            priceInput.value = '';
        }
    }

    // Gọi hàm lần đầu để điền giá sản phẩm đã chọn
    window.onload = function() {
        const selectElement = document.getElementById('product_id');
        updatePrice(selectElement);
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>