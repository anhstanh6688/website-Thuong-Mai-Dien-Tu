<?php
include '../../DB/connect.php';

$message = '';
$order_id = null;

if (!isset($_GET['order_id'])) {
    echo "ID đơn hàng không hợp lệ.";
    exit();
}
$order_id = intval($_GET['order_id']);

// Lấy danh sách sản phẩm để hiển thị trong dropdown
$sql_products = "SELECT product_id, product_name, price FROM `sanpham` ORDER BY product_name ASC";
$result_products = $conn->query($sql_products);

// Lấy dữ liệu sản phẩm dưới dạng mảng để sử dụng trong JavaScript
$products_data = [];
if ($result_products) {
    $products_data = $result_products->fetch_all(MYSQLI_ASSOC);
    // Đặt con trỏ kết quả về đầu để sử dụng lại
    $result_products->data_seek(0);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ mảng
    $product_ids = $_POST['product_id'];
    $quantities = $_POST['quantity'];
    $prices = $_POST['price']; 

    // Bắt đầu một giao dịch (transaction) để đảm bảo tính toàn vẹn dữ liệu
    $conn->begin_transaction();

    try {
        // Vòng lặp để chèn từng chi tiết đơn hàng
        foreach ($product_ids as $key => $product_id) {
            $quantity = $quantities[$key];
            $price_per_item = $prices[$key]; 
            $total_price_for_item = $quantity * $price_per_item;

            $sql_insert_detail = "INSERT INTO `order_detail` (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert_detail);
            $stmt_insert->bind_param("iiii", $order_id, $product_id, $quantity, $total_price_for_item);

            if (!$stmt_insert->execute()) {
                throw new Exception("Lỗi khi thêm chi tiết đơn hàng: " . $stmt_insert->error);
            }
        }

        // Tính lại tổng tiền của đơn hàng
        $sql_update_total = "UPDATE `order` SET total = (SELECT SUM(price) FROM `order_detail` WHERE order_id = ?) WHERE order_id = ?";
        $stmt_update = $conn->prepare($sql_update_total);
        $stmt_update->bind_param("ii", $order_id, $order_id);
        
        if (!$stmt_update->execute()) {
            throw new Exception("Lỗi khi cập nhật tổng tiền: " . $stmt_update->error);
        }

        // Nếu mọi thứ đều thành công, commit giao dịch
        $conn->commit();
        
        $message = "Thêm chi tiết và cập nhật tổng tiền đơn hàng thành công!";
        header("Location: ../index.php?pageLayout=order");
        exit();

    } catch (Exception $e) {
        // Nếu có lỗi, rollback (hủy) giao dịch
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
    <title>Thêm Chi Tiết Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Thêm Chi Tiết cho Đơn Hàng (ID: <?php echo $order_id; ?>)</h2>
    <?php if ($message): ?>
        <div class="alert <?php echo strpos($message, 'thành công') !== false ? 'alert-success' : 'alert-danger'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <form action="addOrderDetail.php?order_id=<?php echo $order_id; ?>" method="post">
        <div id="order-details-container">
            <div class="order-detail-form border p-3 mb-3 rounded">
                <div class="mb-3">
                    <label for="product_id_0" class="form-label">Tên Sản phẩm:</label>
                    <select class="form-select" id="product_id_0" name="product_id[]" required onchange="updatePrice(this, 0)">
                        <option value="">-- Chọn sản phẩm --</option>
                        <?php 
                        if ($result_products->num_rows > 0) {
                            while($row = $result_products->fetch_assoc()) {
                                echo "<option value='" . $row['product_id'] . "' data-price='" . $row['price'] . "'>" . $row['product_name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity_0" class="form-label">Số lượng:</label>
                    <input type="number" class="form-control" id="quantity_0" name="quantity[]" required min="1" value="1" oninput="updatePrice(document.getElementById('product_id_0'), 0)">
                </div>
                <div class="mb-3">
                    <label for="price_0" class="form-label">Giá (tổng cho sản phẩm này):</label>
                    <input type="number" class="form-control" id="price_0" name="price[]" required min="0" readonly>
                </div>
            </div>
        </div>
        
        <button type="button" class="btn btn-info mb-3" onclick="addOrderDetailForm()">Thêm sản phẩm khác</button>
        
        <button type="submit" class="btn btn-primary">Lưu Đơn Hàng</button>
        <a href="../index.php?pageLayout=order" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<script>
    let formCounter = 1;
    // Chuyển dữ liệu PHP sang JavaScript
    const productsData = <?php echo json_encode($products_data); ?>;

    // Hàm cập nhật giá dựa trên sản phẩm đã chọn và số lượng
    function updatePrice(selectElement, counter) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const pricePerItem = selectedOption.getAttribute('data-price');
        const quantityInput = document.getElementById(`quantity_${counter}`);
        const priceInput = document.getElementById(`price_${counter}`);
        
        // Cập nhật giá khi số lượng hoặc sản phẩm thay đổi
        if (pricePerItem && quantityInput.value > 0) {
            priceInput.value = pricePerItem * quantityInput.value;
        } else {
            priceInput.value = 0;
        }
    }
    
    // Hàm thêm form chi tiết đơn hàng
    function addOrderDetailForm() {
        const container = document.getElementById('order-details-container');
        const newForm = document.createElement('div');
        newForm.className = 'order-detail-form border p-3 mb-3 rounded';
        
        // Tạo HTML cho dropdown sản phẩm
        let productsOptions = '<option value="">-- Chọn sản phẩm --</option>';
        productsData.forEach(product => {
            productsOptions += `<option value="${product.product_id}" data-price="${product.price}">${product.product_name}</option>`;
        });

        newForm.innerHTML = `
            <hr>
            <button type="button" class="btn btn-danger btn-sm float-end" onclick="this.parentNode.remove()">Xóa</button>
            <div class="mb-3">
                <label for="product_id_${formCounter}" class="form-label">Tên Sản phẩm:</label>
                <select class="form-select" id="product_id_${formCounter}" name="product_id[]" required onchange="updatePrice(this, ${formCounter})">
                    ${productsOptions}
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity_${formCounter}" class="form-label">Số lượng:</label>
                <input type="number" class="form-control" id="quantity_${formCounter}" name="quantity[]" required min="1" value="1" oninput="updatePrice(document.getElementById('product_id_${formCounter}'), ${formCounter})">
            </div>
            <div class="mb-3">
                <label for="price_${formCounter}" class="form-label">Giá (tổng cho sản phẩm này):</label>
                <input type="number" class="form-control" id="price_${formCounter}" name="price[]" required min="0" readonly>
            </div>
        `;
        container.appendChild(newForm);
        formCounter++;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>