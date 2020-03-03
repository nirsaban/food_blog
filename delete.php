<?php
require_once 'app/function.php';
session_start();
mySessionStart();
if(!empty($_SESSION['uid'])){


/////////////////////////////
///check if push on delete
  if(isset($_POST['submit'])){

  if(isset($_GET['post_id']) && is_numeric($_GET['post_id'])){
    $link = db_connect();
    ///////////////////////
    ///delte from data base
    $sql = "DELETE FROM `posts` WHERE id = {$_GET['post_id']} AND uid = {$_SESSION['uid']} ";
    $result = mysqli_query($link, $sql);

    if($result && mysqli_affected_rows($link)>0){
     $_SESSION['ms'] = "your post has been deleted!!";
      header("location: blog.php");

     }
     }
     }
    }else{
      header("location:signin.php");
    }
?>
<?php require_once 'header.php';?>

  <div class="container-delete">
  <div class="row">
  <h2 class="delete-title">Are you sure you want to delete this post?</h2>
  <form method="post" action="">
  </div>
  <button name="submit" class="btn  btn-primary btn-block" type="submit">Delete</button>
  <a href="blog.php"><input  class="btn  btn-secondary btn-block" value="Cancel" ></a>
</form>    
  </div>
  </div>

<?php require_once 'footer.php';?>

 
