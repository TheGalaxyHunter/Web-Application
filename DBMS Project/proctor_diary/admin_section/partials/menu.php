<?php include('../config/constants.php')?>
<!-- <html>

<head>
    <title>ADMIN HOMEPAGE</title>
    <link rel="stylesheet" href="../css/admin.css">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <div class="menu">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-students.php">Students</a></li>
                <li><a href="manage-dept.php">Departments</a></li>
                <li><a href="search.php">Search</a></li>
                <li><a href="#">Log Out</a></li>
            </ul>
        </div>
    </div> -->
             <?php
              $proctor_id=$_GET['proctor_id'];
              ?>

<html>

<head>
    <title>ADMIN HOMEPAGE</title>
    <link rel="stylesheet" href="../css/admin.css">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <div class="menu">
        <div class="wrapper">
            <ul>
                <li><a href="<?php echo SITEURL;?>index.php?proctor_id=<?php echo $proctor_id;?>">Home</a></li>
                <li><a href="<?php echo SITEURL;?>manage-admin.php?proctor_id=<?php echo $proctor_id;?>">Admin</a></li>
                <li><a href="<?php echo SITEURL;?>manage-students.php?proctor_id=<?php echo $proctor_id;?>">Students</a></li>
                <li><a href="<?php echo SITEURL;?>manage-dept.php?proctor_id=<?php echo $proctor_id;?>">Departments</a></li>
                <li><a href="<?php echo SITEURL;?>search.php?proctor_id=<?php echo $proctor_id;?>">Search</a></li>
                <li><a href="<?php echo SITEURL;?>login-admin.php">Log Out</a></li>
            </ul>
        </div>
    </div>