<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
         <h1>Update Course</h1>
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
               $course_code=$_GET['course_code'];

               $sql="SELECT * FROM courses WHERE course_code='$course_code'";

               $res=mysqli_query($conn,$sql);

               $row=mysqli_fetch_assoc($res);

               $name=$row['name'];
               $sem=$row['sem'];

         ?>
          
         <form action="" method="POST">
            <table class="tbl-form">
                <tr>
                    <td>Course name</td>
                    <td>
                        <input type="text" name="name" placeholder="<?php echo $name ;?>">
                    </td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td>
                    <input type="hidden" name="course code" value="<?php echo $course_code;?>">
                        <input type="text" name="sem" placeholder="<?php echo $sem ;?>">
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
                        <input type="submit" name="submit" value="update course" class="btn-primary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>
<?php include('partials/footer.php');?>


<?php
     
     if(isset($_POST['submit']))
     {
        $course_code=$_POST['course_code'];
         $name=$_POST['name'];
        //  $proctor_password=md5($_POST['proctor_password']);//encrypted
         $sem=$_POST['sem'];


         $sql="UPDATE courses SET
         name='$name',
         sem=$sem
         WHERE course_code='$course_code'
        --  dept_id='$dept_id'
         ";


         $res= mysqli_query($conn,$sql) or die(mysqli_error($conn));

         if($res==true)
         {
             $_SESSION['update']="course updated successfully";

             header("location:".SITEURL.'manage-dept.php?proctor_id='.$proctor_id);
         }
         else
         {
            $_SESSION['update']="failed to update course";

            header("location:".SITEURL.'update-course.php?proctor_id='.$proctor_id);
         }
     }
     else{

     }
?>