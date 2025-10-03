<?php
include "../DB/connect.php";
include "../config.php";

// Lấy comment_id và product_id từ URL
$comment_id = $_GET["comment_id"] ?? null;
$product_id = $_GET["product_id"] ?? null;
$page = $_GET["page"] ?? "item1_1";

if ($comment_id) {
    $sql = "DELETE FROM binhluan WHERE comment_id = '$comment_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Quay lại trang sản phẩm đúng product_id
        switch ($page) {
            case "item1_1":
                header("Location: ../project/products/product1/item1_1.php?this_id=$product_id");
                break;

            case "item2_2":
                header("Location: ../project/products/product2/item2_2.php?this_id=$product_id");
                break;

            case "item3_3":
                header("Location: ../project/products/product3/item3_3.php?this_id=$product_id");
                break;

            case "item4_4":
                header("Location: ../project/products/product4/item4_4.php?this_id=$product_id");
                break;

            case "item5_5":
                header("Location: ../project/products/product5/item5_5.php?this_id=$product_id");
                break;

            default:
                // fallback nếu không khớp case nào
                header("Location: ../project/products/product1/item1_1.php");
                break;
        }
        // if ($product_id) {
        //     header("Location: ../project/products/product1/item1_1.php?this_id=$product_id");
        // } else {
        //     // fallback nếu thiếu product_id
        //     header("Location: ../project/products/product1/item1_1.php");
        // }
        exit();
    } else {
        echo "Lỗi khi xóa: " . mysqli_error($conn);
    }
} else {
    echo " Không có comment_id để xóa.";
}
