<?php
require_once 'app/function.php';
session_start();
$err_post = "";
$err_title = "";
$err = "";
////////////////////////////////////////////
///select the correct post ,follow by post_id.
if(!empty($_SESSION['uid'])){

if(isset($_GET['post_id']) && is_numeric($_GET['post_id'])){
  $link = db_connect();
  $post_id = trim(filter_input(INPUT_GET, 'post_id',FILTER_SANITIZE_STRING));
  $sql = "SELECT * FROM posts WHERE id = '$post_id' AND uid = '{$_SESSION['uid']}'";
  $result = mysqli_query($link,$sql);

if($result && mysqli_num_rows($result)== 1 ){
   $data = mysqli_fetch_assoc($result);
    }
  }
/////////////////////////////////
////check input before update
  if( isset($_POST['submit'])){

  if(isset($_POST['token']) && $_SESSION['token'] == $_POST['token']){
   
   if(empty($_POST['title'])){
    $err_title = "you must fill title input!";

  }elseif (empty ($_POST['post'])) {
    $err = "you must fill ingredients input!";

  }elseif (empty ($_POST['how'])) {
    $err = "you must fill How to making it? input!";

  }elseif (empty ($_POST['amount'])) {
    $err = "you must fill for how many people this recipe?!";
  }else{

    ///////////////////////////////////////////////////////
    ////////////////secure and filter input again
   $title = trim(filter_input(INPUT_POST, 'title',FILTER_SANITIZE_STRING)); 
   $post = trim(filter_input(INPUT_POST, 'post',FILTER_SANITIZE_STRING));
   $image = $data['image'];
   $how = trim(filter_input(INPUT_POST, 'how',FILTER_SANITIZE_STRING));
   $amount = trim(filter_input(INPUT_POST, 'amount',FILTER_SANITIZE_STRING));
   $post_id = trim(filter_input(INPUT_GET, 'post_id',FILTER_SANITIZE_STRING));
   $uid = $_SESSION['uid']; 
   
   $title = mysqli_real_escape_string($link,$title); 
   $post = mysqli_real_escape_string($link,$post);
   $how = mysqli_real_escape_string($link,$how);
   $amount = mysqli_real_escape_string($link,$amount);
   $post_id = mysqli_real_escape_string($link,$post_id);
   
   
   ////////////////////////////////////
   //////update the new info on database
   $sql = "UPDATE `posts` SET `title`='$title',`post`='$post',`create_at`=NOW(),`image`='$image',
   `how`='$how',`amount`='$amount' WHERE id = '$post_id' AND uid = '{$_SESSION['uid']}'";

   $result = mysqli_query($link, $sql);
   if($result && mysqli_affected_rows($link)>0){
     $_SESSION['ms'] = "your post updated!!";
     header("location: blog.php");
  } 
  }
  }  
  }

}else{
  header("location:signup.php");
}
$token = csrfToken();
$_SESSION['token'] = $token;
?>

<?php require_once 'header.php';?>
<div class="container-add">
<div class="row">

<div class="margin-top">
 <a href="blog.php">
 <button name="submit" class="rotate-button">
  <span class="rotate-button-face edit ">back to blog</span>
  <span class="rotate-button-face-back edit">without saving</span>
</button>
</a>
</div>

  <h1 class="h3 ">Edit your recipe</h1>

  <form class="form-shit" method="post" enctype="multipart/form-data">

  <span class="span-add">What you make?
  <span class="example"> What's your recipe name what are you making? </span></span>
  <textarea id="title" name="title" class="title" autofocus><?= htmlentities($data['title']) ;?></textarea>
  <span style="color:red;"><?= $err_title ;?></span>
  
  
  <span class="span-add">Ingredients needed for the recipe
  <span class="example">Required products and quantities</span></span>
  <textarea id="ingredients" name="post" class="ingredients" ><?= htmlentities($data['post']) ;?></textarea>
  <span style="color:red;"><?= $err_post ;?></span>


  <span class="span-add">How to making it?
  <span class="example">Cooking times How to make the mixture</span></span>
  <textarea id="how" name="how"   autofocus>
  <?= old('how') ;?> <?= htmlentities($data['how']) ;?></textarea>
  <span style="color:red;"><?= $err_post ;?></span>


  <span class="span-add">The amount of people: 
  <span class="example">for how many people this recipe?</span></span>
  <textarea id="amount" name="amount"autofocus><?= old('amount') ;?><?= htmlentities($data['amount']) ;?> </textarea>
  <span style="color:red;"><?= $err_post ;?></span>



<input type="hidden" name="token" value="<?= $token ;?>">  

<br>
<hr>

<div class="center-button">
<button name="submit" class="rotate-button"  >
  <span class="rotate-button-face">Save recipe</span>
  <span class="rotate-button-face-back">Let's see</span>
</button>
</div>

</form>    
</div>
</div>



<?php require_once 'footer.php';?>

<!--<script>
$('#inputEmail').hover(function(){
  alert('test');
});
</script>-->