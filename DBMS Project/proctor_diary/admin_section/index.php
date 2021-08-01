<?php include('partials/menu.php');?>
    <!-- djjvdjsdfvsjoe -->
    <div class="main-content">
        <br><br>
        <strong id="st">DASHBOARD</strong>
        <br>
        

        <div class="wrapper1">


            <div class="col-4">
                <h1>
                    <?php
                         $sql1="select * from proctor";
                         $res1=mysqli_query($conn,$sql1);
                         $row1=mysqli_num_rows($res1);
                         echo $row1;
                    ?>
                </h1>
                <br>
                Proctors
            </div>
            <div class="col-4">
                <h1>
                <?php
                         $sql1="select * from student";
                         $res1=mysqli_query($conn,$sql1);
                         $row1=mysqli_num_rows($res1);
                         echo $row1;
                    ?>
                </h1>
                <br>
                Students
            </div>
            <div class="col-4">
                <h1>
                <?php
                         $sql1="select * from department";
                         $res1=mysqli_query($conn,$sql1);
                         $row1=mysqli_num_rows($res1);
                         echo $row1;
                    ?>
                </h1>
                <br>
                Departments
            </div>
            <div class="col-4">
                <h1>
                <?php
                         $sql1="select * from courses";
                         $res1=mysqli_query($conn,$sql1);
                         $row1=mysqli_num_rows($res1);
                         echo $row1;
                    ?>
                </h1>
                <br>
                Courses
            </div>
        </div>
    </div>
    <?php include('partials/footer.php');?>