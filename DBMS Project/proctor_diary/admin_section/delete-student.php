
<?php

include('../config/constants.php');

$proctor_id=$_GET['proctor_id'];
$usn=$_GET['usn'];

$sql="DELETE FROM student WHERE usn='$usn'";

$res=mysqli_query($conn,$sql);

if($res)
{
 $_SESSION['delete']="student deleted successfully";

 header("location:".SITEURL.'manage-students.php?proctor_id='.$proctor_id);
}
else
{
 $_SESSION['delete']="student failed to delete";

 header("location:".SITEURL.'manage-students.php?proctor_id='.$proctor_id);
    
}
?>