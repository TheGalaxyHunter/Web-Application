<?php
// Include config file
require "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
$isStudent = true;
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $isStudent = true;
    // Validate username
    if($isStudent) {
        if(empty(trim($_POST["usn"]))){
            $username_err = "Please enter a usn.";
        } else{
            // Set parameters
            $param_username = trim($_POST["usn"]);
    
            // Prepare a select statement
            $sql = "SELECT usn FROM student WHERE usn = '$param_username'";
            
            if($stmt = $conn -> prepare($sql)){
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_err = "This usn already exist. Please login";
                    } else{
                        $username = trim($_POST["usn"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Validate password
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Check input errors before inserting in database
        if(empty($username_err) && empty($password_err)){
            // Set parameters
            $name = $_POST["name"];
            $usn = $_POST["usn"];
            $dob = $_POST["dob"];
            $dept_id = $_POST["dept_id"];
            $sem = $_POST["sem"];
            $email = $_POST["email"];
            // $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_password = $password;

            // $records = mysqli_query($conn, "SELECT proctor_id FROM `student` WHERE usn='$usn' and proctor_id is not null;");

            // if(mysqli_num_rows($records) == 1) {
                // Prepare an insert statement
            $sql = "INSERT INTO student(usn, student_name, student_dob, dept_id, current_sem, email, student_password) VALUES ('$usn', '$name', '$dob', '$dept_id', '$sem', '$email', '$password');";
            
            if($stmt = $conn -> prepare($sql)){
                // Bind variables to the prepared statement as parameters
                // mysqli_stmt_bind_param($stmt, "ss",$name, $usn, $age, $email, $param_username, $param_password);
                // $stmt -> bind_param("ss",$name, $usn, $age, $email, $param_username, $param_password);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                header("location: login.php");
                } else{
                    echo "Something went wrong with query. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
            // }
            // else {
            //     $username_err = "Proctor has not added this usn.";
            // }
    
            
        }
    
    }

    else {
        if(empty(trim($_POST["proctor-id"]))){
            $username_err = "Please enter a proctor id.";
        } else{
            // Set parameters
            $param_username = trim($_POST["proctor-id"]);
    
            // Prepare a select statement
            $sql = "SELECT proctor_id FROM proctor WHERE proctor_id = '$param_username'";
            
            if($stmt = $conn -> prepare($sql)){
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_err = "This proctor id already exist. Please login";
                    } else{
                        $username = trim($_POST["proctor-id"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Validate password
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Check input errors before inserting in database
        if(empty($username_err) && empty($password_err)){
            // Set parameters
            $name = $_POST["name"];
            $proctor_id = $_POST["proctor-id"];
            $dob = $_POST["dob"];
            $dept_id = $_POST["dept_id"];
            $email = $_POST["email"];
            $designation = $_POST["designation"];
            // $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_password = $password;
    
            // Prepare an insert statement
            $sql = "INSERT INTO `proctor`(`proctor_id`, `proctor_name`, `dept_id`, `proctor_password`, `email`, `dob`, `designation`) VALUES ('$proctor_id', '$name', '$dept_id', '$password', '$email', '$dob', '$designation');";
             
            if($stmt = $conn -> prepare($sql)){
                // Bind variables to the prepared statement as parameters
                // mysqli_stmt_bind_param($stmt, "ss",$name, $usn, $age, $email, $param_username, $param_password);
                // $stmt -> bind_param("ss",$name, $usn, $age, $email, $param_username, $param_password);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt) == true){
                    // Redirect to login page
                    header("location: login.php");
                } else{
                    echo "Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
    }
    
    // Close connection
    $conn -> close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="About Page of the Website.">
    <title>Signup</title>
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
          
          <div class="signup" style="display: grid; justify-items: center; align-items: center;">
            <div class="MuiForm" id="Mui-form" style="width: 30%">
                <br>
                <h1 id="signup-header">Signup</h1>
                <div class="erro-msg" style="color: red; font-style: italic;">
                    <!-- <p class="help-block">Couldn't signup</p> -->
                    <p class="help-block"><?php echo $username_err; ?></p>
                    <p class="help-block"><?php echo $password_err; ?></p>
                </div>
              
                <form id="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <!-- <table style="border:none; float:left;">
                        <tr>
                            <td>
                                <input type="radio" id="proctor" name="isStudent" class="signup-form-field" value="0" onclick="selected()">Proctor
                            </td>
                            <td style="color: black;">
                                Proctor
                            </td>
                            <td>
                                <input type="radio" id="student" name="isStudent" class="signup-form-field" value="1"  checked onclick="selected()">Student
                            </td>
                            <td style="color: black;">
                                Student
                            </td>
                        </tr>
                    </table> -->
                    
                    <input type="text" name="name" id="name-field" class="signup-form-field" placeholder="Name">
                    <input type="text" name="usn" id="usn-field" class="signup-form-field" placeholder="USN">
                    <input type="date" name="dob" id="dob-field" class="signup-form-field" placeholder="Date of Birth">
                    <select name="dept_id" id="dept" class="signup-form-field" placeholder="Department">
                        <option value="1">CSE</option>
                        <option value="2">ISE</option>
                        <option value="3">ECE</option>
                        <option value="4">AI</option>
                    </select>
                    
                    <select name="sem" id="semester" class="signup-form-field" placeholder="Semester">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    </select>
                   
                    
                    <input type="email" name="email" id="email-field" class="signup-form-field" placeholder="Email-ID">
                    <input type="text" name="designation" id="designation-field" class="signup-form-field" placeholder="Designation">
                    <input type="password" name="password" id="password-field1" class="signup-form-field" placeholder="Password">
                    <input type="password" name="confirm_password" id="password-field2" class="signup-form-field" placeholder="Confirm Password">
                    <br>
                    <label style="color: black; margin-top: 10px;">
                        <a href="login.php">Already have an account.!</a>
                    </label>
                    <br>
                    <input type="submit" value="Signup" id="signup-form-submit" onclick="matchPassword()">
                    <br>
                </form>
            </div>
          </div>
      </div>
  </div>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script>
      var dseg = document.getElementById("designation-field");
      dseg.style.display = "none";
      selected();

      <?php $isStudent=true ?>
      function matchPassword() {  
        var pw1 = document.getElementById("password-field1").value;  
        var pw2 = document.getElementById("password-field2").value;  
        if(pw1 != pw2)  
        {   
            alert("Passwords did not match");  
        }
     }
      function selected() {
          var div = document.getElementById("semester");
          var usn_field = document.getElementById("usn-field");
          var ele = document.getElementsByName("isStudent");

          <?php $isStudent=true ?>
            div.style.display = "block";
            dseg.style.display = "none";
            usn_field.setAttribute("name","usn");
            usn_field.placeholder = "USN";

      }
      
  </script>
</body>
</html>