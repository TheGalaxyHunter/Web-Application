<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    // header("location: login.php");
    // exit;
}
?>

<header class="MuiAppBar-root MuiAppBar-positionSticky MuiAppBar-colorPrimary jss7">
    <div class="MuiToolbar-root MuiToolbar-regular MuiToolbar-gutters">
        
        <?php 
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            echo 
            '<h6 class="MuiTypography-root jss4 MuiTypography-h6">
            <span class="MuiButton-label" style="font-size: 30px"><a href="login.php">PROCTOR DIARY</a></span>
            </h6>
            <button class="MuiButtonBase-root MuiButton-root MuiButton-text jss5 MuiButton-colorInherit" tabindex="0" type="button">
                <span class="MuiButton-label"><a href="login.php">Login</a></span>
            </button>
            <button class="MuiButtonBase-root MuiButton-root MuiButton-text jss5 MuiButton-colorInherit" tabindex="0" type="button">
                <span class="MuiButton-label"><a href="signup.php">Signup</a></span>
            </button>';
        }
        else{
            if(!isset($_SESSION["isStudent"]) || $_SESSION["isStudent"] !== true) {
                echo
                '<h6 class="MuiTypography-root jss4 MuiTypography-h6">
                <span class="MuiButton-label" style="font-size: 30px"><a href="proctor-profile.php">PROCTOR DIARY</a></span>
                </h6>
                <button class="MuiButtonBase-root MuiButton-root MuiButton-text jss5 MuiButton-colorInherit" tabindex="0" type="button">
                <span class="MuiButton-label"><a href="proctor-profile.php">' . htmlspecialchars($_SESSION["proctor-id"]) . '</a></span>
                </button>
                <button class="MuiButtonBase-root MuiButton-root MuiButton-text jss5 MuiButton-colorInherit" tabindex="0" type="button">
                <span class="MuiButton-label"><a href="proctor-students-details.php">Student Details</a></span>
                </button>
                <button class="MuiButtonBase-root MuiButton-root MuiButton-text jss5 MuiButton-colorInherit" tabindex="0" type="button">
                <span class="MuiButton-label"><a href="proctor-students-search.php">Student Search</a></span>
                </button>
                <button class="MuiButtonBase-root MuiButton-root MuiButton-text jss5 MuiButton-colorInherit" tabindex="0" type="button">
                <span class="MuiButton-label"><a href="logout.php">Logout</a></span>
                </button>';
            }
            else {
                echo
                '<h6 class="MuiTypography-root jss4 MuiTypography-h6">
                <span class="MuiButton-label" style="font-size: 30px"><a href="student-profile2.php">PROCTOR DIARY</a></span>
                </h6>
                <button class="MuiButtonBase-root MuiButton-root MuiButton-text jss5 MuiButton-colorInherit" tabindex="0" type="button">
                <span class="MuiButton-label"><a href="student-profile2.php">' . htmlspecialchars($_SESSION["usn"]) . '</a></span>
                </button>
                <button class="MuiButtonBase-root MuiButton-root MuiButton-text jss5 MuiButton-colorInherit" tabindex="0" type="button">
                <span class="MuiButton-label"><a href="student-marks.php">Marks</a></span>
                </button>
                <button class="MuiButtonBase-root MuiButton-root MuiButton-text jss5 MuiButton-colorInherit" tabindex="0" type="button">
                <span class="MuiButton-label"><a href="student-update.php">Update</a></span>
                </button>
                <button class="MuiButtonBase-root MuiButton-root MuiButton-text jss5 MuiButton-colorInherit" tabindex="0" type="button">
                <span class="MuiButton-label"><a href="logout.php">Logout</a></span>
                </button>';
            }
            echo
            '<button class="MuiButtonBase-root MuiButton-root MuiButton-text jss5 MuiButton-colorInherit" tabindex="0" type="button">
            <span class="MuiButton-label"><a>Hi, ' . htmlspecialchars($_SESSION["name"]) . '</a></span>
            </button>';
            // echo
            // '<button class="MuiButtonBase-root MuiButton-root MuiButton-text jss5 MuiButton-colorInherit" tabindex="0" type="button">
            // <span class="MuiButton-label"><a href="logout.php">Hi, ' . htmlspecialchars($_SESSION["name"]) . '</a></span>
            // </button>';
        }
        ?>
        
        
    </div>
</header>