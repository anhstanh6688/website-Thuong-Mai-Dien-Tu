<?php 

    include "../DB/connect.php";
    include "../config.php";

    
    $this_id = $_GET["this_id"]; 
    // echo "Đã lấy được ID cần xóa: " .  $this_id;

    $sql = "DELETE FROM sanpham WHERE product_id='$this_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $product_type = $row['product_type'];

    switch($product_type) {
    case "tu_lanh":
        $renderBack = "project/products/product1/index1.php";
        break;
    case "may_giat":
        $renderBack = "project/products/product2/index2.php";
        break;
    case "tivi":
        $renderBack = "project/products/product3/index3.php";
        break;
    case "dieu_hoa":
        $renderBack = "project/products/product4/index4.php";
        break;
    case "loa":
        $renderBack = "project/products/product5/index5.php";
        break;
    default:
        $renderBack = "project/products/product1/index1.php";
}

    header("location:" . BASE_URL . $renderBack);
?>