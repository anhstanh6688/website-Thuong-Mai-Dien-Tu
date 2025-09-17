<style>
  .dashboard-hero {
    background: linear-gradient(90deg, #0d6efd 0%, #0b5ed7 100%);
    color: white;
    padding: 18px;
    border-radius: 8px;
    margin-bottom: 20px;
  }

  .card-img-top {
    height: 160px;
    object-fit: cover;
  }

  .small-card {
    min-height: 110px;
  }

  .clickable-row {
    cursor: pointer;
  }
</style>

<div class="container-fluid">
  <div class="dashboard-hero">
    <div class="d-flex align-items-center justify-content-between">
      <div>
        <h3 class="mb-0">Điện máy xanh — Bảng quản trị</h3>
        <div class="text-white-50">Tổng quan nhanh</div>
      </div>
      <div>
        <a href="index.php?pageLayout=sanPham" class="btn btn-light btn-sm">Quản lý sản phẩm</a>
        <a href="index.php?pageLayout=donHang" class="btn btn-outline-light btn-sm ms-2">Xem đơn hàng</a>
      </div>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-sm-6 col-md-3">
      <div class="card small-card shadow-sm text-center">
        <div class="card-body">
          <small class="text-muted">Sản phẩm</small>
          <h4 class="mt-2">
            <?php
            $cnt = 0;
            if ($r = @$conn->query("SELECT COUNT(*) AS c FROM `sanpham`")) {
              $cnt = $r->fetch_assoc()['c'];
            }
            echo intval($cnt);
            ?>
          </h4>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card small-card shadow-sm text-center">
        <div class="card-body">
          <small class="text-muted">Đơn hàng</small>
          <h4 class="mt-2">
            <?php
            $cnt = 0;
            if ($r = @$conn->query("SELECT COUNT(*) AS c FROM `order`")) {
              $cnt = $r->fetch_assoc()['c'];
            }
            echo intval($cnt);
            ?>
          </h4>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card small-card shadow-sm text-center">
        <div class="card-body">
          <small class="text-muted">Người dùng</small>
          <h4 class="mt-2">
            <?php
            $cnt = 0;
            if ($r = @$conn->query("SELECT COUNT(*) AS c FROM `thanhvien`")) {
              $cnt = $r->fetch_assoc()['c'];
            }
            echo intval($cnt);
            ?>
          </h4>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card small-card shadow-sm text-center">
        <div class="card-body">
          <small class="text-muted">Doanh thu (đ)</small>
          <h4 class="mt-2">
            <?php
            $sum = 0;
            if ($r = @$conn->query("SELECT SUM(total) AS s FROM `order`")) {
              $sum = $r->fetch_assoc()['s'];
            }
            echo $sum ? number_format($sum, 0, ',', '.') . '₫' : '0₫';
            ?>
          </h4>
        </div>
      </div>
    </div>
  </div>

  <h5>Sản phẩm nổi bật</h5>
  <div class="row row-cols-1 row-cols-md-4 g-3 mb-4">
    <?php
    $q = "SELECT * FROM `sanpham` ORDER BY `product_id` DESC LIMIT 8";
    if ($res = @$conn->query($q)) {
      if ($res->num_rows) {
        while ($p = $res->fetch_assoc()) {
          $img = !empty($p['image']) ? htmlspecialchars($p['image']) : 'no-image.png';
          $name = !empty($p['product_name']) ? htmlspecialchars($p['product_name']) : 'Sản phẩm';
          $price = isset($p['price']) ? number_format($p['price'], 0, ',', '.') . '₫' : '';
          echo '<div class="col">';
          echo '<div class="card h-100">';
          echo '<img src="../project/images/' . $img . '" class="card-img-top" alt="' . $name . '">';
          echo '<div class="card-body d-flex flex-column">';
          echo '<h6 class="card-title mb-2">' . $name . '</h6>';
          echo '<p class="card-text mb-3 fw-bold">' . $price . '</p>';
          echo '<div class="mt-auto"><a href="index.php?pageLayout=sanPham" class="btn btn-sm btn-primary">Xem chi tiết</a></div>';
          echo '</div></div></div>';
        }
      } else {
        echo '<div class="col-12"><div class="alert alert-info">Chưa có sản phẩm nào trong cơ sở dữ liệu.</div></div>';
      }
    } else {
      echo '<div class="col-12"><div class="alert alert-warning">Lỗi khi truy vấn sản phẩm.</div></div>';
    }
    ?>
  </div>

  <h5>5 đơn hàng mới nhất</h5>
  <div class="table-responsive mb-5">
    <table class="table table-striped table-hover align-middle">
      <thead class="table-light">
        <tr>
          <th>STT</th>
          <th>Mã đơn</th>
          <th>Khách hàng</th>
          <th>Tổng tiền</th>
          <th>Ghi chú</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        if ($or = @$conn->query("SELECT * FROM `order` ORDER BY `order_id` DESC LIMIT 5")) {
          if ($or->num_rows) {
            while ($o = $or->fetch_assoc()) {
              $order_id = isset($o['order_id']) ? intval($o['order_id']) : '';
              $cust = isset($o['name']) ? htmlspecialchars($o['name']) : 'Khách lạ';
              $total = isset($o['total']) ? number_format($o['total'], 0, ',', '.') . '₫' : '';
              $note = isset($o['note']) ? htmlspecialchars($o['note']) : '';
              $date = isset($o['created_at']) ? htmlspecialchars($o['created_at']) : '';
              echo "<tr class='clickable-row' data-href='index.php?pageLayout=donHang&order_id={$order_id}'>";
              echo "<td>{$i}</td><td>#{$order_id}</td><td>{$cust}</td><td>{$total}</td><td>{$note}</td>";
              echo "</tr>";
              $i++;
            }
          } else {
            echo '<tr><td colspan="6" class="text-center">Không có đơn hàng nào.</td></tr>';
          }
        } else {
          echo '<tr><td colspan="6" class="text-center">Lỗi truy vấn đơn hàng.</td></tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.clickable-row').forEach(function(row) {
      row.addEventListener('click', function() {
        window.location = this.dataset.href;
      });
    });
  });
</script>