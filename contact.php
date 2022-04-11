<?php require_once 'templates/bstory/inc/header.php'; ?><div class="content_resize">
  <div class="mainbar">
    <div class="article">
      <h2><span>Liên hệ</span></h2>
      <div class="clr"></div>
      <p>Nếu có thắc mắc hoặc góp ý, vui lòng liên hệ với chúng tôi theo thông tin dưới đây.</p>
    </div>
    <div class="article">
      <h2>Form liên hệ</h2>

      <?php
      #thuật toán  đặt cờ hiệu
      if (isset($_POST['submit'])) {
        $error = array();
        if ($_POST['name'] && $_POST['email'] && $_POST['website'] && $_POST['content']) {
          $name = $_POST['name'];
          $email = $_POST['email'];
          $website = $_POST['website'];
          $content = $_POST['content'];
        } else {
          $error['name'] = 'Chưa nhập tên liên hệ';
          $error['email'] = 'Chưa nhập email';
          $error['website'] = 'Chưa nhập website';
          $error['content'] = 'Chưa nhập nội dung';
        }
        if (empty($error)) {
          $query = "INSERT INTO contact(name,email,website,content) VALUES ('$name','$email','$website','$content')";
          $result = $mysqli->query($query);

          if ($result) {
            echo "<script>alert('thêm liên hệ thành công')</script>";
          } else {
            echo "không thể thêm liên hệ";
          }
        }
      }
      ?>
      <div class="clr"></div>

      <form role="form" method="POST">
        <ol>
          <li>
            <label for="name">Họ tên (required)</label>
            <input type="text" name="name" class="text" />
            <p class="text-danger"><?php echo isset($error['name']) ? $error['name'] : '' ?></p>
          </li>
          <li>
            <label for="email">Email (required)</label>
            <input type="text" name="email" class="text" />
            <p class="text-danger"><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
          </li>
          <li>
            <label for="website">Website</label>
            <input type="text" name="website" class="text" />
            <p class="text-danger"><?php echo isset($error['website']) ? $error['website'] : '' ?></p>
          </li>
          <li>
            <label for="content">Nội dung</label>
            <textarea name="content" rows="8" cols="50"></textarea>
            <p class="text-danger"><?php echo isset($error['content']) ? $error['content'] : '' ?></p>
          </li>
        </ol>
        <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
      </form>
    </div>
  </div>
  <div class="sidebar">
    <?php require_once 'templates/bstory/inc/leftbar.php' ?>
  </div>
  <div class="clr"></div>
</div>
<?php require_once 'templates/bstory/inc/footer.php'; ?>