<?php 
require_once 'app/function.php';
session_start();
if(!empty($_SESSION['uid'])){
mySessionStart();
uConnected();
 $data='';
 $link = db_connect();
 //////////////////////////
 ///show all post from db
   $sql = "SELECT posts.*,users.name FROM posts JOIN users on posts.uid = users.id";
   $result = mysqli_query($link,$sql);

    if($result && mysqli_num_rows($result) > 0 ){
      $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
  

  }else{
    header("location:signin.php");
  }
  if(!empty($_POST['submit'])){
    header('location:details.php');   
  }
 
?>

<?php require_once 'header.php';?>
<?php  unsetSession();?>
<!-- ///////////////////////////////////
/////////header -->
<div class="all">

<div class="container_header-blog">
   <header class="header_blog">
   <div class="user-navBar">
      <div class="logo_box">
       <img class="logo_blog" src="img/<?= getAvatar() ;?>"> 
       </div>
       <a class="sign-out" href="signout.php">Sign Out</a>
     </div>
   <div class="text_blog">
     <h1 class="heading_primary_blog">
     <span class="heading_primary_main_blog">welcome back </span>
     <span class="heading_primary_sub_blog"><?= $_SESSION['name'] ;?></span>
      </h1>
   </div>
  <p>
    <div class="add-post-logo">
  <a class="add_post" href="add_post.php" role="button">
  <img src="img/add.png" alt="" class="add-logo">Add post</a>
  </p>
  </div>
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
      <img src="img/arrow-right.png" alt="" class="arrow">
    <span class="write-span"><?= htmlspecialchars($row['name']) ;?></span>
    </p>

    <p class="write_time"><?=$row['create_at'];?></p>  
<!--/////////////////////////////////////////////////-->
<!-- if this is your post you see this button beloow-->
<!-- <div class="all_btn"> -->
<a href="details.php?post_id=<?= $row['id'] ;?>">  
 <button class="btn-primary">see more!</button></a>
    <?php if($_SESSION['uid'] == $row['uid']) :?>
          <div class="ed">
          <a class="btn-success" href="edit.php?post_id=<?= $row['id'] ;?>" role="button">Edit</a>
          <a class="btn-danger" href="delete.php?post_id=<?= $row['id'] ;?>" role="button">Delete</a>
          </div>
          <!-- </div> -->
        <?php endif ;?>
       
        <hr>
        </div>
        <?php endforeach ;?> 
        
        <?php endif ;?> 
        </div>
       
  </main>
 
  </div>
   
<?php require_once 'footer.php' ;?>
  
