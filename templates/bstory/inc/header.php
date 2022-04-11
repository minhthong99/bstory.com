<?php session_start(); ?>
<?php require_once 'util/DBConnectionUtil.php' ?>
<?php require_once 'util/utf8ToLatinUtil.php' ?>
<?php require_once 'util/ConstantUtil.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>BStory | VinaEnter Edu</title>
  <base href="http://localhost:8080/bstory.com/">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="templates/bstory/css/bootstrap.css" rel="stylesheet" />
  <link href="templates/bstory/css/font-awesome.css" rel="stylesheet" />
  <link href="templates/bstory/css/style.css" rel="stylesheet" type="text/css" /> 
  <link rel="stylesheet" type="text/css" href="templates/bstory/css/coin-slider.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
  <script type="text/javascript" src="templates/bstory/js/jquery-1.4.2.min.js"></script>
  <script type="text/javascript" src="templates/bstory/js/script.js"></script>
  <script type="text/javascript" src="templates/bstory/js/coin-slider.min.js"></script>
 
</head>

<body>
  <div class="main">
    <div class="header">
      <div class="header_resize">
        <div class="menu_nav">
          <ul>
            <li class="active"><a href="trang-chu"><span>Trang chủ</span></a></li>
            <li><a href="lien-he"><span>Liên hệ</span></a></li>    

          <?php   if(isset($_SESSION['username']) && $_SESSION['username'] !=NULL){    ?>
            <li><a href="admin/"><span>Xin chào <?php echo $_SESSION['username'] ?></span></a></li>  
            <li><a href="admin/auth/logout.php"><span>Đăng Xuất</span></a></li>   
         <?php }else{ ?>
          
          <li><a href="admin/"><span>Đăng Nhập</span></a></li>   
          <?php } ?>     
          </ul>  
        </div>
        <div class="logo">
          <h1><a href="trang-chu">BStory <small>Dự án khóa PHP tại VinaEnter Edu</small></a></h1>
        </div>
        <div class="clr"></div>
        <div class="slider">
          <div id="coin-slider"> <a href="#"><img src="templates/bstory/images/slide1.jpg" width="940" height="310" alt="" /> </a> <a href="#"><img src="templates/bstory/images/slide2.jpg" width="940" height="310" alt="" /> </a> <a href="#"><img src="templates/bstory/images/slide3.jpg" width="940" height="310" alt="" /> </a> </div>
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content">