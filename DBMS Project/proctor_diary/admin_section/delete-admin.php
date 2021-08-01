
<?php

   include('../config/constants.php');

   $proctor_id=$_GET['proctor_id'];

   $sql="DELETE FROM proctor WHERE proctor_id='$proctor_id'";

   $res=mysqli_query($conn,$sql);

   if($res)
   {
    $_SESSION['delete']="Admin deleted successfully";

    header("location:".SITEURL.'manage-admin.php?proctor_id='.$proctor_id);
   }
   else
   {
    $_SESSION['delete']="Admin failed to delete";

    header("location:".SITEURL.'manage-admin.php?proctor_id='.$proctor_id);
       
   }
?>