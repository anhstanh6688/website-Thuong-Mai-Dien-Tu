<?php
$sql = "SELECT * FROM `thanhvien` ORDER BY `id` DESC";
$result = $conn->query($sql);
?>

<div class="d-flex justify-content-between mb-3">
	<h2>Quản lý tài khoản</h2>
	<a href="account/addAccount.php" class="btn btn-primary">Thêm tài khoản mới</a>
</div>

<table>
	<thead>
		<tr>
			<th>STT</th>
			<th>ID</th>
			<th>Quyền</th>
			<th>Tên đăng nhập</th>
			<th>Mật khẩu</th>
			<th>Level</th>
			<th>Thao tác</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if ($result->num_rows > 0) {
			$stt = 1;
			while ($row = $result->fetch_assoc()) {
				echo "
					<tr>
						<td>" . $stt++ . "</td>
						<td>" . $row['id'] . "</td>
						<td>" . $row['role'] . "</td>
						<td>" . $row['username'] . "</td>
						<td>" . $row['password'] . "</td>
						<td>" . $row['level'] . "</td>
						<td>
                            <a href='account/editAccount.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Sửa</a>
                            <a href='account/deleteAccount.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa tài khoản này không?\")'>Xóa</a>
                        </td>
					</tr>
				";
			}
		} else {
			echo "Chưa có tài khoản nào";
		}
		?>
	</tbody>
</table>