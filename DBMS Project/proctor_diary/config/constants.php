<?php

   session_start();
   define('SITEURL','http://115.99.190.90/proctor_diary/admin_section/');
   
   $p_name='princi';
   $p_password='princi';

   
   define('LOCALHOST','localhost');
   define('DB_USERNAME','root');
   define('DB_PASSWORD','');
   define('DB_NAME','proctor_diary');
$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());//db connection
$db_select=mysqli_select_db($conn,DB_NAME)or die(mysqli_error());

?>