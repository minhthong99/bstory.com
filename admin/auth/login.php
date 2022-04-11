<?php session_start(); ?>
<?php require_once '../../util/DBconnectionUtil.php' ?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="http://localhost:8080/bstory.com/">
  <link href="templates/admin/assets/css/style.css" rel="stylesheet">
  <script type="text/javascript">
    document.title = 'Login';
  </script>
</head>

<body>
  <h2>Đăng Nhập</h2>
  <?php if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == "" || $password == "") {
      echo "<script>alert('username hoặc password bạn không được để trống!')</script>";
    } else {
      $md5password = md5($password);
      $query = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$md5password}' ";

      $result = $mysqli->query($query);
      $infoUser = mysqli_fetch_assoc($result);
      $num_rows = mysqli_num_rows($result);
      if ($num_rows == 0) {
        echo "<script>alert('tên đăng nhập hoặc mật khẩu không đúng!')</script>";
      } else {
        $_SESSION['user'] = $infoUser;
        $_SESSION['username'] = $username;
        $_SESSION['user_level'] = $infoUser['role'];
        HEADER('LOCATION:../../index.php');
      }
    }
  }
  ?>

  <form method="post" enctype="multipart/form-data">
    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username">

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password">

      <button type="submit" name="submit">Login</button>

    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" class="cancelbtn"><a href="#">Cancel</a></button>
    </div>
  </form>
</body>

</html>