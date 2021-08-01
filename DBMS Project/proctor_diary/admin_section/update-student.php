<?php include('partials/menu.php');?>
<?php
     
     if(isset($_POST['submit']))
     {
        $proctor_id=$_POST['proctor_id'];
         $dept_name=$_POST['dept_name'];
        //  $proctor_password=md5($_POST['proctor_password']);//encrypted
         $email=$_POST['email'];
        //  $dob=$_POST['dob'];
         $current_sem=$_POST['current_sem'];
         $sql1="select * from department where dept_name='$dept_name'" or die(mysqli_error($conn));
         $res1=mysqli_query($conn,$sql1);
         $rowss=mysqli_fetch_assoc($res1);
         $dept_id=$rowss['dept_id'];
        //  $dept_id=$_POST['dept_id'];
        //  $dept_id=$_POST['dept_id'];

         $sql="UPDATE student SET
         dept_id='$dept_id',
         email='$email',
         current_sem='$current_sem'
         WHERE usn='$usn'
        --  dept_id='$dept_id'
         ";


         $res= mysqli_query($conn,$sql) or die(mysqli_error($conn));

         if($res==true)
         {
             $_SESSION['update']="student updated successfully";

             header("location:".SITEURL.'manage-students.php?proctor_id='.$proctor_id);
         }
         else
         {
            $_SESSION['update']="failed to update student";

            header("location:".SITEURL.'update-student.php?proctor_id='.$proctor_id);
         }
     }
     else{

     }
?>
<div class="main-content">
    <div class="wrapper">
         <h1>Update Student</h1>
         <?php
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
         <?php
              $usn=$_GET['usn'];
              $proctor_id=$_GET['proctor_id'];
              $dept_name=$_GET['dept_name'];
              ?>
        

         <?php
            //    $proctor_id=$_GET['proctor_id'];

               $sql11="SELECT * FROM student WHERE usn='$usn'";

               $res11=mysqli_query($conn,$sql11) or die(mysqli_error($conn));

               $row11=mysqli_fetch_assoc($res11);

               $email=$row11['email'];
               $current_sem=$row11['current_sem'];

         ?>
          
         <form action="" method="POST">
            <table class="tbl-form">
                <tr>
                    <td>Department</td>
                    <td>
                        <input type="text" name="dept_name" placeholder="<?php echo $dept_name ;?>">
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="email" name="email" placeholder="<?php echo $email ;?>">
                    </td>
                </tr>
                <tr>
                    <td>current sem</td>
                    <td>
                        <input type="text" name="current_sem" placeholder="<?php echo $current_sem ;?>">
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


