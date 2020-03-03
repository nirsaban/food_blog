<?php
require_once 'app/function.php';
session_start();
$err = '';
    ///////////////////////////
    ////check session
    if(isset($_SESSION['uid'])){
        header("location:blog.php");
    }else {
       
    ////////////////////////////
    //// check form inout
     if(isset($_POST['submit'])) {
     if(isset($_POST['token']) && $_SESSION['token'] == $_POST['token']) {
     if(empty($_POST['email'])) {
            $err = "you must fill mail input!";
     }elseif (empty($_POST['password'])) {
            $err = "you must fill password input!";
     }else{
            $link = db_connect();
            ////////////////////////////////
            /////////secure input
            $email = trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING));
            $password = trim(filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING));
            $email = mysqli_real_escape_string($link, $email);
            $password = mysqli_real_escape_string($link, $password);
            //////////////////////////////
            ////check if $email = db email
            $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
            $result = mysqli_query($link, $sql);
            /////////////////////////////////////
            /////////insert all values do array
            if ($result && mysqli_num_rows($result) == 1) { 
                $data = mysqli_fetch_assoc($result);
                /////////////////////////////////////
                ////check if password= db password
                ////and create session
               if (password_verify($password, $data['password'])) {
             
                    $_SESSION['name'] = $data['name'];
                    $_SESSION['uid'] = $data['id'];
                    $_SESSION['uip'] = $_SERVER['REMOTE_ADDR'];
                    header("location: blog.php");
                } else {
                    $err = 'your email or password invalid';
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
    <div class="form-container">
        <span class="form-heading">Welcome back!<br />Please login</span>

          <form action="" method="POST">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email..." required="">
                <span class="bar"></span>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password..." required="">
                <span class="bar"></span>
            </div>

            <input type="hidden" name="token" value="<?= $token; ?>">

            <div class="input-group">
                <i class="fab fa-telegram-plane"></i>
                <input type="submit" name="submit" class="submit" value="Sign in">
            </div>

            <h4 class="err"> <?= $err; ?> </h4>
             <div class="switch-login">
                <a href="signup.php">Don't have an account yet? Click here <span> Register</span></a>
            </div>
          </form>
    </div>
</div>
</div>
<?php
require_once 'footer.php';
?>