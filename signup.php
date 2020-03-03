<?php
require_once 'app/function.php';    
 session_start();
   $err = '';

   ///////////////////////////
    ////check session
    if(isset($_SESSION['uid'])){
        header("location:blog.php");
    }else {
   /////////////////////////////
   ////check input form
    if (isset($_POST['submit'])) {

    if (isset($_POST['token']) && $_SESSION['token'] == $_POST['token']) {

    if (empty($_POST['name'])) {
            $err = 'fill your name';

    }elseif (empty($_POST['email'])) {
            $err = 'fill your email';

    }elseif (empty($_POST['password'])) {
            $err = 'fill your password';

    }elseif (empty($_POST['passwordTwo'])) {

          $err = 'you must fill verify password input!';

    }else{
            define('UPLOAD_MAX_SIZE', 1024 * 1024 * 20);
            $ex = ['jpg', 'jpeg', 'png', 'gif', 'bpm', 'pdf', 'doc', 'docx'];
            //////////////////////////////////////////////////////////
            ////////////secure form input
            $name = trim(filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING));
            $email = trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING));
            $password = trim(filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING));
            $passwordTwo = trim(filter_input(INPUT_POST,'passwordTwo',FILTER_SANITIZE_STRING));
           
            $link = db_connect();
            $name = mysqli_real_escape_string($link, $name);
            $email = mysqli_real_escape_string($link, $email);
            $password = mysqli_real_escape_string($link, $password);
            ////////////////////////////////////////////////////////
            ///////////check if the email is used or not
            $sql = "SELECT email FROM `users` WHERE email = '$email'";
            $result = mysqli_query($link, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                $err = 'this email already used';

            } else {
                //////////////////////////////////
                /////check if the password verify
                ///and create password hash
                if ($password == $passwordTwo) { 
                    $link = db_connect();
                    $password = password_hash($password, PASSWORD_BCRYPT);  
                //////////////////////////////
                //////upload user image
                if (!empty($_FILES['image']['name'])) {

                if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            
                if ($_FILES['image']['size'] <= UPLOAD_MAX_SIZE && $_FILES['image']['error'] == 0) {
            
                      $file_info = pathinfo($_FILES['image']['name']);
                      $file_ex = strtolower($file_info['extension']);
            
                if (in_array($file_ex, $ex)) {

                        move_uploaded_file($_FILES['image']['tmp_name'], "img/" . $_FILES['image']['name']);
                        $avatarName = $_FILES['image']['name'];
                 
                 
                        }
               
                    }
           
                }
   
            }
                ///////////////////////////////////////////////
                //////upload new user to data base
                   $sql ="INSERT INTO `users`(`id`, `name`, `email`, `password`, `role`, `update_at`,`avatar`)
                   VALUES ('','$name','$email','$password','6',NOW(),'$avatarName')";

                     $result = mysqli_query($link, $sql);
                    //////////////////////////////////
                    ///insert the value to session
                     if ($result && mysqli_affected_rows($link) > 0) {
                        $_SESSION['name'] = $name;
                        $_SESSION['uid'] = mysqli_insert_id($link);
                        $_SESSION['uip'] = $_SERVER['REMOTE_ADDR'];
                        $_SESSION['ms'] = 'you made it this far!!';
                        header('location:signin.php');
                    } else {
                        $err = 'sorry you got a problem';
                    }
                    } else {
                    $err = "your password's now match";
                   }
                }
              }
            }
          }
        }
$token = csrfToken();
$_SESSION['token'] = $token;
?>
<?php require_once 'header.php'; ?>
<div class="all">
<div class="margin-top">
 <a href="index.php">
 <button  class="rotate-button">
  <span class="rotate-button-face edit ">Back to home</span>
  <span class="rotate-button-face-back edit">NOW!!</span>
</button>
</a>
</div>
        <div id="wrapper">
        <div class="form-container" >
        <span class="form-heading_up"> Let's Sign up</span>

            <form action="" method="POST" enctype="multipart/form-data">
               <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input name="name" type="text" value="<?= old('name') ;?>" placeholder="UserName...">
                    <span class="bar"></span>
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input name="email" type="text"  value="<?= old('email') ;?>" placeholder="Email...">
                    <span class="bar"></span>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input name="password" type="text"placeholder="Password...">
                    <span class="bar"></span>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input name="passwordTwo" type="text" placeholder="Confirm Password" >
                    <span class="bar"></span>
                </div>
                <div class="checkbox mb-3">
             <input type="hidden" name="token" value="<?= $token ;?>">  
              </div>

            <div class="input-group">
                <input type="file" name="image" value="add profil picture" ><br><br>
                </div>
                <div class="input-group">
                    <i class="fab fa-telegram-plane"></i>
                    <input type="submit" name="submit" class="submit" value="Sign up">
                </div>
                <h4 class="err"><?= $err; ?></h4>
                <div class="switch-login">
                  <a href="signin.php">Already have an account? <span>Login</span></a>
                </div>
            </form>
         </div>
      </div>
      </div>
    <?php require_once 'footer.php'; ?>