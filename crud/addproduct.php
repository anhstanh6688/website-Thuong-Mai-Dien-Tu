<?php
    include "../DB/connect.php";
    include "../config.php";
    
        $type = $_POST["type"];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $old_price = $_POST['old_price'];
        $discount_percent = $_POST['discount_percent'];
        $gift = $_POST['gift'];
        $rating = $_POST['rating'];
        $sold_count = $_POST['sold_count'];
        $video_url = $_POST['video_url'];

        
        
        if(isset($_POST["btn_Them"])) {
        // xử lý validate
            $errors = [];
        
            if(empty($type)) {
                $errors[] = "Chưa chọn loại sản phẩm";
            }

            if(empty($description)) {
                $errors[] = "Chưa mô tả sản phẩm";
            }

            if(empty($name)) {
                $errors[] = "Tên sản phẩm không được để trống";
            }
        
            if ((empty($price) || !is_numeric($price)) || (empty($old_price) || !is_numeric($old_price))) {
                $errors[] = "Giá phải là số";
            }

            if(empty($discount_percent)) {
                $errors[] = "Chưa có giảm giá sản phẩm";
            }

            if(empty($gift)) {
                $errors[] = "Chưa ghi quà tặng";
            }

            if(empty($sold_count)) {
                $errors[] = "Chưa có tổng số lượng đã bán";
            }

            if(!empty($rating) && ($rating < 1 || $rating > 5)) {
                $errors[] = "Rating chỉ được từ 1 đến 5";
            }      

            // có lỗi thì in ra và dừng
            if(!empty($errors)) {
                foreach($errors as $err) {
                echo "<p style='color:red'>$err</p>";
                }
            }
            else {
                // xử lý image
            $image = $_FILES["image"]["name"]; 
            $image_tmp_name = $_FILES["image"]["tmp_name"];
            move_uploaded_file($image_tmp_name, '../project/images/' . $image); 
            $sql = "INSERT INTO sanpham(product_type, product_name, description, price, old_price, discount_percent, gift, rating, sold_count, image, video_url)
                    VALUES ('$type', '$name', '$description', '$price', '$old_price', '$discount_percent', '$gift', '$rating', '$sold_count', '$image', '$video_url') "; 
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Thêm sản phẩm thành công !');</script>";
            } else {
                echo "<script>alert('Lỗi !');</script>" . mysqli_error($conn);
            }
        }
    }
?>

<h2>Thêm sản phẩm </h2>
<form action="addproduct.php" method="post" enctype="multipart/form-data">
    <label>Product Type:</label>
    <select name="type">
        <option value="chuachon">Chưa chọn</option>
        <option value="tu_lanh">Tủ lạnh</option>
        <option value="may_giat">Máy giặt</option>
        <option value="tivi">Tivi</option>
        <option value="dieu_hoa">Điều hòa</option>
        <option value="loa">Loa</option>
    </select>
    <br><br>

    <label>Product Name:</label>
    <input type="text" name="name">
    <br><br>

    <label>Description:</label>
    <input type="text" name="description">
    <br><br>

    <label>Price:</label>
    <input type="text" name="price">
    <br><br>

    <label>Old Price:</label>
    <input type="text" name="old_price">
    <br><br>

    <label>Discount percent:</label>
    <input type="text" name="discount_percent">
    <br><br>

    <label>Gift:</label>
    <input type="text" name="gift">
    <br><br>

    <label>Rating:</label>
    <input type="text" name="rating" placeholder="1->5">
    <br><br>

    <label>Sold count:</label>
    <input type="text" name="sold_count">
    <br><br>

    <label>Image: </label>
    <input type="file" name="image">
    <br><br>

    <label>Video url: </label>
    <input type="text" name="video_url" placeholder="e.g: https://www.youtube.com/embed/djegwb8W73k">

    <br><br>
    <button type="submit" name="btn_Them">Thêm</button>
</form>