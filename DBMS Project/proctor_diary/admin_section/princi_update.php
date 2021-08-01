<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login - Principal</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <?php
              $proctor_id=$_GET['proctor_id'];
              ?>

<body>
    <div class="login">
        <h1 class= "text-centre">Principal Login</h1>
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
            <input type="text" name="p_name"><br><br>
            Password:
            <br>
            <input type="password" name="p_password"><br><br>
            <input type="submit" name="submit" value="login" class="btn-primary">
        </form>

    </div>
</body>
</html>
<?php
     
     if(isset($_POST['submit']))
     {
         $pp_name=$_POST['p_name'];
         $pp_password=$_POST['p_password'];
         
         if($pp_name==$p_name && $pp_password==$p_password)
         {
            header("location:".SITEURL.'update-admin.php?proctor_id='.$proctor_id);
         }
         else{
            $_SESSION['log']="principal log in failed";

            header("location:".SITEURL.'princi_update.php?proctor_id='.$proctor_id);
         }

     }
     else{
         echo "access denied";
     }
?>