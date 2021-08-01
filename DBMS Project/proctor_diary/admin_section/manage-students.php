<?php include('partials/menu.php');?>
<div class="main-content">
  
    <div class="wrapper">
        <h1>
            Manage Students
        </h1><br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
       ?><br>
        <?php 
              $sql3="select * from proctor where proctor_id='$proctor_id'";
              $res3=mysqli_query($conn,$sql3);
              $rows3=mysqli_fetch_assoc($res3);
              $proctor_name=$rows3['proctor_name'];
        ?>
        <h2> Students under proctor <?php echo $proctor_name;?></h2>
        <br>
        <a href="<?php echo SITEURL;?>add-student.php?proctor_id=<?php echo $proctor_id;?>" class="btn-primary">Add Student</a>
        <br><br>
        <table class="tbl-full">
                <tr>
                    <th>USN</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Current Sem</th>
                    <th>DOB</th>
                    <th>Email</th>
                    <th>Mother name</th>
                    <th>Father Name</th>
                    <th>Actions</th>
                </tr>
                <?php
                
                $sql="SELECT usn, student_name, student_dob, current_sem, email, mother_name, father_name, dept_name FROM student s JOIN(department d) ON d.dept_id=s.dept_id where proctor_id='$proctor_id'";

                $res= mysqli_query($conn,$sql) or die(mysqli_error($conn));
                if($res)
                {
                    $count = mysqli_num_rows($res);
                    if($count>0)
                    {
                        while($rows=mysqli_fetch_assoc($res) )
                        {
                            $usn=$rows['usn'];
                            $student_name=$rows['student_name'];
                            $dept_name=$rows['dept_name'];
                            $current_sem=$rows['current_sem'];
                            $student_dob=$rows['student_dob'];
                            $email=$rows['email'];
                            $mother_name=$rows['mother_name'];
                            $father_name=$rows['father_name'];
                            
                            ?>
                <tr>
                    <td><?php echo $usn;?></td>
                    <td><?php echo $student_name;?></</td>
                    <td><?php echo $dept_name;?></td>
                    <td><?php echo $current_sem;?></td>
                    <td><?php echo $student_dob;?></td>
                    <td><?php echo $email;?></td>
                    <td><?php echo $mother_name;?></td>
                    <td><?php echo $father_name;?></td>
                    <td>
                        <br>
                        <a href="<?php echo SITEURL;?>update-student.php?usn=<?php echo $usn;?>&proctor_id=<?php echo $proctor_id;?>&dept_name=<?php echo $dept_name;?>" class="btn-secondary">Update</a>
                        <a href="<?php echo SITEURL;?>delete-student.php?usn=<?php echo $usn;?>&proctor_id=<?php echo $proctor_id;?>" class="btn-tertiary">Delete</a>
                        <br>
                    </td>
                </tr>
                <?php
                        }
                    }
                   
                }
                else{

                }
           ?>

            </table>
    </div>
</div>
<?php include('partials/footer.php');?>