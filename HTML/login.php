<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === True){
    header("location: home.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["gebruikersnaam"]))){
        $username_err = "<div style=color:red>vul een gebruikersnaam in.</div>";
    } else{
        $username = trim($_POST["gebruikersnaam"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["wachtwoord"]))){
        $password_err = "<div style=color:red>vul een wachtwoord in.</div>";
    } else{
        $password = trim($_POST["wachtwoord"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, gebruikersnaam, wachtwoord FROM gebruikers WHERE gebruikersnaam = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            // Store data in session variables
                            $_SESSION["loggedin"] = True;
                            $_SESSION["id"] = $id;
                            $_SESSION["gebruikersnaam"] = $username;                            
                            
                            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == True){

                                $servername = "localhost";
                                $dbusername = "root";
                                $dbpassword = "";
                                $dbname = "de levensbron gip";
                                $gebruikersnaam=$_SESSION["gebruikersnaam"];
                          
                                // Create connection
                                $mysqli = new mysqli($servername, $dbusername, $dbpassword, $dbname);
                                $result = $mysqli->query("SELECT gebruikersnaam FROM administrators WHERE gebruikersnaam = '$gebruikersnaam'");
                                  if($result->num_rows == 0) {
                                } else {
                                    session_start();
                                    $_SESSION["admin"] = True;
                                }
                                $mysqli->close();
                              }
                          

                            if(!isset($_COOKIE['visited'])) {
                                setcookie("visited", "True", 2147483647);
                            }
                            $time = time();
                            $servername = "localhost";
                            $dbusername = "root";
                            $dbpassword = "";
                            $dbname = "de levensbron gip";

                            // Create connection
                            $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $sql = "INSERT INTO activiteit (gebruikersnaam, id) VALUES ('" . $username . "', '" . $id . "')";

                            if ($conn->query($sql) === TRUE) {
                                echo "New record created successfully";
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                            
                            
                            // Redirect user to welcome page
                            header('Location: ' . $_SERVER['HTTP_REFERER']);
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "<div style=color:red>ongeldige gebruikersnaam of wachtwoord</div>";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "<div style=color:red>ongeldige gebruikersnaam of wachtwoord</div>";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="nl">
<head>
    
    <link rel="stylesheet" href="../CSS/registreren.css">
    <style>
        body{ position: relative; height: 810px;}
    </style>
</head>
<body>
    <div class="container">
        <h2>Inloggen</h2>
        <p>vul de volgende gegevens in om in te loggen.</p><br>

        

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
                <label><b>Gebruikersnaam</b></label>
                <input type="text" name="gebruikersnaam" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
              
                
                <label><b>Wachtwoord</b></label>
                <input type="password" name="wachtwoord" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>

                <?php 
                if(!empty($login_err)){
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }        
                ?>

                <p style="float:right">Nog geen account?</p><br><br><br><br>
                
                <div>
                <input  class="registerbtn" type="submit" value="Inloggen">
                <a class="andereoptieknop" href="./registreren.php">Registreren</a>
                </div>
        </form>
    </div>
</body>
</html>