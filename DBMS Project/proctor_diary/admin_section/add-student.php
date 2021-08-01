<?php include('partials/menu.php');?>


<?php
     
     if(isset($_POST['submit']))
     {
         $usn=$_POST['usn'];
         $student_name=$_POST['student_name'];
         $student_dob=$_POST['student_dob'];//for encrypted put md5
         $dept_id=$_POST['dept_id'];
         $current_sem=$_POST['current_sem'];
        //  $proctor_id=$_POST['proctor_id'];
         $email=$_POST['email'];
         $student_password=$_POST['student_password'];
         $mother_name=$_POST['mother_name'];
         $father_name=$_POST['father_name'];
         $profile_pic=$_POST['profile_pic'];
        //  $dept_id=$_POST['dept_id'];

         $sql="INSERT INTO student SET
         usn='$usn',
         student_name='$student_name',
         student_dob='$student_dob',
         dept_id='$dept_id',
         current_sem='$current_sem',
         proctor_id='$proctor_id',
         email='$email',
         student_password='$student_password',
         mother_name='$mother_name',
         father_name='$father_name',
         profile_pic='$profile_pic'
         ";


         $res= mysqli_query($conn,$sql) or die(mysqli_error($conn));

         if($res==true)
         {
             $_SESSION['add']="Student added successfully";
             $proctor_id=$_GET['proctor_id'];
             header("location:".SITEURL."manage-students.php?proctor_id=".$proctor_id);
         }
         else
         {
            $_SESSION['add']="failed to add student";

            header("location:".SITEURL."add-student.php?proctor_id=".$proctor_id);
         }
     }
     else{

     }
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Student</h1>
        <?php
              $proctor_id=$_GET['proctor_id'];
              echo $proctor_id;
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
                    <td>usn</td>
                    <td>
                        <input type="text" name="usn" placeholder="enter you usn">
                    </td>
                </tr>
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="student_name" placeholder="enter you name">
                    </td>
                </tr>
                <tr>
                    <td>DOB</td>
                    <td>
                        <input type="date" name="student_dob" >
                    </td>
                </tr>
                <tr>
                    <td>Department id</td>
                    <td>
                        <input type="text" name="dept_id" placeholder="enter dept id">
                    </td>
                </tr>

                <tr>
                    <td>current sem</td>
                    <td>
                        
                        <input type="text" name="current_sem" placeholder="enter current semester">
                    </td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>
                        <input type="email" name="email" placeholder="enter email">
                    </td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>
                        <input type="password" name="student_password" placeholder="enter password">
                    </td>
                </tr>
                <tr>
                    <td>mother name</td>
                    <td>
                        <input type="text" name="mother_name" placeholder="enter mothers name">
                    </td>
                </tr>
                <tr>
                    <td>father name</td>
                    <td>
                        <input type="text" name="father_name" placeholder="enter fathers name">
                    </td>
                </tr>
                <tr>
                    <td>profile pic</td>
                    <td>
                        <input type="text" name="profile_pic" placeholder="enter yes or no">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="add admin" class="btn-primary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php');?>