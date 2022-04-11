<?php require_once 'templates/bstory/inc/header.php'; ?>
<?php
$cat_id = $_GET['cat_id'];
$queryCat = "SELECT name FROM cat WHERE cat_id = {$cat_id}";
$resultCat = $mysqli->query($queryCat);
$arCat = mysqli_fetch_assoc($resultCat);

//tổng số dòng
$queryTSD = "SELECT count(*) AS TSD FROM story WHERE cat_id = {$cat_id} ";
$resultTSD = $mysqli->query($queryTSD);
$arTmp = mysqli_fetch_assoc($resultTSD);
$tongSoDong = $arTmp['TSD'];
//so dong hien tai
$row_count = ROW_COUNT;
//Tổng số trang
$tongsotrang = ceil($tongSoDong / $row_count);
//trang hiện tại
$current_page = 1;
if (isset($_GET['page'])) {
  $current_page = $_GET['page'];
}
//offset
$offset = ($current_page - 1) * $row_count;

?>
<script type="text/javascript">
  document.title = "<?php echo $arCat['name'] ?>";
</script>
<div class="content_resize">
  <div class="mainbar">
    <h1><?php $arCat['name'] ?></h1>
    <?php

    $query = "SELECT * FROM story WHERE cat_id= {$_GET['cat_id']} ORDER BY cat_id DESC LIMIT {$offset},{$row_count} ";
    $result = $mysqli->query($query);
    while ($arStory = mysqli_fetch_assoc($result)) {
      $nameStory = $arStory['name'];
      $story_id = $arStory['story_id'];
      $nameReplace = utf8ToLatin($nameStory);
      $url = $nameReplace . '-' . $story_id . '.html';

    ?>
      <div class="article">

        <h2><?php echo $arStory['name'] ?></h2>
        <p class="infopost">Ngày đăng: <?php echo $arStory['created_at'] ?> Lượt đọc: <?php echo $arStory['counter'] ?></p>
        <div class="clr"></div>
        <div class="img"><img src="<?php echo "files/uploads/" . $arStory['picture'] ?>" width="161" height="192" alt="" class="fl" /></div>
        <div class="post_content">
          <p><?php echo $arStory['preview_text'] ?></p>
          <p class="spec"><a href="<?php echo $url; ?>" class="rm">Chi tiết</a></p>
        </div>
        <div class="clr"></div>
      </div>

    <?php } ?>



    <p class="pages"><small>Page <?php echo $current_page ?> of <?php echo $tongsotrang ?></small> </p>
  
    <?php if ($tongsotrang > 0) { ?>
      <ul class="pagination">
        <?php if ($current_page > 1) { ?>
          <li class="prev"><a href="danh-muc?cat_id=<?php echo $cat_id ?>&page=<?php echo $current_page - 1 ?>">Pre</a></li>
        <?php } ?>

        <?php if ($current_page > 3) { ?>
          <li class="start"><a href="danh-muc?cat_id=<?php echo $cat_id ?>&page=1">1</a></li>

        <?php } ?>

        <?php if ($current_page - 2 > 0) { ?>
          <li class="page"><a href="danh-muc?cat_id=<?php echo $cat_id ?>&page=<?php echo $current_page - 2 ?>"><?php echo $current_page - 2 ?></a></li>
        <?php } ?>
        <?php if ($current_page - 1 > 0) { ?>
          <li class="page"><a href="danh-muc?cat_id=<?php echo $cat_id ?>&page=<?php echo $current_page - 1 ?>"><?php echo $current_page - 1 ?></a></li>
        <?php } ?>

        <li class="paginate_button active"><a href="danh-muc?cat_id=<?php echo $cat_id ?>&page=<?php echo $current_page ?>"><?php echo $current_page ?></a></li>
        <?php if ($current_page + 1 < $tongsotrang + 1) { ?>
          <li class="page"><a href="danh-muc?cat_id=<?php echo $cat_id ?>&page=<?php echo $current_page + 1 ?>"><?php echo $current_page + 1 ?></a></li>
        <?php } ?>
        <?php if ($current_page + 2 < $tongsotrang + 1) { ?>
          <li class="page"><a href="danh-muc?cat_id=<?php echo $cat_id ?>&page=<?php echo $current_page + 2 ?>"><?php echo $current_page + 2 ?></a></li>
        <?php } ?>

        <?php if ($current_page  < $tongsotrang - 2) { ?>
          <li class="end"><a href="danh-muc?cat_id=<?php echo $cat_id ?>&page=<?php echo $tongsotrang ?>"><?php echo $tongsotrang ?></a></li>
        <?php } ?>

        <?php if ($current_page < $tongsotrang) { ?>
          <li class="next"><a href="danh-muc?cat_id=<?php echo $cat_id ?>&page=<?php echo $current_page + 1 ?>">Next</a></li>
        <?php } ?>
      </ul>
    <?php } ?>


  </div>
  <div class="sidebar">
    <?php require_once 'templates/bstory/inc/leftbar.php'; ?>
  </div>
  <div class="clr"></div>
</div>
<?php require_once 'templates/bstory/inc/footer.php'; ?>