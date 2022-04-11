<?php require_once '../../util/DBConnectionUtil.php'; ?>
<?php require_once '../../templates/admin/inc/header.php'; ?>
<?php $currentpage ='dashboard'; ?>
<?php require_once '../../templates/admin/inc/leftbar.php'; ?>
<?php require_once '../../util/checkUserUtil.php' ?>


<?php
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username ='{$username}'";
$result = $mysqli->query($query);
$arUser = mysqli_fetch_array($result);
$sql = "SELECT count(id) AS so FROM users";
$resultUser = $mysqli->query($sql);
$array=mysqli_fetch_assoc($resultUser);
$sum = $array['so'];

$sqlStory = "SELECT count(story_id) AS sotruyen FROM story";
$resultStory = $mysqli->query($sqlStory);
$arrayStory=mysqli_fetch_assoc($resultStory);
$sumStory = $arrayStory['sotruyen'];

$sqlCat = "SELECT count(cat_id) AS sotcat FROM cat";
$resultcat = $mysqli->query($sqlCat);
$arrayCat=mysqli_fetch_assoc($resultcat);
$sumCat = $arrayCat['sotcat'];
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>TRANG QUẢN TRỊ VIÊN</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">

            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-green set-icon">
                        <i class="fa fa-bars"></i>
                    </span>
                    <div class="text-box">
                        <p class="main-text"><a href="admin/cat/index.php" title="">Quản lý danh mục</a></p>
                        <p><?php echo $sumCat ?> danh mục truyện</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-blue set-icon">
                        <i class="fa fa-bell-o"></i>
                    </span>
                    <div class="text-box">
                        <p class="main-text"><a href="admin/story/index.php" title="">Quản lý truyện</a></p>
                        <p><?php echo $sumStory ?> truyện</p>
                    </div>
                </div>
            </div>
           
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-brown set-icon">
                        <i class="fa fa-rocket"></i>
                    </span>
                    <div class="text-box">
                    <?php if($arUser['role'] == 1){ ?>
                        <p class="main-text"><a href="admin/user/index.php" title="">Quản lý người dùng</a></p>
                        <?php }else { ?>
                         <p class="main-text"><a href="admin/dashboard/index.php" title="">Người dùng</a></p>
                            <?php } ?>
                         <p><?php echo $sum  ?> người dùng</p>   
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-brown set-icon">
                        <i class="fa fa-rocket"></i>
                    </span>
                    <div class="text-box">
                        <p class="main-text"><a href="admin/contact/index.php" title="">Quản lý Liên hệ</a></p>

                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-brown set-icon">
                        <i class="fa fa-rocket"></i>
                    </span>
                    <div class="text-box">
                        <p class="main-text"><a href="admin/comment/index.php" title="">Quản lý bình luận</a></p>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php require_once '../../templates/admin/inc/footer.php'; ?>