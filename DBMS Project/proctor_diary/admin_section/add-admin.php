<?php include('partials/menu.php');?>
<?php include('partials/footer.php');?>

<?php
     
     if(isset($_POST['submit']))
     {
         $proctor_id=$_POST['proctor_id'];
         $proctor_name=$_POST['proctor_name'];
         $proctor_password=$_POST['proctor_password'];//for encrypted put md5
         $email=$_POST['email'];
         $dob=$_POST['dob'];
         $designation=$_POST['designation'];
         $dept_id=$_POST['dept_id'];
        //  $dept_id=$_POST['dept_id'];

         $sql="INSERT INTO proctor SET
         proctor_id='$proctor_id',
         proctor_name='$proctor_name',
         proctor_password='$proctor_password',
         email='$email',
         dob='$dob',
         designation='$designation',
         dept_id='$dept_id'
         ";


         $res= mysqli_query($conn,$sql) or die(mysqli_error($conn));

         if($res==true)
         {
             $_SESSION['add']="Admin added successfully";

             header("location:".SITEURL.'manage-admin.php?proctor_id='.$proctor_id);
         }
         else
         {
            $_SESSION['add']="failed to add admin";

            header("location:".SITEURL.'add-admin.php?proctor_id='.$proctor_id);
         }
     }
     else{

     }
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <?php
              $proctor_id=$_GET['proctor_id'];
              ?>
        <br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <br>
        <form action="" method="POST">
            <table class="tbl-form">
            <tr>
                    <td>Proctor id</td>
                    <td>
                        <input type="text" name="proctor_id" placeholder="enter you name">
                    </td>
                </tr>
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="proctor_name" placeholder="enter you name">
                    </td>
                </tr>
                <tr>
                    <td> password</td>
                    <td>
                        <input type="password" name="proctor_password" placeholder="enter password">
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="email" name="email" placeholder="enter email">
                    </td>
                </tr>
                <tr>
                    <td>DOB</td>
                    <td>
                        <input type="date" name="dob">
                    </td>
                </tr>
                <tr>
                    <td>Desigantion</td>
                    <td>
                        <input type="text" name="designation" placeholder="enter designation">
                    </td>
                </tr>
                <tr>
                    <td>Dept id</td>
                    <td>
                        <input type="text" name="dept_id" placeholder="enter you name">
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
                        <input type="submit" name="submit" value="add admin" class="btn-primary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>
