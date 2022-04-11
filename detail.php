<?php require_once 'templates/bstory/inc/header.php'; ?>

<?php
if(isset($_SESSION['username'])){

$queryCounter="UPDATE story SET counter=counter+1 WHERE story_id={$_GET['detail_id']}";
$resultCounter=$mysqli->query($queryCounter);
}
?>

<?php
$queryStory = "SELECT * FROM story WHERE story_id = {$_GET['detail_id']}  ";
$resultStory = $mysqli->query($queryStory);
$arStory = mysqli_fetch_assoc($resultStory);
$newtime = explode(" ",$arStory['created_at']);
$get_date=$newtime[0];
?>
<?php
if (isset($_POST['submit'])) {
  $username = $_SESSION['username'];
  $comment = $_POST['comment'];
  $story_id = $_GET['detail_id'];
  

    $sql = "INSERT INTO comment(story_id,username,comment_detail) VALUES ('$story_id','$username','$comment') ";
    $resultComment = $mysqli->query($sql);
  }

?>

<script type="text/javascript">
  document.title = "<?php echo $arStory['name'] ?>";
</script>
<div class="content_resize">
  <div class="mainbar">
    <div class="article">
      <h1><?php echo $arStory['name'] ?></h1>
      <div class="clr"></div>
      <p>Ngày đăng:<?php echo  $get_date ?> Lượt đọc: <?php echo $arStory['counter'] ?></p>
      <div class="vnecontent">
        <p><?php echo $arStory['detail_text'] ?></p>

      </div>
    </div>

    <div class="article">

      <h2> Truyện liên quan</h2>
      <?php $cat_id = $arStory['cat_id'];
      $queryCat = "SELECT * FROM story WHERE cat_id = {$cat_id} LIMIT 3";
      $resultCat = $mysqli->query($queryCat);
      while ($arCat = mysqli_fetch_assoc($resultCat)) {
        $name = $arCat['name'];
        $id = $arCat['story_id'];
        $nameReplaceStory = utf8ToLatin($name);
        $url = $nameReplaceStory . '-' . $id . '.html';
      ?>
        <div class="clr"></div>

        <div> <a href="#"><img src="files/uploads/<?php echo $arCat['picture'] ?>" width="40" height="40" alt="" class="userpic" /></a>
          <h3><a href="<?php echo $url; ?>" title=""><?php echo $arCat['name'] ?></a></h3>
          <p><?php echo $arCat['preview_text'] ?></p>
        </div>
      <?php } ?>


    </div>
    <?php if (isset($_SESSION['username'])) { ?>
      <div class="well">
        <h4>Viết bình luận... <span class="glyphicon glyphicon-pencil"></span></h4>
        <form action="" method="POST">
          <textarea name="comment" cols="100" rows="10" placeholder="Enter a comment"></textarea>
          <input type="submit" name="submit" value="Comment">
        </form>
      </div>
    <?php } ?>
    <?php 
        $queryComment="SELECT * FROM comment ORDER BY comment_id DESC ";
        $result=$mysqli->query($queryComment);
        $array=mysqli_fetch_array($result);
        $key=$array['story_id'];
      
    if($key = $_GET['detail_id']){

      $query2="SELECT * FROM comment WHERE story_id='{$key}' ORDER BY comment_id DESC ";
      $result2=$mysqli->query($query2);
    while ($arrayComment = mysqli_fetch_assoc($result2)) { ?>
      <li class="media">
        <a class="pull-left" href="#">
          <img class="media-object img-circle" src="https://s.nettruyen.com/Data/SiteImages/anonymous.png" alt="author" style="display: inline;">
        </a>
        <div class="media-body">
          <div class="well well-lg">
            <h4 class="media-heading text-uppercase reviews"><?php echo $arrayComment['username'] ?></h4>
            <ul class="media-date text-uppercase reviews list-inline">
             <li><?php echo $arrayComment['comment_date'] ?></li>
            </ul>
            <p class="media-comment">
              <?php echo $arrayComment['comment_detail'] ?>
            </p>
           

          </div>
        </div>
      </li>
    <?php } ?>
<?php } ?>
  
  </div>
  <div class="sidebar">
    <?php include_once 'templates/bstory/inc/leftbar.php'; ?>
  </div>
  <div class="clr"></div>
</div>
<?php require_once 'templates/bstory/inc/footer.php'; ?>