<?php
$sql = "SELECT * FROM `binhluan` ORDER BY `comment_id` DESC";
$result = $conn->query($sql);
?>

<h2>Quản lý bình luận</h2>
<table>
	<thead>
		<tr>
			<th>STT</th>
			<th>ID Bình luận</th>
			<th>ID Sản Phẩm</th>
			<th>ID Người dùng</th>
			<th>Đánh giá</th>
			<th>Nội dung</th>
			<th>Thao tác</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if($result->num_rows > 0){
			$stt = 1;
			while($row = $result->fetch_assoc()){
				echo "
					<tr>
						<td>".$stt++."</td>
						<td>".$row['comment_id']."</td>
						<td>".$row['product_id']."</td>
						<td>".$row['id']."</td>
						<td>".$row['rating']."</td>
						<td>".$row['comment']."</td>
						<td>
                            <a href='comment/editComment.php?comment_id=".$row['comment_id']."' class='btn btn-warning btn-sm'>Sửa</a>
                            <a href='comment/deleteComment.php?comment_id=".$row['comment_id']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa bình luận này không?\")'>Xóa</a>
                        </td>
					</tr>
				";
			}
		}else{
			echo "Chưa có bình luận nào";
		}
		?>
	</tbody>
</table>