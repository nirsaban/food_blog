<?php
session_start();
session_destroy();
/////////////////////////////
///unset session and go index
header("location: index.php");