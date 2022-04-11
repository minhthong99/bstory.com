<?php require_once '../../util/DBConnectionUtil.php'; ?>
<nav class="navbar-default navbar-side" role="navigation">
    <?php
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username ='{$username}'";
    $result = $mysqli->query($query);
    $arUser = mysqli_fetch_array($result);
    
    ?>
    <form method="get">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">


                <li class="text-center">
                    <img src="templates/admin/assets/img/find_user.png" class="user-image img-responsive" />
                </li>
                <li >
                    <a href="admin/dashboard/index.php"<?php if($currentpage == "dashboard"){ ?> class="active-menu" <?php } ?> ><i class="fa fa-dashboard fa-3x"></i> Trang chủ</a>
                </li>
                <li >
                    <a href="admin/cat/index.php"<?php if($currentpage == "cat"){ ?> class="active-menu" <?php } ?>     ><i class="fa fa-bar-chart-o fa-3x"></i> Quản lý danh mục</a>
                </li>
                <li>
                    <a href="admin/story/index.php" <?php if($currentpage== "story" ){ ?> class="active-menu" <?php } ?>><i class="fa fa-qrcode fa-3x"></i> Quản lý truyện</a>
                </li>
                <?php if ($arUser['role'] == 1) { ?>
                    <li>
                        <a href="admin/user/index.php" <?php if($currentpage== "user"){ ?> class="active-menu" <?php } ?>><i class="fa fa-sitemap fa-3x"></i> Quản lý người dùng</a>
                    </li>
                <?php } ?>
                <li>
                    <a href="admin/contact/index.php" <?php if($currentpage== "contact"){ ?> class="active-menu" <?php } ?>><i class="fa fa-bar-chart-o fa-3x"></i> Quản lý liên hệ</a>
                </li>
                <li>
                    <a href="admin/comment/index.php" <?php if($currentpage== "comment"){ ?> class="active-menu" <?php } ?>><i class="fa fa-bar-chart-o fa-3x"></i> Quản lý bình luận</a>
                </li>

            </ul>

        </div>
    </form>
</nav>
<!-- /. NAV SIDE  -->