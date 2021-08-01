<?php include('partials/menu.php');?>
<div class="main-content">

    <div class="wrapper">
        <div>
            <h1>Manage Admin</h1>
        </div>
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
        <a href="<?php echo SITEURL;?>princi_add.php?proctor_id=<?php echo $proctor_id;?>" class="btn-primary">Add Admin</a>
        <br><br>
        <div>
            <table class="tbl-full">
                <tr>
                    <th>Proctor-ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Actions</th>
                </tr>
                <?php
                
                $sql="SELECT proctor_id, proctor_name, email, designation, dept_name FROM proctor p join(department d) on p.dept_id=d.dept_id";

                $res= mysqli_query($conn,$sql) or die(mysqli_error($conn));
                if($res)
                {
                    $count = mysqli_num_rows($res);
                    if($count>0)
                    {
                        while($rows=mysqli_fetch_assoc($res) )
                        {
                            $proctor_id=$rows['proctor_id'];
                            $proctor_name=$rows['proctor_name'];
                            $email=$rows['email'];
                            $designation=$rows['designation'];
                            $dept_name=$rows['dept_name'];
                            ?>
                <tr>
                    <td><?php echo $proctor_id;?></td>
                    <td><?php echo $proctor_name;?></</td>
                    <td><?php echo $dept_name;?></td>
                    <td><?php echo $email;?></td>
                    <td><?php echo $designation;?></td>
                    <td>
                        <br>
                        <a href="<?php echo SITEURL;?>princi_update.php?proctor_id=<?php echo $proctor_id;?>" class="btn-secondary">Update Admin</a>
                        <a href="<?php echo SITEURL;?>princi_delete.php?proctor_id=<?php echo $proctor_id;?>" class="btn-tertiary">Delete Admin</a>
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