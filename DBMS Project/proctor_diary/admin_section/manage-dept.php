<?php include('partials/menu.php');?>
<div class="main-content">
<?php          
                $sql="SELECT course_code, name, sem, dept_name FROM courses c JOIN(proctor p, department d) ON c.dept_id=p.dept_id and c.dept_id=d.dept_id WHERE p.proctor_id='$proctor_id'";

                $res= mysqli_query($conn,$sql) or die(mysqli_error($conn));

                ?>

    <div class="wrapper">
        <h1>Manage Department</h1>
        <br>
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
       <br>
        <a href="<?php echo SITEURL;?>add-course.php?proctor_id=<?php echo $proctor_id;?>" class="btn-primary">Add course</a>
        <br><br>
        <div>
            <table class="tbl-full">
                <tr>
                    <th>Course-ID</th>
                    <th>Name</th>
                    <th>Semester</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
                <?php
                

                if($res)
                {
                    $count = mysqli_num_rows($res);
                    if($count>0)
                    {
                        while($rows=mysqli_fetch_assoc($res) )
                        {
                            $course_code=$rows['course_code'];
                            $name=$rows['name'];
                            $sem=$rows['sem'];
                            $dept_name=$rows['dept_name'];
                            ?>
                <tr>
                    <td><?php echo $course_code;?></td>
                    <td><?php echo $name;?></</td>
                    <td><?php echo $sem;?></td>
                    <td><?php echo $dept_name;?></td>
                    <td>
                        <br>
                        <a href="<?php echo SITEURL;?>update-course.php?proctor_id=<?php echo $proctor_id;?>&course_code=<?php echo $course_code;?>" class="btn-secondary">Update Course</a>
                        <a href="<?php echo SITEURL;?>delete-course.php?proctor_id=<?php echo $proctor_id;?>&course_code=<?php echo $course_code;?>" class="btn-tertiary">Delete Course</a>
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
</div>
<?php include('partials/footer.php');?>