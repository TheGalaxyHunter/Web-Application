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
    echo $usn;
    $sql = "SELECT `usn`, `student_name`, `student_dob`, `dept_id`, `current_sem`, `proctor_id`, `email`, `mother_name`, `father_name`, `profile_pic`
            from student WHERE usn = '$usn'";
    echo $sql;
            
    if($stmt = $conn -> prepare($sql)){
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Store result
            mysqli_stmt_store_result($stmt);
            
            // Check if username exists, if yes then verify password
            if(mysqli_stmt_num_rows($stmt) == 1){   
                // $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash                 
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $usn, $name, $dob, $dept, $sem, $proctor_id, $email, $m_name, $f_name, $profile_pic);
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
                    
                    // Redirect user to welcome page
                    // header("location: student-profile.php");
                }
            } else{
                // Display an error message if username doesn't exist
                $username_err = "No account found with that username.";
                echo $username_err;
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
    <link href="/static/css/main.086ef52f.chunk.css" rel="stylesheet">
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
          
          <div>
              <div class="text-center" >
                  <div style="margin-top: 20px; font-size: 50px;">PROFILE</div>
                  <hr style="height: 20px">
                  <hr style="height: 1px; background-color: white;">
                  <hr style="height: 20px">
              </div>
              <div class="text-left" style="margin-left: 100px; font-size: 30px;">
                  <p>Name:  &emsp;&emsp;&emsp;&emsp;&nbsp;   <?php echo htmlspecialchars($_SESSION["name"]); ?></p>
                  <p>USN:   &emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;&nbsp;   <?php echo htmlspecialchars($_SESSION["usn"]); ?></p>
                  <p>DOB:   &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;   <?php echo htmlspecialchars($_SESSION["dob"]); ?></p>
                  <p>Department:   &emsp;&nbsp;   <?php echo htmlspecialchars($_SESSION["dept"]); ?></p>
                  <p>Semester:   &emsp;&emsp;&nbsp;&nbsp;   <?php echo htmlspecialchars($_SESSION["sem"]); ?> Sem</p>
                  <p>Proctor:   &emsp;&emsp;&emsp;&nbsp;   <?php echo htmlspecialchars($_SESSION["proctor-id"]); ?></p>
                  <p>Email: &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;   <?php echo htmlspecialchars($_SESSION["email"]); ?></p>
                  <p>Mother's Name: &nbsp;  <?php echo htmlspecialchars($_SESSION["mother-name"]); ?></p>
                  <p>Father's Name: &nbsp;   <?php echo htmlspecialchars($_SESSION["father-name"]); ?></p>
                  <br>
                  <button class="MuiButtonBase-root MuiButton-root MuiButton-text jss5 MuiButton-colorInherit" tabindex="0" type="button">
                        <span class="MuiButton-label-logout"><a href="logout.php">Logout</a></span>
                  </button>
              </div>
          </div>
      </div>
  </div>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</body>
</html>