<?php include('partials/menu.php');?>
<div class="main-content">
<?php
      $search=$_POST['search'];

      $sql1="select * from student where student_name='$search'";
      $res1= mysqli_query($conn,$sql1) or die(mysqli_error($conn));
      $row1=mysqli_fetch_assoc($res1);
      $usn=$row1['usn'];

      $sql="select c.course_code, c.name, m.marks, a.attendance, (a.attendance/a.total_attend*100) as percent from courses c 
                                join(marks m, attendance a) on c.course_code=m.course_code and c.course_code=a.course_code where m.usn='$usn';";
      
       

?>
    <div class="wrapper">
     <h1>Marks, Attendance and Eligibility for student <?php echo $search;?></h1>
     <div>
            <table class="tbl-full">
                <tr>
                    <th>Course-ID</th>
                    <th>Course Name</th>
                    <th>Marks</th>
                    <th>Attendance</th>
                    <th>eligibilty</th>
                </tr>
                <?php
                

                $res= mysqli_query($conn,$sql) or die(mysqli_error($conn));
                //join
                if($res)
                {
                    $count = mysqli_num_rows($res);
                    if($count>0)
                    {
                        while($rows=mysqli_fetch_assoc($res) )
                        {
                            $course_code=$rows['course_code'];
                            $name=$rows['name'];
                            $marks=$rows['marks'];
                            $attendance=$rows['attendance'];
                            $percent=$rows['percent'];
                            ?>
                <tr>
                    <td><?php echo $course_code;?></td>
                    <td><?php echo $name;?></</td>
                    <td><?php echo $marks;?></td>
                    <td><?php echo $attendance;?></td>
                    <td><?php 
                    if($percent <80)
                    {
                        echo "not eligible for SEE";
                    }
                    else{
                        echo "eligible for SEE";
                    }
                    ?></td>
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