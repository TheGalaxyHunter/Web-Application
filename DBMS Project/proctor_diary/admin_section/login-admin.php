<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login - Admin</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

<body>
    <div class="login">
        <h1 class= "text-centre">Proctor Login</h1>
        <?php
            if(isset($_SESSION['log']))
            {
                echo $_SESSION['log'];
                unset($_SESSION['log']);
            }
        ?>
        <form action="" method="POST" class="text-centre">
            Name:
            <br>
            <input type="text" name="proctor_name"><br><br>
            Password:
            <br>
            <input type="password" name="proctor_password"><br><br>
            <input type="submit" name="submit" value="login" class="btn-primary">
        </form>

    </div>
</body>
</html>
<?php
     
     if(isset($_POST['submit']))
     {
         $proctor_name=$_POST['proctor_name'];
         $proctor_password=$_POST['proctor_password'];

         $sql="SELECT * FROM proctor WHERE proctor_name='$proctor_name' AND proctor_password='$proctor_password'";

         $res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

         $count=mysqli_num_rows($res);

         $row=mysqli_fetch_assoc($res);

         $proctor_id=$row['proctor_id'];

         if($count==1)
         {
             $_SESSION["proctor_id"] = $proctor_id;
            header("location:".SITEURL.'index.php?proctor_id='.$proctor_id);//imp passing proc id to index page
         }
         else
         {
            $_SESSION['log']="proctor log in failed";

            header("location:".SITEURL.'login-admin.php');
         }

     }
     else{
         echo "problm";
     }
?>