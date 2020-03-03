<?php
require_once 'app/function.php';
session_start();
mySessionStart();
//////////////////////////////////
//page with all info from database
if(!empty($_SESSION)){
$data = '';
if(isset($_GET['post_id']) && is_numeric($_GET['post_id'])){
    $link = db_connect();
    $sql = "SELECT * FROM posts  WHERE id = {$_GET['post_id']}";
    $result = mysqli_query($link, $sql);

if($result && mysqli_num_rows($result)>0){
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
   }
  }
}else{
    header("location:signin.php");
}
?>
<?php require_once 'header.php';?>
<?php  unsetSession();?>
<main class="post-details">
<div class="margin-top">
 <a href="blog.php">
 <button name="submit" class="rotate-button">
  <span class="rotate-button-face edit ">back to blog</span>
  <span class="rotate-button-face-back edit">pleasant viewing</span>
</button>
</a>
</div>
  <?php if($data):?>
  <?php foreach ($data as $row) :?> 
  <?php $_SESSION['uid']= $row['uid'] ?>

    <div class="post_box-details">

      <h3 class="title-details"><?=htmlspecialchars( $row['title']);?></h3>

      <img src="img/<?php print_r($row['image']);?>" alt="" class="img_food-detalis">
 
    <span class="span-box-details">Ingredients</span>
     <p class="text_area-details">
     <?= htmlspecialchars($row['post']);?>
    </p>

    <span class="span-box-details">How to make it?</span>
    <p class="how-details"><?= htmlspecialchars($row['how']);?></p>

    <span class="span-box-details">The amount of diners</span>
    <p class="amount-details"><?= $row['amount'];?></p>

    <p class="write_time-detalis"><?=$row['create_at'];?></p>  
<!--/////////////////////////////////////////////////-->
<!-- if this is your post you see this button beloow-->

<?php if($_SESSION['uid'] == $row['uid']) :?>
          <p class="btn_ed">
          <a class="btn-success btn-details" href="edit.php?post_id=<?= $row['id'] ;?>" role="button">Edit</a>
          <a class="btn-danger btn-details" href="delete.php?post_id=<?= $row['id'] ;?>" role="button">Delete</a>
          </p>

        <?php endif ;?>
        <hr>
    <?php endforeach ;?>  
    <?php endif ;?> 
    </div>
    </div>
  </main>
  <?php require_once 'footer.php';?>
 