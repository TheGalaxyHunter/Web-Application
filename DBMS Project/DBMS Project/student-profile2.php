<?php

require "config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
else {
    $usn = $_SESSION["usn"];
    $sql = "SELECT `usn`, `student_name`, `student_dob`, s.`dept_id`, `current_sem`, s.`proctor_id`, s.`email`, `mother_name`, `father_name`, `profile_pic`, `proctor_name`, `dept_name`
            from student s join(proctor p, department d) on p.proctor_id=s.proctor_id and d.dept_id=s.dept_id WHERE usn = '$usn';";
    if($stmt = $conn -> prepare($sql)){
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Store result
            mysqli_stmt_store_result($stmt);
            
            
            if(mysqli_stmt_num_rows($stmt) == 1){

                // Bind result variables
                mysqli_stmt_bind_result($stmt, $usn, $name, $dob, $dept, $sem, $proctor_id, $email, $m_name, $f_name, $profile_pic, $proctor_name, $dept_name);
                if(mysqli_stmt_fetch($stmt)){
                    // Password is correct, so start a new session
                    // echo "Succesfully logged in!";
                    
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["isStudent"] = true;
                    $_SESSION["name"] = $name;
                    $_SESSION["usn"] = $usn;
                    $_SESSION["dob"] = $dob; $_SESSION["dept"] = $dept; $_SESSION["sem"] = $sem;
                    $_SESSION["proctor-id"] = $proctor_id; $_SESSION["email"] = $email;
                    $_SESSION["mother-name"] = $m_name; $_SESSION["father-name"] = $f_name;
                    $_SESSION["proctor_name"] = $proctor_name; $_SESSION["dept_name"] = $dept_name;
                    $_SESSION["profile_pic"] = $profile_pic;

                    // Redirect user to welcome page
                    // header("location: student-profile.php");
                }
            } else{
                // Display an error message if username doesn't exist
                $error = "No account found with that username.";
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="About Page of the Website.">
    <title>Profile</title>
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
          
          <div class="profile" style="display: inline-flex; justify-items: center; align-items: center; margin-left:500px;">
            <div class="MuiForm" id="Mui-form" style="width: 60%; height: 650px; align-items:left; padding-right:90px; margin-right:100px; padding-left:50px;">
                <br>
                <h1 id="profile-header">Profile</h1>
                <div class="erro-msg" style="color: red; font-style: italic;">
                <!-- <p class="help-block">Couldn't profile</p> -->
                <!-- <p class="help-block"><?php echo $error; ?></p> -->
                </div>
              
                <form id="profile-form" style="color:black; justify-items: center; align-items: center;">

                    <!-- <p style="text-align: left;">Name: &emsp;&emsp;&emsp;</p> -->
                    

                    <input type="text" name="usn" id="usn-field" class="profile-form-field" placeholder="USN" value="<?php echo htmlspecialchars($_SESSION["usn"]); ?>" style="width:550px; font-size:25px;">
                    
                    <table style="color:black; justify-items: center; align-items: center; border:none; text-align: centre; padding-left: 50px; margin-left:50px;">
                        <tr>
                            <td>Name: &emsp;&emsp;&emsp;</td>
                            <td><input type="text" name="usn" id="name-field" class="profile-form-field" placeholder="Name" value="<?php echo htmlspecialchars($_SESSION["name"]); ?>"></td>
                        </tr>

                        <tr>
                            <td>DOB: </td>
                            <td><input type="date" name="dob" id="dob-field" class="profile-form-field" placeholder="Date of Birth" value="<?php echo htmlspecialchars($_SESSION["dob"]); ?>"></td>
                        </tr>

                        <tr>
                            <td>Department: </td>
                            <td><input type="text" name="dept_id" id="dept" class="profile-form-field" placeholder="Department" value="<?php echo htmlspecialchars($_SESSION["dept_name"]); ?>"></td>
                        </tr>

                        <tr>
                            <td>Semester: </td>
                            <td><input type="number" name="sem" id="semester" class="profile-form-field" placeholder="Semester" value="<?php echo htmlspecialchars($_SESSION["sem"]); ?>"></td>
                        </tr>

                        <tr>
                            <td>Email: </td>
                            <td><input type="email" name="email" id="email-field" class="profile-form-field" placeholder="-" value="<?php echo htmlspecialchars($_SESSION["email"]); ?>"></td>
                        </tr>

                        <tr>
                            <td>Proctor: </td>
                            <td><input type="text" name="email" id="proctor-field" class="profile-form-field" placeholder="-" value="<?php echo htmlspecialchars($_SESSION["proctor_name"]); ?>"></td>
                        </tr>

                        <tr>
                            <td>Mother's Name: &nbsp;</td>
                            <td><input type="text" name="m-name" id="m-name-field" class="profile-form-field" placeholder="-" value="<?php echo htmlspecialchars($_SESSION["mother-name"]); ?>"></td>
                        </tr>

                        <tr>
                            <td>Father's Name: &nbsp;</td>
                            <td><input type="text" name="f-name" id="f-name-field" class="profile-form-field" placeholder="-" value="<?php echo htmlspecialchars($_SESSION["father-name"]); ?>"></td>
                        </tr>

                    </table>
                    <br>
                    
                    
                   
                    
                    
                    <!-- <br>
                    <label style="color: black; margin-top: 10px;">
                        <a href="login.php">Already have an account.!</a>
                    </label> -->
                    <!-- <br><a href="student-update.php">
                    <input type="submit" value="Update" id="profile-form-submit">
                    <br> -->
                </form>
            </div>
            <div class="MuiForm" id="Mui-form" style="color:black; width: 500px; height: 500px; align-items:left;">
                <img src="images/<?php echo $_SESSION["profile_pic"]?>" alt="Profile Picture" style="width:300px;height:350px;border-radius:8px;" />
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
        document.getElementById("name-field").disabled = true;
        document.getElementById("dob-field").disabled = true;
        document.getElementById("dept").disabled = true;
        document.getElementById("semester").disabled = true;
        document.getElementById("email-field").disabled = true;
        document.getElementById("proctor-field").disabled = true;
        document.getElementById("m-name-field").disabled = true;
        document.getElementById("f-name-field").disabled = true;
      }
  </script>
  </body>
</html>