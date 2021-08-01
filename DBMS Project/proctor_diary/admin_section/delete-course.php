
<?php

include('../config/constants.php');

$proctor_id=$_GET['proctor_id'];

$course_code=$_GET['course_code'];

               $sql="delete from courses where course_code='$course_code'";
               $res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

if($res)
{
 $_SESSION['delete']="Course deleted successfully";

 header("location:".SITEURL.'manage-dept.php?proctor_id='.$proctor_id);
}
else
{
 $_SESSION['delete']="Course failed to delete";

 header("location:".SITEURL.'manage-dept.php?proctor_id='.$proctor_id);
    
}
?>