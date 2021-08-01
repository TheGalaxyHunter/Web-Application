<?php

require "config.php";
// Initialize the session
session_start();
$usn = $_SESSION["usn"];

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
else {
    
    $sql = "SELECT `usn`, `student_name`, `student_dob`, s.`dept_id`, `current_sem`, s.`proctor_id`, s.`email`, `mother_name`, `father_name`, `profile_pic`, `proctor_name`, `dept_name`
            from student s join(proctor p, department d) on p.proctor_id=s.proctor_id and d.dept_id=s.dept_id WHERE usn = '$usn';";
            
    if($stmt = $conn -> prepare($sql)){
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Store result
            mysqli_stmt_store_result($stmt);
            
            // Check if username exists, if yes then verify password
            if(mysqli_stmt_num_rows($stmt) == 1){   
                // $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash                 
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
                    // header("location: student-update.php");
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

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST["name"];
        $dob = $_POST["dob"];
        $sem = $_POST["sem"];
        $email = $_POST["email"];
        $m_name = $_POST["m-name"];
        $f_name = $_POST["f-name"];
        $profile_pic = $_FILES['profile_pic']['name'];

        $target = "images/".basename($_FILES['profile_pic']['name']);

        $sql = "UPDATE `student` SET `student_name`='$name', `student_dob`='$dob', `current_sem`=$sem, `email`='$email', `mother_name`='$m_name',`father_name`='$f_name', `profile_pic`='$profile_pic' WHERE usn='$usn';";
        echo $sql;

        if($stmt = $conn -> prepare($sql)){
            // Bind variables to the prepared statement as parameters
            // mysqli_stmt_bind_param($stmt, "ss",$name, $usn, $age, $email, $param_username, $param_password);
            // $stmt -> bind_param("ss",$name, $usn, $age, $email, $param_username, $param_password);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target);
                // Redirect to login page
                header("location: student-update.php");
            } else{
                echo "Something went wrong with query. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="About Page of the Website.">
    <title>Update</title>
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
          
          <div class="update" style="display: inline-flex; justify-items: center; align-items: center; margin-left:500px;">
            <div class="MuiForm" id="Mui-form" style="width: 6
            
            0%; height: 730px; align-items:left; padding-right:90px; margin-right:100px; padding-left:50px;">
                <br>
                <h1 id="update-header">Profile Update</h1>
                <div class="erro-msg" style="color: red; font-style: italic;">
                <!-- <p class="help-block">Couldn't update</p> -->
                <!-- <p class="help-block"><?php echo $error; ?></p> -->
                </div>
              
                <form id="update-form" style="color:black; justify-items: center; align-items: center;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">

                    <input type="text" name="usn" id="usn-field" class="update-form-field" placeholder="USN" value="<?php echo htmlspecialchars($_SESSION["usn"]); ?>" style="width:550px; font-size:25px;">
                    
                    <table style="color:black; justify-items: center; align-items: center; border:none; text-align: centre; padding-left: 50px; margin-left:50px;">
                        <tr>
                            <td>Name: &emsp;&emsp;&emsp;</td>
                            <td><input type="text" name="name" id="name-field" class="update-form-field" placeholder="Name" value="<?php echo htmlspecialchars($_SESSION["name"]); ?>"></td>
                        </tr>

                        <tr>
                            <td>DOB: </td>
                            <td><input type="date" name="dob" id="dob-field" class="update-form-field" placeholder="Date of Birth" value="<?php echo htmlspecialchars($_SESSION["dob"]); ?>"></td>
                        </tr>

                        <tr>
                            <td>Department: </td>
                            <td><input type="text" name="dept_id" id="dept" class="update-form-field" placeholder="Department" value="<?php echo htmlspecialchars($_SESSION["dept_name"]); ?>"></td>
                        </tr>

                        <tr>
                            <td>Semester: </td>
                            <td><input type="number" name="sem" id="semester" class="update-form-field" placeholder="Semester" value="<?php echo htmlspecialchars($_SESSION["sem"]); ?>"></td>
                        </tr>

                        <tr>
                            <td>Email: </td>
                            <td><input type="email" name="email" id="email-field" class="update-form-field" placeholder="-" value="<?php echo htmlspecialchars($_SESSION["email"]); ?>"></td>
                        </tr>

                        <tr>
                            <td>Proctor: </td>
                            <td><input type="text" name="email" id="proctor-field" class="update-form-field" placeholder="-" value="<?php echo htmlspecialchars($_SESSION["proctor_name"]); ?>"></td>
                        </tr>

                        <tr>
                            <td>Mother's Name: &nbsp;</td>
                            <td><input type="text" name="m-name" id="m-name-field" class="update-form-field" placeholder="-" value="<?php echo htmlspecialchars($_SESSION["mother-name"]); ?>"></td>
                        </tr>

                        <tr>
                            <td>Father's Name: &nbsp;</td>
                            <td><input type="text" name="f-name" id="f-name-field" class="update-form-field" placeholder="-" value="<?php echo htmlspecialchars($_SESSION["father-name"]); ?>"></td>
                        </tr>

                    </table>
                    <br>                    
                    
                    <!-- <br>
                    <label style="color: black; margin-top: 10px;">
                        <a href="login.php">Already have an account.!</a>
                    </label> -->
                    <a href="student-update.php">
                    <input type="submit" value="Update" id="update-form-submit" style="width: 100px; margin-left:220px">
                    </a>
                    <br>
                    <br>
                
            </div>
            <div class="MuiForm" id="Mui-form" style="color:black; width: 500px; height: 500px; align-items:left;">
                <img src="images/<?php echo htmlspecialchars($_SESSION["profile_pic"]); ?>" alt="Update Profile Picture" style="width:250px;height:300px;border-radius:8px;" />
                <input type="file" name="profile_pic" value="<?php echo htmlspecialchars($_SESSION["profile_pic"]); ?>">
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
        document.getElementById("dept").disabled = true;
        document.getElementById("proctor-field").disabled = true;
      }
  </script>
  </body>
</html>