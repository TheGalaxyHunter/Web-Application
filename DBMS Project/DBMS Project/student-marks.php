<?php

require "config.php";
// Initialize the session
session_start();

$usn = $_SESSION["usn"];
$eligibility = "none";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
else {
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $eligibility = "block";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="About Page of the Website.">
    <title>Marks and Attendance</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script>
        $(function(){
          $("#nav-bar").load("nav.php"); 
        });
    </script>
    <link rel="stylesheet" href="styles.css">
</head>
    
<body class="jss3">
  <noscript>You need to enable JavaScript to run this app.</noscript>
  <div id="root" style="font-family:Quicksand">
      <div>
          <div id="nav-bar">
          </div>
          
          <div class="marks" style="display: inline-flex; justify-items: center; align-items: center; margin-left:450px;">
            <div class="MuiForm" id="Mui-form" style="width: 90%; height: 550px; align-items:left; padding-right:90px; margin-right:100px; padding-left:50px;">
                <br>
                <h1 id="marks-header" style="margin-left:80px;">Marks and Attendance</h1>
                <div class="erro-msg" style="color: red; font-style: italic;">
                <!-- <p class="help-block">Couldn't marks</p> -->
                <!-- <p class="help-block"><?php echo $error; ?></p> -->
                </div>
              
                <form id="marks-form" style="color:black; justify-items: center; align-items: center;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="text" name="usn" id="usn-field" class="marks-form-field" placeholder="USN" value="<?php echo htmlspecialchars($_SESSION["usn"]); ?>" style="width:750px; font-size:25px;"> 
                    <br><br>
                    <table style="color:black; justify-items: center; align-items: center; border:none; text-align: center; padding-left: 50px; margin-left:100px;">
                        <tr>
                            <th style="width:150px;">Course Code</th>
                            <th style="width:300px;">Course Name</th>
                            <th style="width: 100px;">Marks</th>
                            <th style="width: 100px;">Attendance</th>
                            <th id="eligible_th" style="width: 150px; display: <?php echo $eligibility?>">Eligibility</th>
                            
                        </tr>
                        <tr>
                            <td><hr style="border-top: 1px dashed black;"></td>
                            <td><hr style="border-top: 1px dashed black;"></td>
                            <td><hr style="border-top: 1px dashed black;"></td>
                            <td><hr style="border-top: 1px dashed black;"></td>
                            <td><hr style="border-top: 1px dashed black;"></td>
                        </tr>
                        <?php
                            // Using database connection file here

                            $records = mysqli_query($conn,"select c.course_code, c.name, m.marks, a.attendance, (a.attendance/a.total_attend*100) as percent from courses c 
                                join(marks m, attendance a) on c.course_code=m.course_code and c.course_code=a.course_code where m.usn='$usn';"); // fetch data from database

                            while($data = mysqli_fetch_array($records))
                            {
                        ?>
                        <tr>
                            <td><?php echo $data['course_code']; ?></td>
                            <td style="text-align:left;"><?php echo $data['name']; ?></td>
                            <td><?php echo $data['marks']; ?></td>
                            <td><?php echo $data['attendance']; ?></td>
                            <td id="eligible_td" style="display: <?php echo $eligibility?>;"><?php $percent = $data['percent']; 
                                    if($percent > 80) 
                                        echo 'eligible for SEE'; 
                                    else
                                        echo 'not eligible for SEE'
                                ?></td>

                        </tr>	
                        <?php
                            }
                        ?>
                    </table>

                    <?php mysqli_close($conn); // Close connection ?>
                    <br>
                    
                    
                   
                    
                    
                    <!-- <br>
                    <label style="color: black; margin-top: 10px;">
                        <a href="login.php">Already have an account.!</a>
                    </label> -->
                    <br>
                    <input type="submit" value="Check Eligiblity" id="update-form-submit" style="width: 200px; margin-left:0px" onclick="eligibility()">
                </form>
            </div>
          </div>
      </div>
  </div>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script>
      disable();

      function disable() {
        console.log("Disabling....");
        document.getElementById("usn-field").disabled = true;
      }

      function eligibility() {
        <?php $eligibility = "block" ?>
        var eli_th = document.getElementById("eligible_th");
        var eli_td = document.getElementById("eligible_td");
        eli_td.style.display = "block";
        eli_th.style.display = "block";
        console.log(eli_th.style.display);
      }
  </script>
  </body>
</html>