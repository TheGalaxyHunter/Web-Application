<?php include('partials/menu.php');?>
<?php
     
     if(isset($_POST['submit']))
     {
        $proctor_id=$_POST['proctor_id'];
         $proctor_name=$_POST['proctor_name'];
        //  $proctor_password=md5($_POST['proctor_password']);//encrypted
         $email=$_POST['email'];
        //  $dob=$_POST['dob'];
         $designation=$_POST['designation'];
        //  $dept_id=$_POST['dept_id'];
        //  $dept_id=$_POST['dept_id'];

         $sql="UPDATE proctor SET
         proctor_name='$proctor_name',
         email='$email',
         designation='$designation'
         WHERE proctor_id='$proctor_id'
        --  dept_id='$dept_id'
         ";


         $res= mysqli_query($conn,$sql) or die(mysqli_error($conn));

         if($res==true)
         {
             $_SESSION['update']="Admin updated successfully";

             header("location:".SITEURL.'manage-admin.php?proctor_id='.$proctor_id);
         }
         else
         {
            $_SESSION['update']="failed to update admin";

            header("location:".SITEURL.'update-admin.php?proctor_id='.$proctor_id);
         }
     }
     else{

     }
?>
<div class="main-content">
    <div class="wrapper">
         <h1>Update Admin</h1>
         <?php
              $proctor_id=$_GET['proctor_id'];
              ?>
         <?php
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

         <?php
               $proctor_id=$_GET['proctor_id'];

               $sql="SELECT * FROM proctor WHERE proctor_id='$proctor_id'";

               $res=mysqli_query($conn,$sql);

               $row=mysqli_fetch_assoc($res);

               $proctor_name=$row['proctor_name'];
               $email=$row['email'];
               $designation=$row['designation'];

         ?>
          
         <form action="" method="POST">
            <table class="tbl-form">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="proctor_name" placeholder="<?php echo $proctor_name ;?>">
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="email" name="email" placeholder="<?php echo $email ;?>">
                    </td>
                </tr>
                <tr>
                    <td>Desigantion</td>
                    <td>
                        <input type="text" name="designation" placeholder="<?php echo $designation ;?>">
                    </td>
                </tr>
<!--                 
                <tr>
                    <td>Dept_id</td>
                    <td>
                        <input type="text" name="dept_id" >
                    </td>
                </tr> -->
                <tr>
                    <td>
                        <input type="hidden" name="proctor_id" value="<?php echo $proctor_id; ?>">
                        <input type="submit" name="submit" value="update admin" class="btn-primary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>
<?php include('partials/footer.php');?>


