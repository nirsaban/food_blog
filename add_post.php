<?php
require_once 'app/function.php';
session_start();
mySessionStart();
// uConnected();
$err_post = "";
$err_title = "";
$err = "";
$err_image='';
$err_how="";
$err_amount='';



  ///////////////////////////////
  /////check form input
  if( isset($_POST['submit'])){

  if(isset($_POST['token']) && $_SESSION['token'] == $_POST['token']){
 
  if(empty($_POST['title'])){
    $err_title = "you must fill title input!";
  }
  if(empty ($_POST['post'])){
    $err_post = "you must fill text input!";
    
  }elseif(empty($_POST['how'])){
    $err_how="you must fill how to make it!";

  }elseif(empty($_POST['amount'])){
    $err_amount = "you must fill to how mane person this recipe";

  }
  else{

   define('UPLOAD_MAX_SIZE', 1024 * 1024 * 20);
   $ex = ['jpg', 'jpeg', 'png', 'gif', 'bpm', 'pdf', 'doc', 'docx'];

   ///////////////////////////////////////////////////
   //////////////secure input and filter
   $title = trim(filter_input(INPUT_POST, 'title',FILTER_SANITIZE_STRING)); 
   $post = trim(filter_input(INPUT_POST, 'post',FILTER_SANITIZE_STRING)); 
   $how = trim(filter_input(INPUT_POST, 'how',FILTER_SANITIZE_STRING)); 
   $amount = trim(filter_input(INPUT_POST, 'amount',FILTER_SANITIZE_STRING)); 
   $uid = $_SESSION['uid']; 
   $link = db_connect();
   $title = mysqli_real_escape_string($link,$title); 
   $post = mysqli_real_escape_string($link,$post);
   $how = mysqli_real_escape_string($link,$how);
   $amount = mysqli_real_escape_string($link,$amount);
   
    ///////////////////////////////////
    /////////upload secure image
   if (!empty($_FILES['image']['name'])) {

   if (is_uploaded_file($_FILES['image']['tmp_name'])) {

   if ($_FILES['image']['size'] <= UPLOAD_MAX_SIZE && $_FILES['image']['error'] == 0) {
        $file_info = pathinfo($_FILES['image']['name']);
        $file_ex = strtolower($file_info['extension']);

  if (in_array($file_ex, $ex)) {
        move_uploaded_file($_FILES['image']['tmp_name'], "img/" . $_FILES['image']['name']);
        $image = $_FILES['image']['name'];
        }
      }
    }
  }
  ///////////////////////////////
  ////////Hebrew support
   mysqli_set_charset($link,"utf8");

   /////////////////////////////////
   //////add post to data base
   $sql="INSERT INTO `posts`(`id`, `uid`, `title`, `post`, `create_at`,`image`,`how`,`amount`) VALUES (NULL,'$uid','$title','$post',NOW(),'$image','$how','$amount')";
   $result = mysqli_query($link, $sql);
   if($result && mysqli_affected_rows($link)>0){
     $_SESSION['ms'] = "your post created!!";
     header("location: blog.php");
   }
   }
   }
   }  
   
$token = csrfToken();
$_SESSION['token'] = $token;
?>

<?php require_once 'header.php';?>

<div class="container-add">
  <div class="margin-top">
  <a href="blog.php">
  <button name="submit" class="rotate-button">
  <span class="rotate-button-face edit ">back to blog</span>
  <span class="rotate-button-face-back edit">without saving</span>
</button>
</a>
</div>
  <h1 class="h3 ">Add a new recipe</h1>

  <form class="form-shit" method="post" enctype="multipart/form-data">

  <span class="span-add">What you make?
  <span class="example"> What's your recipe name what are you making? </span></span>
  <textarea id="title" name="title" class="title"></textarea>
  <span style="color:red;"><?= $err_title ;?></span>
  
  
  <span class="span-add">Ingredients needed for the recipe
  <span class="example">Required products and quantities</span></span>
  <textarea id="ingredients" name="post" class="ingredients"></textarea>
  <span style="color:red;"><?= $err_post ;?></span>


  <span class="span-add">How to making it?
  <span class="example">Cooking times How to make the mixture</span></span>
  <textarea id="how" name="how"><?= old('post') ;?> </textarea>
  <span style="color:red;"><?= $err_post ;?></span>


  <span class="span-add">The amount of people: 
  <span class="example">for how many people this recipe?</span></span>
  <textarea id="amount" name="amount" ><?= old('post') ;?> </textarea>
  <span style="color:red;"><?= $err_post ;?></span>


       <div class="checkbox mb-3">
      <span class="span-add">please add picture</span>    
      <div class="input-file">
      <input type="file"  name="image"  id="image"><br><br>
      </div>



      
    <input type="hidden" name="token" value="<?= $token ;?>">  
    </div>

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



<?php require_once 'footer.php';?>