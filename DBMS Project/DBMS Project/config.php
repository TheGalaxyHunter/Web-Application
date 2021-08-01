<?php
define('DBSERVER', 'localhost');
define('DBUSERNAME', 'root');
define('DBPASSWORD', '');
define('DBNAME', 'proctor_diary');

// connect to MySQL database
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

if($conn == false) {
    die("Error: Connection Error! ".mysqli_connect_error());
}
else{
    // echo "Success connecting to database!";
}
?>