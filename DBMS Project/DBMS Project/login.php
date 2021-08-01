<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: home.php");
//     exit;
// }
 
// Include config file
$_SESSION["loggedin"] = false;
$_SESSION["isStudent"] = false;
require "config.php";
$isStudent = true;
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $isStudent = true;

    if($isStudent) {
        // Check if username is empty
        if(empty(trim($_POST["usn"]))){
            $username_err = "Please enter usn.";
        } else{
            $username = trim($_POST["usn"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Set parameters
            $param_username = $username;
            $param_password = $password;

            // Prepare a select statement
            $sql = "SELECT `usn`, `student_name`, `student_password`
                    from student WHERE usn = '$param_username'";
            
            if($stmt = $conn -> prepare($sql)){
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){   
                        // $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash                 
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $usn, $name, $t_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if($param_password == $t_password){
                                // Password is correct, so start a new session
                                echo "Succesfully logged in!";
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["isStudent"] = true;
                                $_SESSION["name"] = $name;
                                $_SESSION["usn"] = $usn;                          
                                
                                // Redirect user to welcome page
                                header("location: student-profile2.php");
                            } else{
                                // Display an error message if password is not valid
                                $password_err = "The password you entered was not valid.";
                                // echo $password_err;
                            }
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
    }

    else {
        // Check if username is empty
        if(empty(trim($_POST["proctor-id"]))){
            $username_err = "Please enter proctor-id.";
        } else{
            $username = trim($_POST["proctor-id"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Set parameters
            $param_username = $username;
            $param_password = $password;

            // Prepare a select statement
            $sql = "SELECT proctor_id, proctor_name, proctor_password FROM proctor WHERE proctor_id = '$param_username'";
            
            if($stmt = $conn -> prepare($sql)){
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){   
                        // $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash                 
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $proctor_id, $name, $t_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if($param_password == $t_password){
                                // Password is correct, so start a new session
                                echo "Succesfully logged in!";
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["isStudent"] = false;
                                $_SESSION["proctor-id"] = $proctor_id;
                                $_SESSION["name"] = $name;                            
                                
                                // Redirect user to welcome page
                                header("location: proctor-profile.php");
                            } else{
                                // Display an error message if password is not valid
                                $password_err = "The password you entered was not valid.";
                                // echo $password_err;
                            }
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
    <title>Login</title>
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
          
          <div class="login" style="display: grid; justify-items: center; align-items: center;">
            <div class="MuiForm" style="width: 30%; height: 400px">
                <br>
                <h1 id="login-header">Login</h1>
                <div class="erro-msg" style="color: red; font-style: italic;">
                    <p class="help-block"><?php echo $username_err; ?></p>
                    <p class="help-block"><?php echo $password_err; ?></p>
                </div>
              
                <form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <!-- <table style="border:none; float:left;">
                        <tr>
                            <td>
                                <input type="radio" id="proctor" name="isStudent" class="login-form-field" value="0" onclick="selected()">p
                            </td>
                            <td style="color: black; vertical-align:centre;">
                                Proctor &emsp;&emsp;
                            </td>
                            <td>
                                <input type="radio" id="student" name="isStudent" class="login-form-field" value="1"  checked onclick="selected()">s
                            </td>
                            <td style="color: black;">
                                Student
                            </td>
                        </tr>
                    </table> -->
                    <input type="text" name="usn" id="usn-field" class="login-form-field" placeholder="USN" style="width: 450px">
                    <input type="password" name="password" id="password-field" class="login-form-field" placeholder="Password" style="width: 450px">
                    <label style="color: black; margin-top: 10px;">
                        <a href="signup.php">Don't have an account.!</a>
                    </label>
                    <br>
                    <input type="submit" value="Login" id="login-form-submit">
                    <br>
                </form>
            </div>
          </div>
      </div>
  </div>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script>
      <?php $isStudent=true ?>
      selected();

      function selected() {
          var div = document.getElementById("semester");
          var usn_field = document.getElementById("usn-field");
          var ele = document.getElementsByName("isStudent");

          <?php $isStudent=true ?>
            usn_field.setAttribute("name","usn");
            usn_field.placeholder = "USN";

        //   if (ele[0].checked) {
        //        usn_field.setAttribute("name","proctor-id");
        //        usn_field.placeholder = "ID";
        //   } 

        //   else {
        //        usn_field.setAttribute("name","usn");
        //        usn_field.placeholder = "USN";
        //   }
      }
      
  </script>
</body>
</html>