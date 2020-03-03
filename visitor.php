<?php 
require_once 'app/function.php';
session_start();
 $data='';
 $link = db_connect();
 /////////////////////////////////////////
 ///this page to visitor can't add post edit or delete
 /// and can't see all recipe details 
 $sql = "SELECT posts.*,users.name FROM posts JOIN users on posts.uid = users.id";
 $result = mysqli_query($link,$sql);
    if($result && mysqli_num_rows($result)> 0 ){
      $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
?>

<?php require_once 'header.php';?>
<?php  unsetSession();?>
<!-- ///////////////////////////////////
/////////header -->
<div class="container_header-blog">
   <header class="header_blog">
   <div class="user-navBar">
      <div class="logo_box">
       <img class="logo_blog" src="img/generic-avatar.png"> 
       </div>
       <a class="sign-out" href="signup.php">Sign up</a>
     </div>
   <div class="text_blog">
     <h1 class="heading_primary_blog">
     <span class="heading_primary_main_blog">welcome  </span>
     <span class="heading_primary_sub_blog">dear bloger</span>
      </h1>
   </div>
  <p>
  </header>
  </div>
  <div class="bgc"></div>
<!-- /////////////////////////
///////blog area -->

  <main class="post-blog">
  <?php if($data):?>
  <?php foreach ($data as $row) :?> 
    <div class="post_box">
    <h3 class="title"><?=htmlspecialchars( $row['title']);?></h3>
      <img src="img/<?php print_r($row['image']);?>" alt="" class="img_food">
    <p class="write">writen by
    <span class="write-span"><?= htmlspecialchars($row['name']) ;?></span>
    </p>
        <p class="write_time"><?=$row['create_at'];?></p>  
        <hr>
        </div>
    <?php endforeach ;?>  
    <?php endif ;?> 
    </div>
  </main>
 

<?php require_once 'footer.php' ;?>
  
