<?php
include "../DB/connect.php";
include "../config.php";

$comment_id = $_GET["comment_id"] ?? null;
$product_id = $_GET["product_id"] ?? null;
$page       = $_GET["page"] ?? null; // lấy thêm page để điều hướng chính xác

// Khi người dùng bấm nút Lưu
if (isset($_POST["btnUpdate"])) {
    if (!empty($_POST["comment"])) {
        $new_content = $_POST["comment"];

        $sql = "UPDATE binhluan SET comment = '$new_content' WHERE comment_id = '$comment_id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Quay lại đúng trang sản phẩm
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
            exit();
        } else {
            echo " Lỗi khi sửa: " . mysqli_error($conn);
        }
    } else {
        echo "Bạn chưa nhập nội dung bình luận.";
    }
} else {
    // Lấy nội dung cũ để hiển thị trong form
    if ($comment_id) {
        $sql = "SELECT * FROM binhluan WHERE comment_id = '$comment_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    }
?>
    <form method="post">
        <h3>Sửa bình luận</h3>
        <textarea name="comment" rows="4" cols="50"><?php echo $row['comment'] ?? ""; ?></textarea><br>
        <button type="submit" name="btnUpdate">Lưu</button>
    </form>
<?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="editcomment.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h3 {
            margin-bottom: 15px;
        }

        textarea {
            width: 100%;
            resize: none;
            padding: 8px;
            margin-bottom: 10px;
        }

        button {
            padding: 8px 16px;
            border: none;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

</body>

</html>