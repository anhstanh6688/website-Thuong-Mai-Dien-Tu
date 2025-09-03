<?php 
    include "../DB/connect.php";
    include "../config.php";
    session_start();


    if(isset($_POST["btn_comment"])) {
        $product_id = $_POST['product_id'];
        $member_id  = $_SESSION["member_id"]; // lấy từ session login
        $rating     = $_POST["rating"];
        $comment    = $_POST["comment"];

        $sql = "INSERT INTO binhluan (product_id, id, rating, comment) 
                VALUES ('$product_id', '$member_id', '$rating', '$comment')";
        if (mysqli_query($conn, $sql)) {
            $redirect = $_POST['redirect']; 
            header("Location:" . $redirect);
            exit;
        }
        else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }
?>