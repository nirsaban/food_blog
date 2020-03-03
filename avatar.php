<?php

// php.ini default max size ( upload_max_filesize=2M )

define('UPLOAD_MAX_SIZE', 1024 * 1024 * 20);
$ex = ['jpg', 'jpeg', 'png', 'gif', 'bpm', 'pdf', 'doc', 'docx'];

if (isset($_POST['submit'])) {

  if (!empty($_FILES['image']['name'])) {

    if (is_uploaded_file($_FILES['image']['tmp_name'])) {

      if ($_FILES['image']['size'] <= UPLOAD_MAX_SIZE && $_FILES['image']['error'] == 0) {
       
        $file_info = pathinfo($_FILES['image']['name']);
        
       
        $file_ex = strtolower($file_info['extension']);

        if (in_array($file_ex, $ex)) {

          move_uploaded_file($_FILES['image']['tmp_name'], "img/".$_FILES['image']['name']);
          
        }
      }
    }
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Single upload</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <form method="post" action="" enctype="multipart/form-data">
      <input type="file" name="image"><br><br>
      <input type="submit" name="submit" value="Save">
    </form>
  </body>
</html>


