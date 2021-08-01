<?php include('partials/menu.php');?>
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
        <?php

              $sql1="select * from proctor where proctor_id='$proctor_id'";
              $res1=mysqli_query($conn,$sql1);
              $row1=mysqli_fetch_assoc($res1);
              $dept_id=$row1['dept_id'];

              $sql2="select * from department where dept_id=$dept_id";
              $res2=mysqli_query($conn,$sql2);
              $row2=mysqli_fetch_assoc($res2);
              $dept_name=$row2['dept_name'];
        ?>
        <br>
        <h2>Enter Course for <?php echo $dept_name;?></h2>
        <br>
        <form action="" method="POST">
            <table class="tbl-form">
            <tr>
                    <td>Course code</td>
                    <td>
                        <input type="text" name="course_code" placeholder="enter course code">
                    </td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td>
                        <input type="text" name="sem" placeholder="enter semester">
                    </td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>
                        <input type="text" name="name" placeholder="enter course name">
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
                        <input type="submit" name="submit" value="add course" class="btn-primary">
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
         $sem=$_POST['sem'];
         $name=$_POST['name'];
        //  $dept_id=$_POST['dept_id'];

         $sql="INSERT INTO courses SET
         course_code='$course_code',
         name='$name',
         sem='$sem',
         dept_id='$dept_id'
        --  dept_id='$dept_id'
         ";


         $res= mysqli_query($conn,$sql) or die(mysqli_error($conn));

         if($res==true)
         {
             $_SESSION['add']="Course added successfully";

             header("location:".SITEURL.'manage-dept.php?proctor_id='.$proctor_id);
         }
         else
         {
            $_SESSION['add']="failed to add course";

            header("location:".SITEURL.'add-course.php?proctor_id='.$proctor_id);
         }
     }
     else{

     }
?>