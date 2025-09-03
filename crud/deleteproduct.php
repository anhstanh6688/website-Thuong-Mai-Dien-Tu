<?php 
include "../DB/connect.php";
include "../config.php";

$this_id = $_GET["this_id"]; 

// lấy product_type trước khi xóa
$sql_get = "SELECT product_type FROM sanpham WHERE product_id='$this_id'";
$result = mysqli_query($conn, $sql_get);
$row = mysqli_fetch_assoc($result);
$product_type = $row['product_type'];

// xóa specs trước
$sql_specs = "DELETE FROM product_specs WHERE product_id='$this_id'";
mysqli_query($conn, $sql_specs);

// xóa sản phẩm
$sql = "DELETE FROM sanpham WHERE product_id='$this_id'";
if (mysqli_query($conn, $sql)) {
    switch($product_type) {
        case "tu_lanh":
            $backPage = "/project/products/product1/index1.php";
            break;
        case "may_giat":
            $backPage = "/project/products/product2/index2.php";
            break;
        case "tivi":
            $backPage = "/project/products/product3/index3.php";
            break;
        case "dieu_hoa":
            $backPage = "/project/products/product4/index4.php";
            break;
        case "loa":
            $backPage = "/project/products/product5/index5.php";
            break;
        default:
            $backPage = "/trangchu/index.php"; 
    }

    header("Location: " . BASE_URL . $backPage);
    exit;
} else {
    echo "Lỗi: " . mysqli_error($conn);
}
?>